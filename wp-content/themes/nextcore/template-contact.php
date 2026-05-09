<?php
/* Template Name: İletişim Tasarımı */
get_header();
?>

<main class="contact-page">
    <!-- Hero -->
    <section class="contact-hero">
        <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 var(--gutter);">
            <span class="eyebrow" style="margin-bottom: 1.5rem; display: block;">Bize Ulaşın</span>
            <h1 style="font-family: var(--font-display); font-size: clamp(2.5rem, 6vw, 4.5rem); color: var(--forest); line-height: 1.1;">Size yardımcı olmaktan <em>mutluluk</em> duyarız.</h1>
            <p style="margin-top: 2rem; font-size: 1.2rem; opacity: 0.8; color: var(--ink);">Rize'deki merkez ofisimizde veya yaylalardaki bungalovlarımızda Karadeniz misafirperverliğiyle sizi bekliyoruz.</p>
        </div>
    </section>

    <!-- Contact Grid -->
    <section class="contact-grid">
        <!-- Info Column -->
        <div class="contact-info">
            <div class="contact-info__item">
                <h3>Merkez Ofis</h3>
                <p>Lazhem Turizm, Merkez Mah. No:42<br>Ardeşen, Rize / Türkiye</p>
            </div>
            
            <div class="contact-info__item">
                <h3>İletişim Kanalları</h3>
                <a href="tel:+904640000000"><strong>T:</strong> +90 464 000 00 00</a>
                <a href="mailto:info@lazhem.com"><strong>E:</strong> info@lazhem.com</a>
                <a href="https://wa.me/904640000000" style="color: #25D366; font-weight: 600; margin-top: 10px;">WhatsApp Hattı →</a>
            </div>

            <div class="contact-info__item">
                <h3>Sosyal Medya</h3>
                <div class="contact-socials">
                    <a href="#" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="#" aria-label="YouTube">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.46 5.58a2.78 2.78 0 0 0 1.94 2c1.72.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.46-5.58z"></path><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"></polygon></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Column -->
        <div class="contact-form">
            <div class="contact-form-card">
                <h2>Hızlı İletişim Formu</h2>
                <form action="#" method="post">
                    <div class="contact-form__group">
                        <label for="name">Adınız Soyadınız</label>
                        <input type="text" id="name" name="name" placeholder="Örn: Mehmet Karadeniz" required>
                    </div>
                    <div class="contact-form__group">
                        <label for="email">E-posta Adresiniz</label>
                        <input type="email" id="email" name="email" placeholder="orn@mail.com" required>
                    </div>
                    <div class="contact-form__group">
                        <label for="phone">Telefon Numaranız</label>
                        <input type="tel" id="phone" name="phone" placeholder="0 5xx xxx xx xx">
                    </div>
                    <div class="contact-form__group">
                        <label for="message">Mesajınız</label>
                        <textarea id="message" name="message" rows="5" placeholder="Size nasıl yardımcı olabiliriz?" required></textarea>
                    </div>
                    <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center; padding: 18px;">Gönder</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section style="height: 500px; background: #eee; margin-bottom: 0;">
        <div style="width: 100%; height: 100%; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/sumela-monastery.png'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; position: relative;">
            <div style="position: absolute; inset: 0; background: rgba(15, 42, 29, 0.4);"></div>
            <div style="position: relative; z-index: 1; text-align: center; color: #fff;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--gold-light); margin-bottom: 20px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <h3 style="font-family: var(--font-display); font-size: 2rem;">Rize'nin kalbindeyiz.</h3>
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
?>
