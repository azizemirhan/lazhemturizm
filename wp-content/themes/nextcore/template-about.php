<?php
/**
 * Template Name: Hakkımızda Tasarımı
 *
 * @package nextcore
 */

get_header();

if ( have_posts() ) {
	the_post();
}

$t = get_template_directory_uri();
$a = static function ( $key, $default = '' ) {
	return lazhem_about( $key, $default );
};

$phil_cards = lazhem_about_philosophy_cards();
$comf_bul   = lazhem_about_comfort_bullets();
?>

<main class="about-page">
	<section class="about-hero">
		<div class="about-hero__inner">
			<nav class="about-breadcrumb" aria-label="<?php esc_attr_e( 'İçerik konumu', 'nextcore' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Anasayfa', 'nextcore' ); ?></a>
				<span class="about-breadcrumb__sep">/</span>
				<span><?php the_title(); ?></span>
			</nav>
			<span class="eyebrow about-hero__eyebrow"><?php echo esc_html( $a( 'ab_hero_eyebrow', 'Hikâyemiz & Vizyonumuz' ) ); ?></span>
			<h1 class="about-hero__title">
				<?php echo wp_kses_post( $a( 'ab_hero_h1', 'Bulutların <em>üzerinde</em>,<br>bir hayalin izinde.' ) ); ?>
			</h1>
			<p class="about-hero__lede">
				<?php echo wp_kses_post( $a( 'ab_hero_lede', '2014 yılında Rize’nin sarp yamaçlarında başlayan yolculuğumuz, bugün Karadeniz’in en seçkin turizm deneyimine dönüştü.' ) ); ?>
			</p>
		</div>
	</section>

    <section class="about-story" style="padding: 120px 0;">
        <div class="about-story__grid" style="display: grid; grid-template-columns: 1fr 1.1fr; gap: 80px; align-items: center; max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div class="about-story__visual" style="position: relative;">
                <img src="<?php echo esc_url( $a( 'ab_story1_img', $t . '/assets/images/rize-tea-plantations.png' ) ); ?>" alt="<?php echo esc_attr( $a( 'ab_story1_img_alt', 'Rize Çay Bahçeleri' ) ); ?>" style="width: 100%; border-radius: 4px; filter: contrast(1.05);">
                <div style="position: absolute; bottom: -30px; right: -30px; background: var(--forest-deep); color: var(--paper); padding: 40px; border-radius: 4px; box-shadow: 20px 20px 60px rgba(0,0,0,0.15); max-width: 280px;">
                    <div style="font-family: var(--font-display); font-size: 2.5rem; margin-bottom: 5px;"><?php echo esc_html( $a( 'ab_story1_float_num', '10+' ) ); ?></div>
                    <div class="eyebrow" style="color: var(--gold-light); font-size: 0.7rem;"><?php echo esc_html( $a( 'ab_story1_float_eyebrow', 'Yıllık Yerel Miras' ) ); ?></div>
                </div>
            </div>
            <div class="about-story__content">
                <span class="eyebrow"><?php echo esc_html( $a( 'ab_story1_eyebrow', 'Nasıl Başladık?' ) ); ?></span>
                <h2 style="font-family: var(--font-display); font-size: 2.8rem; color: var(--forest); margin: 1.5rem 0; line-height: 1.1;"><?php echo wp_kses_post( $a( 'ab_story1_h2', 'Yaylanın <em>sesini</em> duymak.' ) ); ?></h2>
                <p><?php echo wp_kses_post( $a( 'ab_story1_p1', 'Lazhem, sadece bir seyahat acentesi değil; Karadeniz’in doğasına, kültürüne ve sükunetine olan derin bir tutkunun ürünüdür. Kurucularımız, bu toprakların çocukları olarak, bölgenin gizli kalmış güzelliklerini dünyayla paylaşma hayaliyle yola çıktılar.' ) ); ?></p>
                <p><?php echo wp_kses_post( $a( 'ab_story1_p2', 'Başlangıçta sadece bir küçük ahşap bungalovla başlayan bu serüven, bugün Rize, Artvin ve Trabzon\'un en özel noktalarında konaklama ve butik tur hizmetleri sunan kapsamlı bir ekosisteme dönüştü.' ) ); ?></p>
                <div style="margin-top: 2.5rem; padding-left: 25px; border-left: 2px solid var(--sage);">
                    <p style="font-style: italic; font-size: 1.1rem; color: var(--forest);"><?php echo wp_kses_post( $a( 'ab_story1_quote', '"Bizim için her misafir, kapımızı çalan bir aile dostudur. Karadeniz misafirperverliğini, modern konforun zarafetiyle harmanlayarak sunuyoruz."' ) ); ?></p>
                    <strong style="display: block; margin-top: 10px; font-family: var(--font-body); font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase;"><?php echo esc_html( $a( 'ab_story1_quote_attr', '— Lazhem Kurucu Ekibi' ) ); ?></strong>
                </div>
            </div>
        </div>
    </section>

    <section style="background: #091912; padding: 120px 0; color: var(--paper);">
        <div class="container" style="max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div style="text-align: center; margin-bottom: 80px;">
                <span class="eyebrow" style="color: var(--gold-light);"><?php echo esc_html( $a( 'ab_phil_eyebrow', 'Felsefemiz' ) ); ?></span>
                <h2 style="font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.2rem); margin-top: 1rem;"><?php echo wp_kses_post( $a( 'ab_phil_h2', 'Bizi <em>ayıran</em> detaylar' ) ); ?></h2>
            </div>
            <div class="principles__grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
				<?php foreach ( $phil_cards as $pc ) : ?>
                <div class="principle-card" style="background: rgba(255,255,255,0.03); padding: 50px 40px; border: 1px solid rgba(255,255,255,0.08); border-radius: 2px;">
                    <span style="font-family: var(--font-display); font-size: 0.9rem; color: var(--gold-light); display: block; margin-bottom: 25px;"><?php echo esc_html( $pc['num'] ?? '' ); ?></span>
                    <h3 style="font-family: var(--font-display); font-size: 1.6rem; margin-bottom: 20px;"><?php echo esc_html( $pc['title'] ?? '' ); ?></h3>
                    <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7;"><?php echo wp_kses_post( $pc['text'] ?? '' ); ?></p>
                </div>
				<?php endforeach; ?>
            </div>
        </div>
    </section>

    <section style="padding: 140px 0; background: var(--paper);">
        <div class="about-story__grid" style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 100px; align-items: center; max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div class="about-story__content">
                <span class="eyebrow"><?php echo esc_html( $a( 'ab_comf_eyebrow', 'Konaklama Deneyimi' ) ); ?></span>
                <h2 style="font-family: var(--font-display); font-size: 2.8rem; color: var(--forest); margin: 1.5rem 0; line-height: 1.1;"><?php echo wp_kses_post( $a( 'ab_comf_h2', 'Modern <em>lüks</em>, yayla sessizliği.' ) ); ?></h2>
                <p><?php echo wp_kses_post( $a( 'ab_comf_p', 'Bungalovlarımızda sadece bir yatak değil, bir huzur alanı sunuyoruz. Jakuzili teraslarımızda bulut denizi manzarasını izlerken, şömine başında bölgenin en taze çaylarını yudumlayabilirsiniz.' ) ); ?></p>
                <ul style="list-style: none; margin-top: 2rem; display: grid; gap: 15px;">
					<?php foreach ( $comf_bul as $line ) : ?>
                    <li style="display: flex; align-items: center; gap: 12px; font-size: 1.05rem; color: var(--forest);">
                        <span style="width: 6px; height: 6px; background: var(--gold-deep); border-radius: 50%;"></span>
						<?php echo esc_html( $line ); ?>
                    </li>
					<?php endforeach; ?>
                </ul>
            </div>
            <div class="about-story__visual">
                <img src="<?php echo esc_url( $a( 'ab_comf_img', $t . '/assets/images/luxury-bungalow-interior.png' ) ); ?>" alt="<?php echo esc_attr( $a( 'ab_comf_img_alt', 'Bungalov İç Mekan' ) ); ?>" style="width: 100%; border-radius: 4px; box-shadow: 0 30px 70px rgba(0,0,0,0.12);">
            </div>
        </div>
    </section>

    <section style="padding-bottom: 120px; background: var(--paper);">
        <div class="container" style="max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; height: 450px;">
                <div style="background-image: url('<?php echo esc_url( $a( 'ab_gal_1', $t . '/assets/images/pokut-plateau-aerial.png' ) ); ?>'); background-size: cover; background-position: center; border-radius: 2px;"></div>
                <div style="grid-column: span 2; background-image: url('<?php echo esc_url( $a( 'ab_gal_2', $t . '/assets/images/uzungol-lake.png' ) ); ?>'); background-size: cover; background-position: center; border-radius: 2px;"></div>
                <div style="background-image: url('<?php echo esc_url( $a( 'ab_gal_3', $t . '/assets/images/karagol-snow.png' ) ); ?>'); background-size: cover; background-position: center; border-radius: 2px;"></div>
            </div>
        </div>
    </section>

    <section style="padding: 120px 0; background: var(--forest-deep); color: var(--paper); text-align: center; margin-bottom: 0;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.5rem); margin-bottom: 2rem;"><?php echo wp_kses_post( $a( 'ab_cta_h2', 'Karadeniz\'i bir de <em>bizimle</em> yaşayın.' ) ); ?></h2>
            <p style="opacity: 0.8; font-size: 1.15rem; margin-bottom: 3rem;"><?php echo wp_kses_post( $a( 'ab_cta_p', 'Hayalinizdeki rotayı planlamak veya bungalovlarımızda yerinizi ayırtmak için ekibimizle iletişime geçin.' ) ); ?></p>
            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <a href="<?php echo esc_url( $a( 'ab_cta_wa_url', 'https://wa.me/904640000000' ) ); ?>" class="btn btn--gold" style="padding: 18px 35px; font-size: 1rem;"><?php echo esc_html( $a( 'ab_cta_wa_txt', 'WhatsApp\'tan Yazın' ) ); ?></a>
                <a href="<?php echo esc_url( $a( 'ab_cta_sec_url', '#' ) ); ?>" class="btn btn--ghost" style="padding: 18px 35px; font-size: 1rem; border-color: rgba(255,255,255,0.2); color: var(--paper);"><?php echo esc_html( $a( 'ab_cta_sec_txt', 'Turlarımızı İnceleyin' ) ); ?></a>
            </div>
        </div>
    </section>
</main>

<style>
.about-page em {
	font-style: italic;
	color: var(--sage);
	font-variation-settings: "opsz" 144, "SOFT" 80;
}
.about-page .eyebrow {
	font-family: var(--font-body);
	font-size: 0.75rem;
	font-weight: 600;
	letter-spacing: 0.2em;
	text-transform: uppercase;
	color: var(--gold-deep);
}
/* Hero — Bölgeler sayfası (regions-hero) ile aynı ölçü ve ritim */
.about-hero {
	background: var(--paper);
	padding: clamp(100px, 14vw, 160px) 0 clamp(64px, 8vw, 100px);
	border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}
.about-hero__inner {
	max-width: 900px;
	margin: 0 auto;
	padding: 0 var(--gutter, 1.25rem);
	text-align: center;
}
.about-breadcrumb {
	font-family: var(--font-body);
	font-size: 0.8rem;
	color: var(--ink);
	opacity: 0.65;
	margin-bottom: 1.5rem;
}
.about-breadcrumb a {
	color: inherit;
	text-decoration: none;
	border-bottom: 1px solid transparent;
	transition: border-color 0.2s;
}
.about-breadcrumb a:hover {
	border-bottom-color: var(--gold-deep);
}
.about-breadcrumb__sep {
	margin: 0 0.35em;
	opacity: 0.5;
}
.about-hero__eyebrow {
	display: block;
	margin-bottom: 1rem;
	color: var(--gold-deep);
}
.about-hero__title {
	font-family: var(--font-display);
	font-size: clamp(2.4rem, 6vw, 4rem);
	color: var(--forest);
	line-height: 1.05;
	letter-spacing: -0.03em;
	margin: 0;
}
.about-hero__lede {
	margin: 1.75rem auto 0;
	max-width: 640px;
	font-size: 1.15rem;
	line-height: 1.65;
	color: var(--ink);
	opacity: 0.85;
}
@media (max-width: 1024px) {
	.about-story__grid {
		grid-template-columns: 1fr !important;
		gap: 60px !important;
	}
}
</style>

<?php
get_footer();
