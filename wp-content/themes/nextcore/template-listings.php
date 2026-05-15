<?php
/**
 * Template Name: İlanlar Tasarımı
 *
 * @package nextcore
 */

get_header();

if ( have_posts() ) {
	the_post();
}

/**
 * @param string $param Query param (without []).
 * @return string[]
 */
$lazhem_listings_slugs_from_request = static function ( $param ) {
	if ( ! isset( $_GET[ $param ] ) ) {
		return array();
	}
	$raw = wp_unslash( $_GET[ $param ] );
	if ( ! is_array( $raw ) ) {
		$raw = array( $raw );
	}
	$out = array();
	foreach ( $raw as $s ) {
		$s = sanitize_title( (string) $s );
		if ( $s !== '' ) {
			$out[] = $s;
		}
	}
	return array_values( array_unique( $out ) );
};

$cats_req    = $lazhem_listings_slugs_from_request( 'listing_cat' );
$regions_req = $lazhem_listings_slugs_from_request( 'listing_region' );
$paged       = isset( $_GET['paged'] ) ? max( 1, absint( wp_unslash( $_GET['paged'] ) ) ) : 1;
$price_max   = isset( $_GET['price_max'] ) ? absint( wp_unslash( $_GET['price_max'] ) ) : 50000;
$price_max   = min( 50000, max( 500, $price_max ) );
// Üst sınır tam 50.000 = filtre yok (tüm fiyatlar).
$apply_price_cap = ( $price_max < 50000 );

$tax_parts = array();
if ( $cats_req !== array() && taxonomy_exists( 'listing_cat' ) ) {
	$tax_parts[] = array(
		'taxonomy' => 'listing_cat',
		'field'    => 'slug',
		'terms'    => $cats_req,
		'operator' => 'IN',
	);
}
if ( $regions_req !== array() && taxonomy_exists( 'listing_region' ) ) {
	$tax_parts[] = array(
		'taxonomy' => 'listing_region',
		'field'    => 'slug',
		'terms'    => $regions_req,
		'operator' => 'IN',
	);
}

$tax_query = array();
if ( $tax_parts !== array() ) {
	$tax_query = count( $tax_parts ) > 1
		? array_merge( array( 'relation' => 'AND' ), $tax_parts )
		: $tax_parts;
}

$listings_args = array(
	'post_type'              => 'tur',
	'post_status'            => 'publish',
	'posts_per_page'         => 18,
	'paged'                  => $paged,
	'orderby'                => 'date',
	'order'                  => 'DESC',
	'no_found_rows'          => false,
	'update_post_meta_cache' => true,
	'update_post_term_cache' => true,
);

if ( $tax_query !== array() ) {
	$listings_args['tax_query'] = $tax_query;
}

if ( $apply_price_cap ) {
	$id_args = array(
		'post_type'              => 'tur',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'fields'                 => 'ids',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);
	if ( $tax_query !== array() ) {
		$id_args['tax_query'] = $tax_query;
	}
	$candidate_ids = get_posts( $id_args );
	$filtered_ids  = array();
	foreach ( $candidate_ids as $post_id ) {
		$data = get_post_meta( $post_id, '_lazhem_listing_data', true );
		$eff  = lazhem_listing_effective_price_tl( $data );
		if ( $eff > 0 && $eff <= (float) $price_max ) {
			$filtered_ids[] = (int) $post_id;
		}
	}
	$listings_args['post__in'] = $filtered_ids !== array() ? $filtered_ids : array( 0 );
	unset( $listings_args['tax_query'] );
}

$listings_q = new WP_Query( $listings_args );

$cat_terms = array();
if ( taxonomy_exists( 'listing_cat' ) ) {
	$cat_terms = get_terms(
		array(
			'taxonomy'   => 'listing_cat',
			'hide_empty' => false,
			'parent'     => 0,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $cat_terms ) ) {
		$cat_terms = array();
	}
	if ( $cat_terms === array() ) {
		$cat_terms = get_terms(
			array(
				'taxonomy'   => 'listing_cat',
				'hide_empty' => false,
				'parent'     => 0,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);
		if ( is_wp_error( $cat_terms ) ) {
			$cat_terms = array();
		}
	}
	if ( $cat_terms === array() ) {
		$cat_terms = get_terms(
			array(
				'taxonomy'   => 'listing_cat',
				'hide_empty' => false,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);
		if ( is_wp_error( $cat_terms ) ) {
			$cat_terms = array();
		}
	}
}

$region_terms = array();
if ( taxonomy_exists( 'listing_region' ) ) {
	$region_terms = get_terms(
		array(
			'taxonomy'   => 'listing_region',
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);
	if ( is_wp_error( $region_terms ) ) {
		$region_terms = array();
	}
	if ( $region_terms === array() ) {
		$region_terms = get_terms(
			array(
				'taxonomy'   => 'listing_region',
				'hide_empty' => false,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);
		if ( is_wp_error( $region_terms ) ) {
			$region_terms = array();
		}
	}
}

$filter_qs   = $_GET;
unset( $filter_qs['paged'] );
$filter_base = empty( $filter_qs ) ? get_permalink() : add_query_arg( $filter_qs, get_permalink() );
if ( strpos( $filter_base, '?' ) !== false ) {
	$pagination_base = $filter_base . '&paged=%#%';
} else {
	$pagination_base = $filter_base . '?paged=%#%';
}

$pagination_html = '';
if ( $listings_q->max_num_pages > 1 ) {
	$pagination_html = paginate_links(
		array(
			'base'      => $pagination_base,
			'format'    => '',
			'total'     => (int) $listings_q->max_num_pages,
			'current'   => $paged,
			'type'      => 'list',
			'prev_text' => '&lsaquo;',
			'next_text' => '&rsaquo;',
		)
	);
}
?>

<div class="listings-page-wrapper">
	<section class="listing-hero">
		<div class="listing-hero__bg"></div>
		<div class="listings-wrap">
			<div class="listing-hero__content">
				<nav class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Anasayfa', 'nextcore' ); ?></a> / <span><?php the_title(); ?></span></nav>
				<h1 class="listing-hero__title"><?php esc_html_e( 'Doğanın Kalbinde', 'nextcore' ); ?> <em><?php esc_html_e( 'Eşsiz', 'nextcore' ); ?></em> <?php esc_html_e( 'Deneyimler', 'nextcore' ); ?></h1>
				<p class="listing-hero__lede"><?php esc_html_e( 'Karadeniz\'in sisli yaylalarından turkuaz göllerine, en konforlu bungalovlardan butik turlara kadar aradığınız her şey burada.', 'nextcore' ); ?></p>
			</div>
		</div>
	</section>

	<main class="listings-main">
		<div class="listings-wrap">
			<div class="listing-grid-layout">
				<aside class="filters-sidebar">
					<form class="listings-filters-form" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
						<div class="filter-sticky-inner">
							<div class="filter-group">
								<h3 class="filter-title">
									<?php esc_html_e( 'Kategori', 'nextcore' ); ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="filter-title__action"><?php esc_html_e( 'Temizle', 'nextcore' ); ?></a>
								</h3>
								<div class="filter-options">
									<?php if ( ! empty( $cat_terms ) ) : ?>
										<?php foreach ( $cat_terms as $term ) : ?>
											<label class="filter-option">
												<input
													type="checkbox"
													name="listing_cat[]"
													value="<?php echo esc_attr( $term->slug ); ?>"
													<?php checked( in_array( $term->slug, $cats_req, true ) ); ?>
													onchange="this.form.submit()"
												>
												<span><?php echo esc_html( $term->name ); ?></span>
											</label>
										<?php endforeach; ?>
									<?php else : ?>
										<p class="filter-empty"><?php esc_html_e( 'Henüz kategori yok.', 'nextcore' ); ?></p>
									<?php endif; ?>
								</div>
							</div>

							<div class="filter-group">
								<h3 class="filter-title">
									<?php esc_html_e( 'Popüler Bölgeler', 'nextcore' ); ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="filter-title__action"><?php esc_html_e( 'Temizle', 'nextcore' ); ?></a>
								</h3>
								<div class="filter-options">
									<?php if ( ! empty( $region_terms ) ) : ?>
										<?php foreach ( $region_terms as $term ) : ?>
											<label class="filter-option">
												<input
													type="checkbox"
													name="listing_region[]"
													value="<?php echo esc_attr( $term->slug ); ?>"
													<?php checked( in_array( $term->slug, $regions_req, true ) ); ?>
													onchange="this.form.submit()"
												>
												<span><?php echo esc_html( $term->name ); ?></span>
											</label>
										<?php endforeach; ?>
									<?php else : ?>
										<p class="filter-empty"><?php esc_html_e( 'Henüz bölge yok.', 'nextcore' ); ?></p>
									<?php endif; ?>
								</div>
							</div>

							<div class="filter-group">
								<h3 class="filter-title"><?php esc_html_e( 'Fiyat Aralığı', 'nextcore' ); ?></h3>
								<div class="price-range-wrap">
									<label class="screen-reader-text" for="listing-price-max"><?php esc_html_e( 'Maksimum fiyat (TL)', 'nextcore' ); ?></label>
									<input
										type="range"
										class="price-slider"
										id="listing-price-max"
										name="price_max"
										min="500"
										max="50000"
										step="500"
										value="<?php echo esc_attr( (string) $price_max ); ?>"
										oninput="(function(el){var t=document.getElementById('priceMaxDisplay');if(t)t.textContent=Number(el.value).toLocaleString('tr-TR');})(this)"
										onchange="this.form.submit()"
									>
									<div class="price-range-meta">
										<span><?php esc_html_e( 'Üst sınır', 'nextcore' ); ?></span>
										<strong>₺<span id="priceMaxDisplay"><?php echo esc_html( number_format_i18n( $price_max, 0 ) ); ?></span></strong>
									</div>
									<div class="price-range-values">
										<span>₺500</span>
										<span>₺50.000+</span>
									</div>
								</div>
							</div>

							<div class="filter-promo">
								<div class="promo-icon">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
									</svg>
								</div>
								<h4><?php esc_html_e( 'Güvenli Rezervasyon', 'nextcore' ); ?></h4>
								<p><?php esc_html_e( 'Lazhem ile yapacağınız tüm rezervasyonlar TÜRSAB güvencesindedir.', 'nextcore' ); ?></p>
							</div>
						</div>
					</form>
				</aside>

				<div class="listing-content">
					<div class="listing-controls">
						<div class="result-count">
							<?php
							echo wp_kses_post(
								sprintf(
									/* translators: %d: result count */
									__( 'Toplam <strong>%d</strong> sonuç listeleniyor', 'nextcore' ),
									(int) $listings_q->found_posts
								)
							);
							?>
						</div>
						<div class="listing-sort">
							<span><?php esc_html_e( 'Sırala:', 'nextcore' ); ?></span>
							<label class="screen-reader-text" for="listing-sort-select"><?php esc_html_e( 'Sıralama', 'nextcore' ); ?></label>
							<select class="sort-select" id="listing-sort-select" disabled aria-disabled="true" title="<?php esc_attr_e( 'Yakında', 'nextcore' ); ?>">
								<option value="recommended"><?php esc_html_e( 'Önerilen', 'nextcore' ); ?></option>
								<option value="price_low"><?php esc_html_e( 'Fiyat (Artan)', 'nextcore' ); ?></option>
								<option value="price_high"><?php esc_html_e( 'Fiyat (Azalan)', 'nextcore' ); ?></option>
								<option value="newest"><?php esc_html_e( 'En Yeniler', 'nextcore' ); ?></option>
							</select>
						</div>
					</div>

					<div class="items-grid">
						<?php
						if ( $listings_q->have_posts() ) :
							while ( $listings_q->have_posts() ) :
								$listings_q->the_post();
								$post_id = get_the_ID();
								$data    = get_post_meta( $post_id, '_lazhem_listing_data', true );
								$data    = is_array( $data ) ? $data : array();
								$price   = isset( $data['regular_price'] ) ? (string) $data['regular_price'] : '';
								$sale    = isset( $data['sale_price'] ) ? (string) $data['sale_price'] : '';
								$loc     = isset( $data['location'] ) ? (string) $data['location'] : '';
								?>
						<a href="<?php the_permalink(); ?>" class="item-card">
							<div class="item-card__img-wrap">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail(
										'medium_large',
										array(
											'class' => 'item-card__img',
											'alt'   => esc_attr( get_the_title() ),
										)
									);
								} else {
									echo '<div class="item-card__img item-card__img--placeholder" role="img" aria-label=""></div>';
								}
								?>
							</div>
							<div class="item-card__content">
								<span class="item-card__type"><?php esc_html_e( 'İlan', 'nextcore' ); ?></span>
								<h3 class="item-card__title"><?php the_title(); ?></h3>
								<div class="item-card__taxonomies">
									<?php
									$cats = get_the_terms( $post_id, 'listing_cat' );
									if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) :
										foreach ( $cats as $cat ) :
											?>
											<span class="item-card__tax-item item-card__tax-item--cat"><?php echo esc_html( $cat->name ); ?></span>
											<?php
										endforeach;
									endif;
									?>
									<?php
									$regs = get_the_terms( $post_id, 'listing_region' );
									if ( ! empty( $regs ) && ! is_wp_error( $regs ) ) :
										foreach ( $regs as $reg ) :
											?>
											<span class="item-card__tax-item item-card__tax-item--reg"><?php echo esc_html( $reg->name ); ?></span>
											<?php
										endforeach;
									endif;
									?>
								</div>
								<div class="item-card__meta">
									<?php if ( $loc !== '' ) : ?>
										<span class="item-card__meta-item">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
											<?php echo esc_html( $loc ); ?>
										</span>
									<?php endif; ?>
								</div>
								<div class="item-card__footer">
									<div class="item-card__price">
										<span class="price-label"><?php esc_html_e( 'Fiyat', 'nextcore' ); ?></span>
										<span class="price-value">
											<?php if ( lazhem_parse_tl_number( $sale ) > 0 ) : ?>
												<small style="text-decoration:line-through;opacity:0.6;font-size:0.7em;"><?php echo esc_html( $price ); ?> ₺</small>
												<?php echo esc_html( $sale ); ?> ₺
											<?php elseif ( lazhem_parse_tl_number( $price ) > 0 ) : ?>
												<?php echo esc_html( $price ); ?> ₺
											<?php else : ?>
												—
											<?php endif; ?>
										</span>
									</div>
									<span class="btn-detail"><?php esc_html_e( 'İncele', 'nextcore' ); ?></span>
								</div>
							</div>
						</a>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							?>
						<p class="listings-no-results"><?php esc_html_e( 'Bu filtrelere uygun ilan bulunamadı.', 'nextcore' ); ?></p>
						<?php endif; ?>
					</div>

					<?php if ( $pagination_html ) : ?>
						<nav class="listings-pagination" aria-label="<?php esc_attr_e( 'Sayfa navigasyonu', 'nextcore' ); ?>">
							<?php echo wp_kses_post( $pagination_html ); ?>
						</nav>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</main>
</div>

<style>
/* ───────────────────────── İLANLAR — tam genişlik + filtreler ───────────────────────── */
:root {
	--hero-h: 380px;
}

.listings-page-wrapper {
	background: var(--paper);
	min-height: 100vh;
	width: 100%;
	overflow-x: hidden;
}

.listings-page-wrapper .listings-wrap {
	max-width: 100%;
	width: 100%;
	margin: 0 auto;
	padding-left: clamp(1rem, 4vw, 3rem);
	padding-right: clamp(1rem, 4vw, 3rem);
	box-sizing: border-box;
}

.listing-hero {
	position: relative;
	height: var(--hero-h);
	background: var(--forest);
	display: flex;
	align-items: center;
	color: #fff;
	overflow: hidden;
	padding-top: 60px;
	width: 100%;
}

.listing-hero__bg {
	position: absolute;
	inset: 0;
	background-image: url('https://images.unsplash.com/photo-1534067783941-51c9c23ecefd?q=80&w=2000&auto=format&fit=crop');
	background-size: cover;
	background-position: center 30%;
	opacity: 0.35;
	filter: saturate(0.8);
}

.listing-hero__bg::after {
	content: '';
	position: absolute;
	inset: 0;
	background: linear-gradient(to bottom, rgba(15, 42, 29, 0.8) 0%, rgba(15, 42, 29, 0.4) 100%);
}

.listing-hero__content {
	position: relative;
	z-index: 5;
	max-width: 800px;
}

.listing-hero .breadcrumb {
	color: var(--gold-light);
	font-size: 0.7rem;
	margin-bottom: 1rem;
	opacity: 0.9;
	text-transform: uppercase;
	letter-spacing: 0.1em;
}

.listing-hero .breadcrumb a {
	color: inherit;
	text-decoration: none;
	border-bottom: 1px solid transparent;
	transition: border-color 0.2s;
}

.listing-hero .breadcrumb a:hover {
	border-bottom-color: rgba(255,255,255,0.5);
}

.listing-hero .breadcrumb span { color: #fff; opacity: 1; }

.listing-hero__title {
	font-family: var(--font-display);
	font-size: clamp(2.2rem, 5vw, 3.2rem);
	line-height: 1.1;
	letter-spacing: -0.02em;
	margin-bottom: 1rem;
}

.listing-hero__title em {
	font-style: italic;
	color: var(--gold-light);
	font-weight: 400;
}

.listing-hero__lede {
	font-size: 1rem;
	line-height: 1.5;
	color: rgba(255,255,255,0.75);
	max-width: 540px;
}

.listings-main {
	width: 100%;
	padding-bottom: 4rem;
}

.listing-grid-layout {
	display: grid;
	grid-template-columns: minmax(260px, 300px) 1fr;
	gap: clamp(1.5rem, 3vw, 4rem);
	padding: 3rem 0 0;
	max-width: 100%;
}

.filters-sidebar { position: relative; }

.filter-sticky-inner {
	position: sticky;
	top: 120px;
}

.filter-group {
	background: #fbfbfb;
	border: 1px solid #eee;
	border-radius: 22px;
	padding: 1.75rem;
	margin-bottom: 1.5rem;
}

.filter-title {
	font-family: var(--font-display);
	font-size: 1.15rem;
	color: var(--forest);
	margin-bottom: 1.5rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 0.75rem;
}

.filter-title__action {
	font-size: 0.7rem;
	font-family: var(--font-body);
	color: var(--gold-deep);
	text-transform: uppercase;
	letter-spacing: 0.05em;
	text-decoration: none;
	font-weight: 600;
	white-space: nowrap;
}

.filter-title__action:hover { text-decoration: underline; }

.filter-options {
	display: flex;
	flex-direction: column;
	gap: 1rem;
}

.filter-empty {
	margin: 0;
	font-size: 0.9rem;
	color: var(--ink-mute);
}

.filter-option {
	display: flex;
	align-items: center;
	gap: 0.8rem;
	cursor: pointer;
	font-size: 0.95rem;
	color: var(--ink-soft);
}

.filter-option input {
	accent-color: var(--sage);
	width: 18px;
	height: 18px;
}

.price-slider {
	width: 100%;
	accent-color: var(--sage);
	margin-top: 0.5rem;
}

.price-range-meta {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-top: 0.75rem;
	font-size: 0.85rem;
	color: var(--ink-soft);
}

.price-range-meta strong {
	font-family: var(--font-display);
	color: var(--forest);
	font-size: 1rem;
}

.price-range-values {
	display: flex;
	justify-content: space-between;
	margin-top: 12px;
	font-size: 0.8rem;
	color: var(--ink-mute);
	font-weight: 500;
}

.filter-promo {
	background: var(--forest);
	color: #fff;
	padding: 2rem;
	border-radius: 24px;
	text-align: center;
	margin-top: 2rem;
	position: relative;
	overflow: hidden;
}

.filter-promo::before {
	content: '';
	position: absolute;
	inset: 0;
	background-image: var(--topo, none);
	background-size: 400px;
	opacity: 0.15;
}

.promo-icon {
	width: 48px;
	height: 48px;
	background: var(--gold);
	color: var(--forest);
	border-radius: 50%;
	display: grid;
	place-items: center;
	margin: 0 auto 1.25rem;
	position: relative;
}

.promo-icon svg { width: 24px; height: 24px; }

.filter-promo h4 {
	font-family: var(--font-display);
	font-size: 1.2rem;
	margin-bottom: 0.5rem;
	position: relative;
}

.filter-promo p {
	font-size: 0.85rem;
	opacity: 0.7;
	line-height: 1.5;
	position: relative;
}

.listing-controls {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 2.5rem;
	padding-bottom: 1rem;
	border-bottom: 1px solid #eee;
	flex-wrap: wrap;
	gap: 1rem;
}

.result-count { font-size: 0.95rem; color: var(--ink-soft); }
.result-count strong { color: var(--forest); }

.listing-sort {
	display: flex;
	align-items: center;
	gap: 1rem;
	font-size: 0.9rem;
	color: var(--ink-mute);
}

.sort-select {
	border: 0;
	background: #f4f4f4;
	padding: 0.6rem 1.25rem;
	border-radius: 100px;
	font-weight: 500;
	color: var(--forest);
	opacity: 0.6;
}

.items-grid {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
	gap: 2rem;
}

@media (min-width: 1100px) {
	.listing-grid-layout .items-grid {
		grid-template-columns: repeat(3, 1fr);
	}
}

.listings-no-results {
	grid-column: 1 / -1;
	margin: 0;
	padding: 2rem 0;
	text-align: center;
	color: var(--ink-mute);
}

.item-card {
	background: #fff;
	border: 1px solid #eee;
	border-radius: 24px;
	overflow: hidden;
	display: flex;
	flex-direction: column;
	transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
	text-decoration: none;
	color: inherit;
	position: relative;
	width: 100%;
}

.item-card:hover {
	transform: translateY(-8px);
	box-shadow: 0 20px 40px rgba(15, 42, 29, 0.08);
	border-color: var(--gold-light);
}

.item-card__img-wrap {
	position: relative;
	aspect-ratio: 16/10;
	overflow: hidden;
	background: #f4f4f4;
}

.item-card__img {
	width: 100%;
	height: 100%;
	object-fit: cover;
	display: block;
}

.item-card__img--placeholder {
	background: linear-gradient(135deg, #e8e8e8, #f5f5f5);
}

.item-card__content {
	padding: 1.25rem;
	display: flex;
	flex-direction: column;
	flex-grow: 1;
}

.item-card__type {
	font-size: 0.7rem;
	color: var(--gold-deep);
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 0.1em;
	margin-bottom: 0.5rem;
}

.item-card__title {
	font-family: var(--font-display);
	font-size: 1.15rem;
	color: var(--forest);
	line-height: 1.3;
	margin-bottom: 0.75rem;
}

.item-card__taxonomies {
	display: flex;
	flex-wrap: wrap;
	gap: 6px;
	margin-bottom: 0.5rem;
}

.item-card__tax-item {
	font-size: 0.7rem;
	padding: 3px 10px;
	border-radius: 100px;
	font-weight: 600;
	text-transform: uppercase;
	letter-spacing: 0.02em;
}

.item-card__tax-item--cat {
	background: rgba(15, 42, 29, 0.08);
	color: var(--forest);
}

.item-card__tax-item--reg {
	background: rgba(201, 169, 97, 0.12);
	color: var(--gold-deep);
}

.item-card__meta {
	display: flex;
	flex-wrap: wrap;
	gap: 0.8rem;
	margin-bottom: 0.75rem;
}

.item-card__meta-item {
	display: flex;
	align-items: center;
	gap: 0.4rem;
	font-size: 0.8rem;
	color: var(--ink-mute);
}

.item-card__meta-item svg {
	width: 16px !important;
	height: 16px !important;
	min-width: 16px;
	color: var(--sage);
	opacity: 0.8;
}

.item-card__footer {
	margin-top: auto;
	padding-top: 0.75rem;
	border-top: 1px solid #f0f0f0;
	display: flex;
	align-items: center;
	justify-content: space-between;
}

.item-card__price {
	display: flex;
	flex-direction: column;
}

.price-label {
	font-size: 0.65rem;
	color: var(--ink-mute);
}

.price-value {
	font-family: var(--font-display);
	font-size: 1.2rem;
	color: var(--forest);
	font-weight: 600;
}

.btn-detail {
	padding: 0.6rem 1.2rem;
	background: var(--forest);
	color: #fff;
	border-radius: 100px;
	font-size: 0.85rem;
	font-weight: 500;
	transition: background 0.3s;
}

.item-card:hover .btn-detail { background: var(--sage); }

.listings-pagination {
	margin-top: 2.5rem;
	display: flex;
	justify-content: center;
}
.listings-pagination ul.page-numbers {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: center;
	gap: 0.5rem;
}
.listings-pagination ul.page-numbers li {
	display: flex;
}
.listings-pagination ul.page-numbers li .page-numbers {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 44px;
	height: 44px;
	font-family: var(--font-body);
	font-size: 1rem;
	font-weight: 500;
	color: var(--forest);
	text-decoration: none;
	border-radius: 50%;
	background: rgba(15, 42, 29, 0.04);
	border: 1px solid transparent;
	transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.listings-pagination ul.page-numbers li a.page-numbers:hover {
	background: var(--forest);
	color: var(--paper);
	transform: translateY(-2px);
	box-shadow: 0 6px 16px rgba(15, 42, 29, 0.15);
}
.listings-pagination ul.page-numbers li .page-numbers.current {
	background: var(--forest-deep);
	color: var(--gold-light);
	font-weight: 600;
	box-shadow: 0 4px 12px rgba(15, 42, 29, 0.2);
}
.listings-pagination ul.page-numbers li .page-numbers.dots {
	background: transparent;
	color: var(--ink);
	opacity: 0.5;
	width: auto;
	min-width: 24px;
	box-shadow: none;
	pointer-events: none;
}
.listings-pagination ul.page-numbers li .prev.page-numbers,
.listings-pagination ul.page-numbers li .next.page-numbers {
	font-size: 1.5rem;
	line-height: 1;
	padding-bottom: 2px;
}

@media (max-width: 1024px) {
	.listing-grid-layout { grid-template-columns: 1fr; }
	.filters-sidebar { display: none; }
	.listing-hero { height: auto; padding: 120px 0 100px; }
}
</style>

<?php
get_footer();
