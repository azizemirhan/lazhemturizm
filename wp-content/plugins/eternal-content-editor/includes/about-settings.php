<?php
/**
 * Hakkımızda sayfası — tüm bölümler (Next Content).
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Kayıtlı değer; veritabanında yoksa tema varsayılanı (form önizlemesi).
 */
function ece_about_val($key, $default = '')
{
    $k = 'eternal_about_' . sanitize_key($key);
    $v = get_option($k, '__ece_missing__');
    if ($v === '__ece_missing__') {
        return $default;
    }
    return $v;
}

/**
 * Görsel URL satırı — Ortam kütüphanesi (.ece-upload-btn, admin.js).
 *
 * @param string $label   Tablo başlığı.
 * @param string $opt_key eternal_about_{$opt_key} alanı (ece[] anahtarı).
 * @param string $default Varsayılan URL.
 */
function ece_about_media_field_row($label, $opt_key, $default = '')
{
    $val = ece_about_val($opt_key, $default);
    $preview = '';
    if ($val !== '') {
        $preview = '<img src="' . esc_url($val) . '" alt="" style="max-width:220px;height:auto;border-radius:8px;margin-top:8px;display:block;">';
    }
    ?>
    <tr>
        <th scope="row"><?php echo esc_html($label); ?></th>
        <td>
            <div class="ece-field">
                <div class="ece-field-group">
                    <input type="text" name="ece[<?php echo esc_attr($opt_key); ?>]" class="large-text" style="flex:1;min-width:0;" value="<?php echo esc_attr($val); ?>" />
                    <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i> <?php esc_html_e('Ortamdan seç', 'eternal-content-editor'); ?></button>
                </div>
                <div class="ece-image-preview"><?php echo $preview; ?></div>
            </div>
        </td>
    </tr>
    <?php
}

function ece_about_settings_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'hero';
    $tabs = [
        'hero' => ['label' => 'Hero', 'icon' => 'fas fa-mountain'],
        'story' => ['label' => 'Hikâye', 'icon' => 'fas fa-book-open'],
        'phil' => ['label' => 'Felsefe', 'icon' => 'fas fa-gem'],
        'comfort' => ['label' => 'Konfor', 'icon' => 'fas fa-couch'],
        'gallery' => ['label' => 'Galeri', 'icon' => 'fas fa-th-large'],
        'cta' => ['label' => 'CTA', 'icon' => 'fas fa-bullhorn'],
    ];

    $t = get_template_directory_uri();

    $raw_phil = get_option('eternal_about_philosophy_cards', null);
    if (is_array($raw_phil) && $raw_phil !== []) {
        $phil_cards = $raw_phil;
    } elseif (function_exists('lazhem_about_default_philosophy_cards')) {
        $phil_cards = lazhem_about_default_philosophy_cards();
    } else {
        $phil_cards = [];
    }

    $raw_comf = get_option('eternal_about_comfort_bullets', null);
    if (is_array($raw_comf) && $raw_comf !== []) {
        $comfort_bullets = $raw_comf;
    } elseif (function_exists('lazhem_about_default_comfort_bullets')) {
        $comfort_bullets = lazhem_about_default_comfort_bullets();
    } else {
        $comfort_bullets = [];
    }

    ?>
    <form method="post" action="">
        <?php wp_nonce_field('ece_save_about_settings', 'ece_about_nonce'); ?>
        <input type="hidden" name="ece_save_about" value="1" />
        <input type="hidden" name="ece_active_tab" id="eceActiveTab" value="<?php echo esc_attr($active_tab); ?>" />

        <div class="ece-page-header">
            <i class="fas fa-info-circle"></i>
            <span>Next Content — Hakkımızda</span>
        </div>

        <div class="ece-tabs">
            <?php foreach ($tabs as $key => $tab) : ?>
                <button type="button" class="ece-tab <?php echo $active_tab === $key ? 'ece-tab--active' : ''; ?>"
                    data-tab="<?php echo esc_attr($key); ?>">
                    <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div id="tab-hero" class="ece-tab-content <?php echo $active_tab === 'hero' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Üst etiket</th><td><input type="text" name="ece[ab_hero_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_hero_eyebrow', 'Hikâyemiz & Vizyonumuz')); ?>" /></td></tr>
                <tr><th>Başlık (H1, HTML)</th><td><textarea name="ece[ab_hero_h1]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_hero_h1', 'Bulutların <em>üzerinde</em>,<br>bir hayalin izinde.')); ?></textarea></td></tr>
                <tr><th>Özet</th><td><textarea name="ece[ab_hero_lede]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_hero_lede', '2014 yılında Rize’nin sarp yamaçlarında başlayan yolculuğumuz, bugün Karadeniz’in en seçkin turizm deneyimine dönüştü.')); ?></textarea></td></tr>
            </table>
        </div>

        <div id="tab-story" class="ece-tab-content <?php echo $active_tab === 'story' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <?php ece_about_media_field_row(__('Hikâye görseli', 'eternal-content-editor'), 'ab_story1_img', $t . '/assets/images/rize-tea-plantations.png'); ?>
                <tr><th>Görsel alt metni</th><td><input type="text" name="ece[ab_story1_img_alt]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_story1_img_alt', 'Rize Çay Bahçeleri')); ?>" /></td></tr>
                <tr><th>Kutu — sayı</th><td><input type="text" name="ece[ab_story1_float_num]" class="regular-text" value="<?php echo esc_attr(ece_about_val('ab_story1_float_num', '10+')); ?>" /></td></tr>
                <tr><th>Kutu — küçük etiket</th><td><input type="text" name="ece[ab_story1_float_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_story1_float_eyebrow', 'Yıllık Yerel Miras')); ?>" /></td></tr>
                <tr><th>Bölüm etiketi</th><td><input type="text" name="ece[ab_story1_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_story1_eyebrow', 'Nasıl Başladık?')); ?>" /></td></tr>
                <tr><th>Alt başlık (H2)</th><td><textarea name="ece[ab_story1_h2]" class="large-text" rows="2"><?php echo esc_textarea(ece_about_val('ab_story1_h2', 'Yaylanın <em>sesini</em> duymak.')); ?></textarea></td></tr>
                <tr><th>Paragraf 1</th><td><textarea name="ece[ab_story1_p1]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_story1_p1', 'Lazhem, sadece bir seyahat acentesi değil; Karadeniz’in doğasına, kültürüne ve sükunetine olan derin bir tutkunun ürünüdür. Kurucularımız, bu toprakların çocukları olarak, bölgenin gizli kalmış güzelliklerini dünyayla paylaşma hayaliyle yola çıktılar.')); ?></textarea></td></tr>
                <tr><th>Paragraf 2</th><td><textarea name="ece[ab_story1_p2]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_story1_p2', 'Başlangıçta sadece bir küçük ahşap bungalovla başlayan bu serüven, bugün Rize, Artvin ve Trabzon\'un en özel noktalarında konaklama ve butik tur hizmetleri sunan kapsamlı bir ekosisteme dönüştü.')); ?></textarea></td></tr>
                <tr><th>Alıntı</th><td><textarea name="ece[ab_story1_quote]" class="large-text" rows="2"><?php echo esc_textarea(ece_about_val('ab_story1_quote', '"Bizim için her misafir, kapımızı çalan bir aile dostudur. Karadeniz misafirperverliğini, modern konforun zarafetiyle harmanlayarak sunuyoruz."')); ?></textarea></td></tr>
                <tr><th>Alıntı — imza</th><td><input type="text" name="ece[ab_story1_quote_attr]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_story1_quote_attr', '— Lazhem Kurucu Ekibi')); ?>" /></td></tr>
            </table>
        </div>

        <div id="tab-phil" class="ece-tab-content <?php echo $active_tab === 'phil' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Bölüm etiketi</th><td><input type="text" name="ece[ab_phil_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_phil_eyebrow', 'Felsefemiz')); ?>" /></td></tr>
                <tr><th>Başlık (H2)</th><td><textarea name="ece[ab_phil_h2]" class="large-text" rows="2"><?php echo esc_textarea(ece_about_val('ab_phil_h2', 'Bizi <em>ayıran</em> detaylar')); ?></textarea></td></tr>
            </table>
            <div class="ece-card">
                <div class="ece-card-title">Felsefe kartları</div>
                <div class="ece-repeater-container">
                    <?php foreach ($phil_cards as $i => $c) : ?>
                        <div class="ece-repeater-item">
                            <span class="ece-repeater-num"><?php echo (int) $i + 1; ?></span>
                            <button type="button" class="ece-remove-repeater" title="Sil"><i class="fas fa-trash"></i> Sil</button>
                            <div class="ece-field">
                                <label>Numara</label>
                                <input type="text" name="ece[philosophy_cards][<?php echo (int) $i; ?>][num]" value="<?php echo esc_attr($c['num'] ?? ''); ?>" style="width:80px;">
                            </div>
                            <div class="ece-field">
                                <label>Başlık</label>
                                <input type="text" name="ece[philosophy_cards][<?php echo (int) $i; ?>][title]" class="large-text" value="<?php echo esc_attr($c['title'] ?? ''); ?>">
                            </div>
                            <div class="ece-field">
                                <label>Metin</label>
                                <textarea name="ece[philosophy_cards][<?php echo (int) $i; ?>][text]" class="large-text" rows="2"><?php echo esc_textarea($c['text'] ?? ''); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="ece-add-repeater"><i class="fas fa-plus"></i> Kart ekle</button>
            </div>
        </div>

        <div id="tab-comfort" class="ece-tab-content <?php echo $active_tab === 'comfort' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Bölüm etiketi</th><td><input type="text" name="ece[ab_comf_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_comf_eyebrow', 'Konaklama Deneyimi')); ?>" /></td></tr>
                <tr><th>Başlık (H2)</th><td><textarea name="ece[ab_comf_h2]" class="large-text" rows="2"><?php echo esc_textarea(ece_about_val('ab_comf_h2', 'Modern <em>lüks</em>, yayla sessizliği.')); ?></textarea></td></tr>
                <tr><th>Paragraf</th><td><textarea name="ece[ab_comf_p]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_comf_p', 'Bungalovlarımızda sadece bir yatak değil, bir huzur alanı sunuyoruz. Jakuzili teraslarımızda bulut denizi manzarasını izlerken, şömine başında bölgenin en taze çaylarını yudumlayabilirsiniz.')); ?></textarea></td></tr>
                <?php ece_about_media_field_row(__('Konfor görseli', 'eternal-content-editor'), 'ab_comf_img', $t . '/assets/images/luxury-bungalow-interior.png'); ?>
                <tr><th>Görsel alt metni</th><td><input type="text" name="ece[ab_comf_img_alt]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_comf_img_alt', 'Bungalov İç Mekan')); ?>" /></td></tr>
            </table>
            <h3 style="margin-top:1.5em;">Madde işaretleri</h3>
            <?php
            $bul = $comfort_bullets;
            $n = max(3, count($bul));
            for ($b = 0; $b < $n; $b++) {
                $line = $bul[$b] ?? '';
                echo '<p><input type="text" name="ece[comfort_bullets][]" class="large-text" value="' . esc_attr($line) . '" placeholder="Madde ' . ($b + 1) . '" /></p>';
            }
            ?>
        </div>

        <div id="tab-gallery" class="ece-tab-content <?php echo $active_tab === 'gallery' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <?php ece_about_media_field_row(__('Galeri görsel 1', 'eternal-content-editor'), 'ab_gal_1', $t . '/assets/images/pokut-plateau-aerial.png'); ?>
                <?php ece_about_media_field_row(__('Galeri görsel 2', 'eternal-content-editor'), 'ab_gal_2', $t . '/assets/images/uzungol-lake.png'); ?>
                <?php ece_about_media_field_row(__('Galeri görsel 3', 'eternal-content-editor'), 'ab_gal_3', $t . '/assets/images/karagol-snow.png'); ?>
            </table>
        </div>

        <div id="tab-cta" class="ece-tab-content <?php echo $active_tab === 'cta' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Başlık</th><td><textarea name="ece[ab_cta_h2]" class="large-text" rows="2"><?php echo esc_textarea(ece_about_val('ab_cta_h2', 'Karadeniz\'i bir de <em>bizimle</em> yaşayın.')); ?></textarea></td></tr>
                <tr><th>Metin</th><td><textarea name="ece[ab_cta_p]" class="large-text" rows="3"><?php echo esc_textarea(ece_about_val('ab_cta_p', 'Hayalinizdeki rotayı planlamak veya bungalovlarımızda yerinizi ayırtmak için ekibimizle iletişime geçin.')); ?></textarea></td></tr>
                <tr><th>WhatsApp URL</th><td><input type="text" name="ece[ab_cta_wa_url]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_cta_wa_url', 'https://wa.me/904640000000')); ?>" /></td></tr>
                <tr><th>WhatsApp buton metni</th><td><input type="text" name="ece[ab_cta_wa_txt]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_cta_wa_txt', 'WhatsApp\'tan Yazın')); ?>" /></td></tr>
                <tr><th>İkincil buton URL</th><td><input type="text" name="ece[ab_cta_sec_url]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_cta_sec_url', '#')); ?>" /></td></tr>
                <tr><th>İkincil buton metni</th><td><input type="text" name="ece[ab_cta_sec_txt]" class="large-text" value="<?php echo esc_attr(ece_about_val('ab_cta_sec_txt', 'Turlarımızı İnceleyin')); ?>" /></td></tr>
            </table>
        </div>

        <?php submit_button('Kaydet'); ?>
    </form>
    <?php
}

