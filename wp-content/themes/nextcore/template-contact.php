<?php
/**
 * Template Name: İletişim Tasarımı
 *
 * @package nextcore
 */

get_header();

if ( have_posts() ) {
	the_post();
}

$t = get_template_directory_uri();
$c = static function ( $key, $default = '' ) {
	return lazhem_contact( $key, $default );
};

$phone_display = $c( 'ct_phone_display', '+90 464 000 00 00' );
$tel_href      = lazhem_nc_tel_href( $phone_display );
if ( $tel_href === '' ) {
	$tel_href = 'tel:+904640000000';
}

$email_raw   = $c( 'ct_email', 'info@lazhem.com' );
$email_safe  = is_email( $email_raw ) ? $email_raw : 'info@lazhem.com';
?>

<main class="contact-page">
	<section class="contact-hero">
		<div class="contact-hero__inner">
			<nav class="contact-breadcrumb" aria-label="<?php esc_attr_e( 'İçerik konumu', 'nextcore' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Anasayfa', 'nextcore' ); ?></a>
				<span class="contact-breadcrumb__sep">/</span>
				<span><?php the_title(); ?></span>
			</nav>
			<span class="eyebrow contact-hero__eyebrow"><?php echo esc_html( $c( 'ct_hero_eyebrow', 'Bize Ulaşın' ) ); ?></span>
			<h1 class="contact-hero__title"><?php echo wp_kses_post( $c( 'ct_hero_h1', 'Size yardımcı olmaktan <em>mutluluk</em> duyarız.' ) ); ?></h1>
			<p class="contact-hero__lede"><?php echo wp_kses_post( $c( 'ct_hero_lede', 'Rize\'deki merkez ofisimizde veya yaylalardaki bungalovlarımızda Karadeniz misafirperverliğiyle sizi bekliyoruz.' ) ); ?></p>
		</div>
	</section>

    <section class="contact-grid">
        <div class="contact-info">
            <div class="contact-info__item">
                <h3><?php echo esc_html( $c( 'ct_office_h3', 'Merkez Ofis' ) ); ?></h3>
                <p><?php echo wp_kses_post( $c( 'ct_office_address', 'Lazhem Turizm, Merkez Mah. No:42<br>Ardeşen, Rize / Türkiye' ) ); ?></p>
            </div>

            <div class="contact-info__item">
                <h3><?php echo esc_html( $c( 'ct_channels_h3', 'İletişim Kanalları' ) ); ?></h3>
                <a href="<?php echo esc_url( $tel_href ); ?>"><strong>T:</strong> <?php echo esc_html( $phone_display ); ?></a>
                <a href="mailto:<?php echo esc_attr( $email_safe ); ?>"><strong>E:</strong> <?php echo esc_html( $email_safe ); ?></a>
                <a href="<?php echo esc_url( $c( 'ct_wa_url', 'https://wa.me/904640000000' ) ); ?>" style="color: #25D366; font-weight: 600; margin-top: 10px;"><?php echo esc_html( $c( 'ct_wa_label', 'WhatsApp Hattı →' ) ); ?></a>
            </div>

            <div class="contact-info__item">
                <h3><?php echo esc_html( $c( 'ct_social_h3', 'Sosyal Medya' ) ); ?></h3>
                <div class="contact-socials">
                    <a href="<?php echo esc_url( $c( 'ct_social_ig_url', '#' ) ); ?>" aria-label="<?php echo esc_attr( $c( 'ct_social_ig_label', 'Instagram' ) ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="<?php echo esc_url( $c( 'ct_social_fb_url', '#' ) ); ?>" aria-label="<?php echo esc_attr( $c( 'ct_social_fb_label', 'Facebook' ) ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="<?php echo esc_url( $c( 'ct_social_yt_url', '#' ) ); ?>" aria-label="<?php echo esc_attr( $c( 'ct_social_yt_label', 'YouTube' ) ); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.46 5.58a2.78 2.78 0 0 0 1.94 2c1.72.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.46-5.58z"></path><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"></polygon></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="contact-form">
            <div class="contact-form-card">
                <h2><?php echo esc_html( $c( 'ct_form_h2', 'Hızlı İletişim Formu' ) ); ?></h2>
                <form action="<?php echo esc_url( $c( 'ct_form_action', '#' ) ); ?>" method="post">
                    <div class="contact-form__group">
                        <label for="ct_name"><?php echo esc_html( $c( 'ct_form_name_label', 'Adınız Soyadınız' ) ); ?></label>
                        <input type="text" id="ct_name" name="name" placeholder="<?php echo esc_attr( $c( 'ct_form_name_ph', 'Örn: Mehmet Karadeniz' ) ); ?>" required>
                    </div>
                    <div class="contact-form__group">
                        <label for="ct_email"><?php echo esc_html( $c( 'ct_form_email_label', 'E-posta Adresiniz' ) ); ?></label>
                        <input type="email" id="ct_email" name="email" placeholder="<?php echo esc_attr( $c( 'ct_form_email_ph', 'orn@mail.com' ) ); ?>" required>
                    </div>
                    <div class="contact-form__group">
                        <label for="ct_phone"><?php echo esc_html( $c( 'ct_form_phone_label', 'Telefon Numaranız' ) ); ?></label>
                        <input type="tel" id="ct_phone" name="phone" placeholder="<?php echo esc_attr( $c( 'ct_form_phone_ph', '0 5xx xxx xx xx' ) ); ?>">
                    </div>
                    <div class="contact-form__group">
                        <label for="ct_message"><?php echo esc_html( $c( 'ct_form_message_label', 'Mesajınız' ) ); ?></label>
                        <textarea id="ct_message" name="message" rows="5" placeholder="<?php echo esc_attr( $c( 'ct_form_message_ph', 'Size nasıl yardımcı olabiliriz?' ) ); ?>" required></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 18px;"><?php echo esc_html( $c( 'ct_form_submit_txt', 'Gönder' ) ); ?></button>
                </form>
            </div>
        </div>
    </section>

    <section style="height: 500px; background: #eee; margin-bottom: 0;">
        <div style="width: 100%; height: 100%; background-image: url('<?php echo esc_url( $c( 'ct_map_bg', $t . '/assets/images/sumela-monastery.png' ) ); ?>'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; position: relative;">
            <div style="position: absolute; inset: 0; background: rgba(15, 42, 29, 0.4);"></div>
            <div style="position: relative; z-index: 1; text-align: center; color: #fff;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--gold-light); margin-bottom: 20px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <h3 style="font-family: var(--font-display); font-size: 2rem;"><?php echo esc_html( $c( 'ct_map_h3', 'Rize\'nin kalbindeyiz.' ) ); ?></h3>
            </div>
        </div>
    </section>
</main>

<style>
.contact-page em {
    font-style: italic;
    color: var(--sage);
    font-variation-settings: "opsz" 144, "SOFT" 80;
}
</style>

<?php
get_footer();
