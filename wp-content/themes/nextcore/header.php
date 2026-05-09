<?php
/**
 * The header for our theme
 *
 * @package nextcore
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..900;1,9..144,300..900&family=DM+Sans:ital,opsz,wght@0,9..40,300..700;1,9..40,300..700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
    <style>
        body, html { width: 100% !important; max-width: 100% !important; margin: 0 !important; padding: 0 !important; background-color: #FAF7EF !important; }
        #page { width: 100% !important; max-width: 100% !important; margin: 0 !important; padding: 0 !important; }
        .site-header, .site-footer, .topbar { width: 100% !important; max-width: 100% !important; }
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
          <span>Rize · Ardeşen</span>
        </span>
        <span class="topbar__sep"></span>
        <span class="topbar__pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
          <span>7/24 Bilgi Hattı</span>
        </span>
        <span class="topbar__sep"></span>
        <span class="topbar__pill">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5z" />
            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
          </svg>
          <span>2014'ten beri Karadeniz uzmanı</span>
        </span>
      </div>
      <div class="topbar__right">
        <a href="tel:+904640000000">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path
              d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
          </svg>
          <span>+90 464 000 00 00</span>
        </a>
        <button class="topbar__lang">
          <span>TR</span>
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
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo logo--image-only" aria-label="Lazhem Turizm Anasayfa">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="Lazhem Turizm" class="logo__img">
      </a>

      <!-- Primary nav -->
      <nav aria-label="Birincil gezinme">
        <ul class="nav-primary">
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">Ana Sayfa</a></li>

          <!-- BÖLGELER mega -->
          <li class="has-mega" data-mega="destinations">
            <button class="nav-link" aria-haspopup="true" aria-expanded="false">
              Bölgeler
              <svg viewBox="0 0 12 12" fill="none">
                <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              </svg>
            </button>
          </li>

          <li><a href="<?php echo esc_url( home_url( '/balayi' ) ); ?>" class="nav-link">Balayı</a></li>
          <li><a href="<?php echo esc_url( home_url( '/bungalov' ) ); ?>" class="nav-link">Bungalov</a></li>
          <li><a href="<?php echo esc_url( home_url( '/hakkimizda' ) ); ?>" class="nav-link">Hakkımızda</a></li>
          <li><a href="<?php echo esc_url( home_url( '/iletisim' ) ); ?>" class="nav-link">İletişim</a></li>
        </ul>
      </nav>

      <!-- Header actions -->
      <div class="header-actions">
        <button class="icon-btn" aria-label="Ara">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.35-4.35" />
          </svg>
        </button>
        <a href="https://wa.me/904640000000?text=Merhaba%2C%20web%20sitenizden%20yaz%C4%B1yorum%2C%20turlar%20ve%20konaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
          class="btn btn--ghost" target="_blank" rel="noopener noreferrer">WhatsApp</a>
        <a href="https://wa.me/904640000000" class="btn btn--whats">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
          </svg>
          WhatsApp
        </a>
      </div>

      <!-- Hamburger (mobile) -->
      <button class="hamburger" id="hamburger" aria-label="Menü" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>

    <!-- ───────── DESTINATIONS MEGA ───────── -->
    <div class="mega mega--destinations" id="megaDestinations" aria-hidden="true">
      <div class="mega__bg" aria-hidden="true"></div>
      <div class="mega__inner">
        <div class="mega__head">
          <span class="eyebrow">Karadeniz Bölgeleri</span>
          <h3>Bulutların <em>arasında</em> bir yolculuk</h3>
          <p>Yaylalar, mistik göller, çay tepeleri ve tarih kokan sahillerle örülmüş 12 destinasyon, tek bir hayalinizde
            buluşuyor.</p>
          <a href="#" class="mega__cta">
            Tüm destinasyonları keşfet
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
              <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </a>
        </div>

        <div class="dest-grid">
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/ayder-yaylasi-hero.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Ayder Yaylası</div>
              <div class="dest-card__meta">1.350m · Rize</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/uzungol-lake.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Uzungöl</div>
              <div class="dest-card__meta">Trabzon · Çaykara</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/rize-tea-plantations.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Çay Bahçeleri</div>
              <div class="dest-card__meta">Rize · İyidere</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/mavigol-mysterious.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Mavigöl</div>
              <div class="dest-card__meta">Giresun · Dereli</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Pokut Yaylası</div>
              <div class="dest-card__meta">2.100m · Çamlıhemşin</div>
            </div>
          </a>
          <a href="#" class="dest-card">
              <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/karagol-snow.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Karagöl</div>
              <div class="dest-card__meta">Borçka · Artvin</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/batum-seaside.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Batum</div>
              <div class="dest-card__meta">Gürcistan</div>
            </div>
          </a>
          <a href="#" class="dest-card">
            <div class="dest-card__img"
              style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/sumela-monastery.png')">
            </div>
            <div class="dest-card__body">
              <div class="dest-card__name">Sumela Manastırı</div>
              <div class="dest-card__meta">Maçka · Trabzon</div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </header>

<div id="page" class="site">
