<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$post_id = get_the_ID();
$type    = get_post_type( $post_id );
$wa_url  = Lazhem_Utils::get_whatsapp_url( $post_id );
$title   = get_the_title();
$excerpt = get_post_meta( $post_id, '_lazhem_short_description', true );
$price   = get_post_meta( $post_id, '_lazhem_price_start', true );
$currency= get_post_meta( $post_id, '_lazhem_currency', true );
$gallery = array_filter( array_map( 'absint', explode( ',', (string) get_post_meta( $post_id, '_lazhem_gallery_ids', true ) ) ) );

if ( isset( $_GET['lazhem_msg'] ) ) {
	$msg_key = sanitize_text_field( wp_unslash( $_GET['lazhem_msg'] ) );
	if ( 'success' === $msg_key ) {
		echo '<div class="lazhem-notice success">' . esc_html( Lazhem_Utils::get_option( 'thanks_message', 'Tesekkurler. Talebiniz alindi.' ) ) . '</div>';
	} elseif ( 'invalid' === $msg_key ) {
		echo '<div class="lazhem-notice error">Lutfen zorunlu alanlari ve KVKK onayini kontrol edin.</div>';
	}
}
?>
<main class="lazhem-detail">
	<section class="hero wrap">
		<div class="hero__left">
			<span class="eyebrow"><?php echo esc_html( strtoupper( $type ) ); ?></span>
			<h1><?php echo esc_html( $title ); ?></h1>
			<p><?php echo esc_html( $excerpt ? $excerpt : get_the_excerpt() ); ?></p>
			<div class="meta-row">
				<span class="pill"><?php echo esc_html( get_post_meta( $post_id, '_lazhem_region', true ) ); ?></span>
				<?php if ( 'bungalov' === $type ) : ?><span class="pill"><?php echo esc_html( get_post_meta( $post_id, '_lazhem_capacity', true ) ); ?> Kisi</span><?php endif; ?>
				<?php if ( 'tur' === $type ) : ?><span class="pill"><?php echo esc_html( get_post_meta( $post_id, '_lazhem_duration', true ) ); ?></span><?php endif; ?>
			</div>
			<div class="price"><?php echo esc_html( Lazhem_Utils::money_format( $price, $currency ) ); ?></div>
			<div class="cta-row">
				<?php if ( $wa_url ) : ?><a class="lazhem-btn lazhem-btn-whatsapp" target="_blank" rel="noopener" href="<?php echo esc_url( $wa_url ); ?>">WhatsApp'tan Bilgi Al</a><?php endif; ?>
				<a class="lazhem-btn" href="#inquiry">Teklif Formuna Git</a>
			</div>
		</div>
		<div class="hero__right"><?php echo get_the_post_thumbnail( $post_id, 'large' ); ?></div>
	</section>

	<section class="content wrap">
		<div class="left-col">
			<h2>Detayli Aciklama</h2>
			<div class="wysiwyg"><?php echo wp_kses_post( apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) ) ); ?></div>

			<?php if ( 'bungalov' === $type ) :
				$variations = get_post_meta( $post_id, '_lazhem_bungalov_variations', true );
				$variations = is_array( $variations ) ? $variations : array();
			?>
			<h2>Varyasyonlar / Oda Secenekleri</h2>
			<div class="cards">
				<?php foreach ( $variations as $v ) : ?>
					<div class="card"><h3><?php echo esc_html( $v['name'] ?? '' ); ?></h3><p><?php echo esc_html( $v['short_description'] ?? '' ); ?></p><p><?php echo esc_html( $v['capacity'] ?? '' ); ?> Kisi - <?php echo esc_html( Lazhem_Utils::money_format( $v['night_price'] ?? '', $currency ) ); ?></p></div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( 'tur' === $type ) :
				$program = get_post_meta( $post_id, '_lazhem_tur_program', true );
				$program = is_array( $program ) ? $program : array();
			?>
			<h2>Tur Programi</h2>
			<div class="timeline">
				<?php foreach ( $program as $row ) : ?>
					<div class="step"><h3><?php echo esc_html( $row['day_title'] ?? '' ); ?> <small><?php echo esc_html( $row['time_range'] ?? '' ); ?></small></h3><p><strong><?php echo esc_html( $row['activity_title'] ?? '' ); ?></strong></p><p><?php echo esc_html( $row['description'] ?? '' ); ?></p></div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php if ( 'paket' === $type ) : ?>
			<h2>Paket Icerigi</h2>
			<p><?php echo wp_kses_post( nl2br( get_post_meta( $post_id, '_lazhem_package_content', true ) ) ); ?></p>
			<h3>Secili Bungalovlar</h3>
			<ul>
				<?php foreach ( (array) get_post_meta( $post_id, '_lazhem_selected_bungalovlar', true ) as $bid ) : ?><li><a href="<?php echo esc_url( get_permalink( $bid ) ); ?>"><?php echo esc_html( get_the_title( $bid ) ); ?></a></li><?php endforeach; ?>
			</ul>
			<h3>Secili Turlar</h3>
			<ul>
				<?php foreach ( (array) get_post_meta( $post_id, '_lazhem_selected_turlar', true ) as $tid ) : ?><li><a href="<?php echo esc_url( get_permalink( $tid ) ); ?>"><?php echo esc_html( get_the_title( $tid ) ); ?></a></li><?php endforeach; ?>
			</ul>
			<?php endif; ?>

			<?php if ( $gallery ) : ?>
			<h2>Galeri</h2>
			<div class="gallery"><?php foreach ( $gallery as $img_id ) { echo wp_get_attachment_image( $img_id, 'medium_large' ); } ?></div>
			<?php endif; ?>
		</div>

		<aside class="right-col" id="inquiry">
			<h2><?php echo esc_html( get_post_meta( $post_id, '_lazhem_form_cta_title', true ) ?: 'Teklif / Musaitlik Formu' ); ?></h2>
			<p><?php echo esc_html( get_post_meta( $post_id, '_lazhem_form_cta_description', true ) ?: 'Formu doldurun, en kisa surede size donelim.' ); ?></p>
			<?php echo do_shortcode( '[lazhem_inquiry_form]' ); ?>
		</aside>
	</section>

	<section class="wrap">
		<h2>Ilgili Icerikler</h2>
		<?php echo do_shortcode( '[lazhem_related_items]' ); ?>
	</section>
</main>
<?php get_footer(); ?>
