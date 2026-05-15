<?php
/**
 * Footer template — Next Content (eternal_general_*)
 *
 * @package nextcore
 */

$fn_default_phone = '+90 464 000 00 00';
$fn_phone         = lazhem_nc( 'footer_phone_display', $fn_default_phone );
$fn_tel_href      = lazhem_nc_tel_href( $fn_phone );
if ( $fn_tel_href === '' ) {
	$fn_tel_href = lazhem_nc_tel_href( $fn_default_phone );
}
$fn_email    = lazhem_nc( 'footer_email', 'info@lazhemturizm.com' );
$fn_wa       = lazhem_nc( 'header_whatsapp_url', 'https://wa.me/904640000000' );
$fn_wa_parts = wp_parse_url( $fn_wa );
$fn_wa_q     = ( ! empty( $fn_wa_parts['query'] ) ? '&' : '?' ) . 'text=' . rawurlencode( 'Merhaba, bilgi almak istiyorum.' );
$fn_wa_msg   = $fn_wa . $fn_wa_q;
$fn_logo     = lazhem_nc( 'footer_logo', get_template_directory_uri() . '/assets/images/logo.png' );
$fn_logo_alt = lazhem_nc( 'footer_logo_alt', 'Lazhem Turizm' );
$fn_nl_eyebrow = lazhem_nc( 'newsletter_eyebrow', 'Yayla Mektubu' );
$fn_nl_pre     = lazhem_nc( 'newsletter_title_prefix', "Karadeniz'den size" );
$fn_nl_em      = lazhem_nc( 'newsletter_title_em', 'ilham veren' );
$fn_nl_suf     = lazhem_nc( 'newsletter_title_suffix', 'haberler' );
$fn_nl_desc    = lazhem_nc( 'newsletter_desc', 'Sezonluk fırsatlar, yeni rotalar ve abonelere özel bungalov indirimleri — ayda yalnızca iki kez gelir.' );
$fn_nl_ph      = lazhem_nc( 'newsletter_placeholder', 'E-posta adresiniz' );
$fn_nl_note    = lazhem_nc( 'newsletter_note', 'KVKK kapsamında verileriniz gizli tutulur · İstediğiniz zaman çıkabilirsiniz.' );
$fn_about      = lazhem_nc( 'footer_about_text', 'Karadeniz\'in doğasını ve kültürel mirasını keşfetmenin en zarif yolu. 2014\'ten bu yana yaylalarda hayaller buluşturuyoruz.' );
$fn_sig        = lazhem_nc( 'footer_signature', '— Bulutların misafirperveri' );
$fn_href_balayi   = lazhem_listings_url_with_category_hints( array( 'balayi', 'balayi-paketleri' ), array( 'Balayı' ) );
$fn_href_bungalov = lazhem_listings_url_with_category_hints( array( 'bungalov', 'bungalovlar' ), array( 'Bungalov' ) );
$fn_ig         = lazhem_nc( 'social_instagram', '#' );
$fn_fb         = lazhem_nc( 'social_facebook', '#' );
$fn_yt         = lazhem_nc( 'social_youtube', '#' );
$fn_tt         = lazhem_nc( 'social_tiktok', '#' );
$fn_addr       = lazhem_nc( 'footer_address_line', '<strong>Ofis</strong>Cumhuriyet Cad. No:42<br>Ardeşen / Rize' );
$fn_bottom     = lazhem_nc( 'footer_bottom_copy', '© 2026 <strong>Lazhem Turizm</strong> · TÜRSAB Belge No: A-0000 · Tüm hakları saklıdır.' );
$fn_legal      = lazhem_nc_legal_links();
?>
</div><!-- #page --><footer class="site-footer">

    <!-- Newsletter -->
    <div class="newsletter">
      <div class="newsletter__inner">
        <div class="newsletter__head">
          <div class="eyebrow"><?php echo esc_html( $fn_nl_eyebrow ); ?></div>
          <h2><?php echo esc_html( $fn_nl_pre ); ?> <em><?php echo esc_html( $fn_nl_em ); ?></em> <?php echo esc_html( $fn_nl_suf ); ?></h2>
          <p><?php echo wp_kses_post( $fn_nl_desc ); ?></p>
        </div>

        <form class="newsletter__form" onsubmit="event.preventDefault(); alert('Aboneliğiniz alındı, teşekkürler.');">
          <div class="newsletter__field">
            <input type="email" placeholder="<?php echo esc_attr( $fn_nl_ph ); ?>" required>
            <button type="submit">
              Abone ol
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </button>
          </div>
          <div class="newsletter__note"><?php echo wp_kses_post( $fn_nl_note ); ?></div>
        </form>
      </div>
    </div>

    <!-- Main footer -->
    <div class="footer-main">
      <div class="footer-main__inner">

        <div class="footer-brand">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo--image-only footer-logo-card" aria-label="<?php echo esc_attr( $fn_logo_alt ); ?> Anasayfa">
            <img src="<?php echo esc_url( $fn_logo ); ?>" alt="<?php echo esc_attr( $fn_logo_alt ); ?>" class="logo__img">
          </a>
          <p><?php echo wp_kses_post( $fn_about ); ?></p>
          <div class="signature"><?php echo esc_html( $fn_sig ); ?></div>

          <div class="socials" aria-label="Sosyal medya">
            <a href="<?php echo esc_url( $fn_ig ); ?>" aria-label="Instagram" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" />
                <path d="M16 11.37a4 4 0 11-7.914 1.176A4 4 0 0116 11.37z" />
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
              </svg></a>
            <a href="<?php echo esc_url( $fn_fb ); ?>" aria-label="Facebook" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
              </svg></a>
            <a href="<?php echo esc_url( $fn_yt ); ?>" aria-label="YouTube" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path
                  d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z" />
                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor" />
              </svg></a>
            <a href="<?php echo esc_url( $fn_tt ); ?>" aria-label="TikTok" rel="noopener noreferrer"><svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005.8 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1.84-.1z" />
              </svg></a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Bölgeler</h4>
          <ul>
            <?php
            $footer_regions = lazhem_nc_footer_regions();
            if ( ! empty( $footer_regions ) ):
              foreach ( $footer_regions as $term ):
                ?>
                <li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                <?php
              endforeach;
            else:
              // Fallback if no regions selected in Next Content
              ?>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/ayder-yaylasi' ) ); ?>">Ayder Yaylası</a></li>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/uzungol' ) ); ?>">Uzungöl</a></li>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/mavigol-giresun' ) ); ?>">Mavigöl & Giresun</a></li>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/pokut-yaylasi' ) ); ?>">Pokut Yaylası</a></li>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/sumela-manastiri' ) ); ?>">Sumela Manastırı</a></li>
              <li><a href="<?php echo esc_url( home_url( '/ilan-bolgesi/batum' ) ); ?>">Batum</a></li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Lazhem Turizm</h4>
          <ul>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Anasayfa</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-listings.php', '/ilanlar' ) ); ?>">İlanlar</a></li>
            <li><a href="<?php echo esc_url( $fn_href_balayi ); ?>">Balayı</a></li>
            <li><a href="<?php echo esc_url( $fn_href_bungalov ); ?>">Bungalov</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-contact.php', '/iletisim' ) ); ?>">İletişim</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Kurumsal</h4>
          <ul>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-terms.php', '/kullanim-kosullari' ) ); ?>">Kullanım Koşulları</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-privacy.php', '/gizlilik-politikasi' ) ); ?>">Gizlilik Politikası</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-cookies.php', '/cerez-politikasi' ) ); ?>">Çerez Politikası</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-sales.php', '/mesafeli-satis-sozlesmesi' ) ); ?>">Satış Sözleşmesi</a></li>
            <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-contact.php', '/iletisim' ) ); ?>">İletişim</a></li>
          </ul>
        </div>

        <div class="footer-col footer-contact">
          <h4>İletişim</h4>
          <ul>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
              <span><?php echo wp_kses_post( $fn_addr ); ?></span>
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                  d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
              </svg>
              <span><strong>Telefon</strong><a href="<?php echo esc_url( $fn_tel_href ); ?>"><?php echo esc_html( $fn_phone ); ?></a></span>
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
              <span><strong>E-posta</strong><a href="mailto:<?php echo esc_attr( $fn_email ); ?>"><?php echo esc_html( $fn_email ); ?></a></span>
            </li>
          </ul>
        </div>

      </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer-bar">
      <div class="footer-bar__inner">
        <div class="footer-bar__copy">
          <?php echo wp_kses_post( $fn_bottom ); ?>
        </div>
        <div class="footer-bar__legal">
			<?php foreach ( $fn_legal as $link ) : ?>
				<?php if ( ! empty( $link['url'] ) || ! empty( $link['label'] ) ) : ?>
          <a href="<?php echo esc_url( $link['url'] !== '' ? $link['url'] : '#' ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
        </div>
        <div class="footer-bar__pay">
          <span class="pay-chip">VISA</span>
          <span class="pay-chip">MC</span>
          <span class="pay-chip">TROY</span>
        </div>
      </div>
    </div>

  </footer>

  <!-- ═══════════════ MOBILE BOTTOM NAV ═══════════════ -->
  <nav class="bottom-nav" aria-label="Mobil hızlı erişim">
    <ul class="bottom-nav__list">
      <li>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bottom-nav__item active">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
          </svg>
          <span>Anasayfa</span>
        </a>
      </li>
      <li>
        <a href="<?php echo esc_url( home_url( '/rotalar' ) ); ?>" class="bottom-nav__item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="10" r="3" />
            <path d="M12 2a8 8 0 00-8 8c0 5.4 8 12 8 12s8-6.6 8-12a8 8 0 00-8-8z" />
          </svg>
          <span>Rotalar</span>
        </a>
      </li>
      <li class="bottom-nav__fab">
        <a href="<?php echo esc_url( $fn_wa ); ?>" aria-label="WhatsApp ile iletişim" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
          </svg>
        </a>
        <span>Hızlı Soru</span>
      </li>
      <li>
        <a href="<?php echo esc_url( $fn_wa_msg ); ?>" class="bottom-nav__item" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          <span>Talep Oluştur</span>
        </a>
      </li>
      <li>
        <a href="#" class="bottom-nav__item" id="openMobileMenu">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="18" x2="21" y2="18" />
          </svg>
          <span>Menü</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- ═══════════════ MOBILE SLIDE-OUT ═══════════════ -->
  <aside class="mobile-panel" id="mobilePanel" aria-hidden="true">
    <div class="mobile-panel__head">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo--image-only footer-logo-card" aria-label="<?php echo esc_attr( $fn_logo_alt ); ?> Anasayfa">
        <img src="<?php echo esc_url( $fn_logo ); ?>" alt="<?php echo esc_attr( $fn_logo_alt ); ?>" class="logo__img" />
      </a>
      <button class="mobile-panel__close" id="closeMobilePanel" type="button" aria-label="Kapat">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 6L6 18M6 6l12 12" />
        </svg>
      </button>
    </div>

    <nav class="mobile-panel__nav">
      <div class="m-nav-item">
        <a class="m-nav-toggle" href="<?php echo esc_url( home_url( '/' ) ); ?>">Ana Sayfa</a>
      </div>

      <div class="m-nav-item">
        <button class="m-nav-toggle" type="button">
          Bölgeler
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14M5 12h14" />
          </svg>
        </button>
        <div class="m-nav-sub">
          <div>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/ayder' ) ); ?>">Ayder Yaylası</a></li>
              <li><a href="<?php echo esc_url( home_url( '/uzungol' ) ); ?>">Uzungöl</a></li>
              <li><a href="<?php echo esc_url( home_url( '/mavigol' ) ); ?>">Mavigöl</a></li>
              <li><a href="<?php echo esc_url( home_url( '/pokut' ) ); ?>">Pokut Yaylası</a></li>
              <li><a href="<?php echo esc_url( home_url( '/sumela' ) ); ?>">Sumela Manastırı</a></li>
              <li><a href="<?php echo esc_url( home_url( '/batum' ) ); ?>">Batum</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="m-nav-item">
        <a class="m-nav-toggle" href="<?php echo esc_url( $fn_href_balayi ); ?>">Balayı</a>
      </div>
      <div class="m-nav-item">
        <a class="m-nav-toggle" href="<?php echo esc_url( $fn_href_bungalov ); ?>">Bungalov</a>
      </div>
      <div class="m-nav-item">
        <a class="m-nav-toggle" href="<?php echo esc_url( home_url( '/hakkimizda' ) ); ?>">Hakkımızda</a>
      </div>
      <div class="m-nav-item">
        <a class="m-nav-toggle" href="<?php echo esc_url( home_url( '/iletisim' ) ); ?>">İletişim</a>
      </div>
    </nav>

    <div class="mobile-panel__foot">
      <a href="<?php echo esc_url( $fn_wa_msg ); ?>" class="btn btn--whats" target="_blank" rel="noopener noreferrer">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487 2.981 1.286 2.981.858 3.518.804.537-.054 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
        </svg>
        WhatsApp ile İletişim
      </a>
      <a href="<?php echo esc_url( $fn_tel_href ); ?>" class="btn btn--ghost" style="color:var(--paper); border-color:rgba(201,169,97,0.3);">Telefonla
        Ara</a>

      <div class="mobile-panel__contact">
        <span>7/24 Destek</span>
        <a href="<?php echo esc_url( $fn_tel_href ); ?>"><?php echo esc_html( $fn_phone ); ?></a>
      </div>
    </div>
  </aside>

<?php wp_footer(); ?>

</body>
</html>
