<?php
/**
 * Template Name: Bölgeler Tasarımı
 *
 * @package nextcore
 */

get_header();

if ( have_posts() ) {
	the_post();
}

$t = get_template_directory_uri();

$per_page = 16; // 4 sütun × 4 satır
$paged    = isset( $_GET['bolge_pg'] ) ? max( 1, absint( wp_unslash( $_GET['bolge_pg'] ) ) ) : 1;

$regions_for_cards = array();
$total_terms       = 0;

if ( taxonomy_exists( 'listing_region' ) ) {
	$total_terms = (int) wp_count_terms(
		array(
			'taxonomy'   => 'listing_region',
			'hide_empty' => false,
		)
	);
	if ( is_wp_error( $total_terms ) ) {
		$total_terms = 0;
	}

	$term_args = array(
		'taxonomy'   => 'listing_region',
		'hide_empty' => false,
		'number'     => $per_page,
		'offset'     => ( $paged - 1 ) * $per_page,
		'orderby'    => 'name',
		'order'      => 'ASC',
	);

	$terms = get_terms( $term_args );
	if ( ! is_wp_error( $terms ) && is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			if ( class_exists( 'Lazhem_Utils' ) ) {
				$card = Lazhem_Utils::get_listing_region_card( $term );
			} else {
				$link = get_term_link( $term );
				$desc = isset( $term->description ) ? (string) $term->description : '';
				$card = array(
					'title'     => $term->name,
					'subtitle'  => $desc !== '' ? wp_strip_all_tags( $desc ) : '',
					'image_url' => '',
					'url'       => is_wp_error( $link ) ? '' : (string) $link,
				);
			}
			if ( $card ) {
				$regions_for_cards[] = $card;
			}
		}
	}
}

$total_pages = $total_terms > 0 ? (int) ceil( $total_terms / $per_page ) : 1;

$permalink = get_permalink();
if ( $permalink && false === strpos( $permalink, '?' ) ) {
	$pagination_base = $permalink . '?bolge_pg=%#%';
} elseif ( $permalink ) {
	$pagination_base = $permalink . '&bolge_pg=%#%';
} else {
	$pagination_base = '';
}

$pagination_html = '';
if ( $pagination_base && $total_pages > 1 ) {
	$pagination_html = paginate_links(
		array(
			'base'      => $pagination_base,
			'format'    => '',
			'total'     => $total_pages,
			'current'   => $paged,
			'type'      => 'list',
			'mid_size'  => 2,
			'prev_text' => '&lsaquo;',
			'next_text' => '&rsaquo;',
		)
	);
}
?>

<main class="regions-page">
	<section class="regions-hero">
		<div class="regions-hero__inner">
			<nav class="regions-breadcrumb" aria-label="<?php esc_attr_e( 'İçerik konumu', 'nextcore' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Anasayfa', 'nextcore' ); ?></a>
				<span class="regions-breadcrumb__sep">/</span>
				<span><?php the_title(); ?></span>
			</nav>
			<span class="eyebrow regions-hero__eyebrow"><?php esc_html_e( 'Destinasyonlar', 'nextcore' ); ?></span>
			<h1 class="regions-hero__title"><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Bölgeler', 'nextcore' ) ); ?></h1>
			<p class="regions-hero__lede">
				<?php esc_html_e( 'Rize’den Artvin’e, Trabzon’dan sahiline: yaylalar, göller, çay bahçeleri ve tarih rotaları tek bir haritada buluşuyor. Aşağıdan bölgeyi seçin, rotanızı birlikte kuralım.', 'nextcore' ); ?>
			</p>
			<div class="regions-hero__chips" role="list">
				<span class="regions-chip" role="listitem">Rize</span>
				<span class="regions-chip" role="listitem">Trabzon</span>
				<span class="regions-chip" role="listitem">Artvin</span>
				<span class="regions-chip" role="listitem">Giresun</span>
			</div>
		</div>
	</section>

	<?php
	$post_obj               = get_post();
	$regions_editor_content = ( $post_obj && isset( $post_obj->post_content ) ) ? $post_obj->post_content : '';
	if ( is_string( $regions_editor_content ) && trim( $regions_editor_content ) !== '' ) :
		?>
	<section class="regions-editor">
		<div class="regions-editor__inner">
			<?php echo apply_filters( 'the_content', $regions_editor_content ); ?>
		</div>
	</section>
	<?php endif; ?>

	<section class="regions-grid-section">
		<div class="regions-section-head regions-section-head--list">
			<div class="regions-section-head__text">
				<span class="eyebrow"><?php esc_html_e( 'Keşfet', 'nextcore' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Öne çıkan <em>rotalar</em>', 'nextcore' ) ); ?></h2>
			</div>
			<?php if ( $total_terms > 0 ) : ?>
				<p class="regions-result-count">
					<?php
					printf(
						/* translators: %d: region count */
						esc_html__( 'Toplam %d bölge', 'nextcore' ),
						(int) $total_terms
					);
					?>
				</p>
			<?php endif; ?>
		</div>
		<div class="regions-card-grid regions-card-grid--four">
			<?php if ( ! empty( $regions_for_cards ) ) : ?>
				<?php foreach ( $regions_for_cards as $r ) : ?>
					<?php
					$listings_page_url = function_exists('lazhem_page_url_by_template') ? lazhem_page_url_by_template( 'template-listings.php', '/ilanlar' ) : home_url('/ilanlar');
					$url = add_query_arg( 'listing_region[]', $r['slug'], $listings_page_url );
					$img = isset( $r['image_url'] ) ? $r['image_url'] : '';
					if ( ! $img ) {
						$img = $t . '/assets/images/ayder-yaylasi-hero.png';
					}
					?>
				<article class="regions-card">
					<a
						class="regions-card__link"
						href="<?php echo esc_url( $url ); ?>"
						aria-label="<?php echo esc_attr( sprintf( /* translators: %s: region name */ __( '%s — detayları görüntüle', 'nextcore' ), $r['title'] ?? '' ) ); ?>"
					>
						<div class="regions-card__bg" style="background-image: url('<?php echo esc_url( $img ); ?>');"></div>
						<div class="regions-card__shade" aria-hidden="true"></div>
						<div class="regions-card__content">
							<h3 class="regions-card__title"><?php echo esc_html( $r['title'] ?? '' ); ?></h3>
							<?php if ( ! empty( $r['subtitle'] ) ) : ?>
								<span class="regions-card__rule" aria-hidden="true"></span>
								<p class="regions-card__meta"><?php echo esc_html( $r['subtitle'] ); ?></p>
							<?php endif; ?>
						</div>
					</a>
				</article>
				<?php endforeach; ?>
			<?php else : ?>
				<p class="regions-empty"><?php esc_html_e( 'Henüz bölge eklenmemiş. Yönetim panelinden Bölgeler taksonomisine kayıt ekleyebilirsiniz.', 'nextcore' ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $pagination_html ) : ?>
			<nav class="regions-pagination" aria-label="<?php esc_attr_e( 'Bölge sayfaları', 'nextcore' ); ?>">
				<?php echo wp_kses_post( $pagination_html ); ?>
			</nav>
		<?php endif; ?>
	</section>

	<section class="regions-band regions-band--full">
		<div class="regions-band__inner">
			<p><?php esc_html_e( 'Listede göremediğiniz özel bir yayla, köy veya sınır ötesi rota için ekibimize yazın; kürasyonlu program hazırlayalım.', 'nextcore' ); ?></p>
			<a class="btn btn--gold regions-band__btn" href="<?php echo esc_url( home_url( '/iletisim' ) ); ?>"><?php esc_html_e( 'İletişime geç', 'nextcore' ); ?></a>
		</div>
	</section>
</main>

<style>
.regions-page {
	--regions-max: min(var(--container, 1200px), 100% - 2 * var(--gutter, 1.25rem));
}
.regions-hero {
	background: var(--paper);
	padding: clamp(100px, 14vw, 160px) 0 clamp(64px, 8vw, 100px);
	border-bottom: 1px solid rgba(0,0,0,0.06);
}
.regions-hero__inner {
	max-width: 900px;
	margin: 0 auto;
	padding: 0 var(--gutter, 1.25rem);
	text-align: center;
}
.regions-breadcrumb {
	font-family: var(--font-body);
	font-size: 0.8rem;
	color: var(--ink);
	opacity: 0.65;
	margin-bottom: 1.5rem;
}
.regions-breadcrumb a {
	color: inherit;
	text-decoration: none;
	border-bottom: 1px solid transparent;
	transition: border-color 0.2s;
}
.regions-breadcrumb a:hover {
	border-bottom-color: var(--gold-deep);
}
.regions-breadcrumb__sep {
	margin: 0 0.35em;
	opacity: 0.5;
}
.regions-hero__eyebrow {
	display: block;
	margin-bottom: 1rem;
	color: var(--gold-deep);
}
.regions-hero__title {
	font-family: var(--font-display);
	font-size: clamp(2.4rem, 6vw, 4rem);
	color: var(--forest);
	line-height: 1.05;
	letter-spacing: -0.03em;
	margin: 0;
}
.regions-hero__lede {
	margin: 1.75rem auto 0;
	max-width: 640px;
	font-size: 1.15rem;
	line-height: 1.65;
	color: var(--ink);
	opacity: 0.85;
}
.regions-hero__chips {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	gap: 10px;
	margin-top: 2rem;
}
.regions-chip {
	font-family: var(--font-body);
	font-size: 0.72rem;
	font-weight: 600;
	letter-spacing: 0.12em;
	text-transform: uppercase;
	padding: 10px 18px;
	border-radius: 999px;
	border: 1px solid rgba(0,0,0,0.1);
	color: var(--forest);
	background: rgba(255,255,255,0.6);
}
.regions-editor {
	padding: 0 0 clamp(48px, 6vw, 72px);
	background: #fff;
}
.regions-editor__inner {
	max-width: var(--regions-max);
	margin: 0 auto;
	padding: 0 var(--gutter, 1.25rem);
	font-size: 1.05rem;
	line-height: 1.75;
	color: var(--ink);
}
.regions-editor__inner > *:first-child {
	margin-top: 0;
}
.regions-editor__inner > *:last-child {
	margin-bottom: 0;
}
.regions-grid-section {
	padding: 0 0 clamp(80px, 12vw, 140px);
	background: var(--paper);
}
.regions-section-head {
	max-width: var(--regions-max);
	margin: 0 auto;
	padding: clamp(48px, 8vw, 80px) var(--gutter, 1.25rem) 2rem;
}
.regions-section-head--list {
	display: flex;
	flex-wrap: wrap;
	align-items: flex-end;
	justify-content: space-between;
	gap: 1rem 2rem;
	text-align: left;
}
.regions-section-head__text {
	text-align: left;
}
.regions-section-head .eyebrow {
	color: var(--gold-deep);
	display: block;
	margin-bottom: 0.75rem;
}
.regions-section-head h2 {
	font-family: var(--font-display);
	font-size: clamp(2rem, 4.5vw, 3rem);
	color: var(--forest);
	margin: 0;
	line-height: 1.15;
}
.regions-result-count {
	margin: 0;
	font-size: 0.95rem;
	color: var(--ink);
	opacity: 0.75;
}
.regions-card-grid {
	max-width: var(--regions-max);
	margin: 0 auto;
	padding: 0 var(--gutter, 1.25rem);
	display: grid;
	gap: 20px;
}
.regions-card-grid--four {
	grid-template-columns: repeat(4, 1fr);
}
.regions-empty {
	grid-column: 1 / -1;
	margin: 0;
	padding: 2rem 0;
	text-align: center;
	color: var(--ink);
	opacity: 0.7;
	font-size: 1rem;
}
.regions-card {
	min-height: 0;
}
/* Portre vitrin kartı — tam görsel, alt gradient, alt-sol metin */
.regions-card__link {
	position: relative;
	display: block;
	width: 100%;
	overflow: hidden;
	border-radius: 18px;
	aspect-ratio: 3 / 4;
	text-decoration: none;
	color: #fff;
	box-shadow: 0 16px 48px rgba(0, 0, 0, 0.14);
	border: 1px solid rgba(255, 255, 255, 0.12);
	transition: transform 0.35s ease, box-shadow 0.35s ease;
}
.regions-card__link:hover {
	transform: translateY(-6px);
	box-shadow: 0 24px 56px rgba(0, 0, 0, 0.2);
}
.regions-card__link:focus-visible {
	outline: 2px solid var(--gold-light);
	outline-offset: 3px;
}
.regions-card__bg {
	position: absolute;
	inset: 0;
	background-size: cover;
	background-position: center;
	transform: scale(1.02);
	transition: transform 0.5s ease;
}
.regions-card__link:hover .regions-card__bg {
	transform: scale(1.08);
}
.regions-card__shade {
	position: absolute;
	inset: 0;
	pointer-events: none;
	background: linear-gradient(
		to top,
		rgba(0, 0, 0, 0.78) 0%,
		rgba(0, 0, 0, 0.35) 42%,
		rgba(0, 0, 0, 0.08) 68%,
		transparent 100%
	);
}
.regions-card__content {
	position: absolute;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 2;
	padding: 1.35rem 1.25rem 1.6rem;
	text-align: left;
}
.regions-card__title {
	font-family: var(--font-display);
	font-size: clamp(1.45rem, 2.8vw, 1.95rem);
	font-weight: 500;
	line-height: 1.12;
	letter-spacing: -0.02em;
	margin: 0;
	color: #fff;
	text-shadow: 0 1px 12px rgba(0, 0, 0, 0.35);
}
.regions-card__rule {
	display: block;
	width: 2.75rem;
	height: 2px;
	margin: 0.7rem 0 0.65rem;
	background: var(--gold-light, #d4b483);
	border-radius: 1px;
}
.regions-card__meta {
	margin: 0;
	font-family: var(--font-body);
	font-size: 0.68rem;
	font-weight: 700;
	letter-spacing: 0.14em;
	text-transform: uppercase;
	line-height: 1.45;
	color: rgba(255, 255, 255, 0.95);
	text-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
}
.regions-pagination {
	max-width: var(--regions-max);
	margin: 3.5rem auto 1rem;
	padding: 0 var(--gutter, 1.25rem);
	display: flex;
	justify-content: center;
}
.regions-pagination ul.page-numbers {
	list-style: none;
	margin: 0;
	padding: 0;
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: center;
	gap: 0.5rem;
}
.regions-pagination ul.page-numbers li {
	display: flex;
}
.regions-pagination ul.page-numbers li .page-numbers {
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
.regions-pagination ul.page-numbers li a.page-numbers:hover {
	background: var(--forest);
	color: var(--paper);
	transform: translateY(-2px);
	box-shadow: 0 6px 16px rgba(15, 42, 29, 0.15);
}
.regions-pagination ul.page-numbers li .page-numbers.current {
	background: var(--forest-deep);
	color: var(--gold-light);
	font-weight: 600;
	box-shadow: 0 4px 12px rgba(15, 42, 29, 0.2);
}
.regions-pagination ul.page-numbers li .page-numbers.dots {
	background: transparent;
	color: var(--ink);
	opacity: 0.5;
	width: auto;
	min-width: 24px;
	box-shadow: none;
	pointer-events: none;
}
.regions-pagination ul.page-numbers li .prev.page-numbers,
.regions-pagination ul.page-numbers li .next.page-numbers {
	font-size: 1.5rem;
	line-height: 1;
	padding-bottom: 2px;
}
.regions-band.regions-band--full {
	width: 100vw;
	position: relative;
	left: 50%;
	right: auto;
	margin-left: -50vw;
	margin-right: -50vw;
	max-width: 100vw;
	box-sizing: border-box;
	background: var(--forest-deep);
	color: var(--paper);
	padding: clamp(56px, 8vw, 88px) var(--gutter, 1.25rem);
	text-align: center;
}
.regions-band__inner {
	max-width: 640px;
	margin: 0 auto;
}
.regions-band p {
	margin: 0 0 1.75rem;
	font-size: 1.1rem;
	line-height: 1.65;
	opacity: 0.9;
}
.regions-band__btn {
	display: inline-flex;
}
.regions-page em {
	font-style: italic;
	color: var(--sage);
	font-variation-settings: "opsz" 144, "SOFT" 80;
}
.regions-page .eyebrow {
	font-family: var(--font-body);
	font-size: 0.75rem;
	font-weight: 600;
	letter-spacing: 0.2em;
	text-transform: uppercase;
	color: var(--gold-deep);
}
@media (max-width: 1024px) {
	.regions-card-grid--four {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media (max-width: 720px) {
	.regions-section-head--list {
		flex-direction: column;
		align-items: flex-start;
	}
	.regions-card-grid--four {
		grid-template-columns: 1fr;
	}
}
</style>

<?php
get_footer();
