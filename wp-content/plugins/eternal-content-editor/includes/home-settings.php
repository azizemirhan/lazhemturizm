<?php
if (!defined('ABSPATH')) {
    exit;
}

function ece_home_settings_page()
{
    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'hero';
    $tabs = [
        'hero' => ['label' => 'Hero & Arama', 'icon' => 'fas fa-home'],
        'intro' => ['label' => 'Tanıtım / Slider', 'icon' => 'fas fa-images'],
        'bungalow' => ['label' => 'Bungalov Bölümü', 'icon' => 'fas fa-bed'],
        'honeymoon' => ['label' => 'Balayı Bölümü', 'icon' => 'fas fa-heart'],
        'manifesto' => ['label' => 'Neden Lazhem', 'icon' => 'fas fa-quote-left'],
        'cta' => ['label' => 'CTA Band', 'icon' => 'fas fa-bullhorn'],
        'blog' => ['label' => 'Blog Bölümü', 'icon' => 'fas fa-blog']
    ];
    ?>
    <form method="post" action="">
        <?php wp_nonce_field('ece_save_home_action', 'ece_home_nonce'); ?>
        <input type="hidden" name="ece_active_tab" id="eceActiveTab" value="<?php echo esc_attr($active_tab); ?>">

        <div class="ece-page-header">
            <i class="fas fa-home"></i>
            <span>Next Content — Anasayfa</span>
        </div>

        <div class="ece-tabs">
            <?php foreach ($tabs as $key => $tab): ?>
                <button type="button" class="ece-tab <?php echo $active_tab === $key ? 'ece-tab--active' : ''; ?>"
                    data-tab="<?php echo esc_attr($key); ?>">
                    <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="ece-tab-content-wrapper">
            <!-- Hero Tab -->
            <div id="tab-hero" class="ece-tab-content <?php echo $active_tab === 'hero' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Hero (Giriş) Bölümü</div>
                    <table class="form-table">
                        <tr>
                            <th>Pill Metni</th>
                            <td><input type="text" name="ece[hero_pill]" class="large-text" value="<?php echo esc_attr(ece_home('hero_pill', 'Şu an Pokut Yaylası\'nda 48 misafirimiz var')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Ana Başlık (HTML)</th>
                            <td><textarea name="ece[hero_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('hero_title', 'Bulutların üzerinde <em>masalsı</em> bir Karadeniz rüyası')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Alt Metin (Lede)</th>
                            <td><textarea name="ece[hero_lede]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('hero_lede', 'Rize’den Artvin’e, en seçkin bungalovlar ve size özel rotalarla doğanın kalbinde unutulmaz bir deneyime davetlisiniz.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Butonlar & Görsel</div>
                    <table class="form-table">
                        <tr>
                            <th>Buton 1 Metin</th>
                            <td><input type="text" name="ece[hero_cta_1_text]" class="regular-text" value="<?php echo esc_attr(ece_home('hero_cta_1_text', 'Hemen Keşfet')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Buton 1 Link</th>
                            <td><input type="text" name="ece[hero_cta_1_url]" class="large-text" value="<?php echo esc_attr(ece_home('hero_cta_1_url', '#')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Buton 2 Metin</th>
                            <td><input type="text" name="ece[hero_cta_2_text]" class="regular-text" value="<?php echo esc_attr(ece_home('hero_cta_2_text', 'WhatsApp Rezervasyon')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Buton 2 Link</th>
                            <td><input type="text" name="ece[hero_cta_2_url]" class="large-text" value="<?php echo esc_attr(ece_home('hero_cta_2_url', '#')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Hero Görseli</th>
                            <td>
                                <div class="ece-field">
                                    <div class="ece-field-group">
                                        <input type="text" name="ece[hero_image]" class="large-text ece-image-url" value="<?php echo esc_attr(ece_home('hero_image', '')); ?>">
                                        <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i> Görsel Seç</button>
                                    </div>
                                    <div class="ece-image-preview">
                                        <?php if (ece_home('hero_image')): ?>
                                            <img src="<?php echo esc_url(ece_home('hero_image')); ?>" style="max-width:220px;height:auto;border-radius:8px;margin-top:8px;display:block;">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Rating & Hava Durumu</div>
                    <table class="form-table">
                        <tr>
                            <th>Rating Değeri</th>
                            <td><input type="text" name="ece[hero_rating_val]" class="small-text" value="<?php echo esc_attr(ece_home('hero_rating_val', '4.9')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Rating Metni</th>
                            <td><input type="text" name="ece[hero_rating_text]" class="large-text" value="<?php echo esc_attr(ece_home('hero_rating_text', '3.200+ misafir · Google & TripAdvisor')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Hava Durumu Lokasyon</th>
                            <td><input type="text" name="ece[hero_weather_loc]" class="regular-text" value="<?php echo esc_attr(ece_home('hero_weather_loc', 'Ayder · Bugün')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Hava Durumu Bilgi</th>
                            <td><input type="text" name="ece[hero_weather_temp]" class="regular-text" value="<?php echo esc_attr(ece_home('hero_weather_temp', '16°C, sisli')); ?>"></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Ekstra Tasarım Detayları</div>
                    <table class="form-table">
                        <tr>
                            <th>Görsel Üstü Etiket</th>
                            <td><input type="text" name="ece[hero_floating_text]" class="large-text" value="<?php echo esc_attr(ece_home('hero_floating_text', 'Karadeniz · Ayder Yaylası')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Hero Ark Metni (SVG)</th>
                            <td><input type="text" name="ece[hero_arc_text]" class="large-text" value="<?php echo esc_attr(ece_home('hero_arc_text', 'yaylanın sessizliği · bulutların selamı · çay tarlasında bir nefes · Karadeniz\'in büyüsü')); ?>"></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Hızlı Arama Çubuğu</div>
                    <table class="form-table">
                        <tr>
                            <th>Konum Etiketi</th>
                            <td><input type="text" name="ece[search_loc_label]" class="regular-text" value="<?php echo esc_attr(ece_home('search_loc_label', 'Lokasyon')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Konum Değeri</th>
                            <td><input type="text" name="ece[search_loc_val]" class="large-text" value="<?php echo esc_attr(ece_home('search_loc_val', 'Rize · Ardeşen 🇹🇷')); ?>"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Intro Tab -->
            <div id="tab-intro" class="ece-tab-content <?php echo $active_tab === 'intro' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Tanıtım Başlığı (Slider Üstü)</div>
                    <table class="form-table">
                        <tr>
                            <th>Küçük Başlık (Eyebrow)</th>
                            <td><input type="text" name="ece[intro_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_home('intro_eyebrow', 'Öne Çıkan Deneyimler')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Ana Başlık (HTML)</th>
                            <td><textarea name="ece[intro_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('intro_title', 'Yaylanın <em>en güzel</em> rotaları, sizin hikâyeniz olsun.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Öne Çıkan Kartlar (Slider)</div>
                    <div class="ece-repeater-container">
                        <?php
                        $slider_cards = ece_home('home_slider_cards', []);
                        if (empty($slider_cards)) {
                            // Default card to show structure
                            $slider_cards = [
                                [
                                    'image' => '',
                                    'badge_text' => 'Video İzle',
                                    'badge_type' => 'video',
                                    'title' => 'Ayder Yaylası<br>2 Gün Turu',
                                    'loc' => 'Rize',
                                    'duration' => '2 Gece',
                                    'price_label' => 'Kişi Başı',
                                    'price_amt' => '₺ 4.250',
                                    'url' => '#'
                                ]
                            ];
                        }
                        foreach ($slider_cards as $index => $card): ?>
                            <div class="ece-repeater-item">
                                <div class="ece-repeater-header">
                                    <span>Kart #<span class="ece-repeater-num"><?php echo $index + 1; ?></span></span>
                                    <button type="button" class="ece-remove-repeater"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="ece-repeater-content">
                                    <div class="ece-field">
                                        <label>Görsel</label>
                                        <div class="ece-field-group">
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][image]" class="regular-text" value="<?php echo esc_attr($card['image'] ?? ''); ?>">
                                            <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i></button>
                                        </div>
                                    </div>
                                    <div class="ece-grid-3">
                                        <div class="ece-field">
                                            <label>Badge Metni</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][badge_text]" value="<?php echo esc_attr($card['badge_text'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Badge Tipi (class)</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][badge_type]" value="<?php echo esc_attr($card['badge_type'] ?? ''); ?>" placeholder="video, house, honeymoon, etc.">
                                        </div>
                                        <div class="ece-field">
                                            <label>Link (URL)</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][url]" value="<?php echo esc_attr($card['url'] ?? '#'); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-field">
                                        <label>Başlık (HTML)</label>
                                        <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][title]" class="large-text" value="<?php echo esc_attr($card['title'] ?? ''); ?>">
                                    </div>
                                    <div class="ece-grid-4">
                                        <div class="ece-field">
                                            <label>Lokasyon</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][loc]" value="<?php echo esc_attr($card['loc'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Süre</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][duration]" value="<?php echo esc_attr($card['duration'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Fiyat Etiketi</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][price_label]" value="<?php echo esc_attr($card['price_label'] ?? 'Kişi Başı'); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Fiyat Tutarı</label>
                                            <input type="text" name="ece[home_slider_cards][<?php echo $index; ?>][price_amt]" value="<?php echo esc_attr($card['price_amt'] ?? ''); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="ece-add-repeater btn-primary"><i class="fas fa-plus"></i> Yeni Kart Ekle</button>
                </div>
            </div>

            <!-- Bungalow Tab -->
            <div id="tab-bungalow" class="ece-tab-content <?php echo $active_tab === 'bungalow' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Bungalov Vitrini Başlıkları</div>
                    <table class="form-table">
                        <tr>
                            <th>Küçük Başlık (Eyebrow)</th>
                            <td><input type="text" name="ece[bn_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_home('bn_eyebrow', 'Bungalov Koleksiyonu')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Bölüm Başlığı</th>
                            <td><textarea name="ece[bn_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('bn_title', 'Doğanın <em>kucağında</em>, ahşabın sıcaklığında bir uyku.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Bölüm Alt Metni</th>
                            <td><textarea name="ece[bn_lede]" class="large-text" rows="4"><?php echo esc_textarea(ece_home('bn_lede', 'Karadeniz\'in en zarif yaylalarına özenle yerleştirilmiş 12 bungalov. Her biri kendi karakteriyle — biri ormanın tam ortasında, biri sisin üzerinde, biri çay tarlasının yanı başında.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Bungalov Showcaseleri (Tablar)</div>
                    <div class="ece-repeater-container">
                        <?php
                        $bn_showcases = ece_home('home_bungalow_showcases', []);
                        if (empty($bn_showcases)) {
                            $bn_showcases = [['tab_name' => 'Pokut Loft', 'id' => 'pokut']];
                        }
                        foreach ($bn_showcases as $index => $bn): ?>
                            <div class="ece-repeater-item">
                                <div class="ece-repeater-header">
                                    <span>Bungalov #<span class="ece-repeater-num"><?php echo $index + 1; ?></span>: <?php echo esc_html($bn['tab_name'] ?? 'Yeni'); ?></span>
                                    <button type="button" class="ece-remove-repeater"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="ece-repeater-content">
                                    <div class="ece-grid-2">
                                        <div class="ece-field">
                                            <label>Tab Başlığı (Örn: Pokut Loft)</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][tab_name]" value="<?php echo esc_attr($bn['tab_name'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Tab ID (Küçük harf, benzersiz, örn: pokut)</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][id]" value="<?php echo esc_attr($bn['id'] ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-field">
                                        <label>Ana Görsel</label>
                                        <div class="ece-field-group">
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][hero_image]" class="regular-text" value="<?php echo esc_attr($bn['hero_image'] ?? ''); ?>">
                                            <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i></button>
                                        </div>
                                    </div>
                                    <div class="ece-grid-2">
                                        <div class="ece-field">
                                            <label>Etiket Metni (Örn: Misafir Favorisi)</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][chip_text]" value="<?php echo esc_attr($bn['chip_text'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Lokasyon Bilgisi</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][loc]" value="<?php echo esc_attr($bn['loc'] ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-field">
                                        <label>İsim (HTML - Örn: Pokut <em>Loft</em>)</label>
                                        <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][name]" class="large-text" value="<?php echo esc_attr($bn['name'] ?? ''); ?>">
                                    </div>
                                    <div class="ece-field">
                                        <label>Kısa Açıklama</label>
                                        <textarea name="ece[home_bungalow_showcases][<?php echo $index; ?>][subtitle]" rows="2"><?php echo esc_textarea($bn['subtitle'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="ece-grid-2">
                                        <div class="ece-field">
                                            <label>Fiyat (Örn: ₺ 3.900)</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][price_amt]" value="<?php echo esc_attr($bn['price_amt'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Fiyat Notu (Örn: 'den)</label>
                                            <input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][price_note]" value="<?php echo esc_attr($bn['price_note'] ?? "'den"); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-grid-4">
                                        <div class="ece-field"><label>Spec 1 (Alan)</label><input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][spec_1]" value="<?php echo esc_attr($bn['spec_1'] ?? ''); ?>" placeholder="65 m²"></div>
                                        <div class="ece-field"><label>Spec 2 (Kapasite)</label><input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][spec_2]" value="<?php echo esc_attr($bn['spec_2'] ?? ''); ?>" placeholder="2-4 kişi"></div>
                                        <div class="ece-field"><label>Spec 3 (Yatak)</label><input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][spec_3]" value="<?php echo esc_attr($bn['spec_3'] ?? ''); ?>" placeholder="1 çift + 1 tek"></div>
                                        <div class="ece-field"><label>Spec 4 (Diğer)</label><input type="text" name="ece[home_bungalow_showcases][<?php echo $index; ?>][spec_4]" value="<?php echo esc_attr($bn['spec_4'] ?? ''); ?>" placeholder="2 gece"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="ece-add-repeater btn-primary"><i class="fas fa-plus"></i> Yeni Bungalov Ekle</button>
                </div>
            </div>

            <!-- Honeymoon Tab -->
            <div id="tab-honeymoon" class="ece-tab-content <?php echo $active_tab === 'honeymoon' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Balayı (Yaylası Mektubu) Başlıkları</div>
                    <table class="form-table">
                        <tr>
                            <th>Üst Yazı (Handwritten)</th>
                            <td><input type="text" name="ece[bly_hand]" class="large-text" value="<?php echo esc_attr(ece_home('bly_hand', '— sevgilerle, Lazhem')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Ana Başlık (HTML)</th>
                            <td><textarea name="ece[bly_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('bly_title', 'İki kişilik bir <em>masal</em> yaylanın sessizliğinde')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Giriş Metni</th>
                            <td><textarea name="ece[bly_intro]" class="large-text" rows="4"><?php echo esc_textarea(ece_home('bly_intro', 'Bulutların hizasında dört gün — siz sadece birbirinize bakın, gerisini biz hallederiz.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Balayı Programı (Günler)</div>
                    <div class="ece-repeater-container">
                        <?php
                        $bly_days = ece_home('home_honeymoon_days', []);
                        if (empty($bly_days)) {
                            $bly_days = [['title' => 'Trabzon havalimanından VIP transfer']];
                        }
                        foreach ($bly_days as $index => $day): ?>
                            <div class="ece-repeater-item">
                                <div class="ece-repeater-header">
                                    <span>Gün #<span class="ece-repeater-num"><?php echo $index + 1; ?></span></span>
                                    <button type="button" class="ece-remove-repeater"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="ece-repeater-content">
                                    <div class="ece-grid-2">
                                        <div class="ece-field">
                                            <label>Gün Etiketi (Örn: Gün Bir · Karşılama)</label>
                                            <input type="text" name="ece[home_honeymoon_days][<?php echo $index; ?>][label]" value="<?php echo esc_attr($day['label'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>Zaman (Örn: 14:30 — 21:00)</label>
                                            <input type="text" name="ece[home_honeymoon_days][<?php echo $index; ?>][time]" value="<?php echo esc_attr($day['time'] ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-field">
                                        <label>Başlık (HTML)</label>
                                        <input type="text" name="ece[home_honeymoon_days][<?php echo $index; ?>][title]" class="large-text" value="<?php echo esc_attr($day['title'] ?? ''); ?>">
                                    </div>
                                    <div class="ece-field">
                                        <label>Hizmet Listesi (Her satıra bir tane)</label>
                                        <textarea name="ece[home_honeymoon_days][<?php echo $index; ?>][items]" rows="3"><?php echo esc_textarea($day['items'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="ece-add-repeater btn-primary"><i class="fas fa-plus"></i> Yeni Gün Ekle</button>
                </div>
            </div>

            <!-- Manifesto Tab -->
            <div id="tab-manifesto" class="ece-tab-content <?php echo $active_tab === 'manifesto' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Neden Lazhem (Manifesto) Başlık</div>
                    <table class="form-table">
                        <tr>
                            <th>Slogan (HTML)</th>
                            <td><textarea name="ece[nd_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('nd_title', 'Karadeniz\'i bilen, sizi <em>tanıyan</em> bir yol arkadaşı — altı sözle özetlersek.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Prensip Sayısı Metni</th>
                            <td><input type="text" name="ece[nd_count_text]" class="regular-text" value="<?php echo esc_attr(ece_home('nd_count_text', '06 · prensip')); ?>"></td>
                        </tr>
                    </table>
                </div>

                <div class="ece-card">
                    <div class="ece-card-title">Manifesto Prensipleri</div>
                    <div class="ece-repeater-container">
                        <?php
                        $nd_principles = ece_home('home_manifesto_principles', []);
                        if (empty($nd_principles)) {
                            $nd_principles = [['title' => 'Yılların birikimi.']];
                        }
                        foreach ($nd_principles as $index => $nd): ?>
                            <div class="ece-repeater-item">
                                <div class="ece-repeater-header">
                                    <span>Prensip #<span class="ece-repeater-num"><?php echo $index + 1; ?></span></span>
                                    <button type="button" class="ece-remove-repeater"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="ece-repeater-content">
                                    <div class="ece-grid-2">
                                        <div class="ece-field">
                                            <label>Sıra No (Örn: 01)</label>
                                            <input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][num]" value="<?php echo esc_attr($nd['num'] ?? ''); ?>">
                                        </div>
                                        <div class="ece-field">
                                            <label>İkon Class (FA - Örn: fas fa-history)</label>
                                            <input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][icon]" value="<?php echo esc_attr($nd['icon'] ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="ece-field">
                                        <label>Başlık (HTML)</label>
                                        <input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][title]" class="large-text" value="<?php echo esc_attr($nd['title'] ?? ''); ?>">
                                    </div>
                                    <div class="ece-field">
                                        <label>Açıklama</label>
                                        <textarea name="ece[home_manifesto_principles][<?php echo $index; ?>][lede]" rows="2"><?php echo esc_textarea($nd['lede'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="ece-grid-3">
                                        <div class="ece-field"><label>Meta Etiketi</label><input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][meta_label]" value="<?php echo esc_attr($nd['meta_label'] ?? ''); ?>"></div>
                                        <div class="ece-field"><label>Meta Değer</label><input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][meta_value]" value="<?php echo esc_attr($nd['meta_value'] ?? ''); ?>"></div>
                                        <div class="ece-field"><label>Meta Not</label><input type="text" name="ece[home_manifesto_principles][<?php echo $index; ?>][meta_note]" value="<?php echo esc_attr($nd['meta_note'] ?? ''); ?>"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="ece-add-repeater btn-primary"><i class="fas fa-plus"></i> Yeni Prensip Ekle</button>
                </div>
            </div>

            <!-- CTA Tab -->
            <div id="tab-cta" class="ece-tab-content <?php echo $active_tab === 'cta' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">CTA Band (Hayal Ettiğiniz Tatil)</div>
                    <table class="form-table">
                        <tr>
                            <th>Slogan (Eyebrow)</th>
                            <td><input type="text" name="ece[cta_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_home('cta_eyebrow', 'Sıradaki tatil sizin')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Ana Başlık (HTML)</th>
                            <td><textarea name="ece[cta_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('cta_title', 'Hayal ettiğiniz tatil <em>bir mesaj</em> uzakta.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th>Alt Metin</th>
                            <td><textarea name="ece[cta_lede]" class="large-text" rows="4"><?php echo esc_textarea(ece_home('cta_lede', 'Karadeniz\'i en iyi bilen ekibe rotanızı anlatın — biz, takvimi, bütçeyi ve tüm ayrıntıları siz hiç düşünmeden çözelim. 5 dakika içinde dönüş yapıyoruz.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Blog Tab -->
            <div id="tab-blog" class="ece-tab-content <?php echo $active_tab === 'blog' ? 'ece-tab-content--active' : ''; ?>">
                <div class="ece-card">
                    <div class="ece-card-title">Blog Bölümü</div>
                    <table class="form-table">
                        <tr>
                            <th>Slogan (Eyebrow)</th>
                            <td><input type="text" name="ece[blog_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_home('blog_eyebrow', 'Yayla Rehberi · Blog')); ?>"></td>
                        </tr>
                        <tr>
                            <th>Ana Başlık (HTML)</th>
                            <td><textarea name="ece[blog_title]" class="large-text" rows="3"><?php echo esc_textarea(ece_home('blog_title', 'Karadeniz\'den <em>notlar</em>, ilham veren hikâyeler.')); ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="ece-save-bar">
            <button type="submit" name="ece_save_home" class="ece-save-btn">
                <i class="fas fa-save"></i> Ayarları Kaydet
            </button>
        </div>
    </form>
    <?php
}
