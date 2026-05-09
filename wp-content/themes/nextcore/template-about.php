<?php
/* Template Name: Hakkımızda Tasarımı */
get_header();
?>

<main class="about-page">
    <!-- ═══════════════ HERO ═══════════════ -->
    <section class="about-hero" style="background: var(--paper); padding: 180px 0 140px; display: flex; align-items: center; justify-content: center; min-height: 50vh;">
        <div class="container" style="max-width: 1100px; text-align: center;">
            <span class="eyebrow" style="margin-bottom: 2rem; display: block; color: var(--gold-deep);">Hikâyemiz & Vizyonumuz</span>
            <h1 style="font-family: var(--font-display); font-size: clamp(2.8rem, 7vw, 5.2rem); color: var(--forest); line-height: 1; letter-spacing: -0.04em;">
                Bulutların <em>üzerinde</em>,<br>bir hayalin izinde.
            </h1>
            <p style="font-size: 1.35rem; color: var(--ink); max-width: 700px; margin: 2.5rem auto 0; line-height: 1.5; opacity: 0.85;">
                2014 yılında Rize’nin sarp yamaçlarında başlayan yolculuğumuz, bugün Karadeniz’in en seçkin turizm deneyimine dönüştü.
            </p>
        </div>
    </section>

    <!-- ═══════════════ STORY SEPARATOR ═══════════════ -->
    <div style="height: 1px; background: rgba(0,0,0,0.06); max-width: var(--container); margin: 0 auto;"></div>

    <!-- ═══════════════ THE STORY ═══════════════ -->
    <section class="about-story" style="padding: 120px 0;">
        <div class="about-story__grid" style="display: grid; grid-template-columns: 1fr 1.1fr; gap: 80px; align-items: center; max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div class="about-story__visual" style="position: relative;">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rize-tea-plantations.png" alt="Rize Çay Bahçeleri" style="width: 100%; border-radius: 4px; filter: contrast(1.05);">
                <div style="position: absolute; bottom: -30px; right: -30px; background: var(--forest-deep); color: var(--paper); padding: 40px; border-radius: 4px; box-shadow: 20px 20px 60px rgba(0,0,0,0.15); max-width: 280px;">
                    <div style="font-family: var(--font-display); font-size: 2.5rem; margin-bottom: 5px;">10+</div>
                    <div class="eyebrow" style="color: var(--gold-light); font-size: 0.7rem;">Yıllık Yerel Miras</div>
                </div>
            </div>
            <div class="about-story__content">
                <span class="eyebrow">Nasıl Başladık?</span>
                <h2 style="font-family: var(--font-display); font-size: 2.8rem; color: var(--forest); margin: 1.5rem 0; line-height: 1.1;">Yaylanın <em>sesini</em> duymak.</h2>
                <p>Lazhem, sadece bir seyahat acentesi değil; Karadeniz’in doğasına, kültürüne ve sükunetine olan derin bir tutkunun ürünüdür. Kurucularımız, bu toprakların çocukları olarak, bölgenin gizli kalmış güzelliklerini dünyayla paylaşma hayaliyle yola çıktılar.</p>
                <p>Başlangıçta sadece bir küçük ahşap bungalovla başlayan bu serüven, bugün Rize, Artvin ve Trabzon'un en özel noktalarında konaklama ve butik tur hizmetleri sunan kapsamlı bir ekosisteme dönüştü.</p>
                <div style="margin-top: 2.5rem; padding-left: 25px; border-left: 2px solid var(--sage);">
                    <p style="font-style: italic; font-size: 1.1rem; color: var(--forest);">"Bizim için her misafir, kapımızı çalan bir aile dostudur. Karadeniz misafirperverliğini, modern konforun zarafetiyle harmanlayarak sunuyoruz."</p>
                    <strong style="display: block; margin-top: 10px; font-family: var(--font-body); font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase;">— Lazhem Kurucu Ekibi</strong>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ PHILOSOPHY (3-UP GRID) ═══════════════ -->
    <section style="background: #091912; padding: 120px 0; color: var(--paper);">
        <div class="container" style="max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div style="text-align: center; margin-bottom: 80px;">
                <span class="eyebrow" style="color: var(--gold-light);">Felsefemiz</span>
                <h2 style="font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.2rem); margin-top: 1rem;">Bizi <em>ayıran</em> detaylar</h2>
            </div>
            <div class="principles__grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <div class="principle-card" style="background: rgba(255,255,255,0.03); padding: 50px 40px; border: 1px solid rgba(255,255,255,0.08); border-radius: 2px;">
                    <span style="font-family: var(--font-display); font-size: 0.9rem; color: var(--gold-light); display: block; margin-bottom: 25px;">01.</span>
                    <h3 style="font-family: var(--font-display); font-size: 1.6rem; margin-bottom: 20px;">Sürdürülebilirlik</h3>
                    <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7;">Yaylalarımızı korumak en büyük önceliğimiz. İnşa ettiğimiz her bungalovda yerel ahşap tekniklerini ve doğaya en az müdahale eden yöntemleri kullanıyoruz.</p>
                </div>
                <div class="principle-card" style="background: rgba(255,255,255,0.03); padding: 50px 40px; border: 1px solid rgba(255,255,255,0.08); border-radius: 2px;">
                    <span style="font-family: var(--font-display); font-size: 0.9rem; color: var(--gold-light); display: block; margin-bottom: 25px;">02.</span>
                    <h3 style="font-family: var(--font-display); font-size: 1.6rem; margin-bottom: 20px;">Küratörlük</h3>
                    <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7;">Sıradan turlar yerine, Karadeniz'in ruhuna dokunan özel rotalar küratörlüğü yapıyoruz. Kalabalıklardan uzak, sadece size özel anlar tasarlıyoruz.</p>
                </div>
                <div class="principle-card" style="background: rgba(255,255,255,0.03); padding: 50px 40px; border: 1px solid rgba(255,255,255,0.08); border-radius: 2px;">
                    <span style="font-family: var(--font-display); font-size: 0.9rem; color: var(--gold-light); display: block; margin-bottom: 25px;">03.</span>
                    <h3 style="font-family: var(--font-display); font-size: 1.6rem; margin-bottom: 20px;">Kusursuzluk</h3>
                    <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7;">VIP araçlarımızdan oda içindeki ikramlarımıza kadar her noktada lüksü ve Karadeniz'in sıcaklığını bir arada hissetmenizi sağlıyoruz.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ INTERIOR/COMFORT ═══════════════ -->
    <section style="padding: 140px 0; background: var(--paper);">
        <div class="about-story__grid" style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 100px; align-items: center; max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div class="about-story__content">
                <span class="eyebrow">Konaklama Deneyimi</span>
                <h2 style="font-family: var(--font-display); font-size: 2.8rem; color: var(--forest); margin: 1.5rem 0; line-height: 1.1;">Modern <em>lüks</em>, yayla sessizliği.</h2>
                <p>Bungalovlarımızda sadece bir yatak değil, bir huzur alanı sunuyoruz. Jakuzili teraslarımızda bulut denizi manzarasını izlerken, şömine başında bölgenin en taze çaylarını yudumlayabilirsiniz.</p>
                <ul style="list-style: none; margin-top: 2rem; display: grid; gap: 15px;">
                    <li style="display: flex; align-items: center; gap: 12px; font-size: 1.05rem; color: var(--forest);">
                        <span style="width: 6px; height: 6px; background: var(--gold-deep); border-radius: 50%;"></span>
                        %100 Doğal Ahşap Mimarisi
                    </li>
                    <li style="display: flex; align-items: center; gap: 12px; font-size: 1.05rem; color: var(--forest);">
                        <span style="width: 6px; height: 6px; background: var(--gold-deep); border-radius: 50%;"></span>
                        Panoramik Yayla Manzaralı Teraslar
                    </li>
                    <li style="display: flex; align-items: center; gap: 12px; font-size: 1.05rem; color: var(--forest);">
                        <span style="width: 6px; height: 6px; background: var(--gold-deep); border-radius: 50%;"></span>
                        Sürdürülebilir Enerji ve Su Sistemleri
                    </li>
                </ul>
            </div>
            <div class="about-story__visual">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/luxury-bungalow-interior.png" alt="Bungalov İç Mekan" style="width: 100%; border-radius: 4px; box-shadow: 0 30px 70px rgba(0,0,0,0.12);">
            </div>
        </div>
    </section>

    <!-- ═══════════════ FINAL GALLERY GRID ═══════════════ -->
    <section style="padding-bottom: 120px; background: var(--paper);">
        <div class="container" style="max-width: var(--container); margin: 0 auto; padding: 0 var(--gutter);">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; height: 450px;">
                <div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png'); background-size: cover; background-position: center; border-radius: 2px;"></div>
                <div style="grid-column: span 2; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/uzungol-lake.png'); background-size: cover; background-position: center; border-radius: 2px;"></div>
                <div style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/karagol-snow.png'); background-size: cover; background-position: center; border-radius: 2px;"></div>
            </div>
        </div>
    </section>

    <!-- ═══════════════ FINAL CALL ═══════════════ -->
    <section style="padding: 120px 0; background: var(--forest-deep); color: var(--paper); text-align: center; margin-bottom: 0;">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.5rem); margin-bottom: 2rem;">Karadeniz'i bir de <em>bizimle</em> yaşayın.</h2>
            <p style="opacity: 0.8; font-size: 1.15rem; margin-bottom: 3rem;">Hayalinizdeki rotayı planlamak veya bungalovlarımızda yerinizi ayırtmak için ekibimizle iletişime geçin.</p>
            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <a href="https://wa.me/904640000000" class="btn btn--gold" style="padding: 18px 35px; font-size: 1rem;">WhatsApp'tan Yazın</a>
                <a href="#" class="btn btn--ghost" style="padding: 18px 35px; font-size: 1rem; border-color: rgba(255,255,255,0.2); color: var(--paper);">Turlarımızı İnceleyin</a>
            </div>
        </div>
    </section>
</main>

<style>
/* Local overrides for About Page */
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
@media (max-width: 1024px) {
    .about-story__grid { grid-template-columns: 1fr !important; gap: 60px !important; }
}
</style>

<?php
get_footer();
?>
