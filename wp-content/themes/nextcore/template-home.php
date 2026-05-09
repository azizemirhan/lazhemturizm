<?php
/* Template Name: Anasayfa Tasarımı */
get_header();
?>


  <!-- Mega backdrop -->
  <div class="mega-backdrop" id="megaBackdrop"></div>

  <!-- ═══════════════ HERO ═══════════════ -->
  <main>
    <section class="hero" aria-label="Tanıtım">
      <div class="hero__grid">

        <!-- LEFT: Text card -->
        <div class="hero__text">
          <span class="hero__pill">7/24 Destek · 2014'ten beri Karadeniz</span>

          <div>
            <h1 class="hero__title">
              <span class="ornament"></span>Bulutların altında,<br>
              <em>huzurun</em> tam ortasında bir tatil.
            </h1>
            <p class="hero__lede">
              Ayder'in yeşilinden Uzungöl'ün gizemine, çay tepelerinden bungalov ateşine — Lazhem ile Karadeniz'i bir
              tatilden çok bir hikâye olarak yaşayın.
            </p>

            <div class="hero__actions">
              <a href="#" class="btn btn--primary">
                Rotanı Keşfet
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </a>
              <a href="https://wa.me/904640000000" class="btn btn--whats">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                WhatsApp ile Sor
              </a>
            </div>
          </div>

          <div class="hero__meta">
            <div class="hero__meta-stack">
              <span class="hero__meta-avatar"
                style="background-image:url('https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=80&q=80')"></span>
              <span class="hero__meta-avatar"
                style="background-image:url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&q=80')"></span>
              <span class="hero__meta-avatar"
                style="background-image:url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=80&q=80')"></span>
              <span class="hero__meta-avatar"
                style="background-image:url('https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=80&q=80')"></span>
            </div>
            <div>
              <div class="hero__meta-rating">
                <em>4.9</em> ★★★★★ <span style="font-weight:400; color:var(--ink-mute); font-size:0.85em;">/ 5</span>
              </div>
              <div class="hero__meta-text">3.200+ misafir · Google & TripAdvisor</div>
            </div>
          </div>
        </div>

        <!-- RIGHT: Image card with arc text -->
        <div class="hero__visual">
          <div class="hero__visual-img" role="img" aria-label="Karadeniz yaylalarından sisli bir manzara"></div>

          <div class="hero__weather" title="Ayder Yaylası bugün">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M17 18a4 4 0 100-8 6 6 0 00-11.6 1A4 4 0 005 18z" />
            </svg>
            <div>
              <small>Ayder · Bugün</small>
              <strong>16°C, sisli</strong>
            </div>
          </div>

          <div class="hero__floating-tag">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            Karadeniz · Ayder Yaylası
          </div>

          <div class="hero__arc" aria-hidden="true">
            <svg viewBox="0 0 600 480" preserveAspectRatio="none">
              <defs>
                <!-- Filled band (visual) -->
                <path id="arcBand" d="M -40,90 Q 240,210 660,400 L 660,460 Q 240,265 -40,150 Z" />
                <!-- Centerline path for text -->
                <path id="arcText" d="M -30,120 Q 240,235 660,425" />
              </defs>
              <use href="#arcBand" fill="#F4EFE3" />
              <text fill="#0F2A1D" font-family="Fraunces, serif" font-size="20" font-style="italic" font-weight="400"
                letter-spacing="0.5">
                <textPath href="#arcText" startOffset="50%" text-anchor="middle">
                  yaylanın sessizliği · bulutların selamı · çay tarlasında bir nefes · Karadeniz'in büyüsü
                </textPath>
              </text>
            </svg>
          </div>
        </div>

      </div>
    </section>

    <!-- ═══════════════ TOUR SLIDER ═══════════════ -->
    <section class="slider-section" aria-label="Öne çıkan turlar ve bungalovlar">
      <div class="slider-section__inner">

        <div class="slider__head">
          <div class="slider__head-left">
            <div class="eyebrow">Öne Çıkan Deneyimler</div>
            <h2>Yaylanın <em>en güzel</em> rotaları, sizin hikâyeniz olsun.</h2>
          </div>
          <div class="slider__controls">
            <span class="slider__count" id="sliderCount">01 <em>/ 08</em></span>
            <button class="slider__btn" id="sliderPrev" aria-label="Önceki" disabled>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M15 18l-6-6 6-6" />
              </svg>
            </button>
            <button class="slider__btn" id="sliderNext" aria-label="Sonraki">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M9 18l6-6-6-6" />
              </svg>
            </button>
          </div>
        </div>

        <div class="slider__viewport" id="sliderViewport">
          <div class="slider__track">

            <!-- Card 1: Ayder Tour -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/ayder-yaylasi-hero.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge tour-badge--video">Video İzle</span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Ayder Yaylası<br>2 Gün Turu</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Rize
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    2 Gece
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Kişi Başı</small>
                ₺ 4.250
              </div>
            </a>

            <!-- Card 2: Pokut Bungalov -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                  </svg>
                  Bungalov
                </span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Pokut'ta<br>Ahşap Bungalov</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Çamlıhemşin
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                      <circle cx="9" cy="7" r="4" />
                      <path d="M22 21v-2a4 4 0 00-3-3.87" />
                    </svg>
                    2-4 Kişi
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Gece</small>
                ₺ 3.900
              </div>
            </a>

            <!-- Card 3: SPECIAL CTA -->
            <div class="tour-card tour-card--cta">
              <span class="tour-badge">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M9 11l3 3L22 4l-1.5-1.5L12 11 10.5 9.5 9 11z" />
                  <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" fill="none" stroke="currentColor"
                    stroke-width="2" />
                </svg>
                Hızlı İletişim
              </span>
              <h3 class="tour-card--cta__title">Size <em>özel</em> bir rota planlayalım.</h3>
              <p>Numaranızı bırakın, bölge uzmanımız 10 dakika içinde sizi arasın. Ücretsiz danışmanlık.</p>
              <div class="tour-card--cta__form">
                <input type="tel" placeholder="0 5XX XXX XX XX" required>
                <button type="button" onclick="alert('Talebiniz alındı, kısa sürede arayacağız.');">
                  Beni Ara
                  <svg width="12" height="12" viewBox="0 0 14 14" fill="none">
                    <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Card 4: Uzungöl -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/uzungol-lake.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge tour-badge--video">Video İzle</span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Uzungöl &<br>Sumela Turu</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Trabzon
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Günübirlik
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Kişi Başı</small>
                ₺ 1.890
              </div>
            </a>

            <!-- Card 5: Honeymoon -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/luxury-bungalow-interior.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge">
                  <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                  </svg>
                  Balayı
                </span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Loft Bungalov<br>Balayı Paketi</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    4 Gece
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path
                        d="M5 12V7a7 7 0 0114 0v5M5 12h14a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                    </svg>
                    Jakuzili
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Çift Başına</small>
                ₺ 18.500
              </div>
            </a>

            <!-- Card 6: Mavigöl -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/mavigol-mysterious.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                  </svg>
                  Yeni
                </span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Mavigöl<br>Glamping</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Giresun
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    3 Gece
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Gece</small>
                ₺ 5.250
              </div>
            </a>

            <!-- Card 7: Batum -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/batum-seaside.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="2" y1="12" x2="22" y2="12" />
                    <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
                  </svg>
                  Yurtdışı
                </span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Batum<br>Şehir Turu</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Gürcistan
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Günübirlik
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Kişi Başı</small>
                ₺ 2.450
              </div>
            </a>

            <!-- Card 8: Transfer -->
            <a href="#" class="tour-card">
              <div class="tour-card__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/karagol-snow.png')">
              </div>
              <div class="tour-card__top">
                <span class="tour-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="6" width="22" height="13" rx="2" />
                    <circle cx="7" cy="19" r="2" />
                    <circle cx="17" cy="19" r="2" />
                  </svg>
                  VIP Transfer
                </span>
                <span class="tour-arrow">
                  <svg viewBox="0 0 14 14" fill="none">
                    <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </span>
              </div>
              <div class="tour-card__body">
                <div class="tour-card__title">Havalimanı<br>VIP Karşılama</div>
                <div class="tour-card__meta">
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Trabzon · Rize
                  </span>
                  <span class="tour-card__meta-divider"></span>
                  <span class="tour-card__meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10" />
                      <polyline points="12 6 12 12 16 14" />
                    </svg>
                    7/24
                  </span>
                </div>
              </div>
              <div class="tour-card__price">
                <small>Tek Yön</small>
                ₺ 1.150
              </div>
            </a>

          </div>
        </div>

        <div class="slider__hint">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14m-7-7v14" />
          </svg>
          Kart üzerinde sürükle veya kaydır
        </div>

      </div>
    </section>
    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 1  ·  BUNGALOV — EDITORIAL SPREAD
     ═══════════════════════════════════════════════════════════════ -->
    <section class="bn" aria-label="Bungalov koleksiyonu">
      <div class="bn__inner">

        <header class="bn__head">
          <div class="bn__head-text">
            <span class="eyebrow">Bungalov Koleksiyonu</span>
            <h2>Doğanın <em>kucağında</em>, ahşabın sıcaklığında bir uyku.</h2>
            <p>Karadeniz'in en zarif yaylalarına özenle yerleştirilmiş 12 bungalov. Her biri kendi karakteriyle — biri
              ormanın tam ortasında, biri sisin üzerinde, biri çay tarlasının yanı başında.</p>
          </div>
          <div class="bn__index">
            <span class="bn__index-label">— şu an gösteriliyor</span>
            <span class="bn__index-current" id="bnCurrent">01 <em>/ 04</em></span>
          </div>
        </header>

        <div class="bn__tabs" role="tablist">
          <button class="bn-tab active" data-bn="pokut" role="tab"><span>01</span> Pokut Loft</button>
          <button class="bn-tab" data-bn="mavigol" role="tab"><span>02</span> Mavigöl Glamping</button>
          <button class="bn-tab" data-bn="ayder" role="tab"><span>03</span> Ayder Klasik</button>
          <button class="bn-tab" data-bn="sal" role="tab"><span>04</span> Sal Suit</button>
        </div>

        <!-- POKUT -->
        <div class="bn-showcase active" data-show="pokut">
          <div class="bn__spread">
            <article class="bn-hero">
              <div class="bn-hero__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
              </div>
              <div class="bn-hero__top">
                <span class="bn-hero__chip">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                  </svg>
                  Misafir Favorisi
                </span>
                <span class="bn-hero__chip bn-hero__chip--dark">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                  </svg>
                  Tüm Galeri (24)
                </span>
              </div>
              <div class="bn-hero__bottom">
                <div class="bn-hero__loc">Çamlıhemşin · Rize · 2.100m</div>
                <h3 class="bn-hero__name">Pokut <em>Loft</em></h3>
                <p class="bn-hero__sub">Bulutların hizasında, ahşap ve cam — sisin doğrudan terasınıza misafir geldiği
                  bir bungalov.</p>
              </div>
            </article>

            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/luxury-bungalow-interior.png')">
              </div>
              <span class="bn-detail__zoom">
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </span>
              <span class="bn-detail__cap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M5 12V7a7 7 0 0114 0v5" />
                  <rect x="3" y="12" width="18" height="9" rx="2" />
                </svg>
                Açık Hava Jakuzisi
              </span>
            </article>

            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
              </div>
              <span class="bn-detail__zoom">
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </span>
              <span class="bn-detail__cap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="8" width="18" height="11" rx="2" />
                  <path d="M3 14h18" />
                </svg>
                Çift Kişilik Yatak Odası
              </span>
            </article>
          </div>

          <div class="bn__ribbon">
            <div class="bn-ribbon__price">
              <span class="bn-ribbon__price-from">Gece başı / 2 kişi</span>
              <span class="bn-ribbon__price-amt">₺ 3.900<em>'den</em></span>
            </div>
            <div class="bn-ribbon__specs">
              <div class="bn-spec">
                <span class="bn-spec__label">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" />
                    <path d="M9 3v18M15 3v18M3 9h18M3 15h18" />
                  </svg>
                  Alan
                </span>
                <span class="bn-spec__value">65 <em>m²</em></span>
              </div>
              <div class="bn-spec">
                <span class="bn-spec__label">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 21v-2a4 4 0 00-3-3.87" />
                  </svg>
                  Kapasite
                </span>
                <span class="bn-spec__value">2-4 <em>kişi</em></span>
              </div>
              <div class="bn-spec">
                <span class="bn-spec__label">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="9" width="20" height="10" rx="2" />
                    <path d="M5 9V6a2 2 0 012-2h10a2 2 0 012 2v3" />
                  </svg>
                  Yatak
                </span>
                <span class="bn-spec__value">1 çift + 1 tek</span>
              </div>
              <div class="bn-spec">
                <span class="bn-spec__label">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                  </svg>
                  Min. Konaklama
                </span>
                <span class="bn-spec__value">2 <em>gece</em></span>
              </div>
            </div>
            <div class="bn-ribbon__cta">
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Pokut%20Loft%20Bungalov%20i%C3%A7in%20m%C3%BCsaitlik%20sormak%20istiyorum."
                class="btn btn--dark" target="_blank" rel="noopener noreferrer">Müsaitlik Sor</a>
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Pokut%20Loft%20Bungalov%20hakk%C4%B1nda%20bilgi%20ve%20fiyat%20sormak%20istiyorum."
                class="btn btn--gold" target="_blank" rel="noopener noreferrer">WhatsApp'tan Bilgi Al</a>
            </div>
          </div>
        </div>

        <!-- MAVIGOL -->
        <div class="bn-showcase" data-show="mavigol">
          <div class="bn__spread">
            <article class="bn-hero">
              <div class="bn-hero__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/mavigol-mysterious.png')">
              </div>
              <div class="bn-hero__top">
                <span class="bn-hero__chip">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                  </svg>
                  Yeni Sezon
                </span>
                <span class="bn-hero__chip bn-hero__chip--dark">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7" />
                    <rect x="14" y="3" width="7" height="7" />
                    <rect x="14" y="14" width="7" height="7" />
                    <rect x="3" y="14" width="7" height="7" />
                  </svg>
                  Tüm Galeri (18)
                </span>
              </div>
              <div class="bn-hero__bottom">
                <div class="bn-hero__loc">Dereli · Giresun · 1.450m</div>
                <h3 class="bn-hero__name">Mavigöl <em>Glamping</em></h3>
                <p class="bn-hero__sub">Turkuaz gölün hemen yanında, yıldızların altında çıplak gözle uyumanın hissini
                  geri getiren çadır-bungalov.</p>
              </div>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/luxury-bungalow-interior.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">İç Mekan</span>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/mavigol-mysterious.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">Göl Manzarası</span>
            </article>
          </div>
          <div class="bn__ribbon">
            <div class="bn-ribbon__price">
              <span class="bn-ribbon__price-from">Gece başı / 2 kişi</span>
              <span class="bn-ribbon__price-amt">₺ 3.250<em>'den</em></span>
            </div>
            <div class="bn-ribbon__specs">
              <div class="bn-spec"><span class="bn-spec__label">Alan</span><span class="bn-spec__value">45
                  <em>m²</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Kapasite</span><span class="bn-spec__value">2
                  <em>kişi</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Yatak</span><span class="bn-spec__value">1 çift</span>
              </div>
              <div class="bn-spec"><span class="bn-spec__label">Sezon</span><span class="bn-spec__value">May–Eki</span>
              </div>
            </div>
            <div class="bn-ribbon__cta">
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Mavig%C3%B6l%20Glamping%20i%C3%A7in%20m%C3%BCsaitlik%20sormak%20istiyorum."
                class="btn btn--dark" target="_blank" rel="noopener noreferrer">Müsaitlik Sor</a>
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Mavig%C3%B6l%20Glamping%20hakk%C4%B1nda%20bilgi%20ve%20fiyat%20sormak%20istiyorum."
                class="btn btn--gold" target="_blank" rel="noopener noreferrer">WhatsApp'tan Bilgi Al</a>
            </div>
          </div>
        </div>

        <!-- AYDER -->
        <div class="bn-showcase" data-show="ayder">
          <div class="bn__spread">
            <article class="bn-hero">
              <div class="bn-hero__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
              </div>
              <div class="bn-hero__top">
                <span class="bn-hero__chip">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                  </svg>
                  Aile Dostu
                </span>
                <span class="bn-hero__chip bn-hero__chip--dark">Tüm Galeri (32)</span>
              </div>
              <div class="bn-hero__bottom">
                <div class="bn-hero__loc">Ayder · Rize · 1.350m</div>
                <h3 class="bn-hero__name">Ayder <em>Klasik</em></h3>
                <p class="bn-hero__sub">Şömineli salon, geniş teras, çocuklar için ahşap salıncak — kalabalık aileler
                  için tasarlandı.</p>
              </div>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/uzungol-lake.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">Şömineli Salon</span>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/rize-tea-plantations.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">Geniş Banyo</span>
            </article>
          </div>
          <div class="bn__ribbon">
            <div class="bn-ribbon__price">
              <span class="bn-ribbon__price-from">Gece başı / aile</span>
              <span class="bn-ribbon__price-amt">₺ 4.500<em>'den</em></span>
            </div>
            <div class="bn-ribbon__specs">
              <div class="bn-spec"><span class="bn-spec__label">Alan</span><span class="bn-spec__value">80
                  <em>m²</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Kapasite</span><span class="bn-spec__value">4-6
                  <em>kişi</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Yatak</span><span class="bn-spec__value">2 çift + 1
                  tek</span></div>
              <div class="bn-spec"><span class="bn-spec__label">Şömine</span><span class="bn-spec__value">Var</span>
              </div>
            </div>
            <div class="bn-ribbon__cta">
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Ayder%20Klasik%20Bungalov%20i%C3%A7in%20m%C3%BCsaitlik%20sormak%20istiyorum."
                class="btn btn--dark" target="_blank" rel="noopener noreferrer">Müsaitlik Sor</a>
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Ayder%20Klasik%20Bungalov%20hakk%C4%B1nda%20bilgi%20ve%20fiyat%20sormak%20istiyorum."
                class="btn btn--gold" target="_blank" rel="noopener noreferrer">WhatsApp'tan Bilgi Al</a>
            </div>
          </div>
        </div>

        <!-- SAL -->
        <div class="bn-showcase" data-show="sal">
          <div class="bn__spread">
            <article class="bn-hero">
              <div class="bn-hero__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/ayder-yaylasi-hero.png')">
              </div>
              <div class="bn-hero__top">
                <span class="bn-hero__chip">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                  </svg>
                  Çiftlere Özel
                </span>
                <span class="bn-hero__chip bn-hero__chip--dark">Tüm Galeri (20)</span>
              </div>
              <div class="bn-hero__bottom">
                <div class="bn-hero__loc">Sal Yaylası · Çamlıhemşin · 1.800m</div>
                <h3 class="bn-hero__name">Sal <em>Suit</em></h3>
                <p class="bn-hero__sub">Sis denizinin tam ortasında, romantik akşamlar için tasarlanmış izole bir
                  kaçamak.</p>
              </div>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/sumela-monastery.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">Yatak Odası</span>
            </article>
            <article class="bn-detail">
              <div class="bn-detail__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/batum-seaside.png')">
              </div>
              <span class="bn-detail__zoom"><svg viewBox="0 0 14 14" fill="none">
                  <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg></span>
              <span class="bn-detail__cap">Sis Manzarası</span>
            </article>
          </div>
          <div class="bn__ribbon">
            <div class="bn-ribbon__price">
              <span class="bn-ribbon__price-from">Gece başı / 2 kişi</span>
              <span class="bn-ribbon__price-amt">₺ 3.450<em>'den</em></span>
            </div>
            <div class="bn-ribbon__specs">
              <div class="bn-spec"><span class="bn-spec__label">Alan</span><span class="bn-spec__value">55
                  <em>m²</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Kapasite</span><span class="bn-spec__value">2-3
                  <em>kişi</em></span></div>
              <div class="bn-spec"><span class="bn-spec__label">Yatak</span><span class="bn-spec__value">1 çift + 1
                  tek</span></div>
              <div class="bn-spec"><span class="bn-spec__label">Yükseklik</span><span
                  class="bn-spec__value">1.800<em>m</em></span></div>
            </div>
            <div class="bn-ribbon__cta">
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Sal%20Suit%20Bungalov%20i%C3%A7in%20m%C3%BCsaitlik%20sormak%20istiyorum."
                class="btn btn--dark" target="_blank" rel="noopener noreferrer">Müsaitlik Sor</a>
              <a href="https://wa.me/904640000000?text=Merhaba%2C%20Sal%20Suit%20Bungalov%20hakk%C4%B1nda%20bilgi%20ve%20fiyat%20sormak%20istiyorum."
                class="btn btn--gold" target="_blank" rel="noopener noreferrer">WhatsApp'tan Bilgi Al</a>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 2  ·  BALAYI — LOVE LETTER
     ═══════════════════════════════════════════════════════════════ -->
    <section class="bly" aria-label="Balayı paketi">
      <div class="bly__inner">

        <header class="bly__head">
          <span class="bly__hand-top">— sevgilerle, Lazhem</span>
          <h2 class="bly__title">
            İki kişilik bir <em>masal</em>
            <span class="bly__title-deco">
              <svg viewBox="0 0 60 24" fill="none">
                <path d="M2 12 Q15 4 30 12 Q45 20 58 12" stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round" />
              </svg>
            </span>
            <em>yaylanın</em> sessizliğinde
          </h2>
          <p class="bly__intro">Bulutların hizasında dört gün — siz sadece birbirinize bakın, gerisini biz hallederiz.
          </p>
        </header>

        <div class="bly__spread">

          <!-- POLAROIDS -->
          <div class="bly__polaroids">

            <div class="bly__stamp">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
              </svg>
              <strong>Lazhem</strong>
              Çifte<br>özel
            </div>

            <figure class="polaroid polaroid--main">
              <div class="polaroid__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/luxury-bungalow-interior.png')">
              </div>
              <figcaption class="polaroid__cap">Pokut, mart sabahı</figcaption>
            </figure>

            <figure class="polaroid polaroid--accent">
              <div class="polaroid__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/rize-tea-plantations.png')">
              </div>
              <figcaption class="polaroid__cap">çay molası</figcaption>
            </figure>
          </div>

          <!-- TIMELINE -->
          <div class="bly__timeline">

            <div class="bly__timeline-head">
              <h3 class="bly__pkg-name">Pokut'ta <em>4 Gece</em><br>Balayı Paketi</h3>
              <div class="bly__pkg-meta">
                <span class="bly__pkg-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                    <circle cx="12" cy="10" r="3" />
                  </svg>
                  Çamlıhemşin · Rize
                </span>
                <span class="bly__pkg-meta-divider"></span>
                <span class="bly__pkg-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                  </svg>
                  4 gece / 5 gün
                </span>
                <span class="bly__pkg-meta-divider"></span>
                <span class="bly__pkg-meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                  </svg>
                  2 kişi
                </span>
              </div>
            </div>

            <ol class="bly__days">
              <li class="day">
                <div class="day__head">
                  <div>
                    <span class="day__num">Gün Bir · Karşılama</span>
                  </div>
                  <span class="day__time">14:30 — 21:00</span>
                </div>
                <div class="day__title">Trabzon havalimanından <em>VIP transfer</em></div>
                <div class="day__items">
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Şampanya servisli karşılama</span></div>
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Gül süslemeli oda · welcome amenity</span></div>
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Mum ışığında ilk akşam yemeği</span></div>
                </div>
              </li>

              <li class="day">
                <div class="day__head">
                  <div><span class="day__num">Gün İki · Spa &amp; Tur</span></div>
                  <span class="day__time">tüm gün</span>
                </div>
                <div class="day__title">Yöresel <em>aromaterapi</em> ve özel rehberli yayla turu</div>
                <div class="day__items">
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Çift için 60 dk relaxation masajı</span></div>
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Sal + Pokut + Hazindak premium tur</span></div>
                </div>
              </li>

              <li class="day">
                <div class="day__head">
                  <div><span class="day__num">Gün Üç · Anı</span></div>
                  <span class="day__time">10:00 sonrası</span>
                </div>
                <div class="day__title">Profesyonel <em>fotoğraf çekimi</em> ve serbest gün</div>
                <div class="day__items">
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>1 saat dış mekan + 30 dijital kare</span></div>
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Açık hava jakuzisi · şömineli akşam</span></div>
                </div>
              </li>

              <li class="day">
                <div class="day__head">
                  <div><span class="day__num">Gün Dört · Veda</span></div>
                  <span class="day__time">11:00 — 14:00</span>
                </div>
                <div class="day__title">Geç kahvaltı ve <em>el sallayan</em> bir veda</div>
                <div class="day__items">
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Yöresel kahvaltı · sınırsız menü</span></div>
                  <div class="day__item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                      <polyline points="20 6 9 17 4 12" />
                    </svg><span>Havalimanına VIP transfer</span></div>
                </div>
              </li>
            </ol>

            <div class="bly__pricecard">
              <div class="bly__pricecard-left">
                <span class="bly__pricecard-from">Çift başı / 4 gece — her şey dahil</span>
                <span class="bly__pricecard-amt">₺ 18.500<em>'den</em></span>
                <span class="bly__pricecard-note">Vergiler, transfer, masaj ve fotoğraf çekimi dahildir.</span>
              </div>
              <div class="bly__pricecard-cta">
                <a href="#" class="btn btn--gold">Detayları Gör</a>
                <a href="https://wa.me/904640000000" class="btn btn--whats" target="_blank" rel="noopener noreferrer">
                  <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                      d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                  </svg>
                  WhatsApp
                </a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 3  ·  NEDEN LAZHEM — MANIFEST/INDEX
     ═══════════════════════════════════════════════════════════════ -->
    <section class="nd" aria-label="Neden Lazhem">
      <div class="nd__inner">

        <header class="nd__head">
          <div class="nd__head-left">
            <span class="nd__manifest-num">06 <em>· prensip</em></span>
            <span class="nd__manifest-tag">Lazhem Manifestosu</span>
          </div>
          <h2 class="nd__statement">
            <span class="nd__statement-deco"></span>Karadeniz'i bilen, sizi <em>tanıyan</em> bir yol arkadaşı — altı
            sözle özetlersek.
          </h2>
        </header>

        <ol class="nd__list">

          <li class="principle">
            <div class="principle__num">01</div>
            <div class="principle__body">
              <h3 class="principle__title"><em>Yılların</em> birikimi.</h3>
              <p class="principle__lede">2014'ten bu yana sadece Karadeniz. Aynı rehberler, aynı yöre halkı, aynı
                patikalar — tatilinizin arkasında bir uzmanlığın sessiz birikimi var.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">Deneyim</span>
              <span class="principle__meta-value">12 <em>yıl</em></span>
              <span class="principle__meta-note">3.200+ memnun misafir</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                <path d="M2 17l10 5 10-5M2 12l10 5 10-5" />
              </svg>
            </div>
          </li>

          <li class="principle">
            <div class="principle__num">02</div>
            <div class="principle__body">
              <h3 class="principle__title">Kalitesi <em>denenmiş</em> her detay.</h3>
              <p class="principle__lede">Konaklamadan çay sohbetine, transferden rehberlik hizmetine — tüm
                partnerlerimiz aynı titizlikle seçilir. TÜRSAB belgeli güvence.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">Memnuniyet</span>
              <span class="principle__meta-value">4.9 <em>/ 5</em></span>
              <span class="principle__meta-note">Google + TripAdvisor</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                <polyline points="9 12 11 14 15 10" />
              </svg>
            </div>
          </li>

          <li class="principle">
            <div class="principle__num">03</div>
            <div class="principle__body">
              <h3 class="principle__title">Doğa için <em>sorumluluk</em>.</h3>
              <p class="principle__lede">Atık ayrıştırması yapan tek bölgesel acentayız. Turizm geliriyle yaylada üç
                ağaç dikiyoruz — her misafir başına.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">2026'da Dikilen</span>
              <span class="principle__meta-value">9.600 <em>fidan</em></span>
              <span class="principle__meta-note">Ayder + Pokut bölgesi</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 2v8M12 22v-4M5 12H2M22 12h-3M6 6L4 4M20 20l-2-2M6 18l-2 2M20 4l-2 2" />
                <circle cx="12" cy="12" r="4" />
              </svg>
            </div>
          </li>

          <li class="principle">
            <div class="principle__num">04</div>
            <div class="principle__body">
              <h3 class="principle__title">Aracısız, <em>şeffaf</em> fiyat.</h3>
              <p class="principle__lede">Direkt yöre kaynağından, gizli ücret olmadan. Aynı kalitede %15-25 daha
                ekonomik fiyatlarla — çünkü aracı yok.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">Ortalama Tasarruf</span>
              <span class="principle__meta-value">%22 <em>kadar</em></span>
              <span class="principle__meta-note">Benzer paket fiyatlarına göre</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
              </svg>
            </div>
          </li>

          <li class="principle">
            <div class="principle__num">05</div>
            <div class="principle__body">
              <h3 class="principle__title">Size özel <em>çözümler</em>.</h3>
              <p class="principle__lede">Hazır paket sunmuyoruz, dinleyip tasarlıyoruz. İhtiyacınız aileniz için aile
                paketi mi, balayınız için romantik bir kaçamak mı? Ona göre düşünüyoruz.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">Özelleştirme</span>
              <span class="principle__meta-value">%100 <em>esnek</em></span>
              <span class="principle__meta-note">Tarih · rota · bütçe</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="3" />
                <path
                  d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
              </svg>
            </div>
          </li>

          <li class="principle">
            <div class="principle__num">06</div>
            <div class="principle__body">
              <h3 class="principle__title">Tek tuşla <em>iletişim</em>.</h3>
              <p class="principle__lede">İletişimden dönüş yolculuğuna kadar tek bir WhatsApp hattı. 7/24 açık,
                ortalama 4 dakikada yanıt — bürokrasi yok, mağaza saati yok.</p>
            </div>
            <div class="principle__meta">
              <span class="principle__meta-label">Yanıt Süresi</span>
              <span class="principle__meta-value">~4 <em>dk</em></span>
              <span class="principle__meta-note">Ortalama / 7/24</span>
            </div>
            <div class="principle__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
              </svg>
            </div>
          </li>

        </ol>

        <!-- Manifesto closer -->
        <div class="nd__cta">
          <div class="nd__cta-left">
            <span class="nd__cta-eyebrow">Sözümüz Bu Kadar</span>
            <p class="nd__cta-title">
              Geri kalanını birlikte yazalım. <strong>Bir mesaj kadar yakındayız</strong> — siz isteyin, biz
              hazırlayalım.
            </p>
          </div>
          <div class="nd__cta-buttons">
            <a href="tel:+904640000000" class="btn btn--ghost-light">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path
                  d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z" />
              </svg>
              Bizi Ara
            </a>
            <a href="https://wa.me/904640000000" class="btn btn--whats">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
              </svg>
              WhatsApp
            </a>
          </div>
        </div>

      </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 1  ·  TRAVEL LIST
     ═══════════════════════════════════════════════════════════════ -->
    <section class="tl" aria-label="Tur listesi ve filtreler">
      <div class="tl__inner">

        <!-- 1. Search Bar -->
        <div class="tl-search" role="search">

          <div class="tl-search__cell">
            <span class="tl-search__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
            </span>
            <div class="tl-search__field">
              <span class="tl-search__label">Lokasyon</span>
              <span class="tl-search__value">
                Rize · Ardeşen 🇹🇷
                <svg viewBox="0 0 12 12" fill="none">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </span>
            </div>
          </div>

          <div class="tl-search__cell">
            <span class="tl-search__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </span>
            <div class="tl-search__field">
              <span class="tl-search__label">Giriş Tarihi</span>
              <span class="tl-search__value">
                12 Mayıs · Salı
                <svg viewBox="0 0 12 12" fill="none">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </span>
            </div>
          </div>

          <div class="tl-search__cell">
            <span class="tl-search__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </span>
            <div class="tl-search__field">
              <span class="tl-search__label">Çıkış Tarihi</span>
              <span class="tl-search__value">
                16 Mayıs · Cuma
                <svg viewBox="0 0 12 12" fill="none">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </span>
            </div>
          </div>

          <div class="tl-search__cell">
            <span class="tl-search__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 00-3-3.87" />
                <path d="M16 3.13a4 4 0 010 7.75" />
              </svg>
            </span>
            <div class="tl-search__field">
              <span class="tl-search__label">Misafir</span>
              <span class="tl-search__value">
                2 yetişkin · 1 çocuk
                <svg viewBox="0 0 12 12" fill="none">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </span>
            </div>
          </div>

          <button class="tl-search__btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.35-4.35" />
            </svg>
            Tur Ara
          </button>

          <button class="tl-search__btn tl-search__btn--mobile">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.35-4.35" />
            </svg>
            Aramaya Başla
          </button>
        </div>

        <!-- 2. Breadcrumb + Title -->
        <nav class="tl-crumb" aria-label="Bilgi yolu">
          <a href="#">Anasayfa</a>
          <svg viewBox="0 0 12 12" fill="none">
            <path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <a href="#">Turlar</a>
          <svg viewBox="0 0 12 12" fill="none">
            <path d="M4 2l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          </svg>
          <span class="tl-crumb__current">Arama Sonuçları</span>
        </nav>

        <h1 class="tl-title">
          <span class="tl-title__num">237</span> tur ve <em>bungalov</em> sizi bekliyor
        </h1>

        <!-- 3. Layout: Filters | Results -->
        <div class="tl-layout">

          <!-- FILTERS PANEL -->
          <aside class="filters" aria-label="Filtreler">
            <div class="filters__head">
              <h3 class="filters__title">Filtreler</h3>
              <button class="filters__reset">
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M1 4h12M11 4v8a1 1 0 01-1 1H4a1 1 0 01-1-1V4M5 4V2a1 1 0 011-1h2a1 1 0 011 1v2"
                    stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                </svg>
                Sıfırla
              </button>
            </div>

            <!-- Tour Type -->
            <div class="fgroup">
              <label class="fgroup__label">Tur Tipi</label>
              <button class="fselect">
                <span>Tur tipi seçin</span>
                <svg viewBox="0 0 12 12" fill="none">
                  <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
              </button>
            </div>

            <!-- Bölge -->
            <div class="fgroup">
              <label class="fgroup__label">Bölge</label>
              <div class="fchips">
                <button class="fchip active">Rize</button>
                <button class="fchip">Trabzon</button>
                <button class="fchip active">Çamlıhemşin</button>
                <button class="fchip">Giresun</button>
                <button class="fchip">Artvin</button>
                <button class="fchip">Batum 🇬🇪</button>
              </div>
            </div>

            <!-- Fiyat -->
            <div class="fgroup">
              <label class="fgroup__label">Fiyat Aralığı (TL)</label>
              <div class="fprice">
                <div class="fprice__hist" aria-hidden="true">
                  <span class="fprice__bar" style="height:30%"></span>
                  <span class="fprice__bar in-range" style="height:55%"></span>
                  <span class="fprice__bar in-range" style="height:75%"></span>
                  <span class="fprice__bar in-range" style="height:92%"></span>
                  <span class="fprice__bar in-range" style="height:88%"></span>
                  <span class="fprice__bar in-range" style="height:65%"></span>
                  <span class="fprice__bar in-range" style="height:45%"></span>
                  <span class="fprice__bar" style="height:35%"></span>
                  <span class="fprice__bar" style="height:22%"></span>
                  <span class="fprice__bar" style="height:15%"></span>
                </div>
                <div class="fprice__track">
                  <div class="fprice__fill"></div>
                  <div class="fprice__handle fprice__handle--lo"></div>
                  <div class="fprice__handle fprice__handle--hi"></div>
                </div>
                <div class="fprice__inputs">
                  <input type="text" class="fprice__input" value="₺ 1.500" />
                  <span>—</span>
                  <input type="text" class="fprice__input" value="₺ 8.500" />
                </div>
              </div>
            </div>

            <!-- Süre -->
            <div class="fgroup">
              <label class="fgroup__label">Süre</label>
              <div class="fchips">
                <button class="fchip">Günübirlik</button>
                <button class="fchip active">2-3 gün</button>
                <button class="fchip">4+ gün</button>
                <button class="fchip">1 hafta</button>
              </div>
            </div>

            <!-- Toggles -->
            <div class="fgroup">
              <label class="fgroup__label">Dahil Hizmetler</label>
              <div class="ftoggle active">
                <span class="ftoggle__label">Profesyonel rehber</span>
                <span class="ftoggle__switch"></span>
              </div>
              <div class="ftoggle active">
                <span class="ftoggle__label">Transfer dahil</span>
                <span class="ftoggle__switch"></span>
              </div>
              <div class="ftoggle">
                <span class="ftoggle__label">Kahvaltı dahil</span>
                <span class="ftoggle__switch"></span>
              </div>
              <div class="ftoggle">
                <span class="ftoggle__label">Ücretsiz iptal</span>
                <span class="ftoggle__switch"></span>
              </div>
            </div>

            <!-- Help / WhatsApp CTA -->
            <div class="fhelp">
              <h4 class="fhelp__title">Yardım gerekirse?</h4>
              <p class="fhelp__desc">Bölge uzmanımız size özel rota planlasın.</p>
              <a href="https://wa.me/904640000000" class="btn btn--whats">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
                </svg>
                WhatsApp ile Sor
              </a>
            </div>
          </aside>

          <!-- RESULTS PANEL -->
          <div class="results">

            <!-- Featured -->
            <div class="results__head">
              <div class="results__head-left">
                <span class="results__pill results__pill--featured">
                  <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                      d="M13.5 2C12 5.5 7 6.5 7 11.5c0 3.5 2 6 5 6.5-1-1-2-2.5-2-4.5 0-2 2-3.5 3.5-4 0 1.5 1 2 1 4 0 1-.5 2-1.5 2.5 3.5-.5 5.5-3 5.5-6.5 0-3.5-2-5-5-7.5z" />
                  </svg>
                  Öne Çıkan Turlar
                </span>
                <span class="results__pill">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                  </svg>
                  12 yeni eklendi
                </span>
              </div>
              <div class="results__nav">
                <button class="results__nav-btn" aria-label="Önceki">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M15 18l-6-6 6-6" />
                  </svg>
                </button>
                <button class="results__nav-btn" aria-label="Sonraki">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M9 18l6-6-6-6" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Featured Cards -->
            <div class="tcards">

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/ayder-yaylasi-hero.png')">
                  </div>
                  <span class="tcard__badge tcard__badge--new">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    </svg>
                    Yeni Sezon
                  </span>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    4.8
                  </span>
                  <button class="tcard__fav active" aria-label="Favorilere ekle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg>
                  </button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Ayder Yaylası <em>2 Gün</em> Turu</h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Ayder · Çamlıhemşin · Rize
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>
                      2 gece / 3 gün
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>
                      Min. 2 kişi
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="6" width="22" height="13" rx="2" />
                        <circle cx="7" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                      </svg>
                      Transfer dahil
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 21V8M21 21V8M3 8l9-5 9 5M9 13h6M9 17h6" />
                      </svg>
                      Bungalov
                    </span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Kişi başı / dan</span>
                      <span class="tcard__price-amt">₺4.250<em>/ kişi</em></span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
                  </div>
                  <span class="tcard__badge tcard__badge--off">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <path d="M21 5l-2-2-9 9-4-4-2 2 6 6z" />
                    </svg>
                    %15 İndirim
                  </span>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    4.9
                  </span>
                  <button class="tcard__fav" aria-label="Favorilere ekle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg>
                  </button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Pokut <em>Loft</em> Bungalov</h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Pokut Yaylası · 2.100m
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>
                      Min. 2 gece
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>
                      2-4 kişi
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12V7a7 7 0 0114 0v5" />
                        <rect x="3" y="12" width="18" height="9" rx="2" />
                      </svg>
                      Jakuzi
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10" />
                      </svg>
                      Şömine
                    </span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Gece / dan</span>
                      <span class="tcard__price-amt">₺3.900<em>/ gece</em></span>
                      <span class="tcard__price-old">₺4.580</span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/batum-seaside.png')">
                  </div>
                  <span class="tcard__badge tcard__badge--popular">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <path
                        d="M13.5 2C12 5.5 7 6.5 7 11.5c0 3.5 2 6 5 6.5-1-1-2-2.5-2-4.5 0-2 2-3.5 3.5-4 0 1.5 1 2 1 4 0 1-.5 2-1.5 2.5 3.5-.5 5.5-3 5.5-6.5 0-3.5-2-5-5-7.5z" />
                    </svg>
                    En Popüler
                  </span>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    4.7
                  </span>
                  <button class="tcard__fav" aria-label="Favorilere ekle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg>
                  </button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Batum <em>Şehir</em> Turu</h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Batum · Gürcistan
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>
                      Günübirlik
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>
                      Min. 4 kişi
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="6" width="22" height="13" rx="2" />
                        <circle cx="7" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                      </svg>
                      VIP transfer
                    </span>
                    <span class="tfeat">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="2" y1="12" x2="22" y2="12" />
                        <path
                          d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" />
                      </svg>
                      Pasaport
                    </span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Kişi başı / dan</span>
                      <span class="tcard__price-amt">₺2.450<em>/ kişi</em></span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

            </div>

            <!-- More tours -->
            <div class="results__sub-head">
              <h3 class="results__sub-title">Daha fazla <em>tur ve bungalov</em></h3>
              <div class="results__controls">
                <span>Göster:</span>
                <button class="results__sort">
                  20
                  <svg viewBox="0 0 12 12" fill="none">
                    <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  </svg>
                </button>
                <span>Sırala:</span>
                <button class="results__sort">
                  <span class="results__sort-label">Önerilen</span>
                  <svg viewBox="0 0 12 12" fill="none">
                    <path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="tcards">

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/sumela-monastery.png')">
                  </div>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    4.8
                  </span>
                  <button class="tcard__fav" aria-label="Favorilere ekle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg>
                  </button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Uzungöl &amp; <em>Sumela</em></h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Trabzon
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>Günübirlik</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>Min. 2 kişi</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="6" width="22" height="13" rx="2" />
                        <circle cx="7" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                      </svg>Transfer</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 11l3 3L22 4" />
                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                      </svg>Rehberli</span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Kişi başı / dan</span>
                      <span class="tcard__price-amt">₺1.890<em>/ kişi</em></span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/mavigol-mysterious.png')">
                  </div>
                  <span class="tcard__badge tcard__badge--new"><svg viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2L2 7l10 5 10-5-10-5z" />
                    </svg>Yeni</span>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    4.9
                  </span>
                  <button class="tcard__fav" aria-label="Favorilere ekle"><svg viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg></button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Mavigöl <em>Glamping</em></h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Dereli · Giresun
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>Min. 2 gece</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>2 kişi</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                      </svg>May–Eki</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3l18 18" />
                        <path d="M3 21h18" />
                        <path d="M12 3v18" />
                      </svg>Glamping</span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Gece / dan</span>
                      <span class="tcard__price-amt">₺3.250<em>/ gece</em></span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

              <article class="tcard">
                <div class="tcard__media">
                  <div class="tcard__img"
                    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
                  </div>
                  <span class="tcard__badge tcard__badge--popular"><svg viewBox="0 0 24 24" fill="currentColor">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg>Balayı</span>
                  <span class="tcard__rate">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <polygon points="12 2 15 8 22 9 17 14 18 21 12 18 6 21 7 14 2 9 9 8" />
                    </svg>
                    5.0
                  </span>
                  <button class="tcard__fav active" aria-label="Favorilere ekle"><svg viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2">
                      <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                    </svg></button>
                </div>
                <div class="tcard__body">
                  <h3 class="tcard__title">Pokut <em>4 Gece</em> Balayı</h3>
                  <span class="tcard__loc">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                      <circle cx="12" cy="10" r="3" />
                    </svg>
                    Pokut · Çamlıhemşin
                  </span>
                  <div class="tcard__features">
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                      </svg>4 gece / 5 gün</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                      </svg>2 kişi</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12V7a7 7 0 0114 0v5" />
                        <rect x="3" y="12" width="18" height="9" rx="2" />
                      </svg>Jakuzi</span>
                    <span class="tfeat"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="13" r="3" />
                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" />
                      </svg>Foto çekim</span>
                  </div>
                  <div class="tcard__foot">
                    <div class="tcard__price">
                      <span class="tcard__price-from">Çift / paket</span>
                      <span class="tcard__price-amt">₺18.500<em>/ çift</em></span>
                    </div>
                    <div class="tcard__actions">
                    <a href="#" class="tcard__cta">Detayı gör<svg viewBox="0 0 12 12" fill="none">
                        <path d="M2 6h8m0 0L7 3m3 3l-3 3" stroke="currentColor" stroke-width="1.6"
                          stroke-linecap="round" stroke-linejoin="round" />
                      </svg></a>
                    <a href="https://wa.me/904640000000?text=Merhaba%2C%20turlar%2Fkonaklama%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum."
                      class="tcard__link-wa" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                    </div>
                  </div>
                </div>
              </article>

            </div>

            <div class="results__more">
              <a href="#" class="btn btn--dark">
                Tüm programı aç
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </a>
            </div>

          </div>
        </div>

      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 2  ·  CTA BAND
     ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-band" aria-label="Lazhem ile başlayın">
      <div class="cta">
        <div class="cta__bg" aria-hidden="true"></div>

        <div class="cta__content">
          <div class="cta__head">
            <span class="cta__eyebrow">
              Sıradaki tatil sizin
              <span class="cta__eyebrow-pulse"></span>
            </span>

            <h2 class="cta__title">
              <span class="cta__title-ornament"></span>Hayal ettiğiniz tatil <em>bir mesaj</em> uzakta.
            </h2>

            <p class="cta__lede">
              Karadeniz'i en iyi bilen ekibe rotanızı anlatın — biz, takvimi, bütçeyi ve tüm ayrıntıları siz hiç
              düşünmeden çözelim. 5 dakika içinde dönüş yapıyoruz.
            </p>

            <div class="cta__actions">
              <a href="https://wa.me/904640000000" class="btn btn--whats">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                WhatsApp ile Başla
              </a>
              <a href="#" class="btn btn--ghost-light">
                Tüm Turları Görüntüle
                <svg viewBox="0 0 14 14" fill="none">
                  <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </a>
            </div>
          </div>

          <div class="cta__foot">
            <div class="cta__avatars">
              <span class="cta__avatar"
                style="background-image:url('https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=80&q=80')"></span>
              <span class="cta__avatar"
                style="background-image:url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&q=80')"></span>
              <span class="cta__avatar"
                style="background-image:url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=80&q=80')"></span>
              <span class="cta__avatar cta__avatar--more">+3.2K</span>
            </div>
            <div class="cta__foot-text">
              <strong>4.9 ★★★★★ memnuniyet</strong>
              3.200+ misafir · Google &amp; TripAdvisor onaylı
            </div>
          </div>
        </div>

        <div class="cta__side">
          <div class="cta-stat">
            <div class="cta-stat__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
              </svg>
            </div>
            <div class="cta-stat__body">
              <span class="cta-stat__num">~ 4 <em>dk</em></span>
              <span class="cta-stat__label">Ortalama yanıt süresi</span>
            </div>
            <span class="cta-stat__arrow">
              <svg viewBox="0 0 14 14" fill="none">
                <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
          </div>

          <div class="cta-stat">
            <div class="cta-stat__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
            <div class="cta-stat__body">
              <span class="cta-stat__num">%100 <em>esnek</em></span>
              <span class="cta-stat__label">Tarih · rota · bütçe</span>
            </div>
            <span class="cta-stat__arrow">
              <svg viewBox="0 0 14 14" fill="none">
                <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
          </div>

          <div class="cta-stat">
            <div class="cta-stat__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>
            <div class="cta-stat__body">
              <span class="cta-stat__num">12 <em>yıl</em></span>
              <span class="cta-stat__label">TÜRSAB belgeli güvence</span>
            </div>
            <span class="cta-stat__arrow">
              <svg viewBox="0 0 14 14" fill="none">
                <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
          </div>

          <div class="cta-stat">
            <div class="cta-stat__icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            <div class="cta-stat__body">
              <span class="cta-stat__num">7/24 <em>destek</em></span>
              <span class="cta-stat__label">WhatsApp · telefon · e-posta</span>
            </div>
            <span class="cta-stat__arrow">
              <svg viewBox="0 0 14 14" fill="none">
                <path d="M3 11L11 3M11 3H5M11 3V9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </span>
          </div>
        </div>
      </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════════════
     SECTION 3  ·  FEATURED BLOG
     ═══════════════════════════════════════════════════════════════ -->
    <section class="blog" aria-label="Öne çıkan blog yazıları">
      <div class="blog__inner">

        <header class="blog__head">
          <div class="blog__head-text">
            <span class="eyebrow">Yayla Rehberi · Blog</span>
            <h2>Karadeniz'den <em>notlar</em>, ilham veren hikâyeler.</h2>
          </div>
          <a href="#" class="blog__head-link">
            Tüm yazıları görüntüle
            <svg viewBox="0 0 14 14" fill="none">
              <path d="M2 7h10m0 0L7 2m5 5l-5 5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </a>
        </header>

        <div class="blog__grid">

          <!-- Featured (large) post -->
          <article class="blog-feat">
            <div class="blog-feat__media">
              <div class="blog-feat__img"
                style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
              </div>
              <span class="blog-feat__category">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
                Rehber
              </span>
              <span class="blog-feat__read">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10" />
                  <polyline points="12 6 12 12 16 14" />
                </svg>
                8 dk okuma
              </span>
              <div class="blog-feat__meta">
                <span class="blog-feat__date">12 Mayıs 2026 · Ayça K.</span>
                <h3 class="blog-feat__title">Karadeniz'e ne zaman gitmeli? <em>Aylara</em> göre tam rehber.</h3>
                <p class="blog-feat__excerpt">Mayıs'ta yaylalar uyanıyor, Eylül'de çay hasadı yapılıyor, Kasım'da sis
                  yoğunlaşıyor — her ayın kendi büyüsü var. 12 ay için detaylı tavsiye.</p>
              </div>
            </div>
          </article>

          <!-- Side stack -->
          <div class="blog__side">

            <article class="blog-mini">
              <div class="blog-mini__media">
                <div class="blog-mini__img"
                  style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/pokut-plateau-aerial.png')">
                </div>
              </div>
              <div class="blog-mini__body">
                <span class="blog-mini__cat">İpuçları</span>
                <h4 class="blog-mini__title">Bungalov rezervasyonunda dikkat edilecek <em>5 detay</em></h4>
                <div class="blog-mini__meta">
                  <span>5 dk okuma</span>
                  <span class="blog-mini__meta-divider"></span>
                  <span>08 May 2026</span>
                </div>
              </div>
            </article>

            <article class="blog-mini">
              <div class="blog-mini__media">
                <div class="blog-mini__img"
                  style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/uzungol-lake.png')">
                </div>
              </div>
              <div class="blog-mini__body">
                <span class="blog-mini__cat">Hikâye</span>
                <h4 class="blog-mini__title">Uzungöl'de <em>çay</em> sohbetleri: Yöre halkıyla bir gün</h4>
                <div class="blog-mini__meta">
                  <span>6 dk okuma</span>
                  <span class="blog-mini__meta-divider"></span>
                  <span>30 Nis 2026</span>
                </div>
              </div>
            </article>

            <article class="blog-mini">
              <div class="blog-mini__media">
                <div class="blog-mini__img"
                  style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/ayder-yaylasi-hero.png')">
                </div>
              </div>
              <div class="blog-mini__body">
                <span class="blog-mini__cat">Balayı</span>
                <h4 class="blog-mini__title"><em>Romantik</em> bir balayı için doğru yayla nasıl seçilir?</h4>
                <div class="blog-mini__meta">
                  <span>7 dk okuma</span>
                  <span class="blog-mini__meta-divider"></span>
                  <span>22 Nis 2026</span>
                </div>
              </div>
            </article>

          </div>

        </div>

      </div>
    </section>

  </main>

  <!-- ═══════════════ FOOTER ═══════════════ -->
  
<?php
get_footer();
