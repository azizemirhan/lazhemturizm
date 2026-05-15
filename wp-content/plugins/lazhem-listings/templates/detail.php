<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();

$post_id  = get_the_ID();
$data     = get_post_meta( $post_id, '_lazhem_listing_data', true );
$data     = is_array( $data ) ? $data : array();

$title       = get_the_title();
$base_v_name = $data['base_variation_name'] ?? 'Genel Bilgi';
$short_desc  = $data['short_desc'] ?? '';
$regular     = $data['regular_price'] ?? '';
$sale        = $data['sale_price'] ?? '';
$wa_base_url = function_exists('lazhem_nc') ? lazhem_nc( 'header_whatsapp_url', 'https://wa.me/904640000000' ) : 'https://wa.me/904640000000';
$wa_clean_url = strtok($wa_base_url, '?'); // Get base link without parameters

$gallery_ids = ! empty( $data['main_gallery'] ) ? array_filter( array_map( 'absint', explode( ',', $data['main_gallery'] ) ) ) : array();
$sections    = ! empty( $data['sections'] ) && is_array( $data['sections'] ) ? $data['sections'] : array();
$variations  = ! empty( $data['variations'] ) && is_array( $data['variations'] ) ? $data['variations'] : array();

$wa_url = Lazhem_Utils::get_whatsapp_url( $post_id );

// Taxonomies
$cats    = get_the_terms( $post_id, 'listing_cat' );
$regions = get_the_terms( $post_id, 'listing_region' );
$tags    = get_the_terms( $post_id, 'listing_tag' );

// Build gallery array
$feat_id = get_post_thumbnail_id( $post_id );
$all_images = array();
if ( $feat_id ) { $all_images[] = $feat_id; }
foreach ( $gallery_ids as $gid ) {
	if ( $gid && $gid !== $feat_id ) { $all_images[] = $gid; }
}

// Prepare data for JS
$original_data = array(
	'name'       => $base_v_name,
	'price'      => $sale ? '₺' . number_format_i18n((float)$sale, 0) : ($regular ? '₺' . number_format_i18n((float)$regular, 0) : 'Fiyat için iletişime geçin'),
	'old_price'  => $sale ? '₺' . number_format_i18n((float)$regular, 0) : '',
	'gallery'    => array(),
	'sections'   => $sections
);
$original_data['wa'] = $wa_clean_url . '?text=' . urlencode('Merhaba, ' . $title . ' (' . $base_v_name . ') ilanı hakkında bilgi almak istiyorum.');


foreach ($all_images as $img_id) {
	$original_data['gallery'][] = array(
		'id'    => $img_id,
		'thumb' => wp_get_attachment_image_url($img_id, 'thumbnail'),
		'full'  => wp_get_attachment_image_url($img_id, 'large')
	);
}

$prep_variations = array();
foreach ($variations as $idx => $v) {
	$v_gallery_ids = !empty($v['gallery']) ? explode(',', $v['gallery']) : array();
	$v_gallery = array();
	foreach ($v_gallery_ids as $v_gid) {
		$v_gallery[] = array(
			'id'    => $v_gid,
			'thumb' => wp_get_attachment_image_url($v_gid, 'thumbnail'),
			'full'  => wp_get_attachment_image_url($v_gid, 'large')
		);
	}
	
	$v_name = $v['name'] ?? '';
	$prep_variations[$idx] = array(
		'name'       => $v_name,
		'price'      => $v['price'] ? '₺' . number_format_i18n((float)$v['price'], 0) : $original_data['price'],
		'gallery'    => !empty($v_gallery) ? $v_gallery : $original_data['gallery'],
		'sections'   => !empty($v['sections']) ? $v['sections'] : $original_data['sections']
	);
	$prep_variations[$idx]['wa'] = $wa_clean_url . '?text=' . urlencode('Merhaba, ' . $title . ' (' . $v_name . ') ilanı hakkında bilgi almak istiyorum.');
}

// Add original as index 'base'
$prep_variations['base'] = $original_data;

if ( isset( $_GET['lazhem_msg'] ) ) {
	$msg_key = sanitize_text_field( wp_unslash( $_GET['lazhem_msg'] ) );
	if ( 'success' === $msg_key ) {
		echo '<div class="lazhem-notice success">' . esc_html( Lazhem_Utils::get_option( 'thanks_message', 'Teşekkürler. Talebiniz alındı.' ) ) . '</div>';
	} elseif ( 'invalid' === $msg_key ) {
		echo '<div class="lazhem-notice error">Lütfen zorunlu alanları ve KVKK onayını kontrol edin.</div>';
	}
}
?>

<main class="lazhem-detail">
	<div class="lazhem-wrap">

		<!-- Breadcrumb -->
		<nav class="lazhem-breadcrumb" aria-label="Bilgi yolu">
			<a href="<?php echo esc_url( home_url() ); ?>">Anasayfa</a>
			<svg viewBox="0 0 12 12" fill="none"><path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'tur' ) ); ?>">İlanlar</a>
			<?php if ( ! empty( $regions ) && ! is_wp_error( $regions ) && isset( $regions[0] ) ) : ?>
				<svg viewBox="0 0 12 12" fill="none"><path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
				<a href="<?php echo esc_url( get_term_link( $regions[0] ) ); ?>"><?php echo esc_html( $regions[0]->name ); ?></a>
			<?php endif; ?>
			<svg viewBox="0 0 12 12" fill="none"><path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
			<span class="lazhem-breadcrumb__current"><?php echo esc_html( $title ); ?></span>
		</nav>

		<!-- Product Layout -->
		<div class="lazhem-layout">

			<!-- LEFT: Gallery -->
			<div class="lazhem-gallery">
				<?php $main_url = $feat_id ? wp_get_attachment_image_url( $feat_id, 'large' ) : ''; ?>
				<div class="lazhem-gallery__stage" id="galleryStage">
					<?php if ( $main_url ) : ?>
						<img id="galleryMain" src="<?php echo esc_url( $main_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" onclick="document.getElementById('lazhemLightbox').showModal()">
					<?php else : ?>
						<div style="width:100%;height:100%;display:grid;place-items:center;background:#ebe3cf;color:var(--gold-deep);">
							<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
						</div>
					<?php endif; ?>

					<div class="lazhem-gallery__nav">
						<button type="button" class="lazhem-gallery__arrow prev" onclick="lazhemCycleImg(-1)">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
						</button>
						<button type="button" class="lazhem-gallery__arrow next" onclick="lazhemCycleImg(1)">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
						</button>
					</div>
				</div>

				<?php if ( count( $all_images ) > 1 ) : ?>
				<div class="lazhem-gallery__thumbs">
					<?php foreach ( $all_images as $idx => $img_id ) :
						$thumb = wp_get_attachment_image_url( $img_id, 'thumbnail' );
						$full  = wp_get_attachment_image_url( $img_id, 'large' );
						if ( ! $thumb || ! $full ) continue;
					?>
					<button type="button" class="lazhem-gallery__thumb <?php echo $idx === 0 ? 'is-active' : ''; ?>"
						data-full="<?php echo esc_url( $full ); ?>"
						onclick="lazhemSetImg(<?php echo $idx; ?>)">
						<img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
					</button>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>

			<!-- RIGHT: Product Info -->
			<div class="lazhem-info">

				<!-- Title -->
				<h1 class="lazhem-info__title"><?php echo esc_html( $title ); ?></h1>

				<!-- Meta -->
				<div class="lazhem-info__meta">
					<?php if ( ! empty( $regions ) && ! is_wp_error( $regions ) && isset( $regions[0] ) ) : ?>
					<span class="lazhem-info__meta-item">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
						<?php echo esc_html( $regions[0]->name ); ?>
					</span>
					<?php endif; ?>
					<?php if ( ! empty( $cats ) && ! is_wp_error( $cats ) && isset( $cats[0] ) ) : ?>
					<span class="lazhem-info__meta-divider"></span>
					<span class="lazhem-info__meta-item">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
						<?php echo esc_html( $cats[0]->name ); ?>
					</span>
					<?php endif; ?>
				</div>

				<!-- Price -->
				<div class="lazhem-price-block">
					<?php if ( $sale ) : ?>
						<span class="lazhem-price-block__current">₺<?php echo esc_html( number_format_i18n( (float) $sale, 0 ) ); ?></span>
						<span class="lazhem-price-block__old">₺<?php echo esc_html( number_format_i18n( (float) $regular, 0 ) ); ?></span>
						<span class="lazhem-price-block__tag">İndirimli</span>
					<?php elseif ( $regular ) : ?>
						<span class="lazhem-price-block__current">₺<?php echo esc_html( number_format_i18n( (float) $regular, 0 ) ); ?></span>
					<?php else : ?>
						<span class="lazhem-price-block__current" style="font-size:1.2rem;">Fiyat için iletişime geçin</span>
					<?php endif; ?>
				</div>

				<!-- Short description -->
				<?php if ( $short_desc ) : ?>
				<p class="lazhem-lead"><?php echo esc_html( $short_desc ); ?></p>
				<?php endif; ?>

				<!-- Variations -->
				<?php if ( ! empty( $variations ) ) : ?>
				<div class="lazhem-var-group">
					<span class="lazhem-var-group__label">Varyasyon Seçin</span>
					<div class="lazhem-var-options">
						<!-- Base Variation -->
						<button type="button" class="lazhem-var-chip is-active"
							data-index="base"
							onclick="lazhemSwitchVar(this)">
							<?php echo esc_html( $base_v_name ); ?>
							<span class="lazhem-var-chip__price"><?php echo $original_data['price']; ?></span>
						</button>

						<?php foreach ( $variations as $idx => $v ) :
							$v_name  = $v['name'] ?? '';
							$v_price = $v['price'] ?? '';
						?>
						<button type="button" class="lazhem-var-chip"
							data-index="<?php echo $idx; ?>"
							onclick="lazhemSwitchVar(this)">
							<?php echo esc_html( $v_name ); ?>
							<?php if ( $v_price ) : ?>
							<span class="lazhem-var-chip__price">₺<?php echo esc_html( number_format_i18n( (float) $v_price, 0 ) ); ?></span>
							<?php endif; ?>
						</button>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="lazhem-cta-box" style="margin-top: 1.5rem;">
					<a href="<?php echo esc_url($original_data['wa']); ?>" id="lazhemWaBtn" class="lazhem-btn lazhem-btn--wa" target="_blank" rel="noopener noreferrer">
						<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.185-.573c.948.517 1.862.887 3.145.887 3.181 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.766-5.767-5.766zm3.375 8.203c-.144.406-.833.784-1.147.821-.314.037-.67-.144-1.07-.301-1.203-.49-2.096-1.458-2.635-2.278-.54-.82-.901-1.776-.901-2.803 0-1.027.54-1.586.738-1.784.199-.199.535-.25.77-.25s.471.01.674.01c.203 0 .471-.074.738.582s.912 2.215.992 2.378c.079.162.131.351.025.562-.105.212-.158.351-.314.535-.157.185-.333.41-.471.55s-.301.296-.131.591c.17.296.753 1.24 1.62 2.012.724.644 1.333.844 1.656.977.323.133.512.111.701-.111s.813-.948.924-1.27c.111-.323.221-.274.369-.162s.948.448 1.111.53c.162.083.274.12.314.19.04.07.04.406-.104.812zM12 2C6.477 2 2 6.477 2 12c0 1.891.528 3.655 1.446 5.161L2 22l4.99-.1.01-.01c1.512.879 3.244 1.39 5.1 1.39 5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
						WhatsApp Rezervasyon
					</a>
				</div>
				<?php endif; ?>

				<!-- CTA -->
				<div class="lazhem-cta-row">
					<?php if ( $wa_url ) : ?>
					<a href="<?php echo esc_url( $wa_url ); ?>" class="lazhem-btn lazhem-btn--whats" target="_blank" rel="noopener noreferrer">
						<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
						WhatsApp'tan Bilgi Al
					</a>
					<?php endif; ?>
				</div>

				<!-- Trust -->
				<div class="lazhem-trust">
					<span class="lazhem-trust__item">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
						Ücretsiz iptal
					</span>
					<span class="lazhem-trust__item">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
						Güvenli rezervasyon
					</span>
				</div>

				<!-- Tabs -->
				<div class="lazhem-tabs" role="tablist">
					<button type="button" class="lazhem-tabs__btn is-active" data-tab="tab-desc">Açıklama</button>
					<?php if ( ! empty( $sections ) ) : ?>
					<button type="button" class="lazhem-tabs__btn" data-tab="tab-info">Önemli Bilgiler</button>
					<?php endif; ?>
				</div>

				<div class="lazhem-tab-panels">
					<!-- Tab: Description -->
					<div id="tab-desc" class="lazhem-tab-panel is-active">
						<div class="desc">
							<?php if ( get_the_content() ) : ?>
								<?php echo wp_kses_post( apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) ) ); ?>
							<?php else : ?>
								<p>Detaylı açıklama yakında eklenecek.</p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Tab: Sections -->
					<?php if ( ! empty( $sections ) ) : ?>
					<div id="tab-info" class="lazhem-tab-panel">
						<div class="lazhem-accordion">
							<?php foreach ( $sections as $s ) : ?>
							<div class="lazhem-acc">
								<button type="button" class="lazhem-acc__toggle" aria-expanded="false">
									<?php echo esc_html( $s['title'] ?? '' ); ?>
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
								</button>
								<div class="lazhem-acc__body"><div>
									<div class="lazhem-acc__content">
										<?php echo wp_kses_post( $s['content'] ?? '' ); ?>
									</div>
								</div></div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>

				</div>

				<!-- Tags -->
				<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
				<div class="lazhem-tags">
					<?php foreach ( $tags as $t ) : ?>
					<span class="lazhem-tag">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
						<?php echo esc_html( $t->name ); ?>
					</span>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- Related items -->
	<?php
	$related = new WP_Query( array(
		'post_type'      => 'tur',
		'posts_per_page' => 4,
		'post__not_in'   => array( $post_id ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'listing_region',
				'field'    => 'slug',
				'terms'    => $regions && ! is_wp_error( $regions ) ? wp_list_pluck( $regions, 'slug' ) : array(),
			),
		),
	) );
	?>
	<?php if ( $related->have_posts() ) : ?>
	<section class="lazhem-related lazhem-wrap">
		<div class="lazhem-related__head">
			<h2>Benzer <em>İlanlar</em></h2>
		</div>
		<div class="lazhem-related__grid">
			<?php while ( $related->have_posts() ) : $related->the_post();
				$r_id    = get_the_ID();
				$r_data  = get_post_meta( $r_id, '_lazhem_listing_data', true );
				$r_price = $r_data['sale_price'] ?? ( $r_data['regular_price'] ?? '' );
				$r_regular_price = $r_data['regular_price'] ?? '';
				$r_region = get_the_terms( $r_id, 'listing_region' );
				$r_cats   = get_the_terms( $r_id, 'listing_category' );
			?>
			<a href="<?php the_permalink(); ?>" class="item-card">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="item-card__img-wrap">
					<img src="<?php echo esc_url( get_the_post_thumbnail_url( $r_id, 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="item-card__img">
				</div>
				<?php endif; ?>
				<div class="item-card__content">
					<span class="item-card__type">İLAN</span>
					<h2 class="item-card__title"><?php the_title(); ?></h2>
					<div class="item-card__pills">
						<?php 
						if ( $r_cats && ! is_wp_error( $r_cats ) ) {
							foreach( $r_cats as $cat ) {
								echo '<span class="item-card__pill">' . esc_html( mb_strtoupper( $cat->name, 'UTF-8' ) ) . '</span>';
							}
						}
						if ( $r_region && ! is_wp_error( $r_region ) ) {
							foreach( $r_region as $reg ) {
								echo '<span class="item-card__pill">' . esc_html( mb_strtoupper( $reg->name, 'UTF-8' ) ) . '</span>';
							}
						}
						?>
					</div>
					<div class="item-card__footer">
						<div class="item-card__price">
							<span class="price-label">Fiyat</span>
							<div>
								<?php if ( ! empty( $r_regular_price ) && $r_regular_price > $r_price ) : ?>
								<span class="price-old"><?php echo esc_html( number_format_i18n( (float) $r_regular_price, 0 ) ); ?> ₺</span>
								<?php endif; ?>
								<?php if ( $r_price ) : ?>
								<span class="price-value"><?php echo esc_html( number_format_i18n( (float) $r_price, 0 ) ); ?> ₺</span>
								<?php endif; ?>
							</div>
						</div>
						<div class="item-card__actions">
							<div class="btn-detail">İncele</div>
						</div>
					</div>
				</div>
			</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</section>
	<?php endif; ?>

</main>

<!-- Lightbox -->
<dialog id="lazhemLightbox" style="border:none;border-radius:20px;padding:0;max-width:90vw;max-height:90vh;background:transparent;">
	<div style="position:relative;background:#0f2a1d;border-radius:20px;padding:1rem;">
		<button type="button" onclick="document.getElementById('lazhemLightbox').close()" style="position:absolute;top:12px;right:12px;z-index:10;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.15);color:#fff;display:grid;place-items:center;cursor:pointer;border:none;">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
		</button>
		<div class="lightbox-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:10px;max-height:80vh;overflow-y:auto;padding:1rem;">
			<?php foreach ( $all_images as $img_id ) :
				$gurl = wp_get_attachment_image_url( $img_id, 'medium' );
				if ( ! $gurl ) continue;
			?>
			<img src="<?php echo esc_url( $gurl ); ?>" alt="" style="width:100%;height:180px;object-fit:cover;border-radius:12px;cursor:pointer;transition:transform .3s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
			<?php endforeach; ?>
		</div>
	</div>
</dialog>

<script>
(function() {
	// Tabs
	document.querySelectorAll('.lazhem-tabs__btn').forEach(function(btn) {
		btn.addEventListener('click', function() {
			var tabId = this.dataset.tab;
			// buttons
			this.closest('.lazhem-tabs').querySelectorAll('.lazhem-tabs__btn').forEach(function(b) { b.classList.remove('is-active'); });
			this.classList.add('is-active');
			// panels
			this.closest('.lazhem-info').querySelectorAll('.lazhem-tab-panel').forEach(function(p) { p.classList.remove('is-active'); });
			document.getElementById(tabId).classList.add('is-active');
		});
	});

	// Accordion
	document.querySelectorAll('.lazhem-acc__toggle').forEach(function(btn) {
		btn.addEventListener('click', function() {
			var parent = this.closest('.lazhem-acc');
			var wasOpen = parent.classList.contains('is-open');
			var siblings = parent.parentElement.querySelectorAll('.lazhem-acc');
			siblings.forEach(function(s) { s.classList.remove('is-open'); s.querySelector('.lazhem-acc__toggle').setAttribute('aria-expanded','false'); });
			if (!wasOpen) {
				parent.classList.add('is-open');
				this.setAttribute('aria-expanded','true');
			}
		});
	});

	// Variation Switching
	window.lazhemVariations = <?php echo wp_json_encode($prep_variations); ?>;
	window.lazhemOriginal = <?php echo wp_json_encode($original_data); ?>;
	window.currentGallery = window.lazhemOriginal.gallery;
	window.currentImgIdx = 0;

	window.lazhemCycleImg = function(dir) {
		if (!window.currentGallery || window.currentGallery.length <= 1) return;
		window.lazhemSetImg((window.currentImgIdx + dir + window.currentGallery.length) % window.currentGallery.length);
	};

	window.lazhemSetImg = function(index) {
		window.currentImgIdx = index;
		var img = window.currentGallery[window.currentImgIdx];
		
		var stage = document.getElementById('galleryMain');
		if (stage) {
			stage.style.opacity = '0';
			setTimeout(function() {
				stage.src = img.full;
				stage.style.opacity = '1';
			}, 200);
		}

		// Update thumb active state
		var thumbs = document.querySelectorAll('.lazhem-gallery__thumb');
		thumbs.forEach(function(t, i) {
			if (i === window.currentImgIdx) t.classList.add('is-active');
			else t.classList.remove('is-active');
		});
	};

	window.lazhemSwitchVar = function(btn) {
		var index = btn.dataset.index;
		var data = window.lazhemVariations[index];
		window.currentGallery = data.gallery;
		window.currentImgIdx = 0;
		
		// Active state
		btn.parentElement.querySelectorAll('.lazhem-var-chip').forEach(function(c) { c.classList.remove('is-active'); });
		btn.classList.add('is-active');

		// 1. Price
		var priceBlock = document.querySelector('.lazhem-price-block');
		if (priceBlock) {
			var html = '<span class="lazhem-price-block__current">' + data.price + '</span>';
			if (data.old_price) {
				html += ' <span class="lazhem-price-block__old">' + data.old_price + '</span>';
				html += ' <span class="lazhem-price-block__tag">İndirimli</span>';
			}
			priceBlock.innerHTML = html;
		}

		// 1.1 WhatsApp
		var waBtn = document.getElementById('lazhemWaBtn');
		if (waBtn) {
			waBtn.href = data.wa;
		}

		// 2. Gallery
		var stage = document.getElementById('galleryMain');
		var thumbContainer = document.querySelector('.lazhem-gallery__thumbs');
		var lightboxGrid = document.querySelector('#lazhemLightbox .lightbox-grid');
		
		if (data.gallery.length > 0) {
			if (stage) stage.src = data.gallery[0].full;
			
			if (thumbContainer) {
				var thumbHtml = '';
				data.gallery.forEach(function(img, i) {
					var activeClass = (i === 0) ? 'is-active' : '';
					thumbHtml += '<button type="button" class="lazhem-gallery__thumb ' + activeClass + '" data-full="' + img.full + '" onclick="lazhemSetImg(' + i + ')">';
					thumbHtml += '<img src="' + img.thumb + '" alt="" loading="lazy"></button>';
				});
				thumbContainer.innerHTML = thumbHtml;
			}

			if (lightboxGrid) {
				var lbHtml = '';
				data.gallery.forEach(function(img) {
					lbHtml += '<img src="' + img.full + '" alt="" style="width:100%;height:180px;object-fit:cover;border-radius:12px;cursor:pointer;transition:transform .3s;" onmouseover="this.style.transform=\'scale(1.03)\'" onmouseout="this.style.transform=\'scale(1)\'">';
				});
				lightboxGrid.innerHTML = lbHtml;
			}
		}

		// 3. Sections
		var accordion = document.querySelector('.lazhem-accordion');
		if (accordion && data.sections) {
			var accHtml = '';
			data.sections.forEach(function(s) {
				accHtml += '<div class="lazhem-acc">';
				accHtml += '<button type="button" class="lazhem-acc__toggle" aria-expanded="false">' + s.title;
				accHtml += '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></button>';
				accHtml += '<div class="lazhem-acc__body"><div><div class="lazhem-acc__content">' + s.content + '</div></div></div></div>';
			});
			accordion.innerHTML = accHtml;
			
			// Re-attach accordion events
			accordion.querySelectorAll('.lazhem-acc__toggle').forEach(function(btn) {
				btn.addEventListener('click', function() {
					var parent = this.closest('.lazhem-acc');
					var wasOpen = parent.classList.contains('is-open');
					var siblings = parent.parentElement.querySelectorAll('.lazhem-acc');
					siblings.forEach(function(s) { s.classList.remove('is-open'); s.querySelector('.lazhem-acc__toggle').setAttribute('aria-expanded','false'); });
					if (!wasOpen) {
						parent.classList.add('is-open');
						this.setAttribute('aria-expanded','true');
					}
				});
			});
		}
	};

	// Trigger first variation if exists
	var firstVar = document.querySelector('.lazhem-var-chip.is-active');
	if (firstVar) {
		window.lazhemSwitchVar(firstVar);
	}
})();
</script>

<?php get_footer(); ?>
