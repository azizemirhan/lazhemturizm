<?php
/**
 * The header for our theme
 *
 * @package nextcore
 */

$nc_default_phone = '+90 464 000 00 00';
$nc_phone_display = lazhem_nc( 'topbar_phone', $nc_default_phone );
$nc_tel_href      = lazhem_nc_tel_href( $nc_phone_display );
if ( $nc_tel_href === '' ) {
	$nc_tel_href = lazhem_nc_tel_href( $nc_default_phone );
}
$nc_wa_url        = lazhem_nc( 'header_whatsapp_url', 'https://wa.me/904640000000' );
$nc_wa_label      = lazhem_nc( 'header_whatsapp_label', 'WhatsApp' );
$nc_logo          = lazhem_nc( 'header_logo', get_template_directory_uri() . '/assets/images/logo.png' );
$nc_logo_alt      = lazhem_nc( 'header_logo_alt', 'Lazhem Turizm' );
$nc_pill_1        = lazhem_nc( 'topbar_pill_1', 'Rize · Ardeşen' );
$nc_pill_2        = lazhem_nc( 'topbar_pill_2', '7/24 Bilgi Hattı' );
$nc_pill_3        = lazhem_nc( 'topbar_pill_3', '2014\'ten beri Karadeniz uzmanı' );
$nc_lang          = lazhem_nc( 'topbar_lang_label', 'TR' );
$nc_mega_eyebrow  = lazhem_nc( 'mega_eyebrow', 'Karadeniz Bölgeleri' );
$nc_mega_pre      = lazhem_nc( 'mega_h3_prefix', 'Bulutların' );
$nc_mega_em       = lazhem_nc( 'mega_h3_em', 'arasında' );
$nc_mega_suf      = lazhem_nc( 'mega_h3_suffix', 'bir yolculuk' );
$nc_mega_desc     = lazhem_nc( 'mega_desc', 'Yaylalar, mistik göller, çay tepeleri ve tarih kokan sahillerle örülmüş 12 destinasyon, tek bir hayalinizde buluşuyor.' );
$nc_mega_cta      = lazhem_nc( 'mega_cta_text', 'Tüm destinasyonları keşfet' );
$nc_mega_cta_url  = lazhem_nc( 'mega_cta_url', '#' );
$nc_mega_dests    = lazhem_nc_mega_destinations();
$nc_href_balayi   = lazhem_listings_url_with_category_hints( array( 'balayi', 'balayi-paketleri' ), array( 'Balayı' ) );
$nc_href_bungalov = lazhem_listings_url_with_category_hints( array( 'bungalov', 'bungalovlar' ), array( 'Bungalov' ) );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..900;1,9..144,300..900&family=DM+Sans:ital,opsz,wght@0,9..40,300..700;1,9..40,300..700&family=Caveat:wght@400..700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
    <style>
        body, html { margin: 0; padding: 0; background-color: #FAF7EF; }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <!-- ═══════════════ TOPBAR ═══════════════ -->
  <div class="topbar">
    <div class="topbar__inner">
      <div class="topbar__left">
        <span class="topbar__pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
            <circle cx="12" cy="10" r="3" />
          </svg>
          <span><?php echo esc_html( $nc_pill_1 ); ?></span>
        </span>
        <span class="topbar__sep"></span>
        <span class="topbar__pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
          <span><?php echo esc_html( $nc_pill_2 ); ?></span>
        </span>
        <span class="topbar__sep"></span>
        <span class="topbar__pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5z" />
            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
          </svg>
          <span><?php echo esc_html( $nc_pill_3 ); ?></span>
        </span>
      </div>
      <div class="topbar__right">
        <a href="<?php echo esc_url( $nc_tel_href ); ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path
              d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
          </svg>
          <span><?php echo esc_html( $nc_phone_display ); ?></span>
        </a>
        <button class="topbar__lang" type="button">
          <span><?php echo esc_html( $nc_lang ); ?></span>
          <svg width="10" height="6" viewBox="0 0 10 6">
            <path d="M1 1l4 4 4-4" stroke="currentColor" fill="none" stroke-width="1.5" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- ═══════════════ HEADER ═══════════════ -->
  <header class="site-header" id="siteHeader">
    <div class="header__inner">
      <!-- Logo -->
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo--image-only" aria-label="<?php echo esc_attr( $nc_logo_alt ); ?> Anasayfa">
        <img src="<?php echo esc_url( $nc_logo ); ?>" alt="<?php echo esc_attr( $nc_logo_alt ); ?>" class="logo__img">
      </a>

      <!-- Primary nav -->
      <nav aria-label="Birincil gezinme">
        <ul class="nav-primary">
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Ana Sayfa</a></li>

          <!-- BÖLGELER mega -->
          <li class="has-mega" data-mega="destinations">
            <a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-regions.php', '/bolgeler' ) ); ?>" class="nav-link" aria-haspopup="true" aria-expanded="false">
              Bölgeler
              <svg viewBox="0 0 12 12" fill="none" width="12" height="12">
                <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              </svg>
            </a>
          </li>

          <li><a href="<?php echo esc_url( lazhem_page_url_by_template( 'template-listings.php', '/ilanlar' ) ); ?>" class="nav-link">İlanlar</a></li>

          <li><a href="<?php echo esc_url( $nc_href_balayi ); ?>" class="nav-link">Balayı</a></li>
          <li><a href="<?php echo esc_url( $nc_href_bungalov ); ?>" class="nav-link">Bungalov</a></li>
          <li><a href="<?php echo esc_url( home_url( '/hakkimizda' ) ); ?>" class="nav-link">Hakkımızda</a></li>
          <li><a href="<?php echo esc_url( home_url( '/iletisim' ) ); ?>" class="nav-link">İletişim</a></li>
        </ul>
      </nav>

      <!-- Header actions -->
      <div class="header-actions">
        <button class="icon-btn" type="button" aria-label="Ara">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="11" cy="11" r="7.5" />
            <path d="m21 21-4.3-4.3" stroke-linecap="round" />
          </svg>
        </button>
        <a href="<?php echo esc_url( $nc_tel_href ); ?>" class="btn btn--phone">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
          </svg>
          Telefon
        </a>
        <a href="<?php echo esc_url( $nc_wa_url ); ?>" class="btn btn--whats" target="_blank" rel="noopener noreferrer">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
          </svg>
          <?php echo esc_html( $nc_wa_label ); ?>
        </a>
      </div>

      <!-- Hamburger (mobile) -->
      <button class="hamburger" id="hamburger" type="button" aria-label="Menü" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>

    <!-- ───────── DESTINATIONS MEGA ───────── -->
    <div class="mega mega--destinations" id="megaDestinations" aria-hidden="true">
      <div class="mega__bg" aria-hidden="true"></div>
      <div class="mega__inner">
        <div class="mega__head">
          <span class="eyebrow"><?php echo esc_html( $nc_mega_eyebrow ); ?></span>
          <h3><?php echo esc_html( $nc_mega_pre ); ?> <em><?php echo esc_html( $nc_mega_em ); ?></em> <?php echo esc_html( $nc_mega_suf ); ?></h3>
          <p><?php echo wp_kses_post( $nc_mega_desc ); ?></p>
          <a href="<?php echo esc_url( $nc_mega_cta_url ); ?>" class="mega__cta">
            <?php echo esc_html( $nc_mega_cta ); ?>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </a>
        </div>

        <div class="dest-grid">
			<?php foreach ( $nc_mega_dests as $dest ) : ?>
				<?php
				$d_url   = isset( $dest['url'] ) && $dest['url'] !== '' ? $dest['url'] : '#';
				if ( $d_url !== '#' && strpos( $d_url, '://' ) === false && isset( $d_url[0] ) && $d_url[0] === '/' ) {
					$d_url = home_url( $d_url );
				}
				$d_img   = isset( $dest['image'] ) ? $dest['image'] : '';
				$d_name  = isset( $dest['name'] ) ? $dest['name'] : '';
				$d_meta  = isset( $dest['meta'] ) ? $dest['meta'] : '';
				$d_style = $d_img !== '' ? 'background-image:url(\'' . esc_url( $d_img ) . '\')' : '';
				?>
          <a href="<?php echo esc_url( $d_url ); ?>" class="dest-card">
            <div class="dest-card__img" style="<?php echo esc_attr( $d_style ); ?>"></div>
            <div class="dest-card__body">
              <div class="dest-card__name"><?php echo esc_html( $d_name ); ?></div>
              <div class="dest-card__meta"><?php echo esc_html( $d_meta ); ?></div>
            </div>
          </a>
			<?php endforeach; ?>
        </div>
      </div>
    </div>
  </header>

  <!-- Mega backdrop (index.html ile aynı: header ile #page arası) -->
  <div class="mega-backdrop" id="megaBackdrop"></div>

<div id="page" class="site">
