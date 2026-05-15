<?php
/**
 * Next Content — Header & Footer ayarları
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('ece_general_get')) {
    /**
     * @param string $key Option suffix (eternal_general_{$key})
     * @param mixed  $default
     * @return mixed
     */
    function ece_general_get($key, $default = '')
    {
        return get_option('eternal_general_' . sanitize_key($key), $default);
    }
}

function ece_general_settings_page()
{
    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'header';

    $tabs = [
        'header' => ['label' => 'Header', 'icon' => 'fas fa-heading'],
        'footer' => ['label' => 'Footer', 'icon' => 'fas fa-shoe-prints'],
    ];

    $legal_links = ece_general_get('legal_links', []);
    if (!is_array($legal_links)) {
        $legal_links = [];
    }
    if ($legal_links === []) {
        $legal_links = [['label' => '', 'url' => '']];
    }

    $mega_region_ids = ece_general_get('mega_region_ids', []);
    if (!is_array($mega_region_ids)) {
        $mega_region_ids = [];
    }
    $mega_region_ids = array_values(array_map('absint', $mega_region_ids));
    $mega_region_ids = array_slice($mega_region_ids, 0, 4);
    while (count($mega_region_ids) < 4) {
        $mega_region_ids[] = 0;
    }

    $listing_region_terms = [];
    if (taxonomy_exists('listing_region')) {
        $listing_region_terms = get_terms([
            'taxonomy' => 'listing_region',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
        ]);
        if (is_wp_error($listing_region_terms)) {
            $listing_region_terms = [];
        }
    }
    ?>
    <form method="post" action="">
        <?php wp_nonce_field('ece_save_general_action', 'ece_general_nonce'); ?>
        <input type="hidden" name="ece_save_general" value="1">
        <input type="hidden" name="ece_active_tab" value="<?php echo esc_attr($active_tab); ?>" id="eceActiveTab">

        <div class="ece-page-header">
            <i class="fas fa-cogs"></i>
            <span>Next Content — Header &amp; Footer</span>
        </div>

        <div class="ece-tabs">
            <?php foreach ($tabs as $key => $tab): ?>
                <button type="button" class="ece-tab <?php echo ($active_tab === $key) ? 'ece-tab--active' : ''; ?>"
                    data-tab="<?php echo esc_attr($key); ?>">
                    <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="ece-tab-content <?php echo ($active_tab === 'header') ? 'ece-tab-content--active' : ''; ?>"
            id="tab-header">

            <div class="ece-card">
                <div class="ece-card-title">Logo</div>
                <div class="ece-field">
                    <label>Logo görseli (URL)</label>
                    <div class="ece-field-group">
                        <input type="text" name="ece[header_logo]" class="widefat"
                            value="<?php echo esc_attr(ece_general_get('header_logo')); ?>">
                        <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i> Yükle</button>
                    </div>
                    <div class="ece-image-preview">
                        <?php if (ece_general_get('header_logo')): ?>
                            <img src="<?php echo esc_url(ece_general_get('header_logo')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ece-field">
                    <label>Logo alt metni</label>
                    <input type="text" name="ece[header_logo_alt]"
                        value="<?php echo esc_attr(ece_general_get('header_logo_alt')); ?>">
                </div>
            </div>

            <div class="ece-card">
                <div class="ece-card-title">Üst bar (3 kısa metin)</div>
                <div class="ece-row">
                    <div class="ece-field">
                        <label>Metin 1</label>
                        <input type="text" name="ece[topbar_pill_1]"
                            value="<?php echo esc_attr(ece_general_get('topbar_pill_1')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>Metin 2</label>
                        <input type="text" name="ece[topbar_pill_2]"
                            value="<?php echo esc_attr(ece_general_get('topbar_pill_2')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>Metin 3</label>
                        <input type="text" name="ece[topbar_pill_3]"
                            value="<?php echo esc_attr(ece_general_get('topbar_pill_3')); ?>">
                    </div>
                </div>
                <div class="ece-row">
                    <div class="ece-field">
                        <label>Telefon (görünen)</label>
                        <input type="text" name="ece[topbar_phone]"
                            value="<?php echo esc_attr(ece_general_get('topbar_phone')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>Dil etiketi</label>
                        <input type="text" name="ece[topbar_lang_label]"
                            value="<?php echo esc_attr(ece_general_get('topbar_lang_label')); ?>">
                    </div>
                </div>
            </div>

            <div class="ece-card">
                <div class="ece-card-title">Header — WhatsApp</div>
                <div class="ece-row">
                    <div class="ece-field">
                        <label>Buton metni</label>
                        <input type="text" name="ece[header_whatsapp_label]"
                            value="<?php echo esc_attr(ece_general_get('header_whatsapp_label')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>WhatsApp bağlantısı</label>
                        <input type="text" name="ece[header_whatsapp_url]"
                            value="<?php echo esc_attr(ece_general_get('header_whatsapp_url')); ?>"
                            placeholder="https://wa.me/90...">
                    </div>
                </div>
            </div>

            <div class="ece-card">
                <div class="ece-card-title">Mega menü — öne çıkan bölgeler</div>
                <p class="ece-help">
                    Lazhem İlanları eklentisindeki <strong>Bölgeler</strong> taksonomisinden en fazla <strong>4</strong> kayıt seçin.
                    Başlık, alt satır, görsel ve bağlantı bu bölgelerden otomatik gelir. Sıra, menüdeki kart sırasıdır.
                </p>
                <?php if (!taxonomy_exists('listing_region')): ?>
                    <p class="notice notice-warning" style="margin:0 0 1em;">
                        <code>listing_region</code> taksonomisi yok. Lazhem İlanları eklentisinin etkin olduğundan emin olun.
                    </p>
                <?php elseif ($listing_region_terms === []): ?>
                    <p class="notice notice-info" style="margin:0 0 1em;">
                        Henüz bölge eklenmemiş. <strong>İlanlar → Bölgeler</strong> üzerinden bölge oluşturun.
                    </p>
                <?php endif; ?>
                <div class="ece-mega-region-slots">
                    <?php for ($slot = 0; $slot < 4; $slot++): ?>
                        <?php $selected = isset($mega_region_ids[$slot]) ? (int) $mega_region_ids[$slot] : 0; ?>
                        <div class="ece-field">
                            <label><?php printf(esc_html__('Kart %d', 'eternal-content-editor'), $slot + 1); ?></label>
                            <select name="ece[mega_region_ids][]" class="widefat">
                                <option value="0"><?php esc_html_e('— Seçim yok —', 'eternal-content-editor'); ?></option>
                                <?php foreach ($listing_region_terms as $term): ?>
                                    <option value="<?php echo (int) $term->term_id; ?>" <?php selected($selected, (int) $term->term_id); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="ece-tab-content <?php echo ($active_tab === 'footer') ? 'ece-tab-content--active' : ''; ?>"
            id="tab-footer">

            <div class="ece-card">
                <div class="ece-card-title">Footer logosu</div>
                <div class="ece-field">
                    <label>Görsel URL</label>
                    <div class="ece-field-group">
                        <input type="text" name="ece[footer_logo]"
                            value="<?php echo esc_attr(ece_general_get('footer_logo')); ?>">
                        <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i> Yükle</button>
                    </div>
                    <div class="ece-image-preview">
                        <?php if (ece_general_get('footer_logo')): ?>
                            <img src="<?php echo esc_url(ece_general_get('footer_logo')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ece-field">
                    <label>Alt metin</label>
                    <input type="text" name="ece[footer_logo_alt]"
                        value="<?php echo esc_attr(ece_general_get('footer_logo_alt')); ?>">
                </div>
            </div>

            <div class="ece-card">
                <div class="ece-card-title">Sosyal medya</div>
                <div class="ece-row">
                    <div class="ece-field">
                        <label>Instagram URL</label>
                        <input type="text" name="ece[social_instagram]"
                            value="<?php echo esc_attr(ece_general_get('social_instagram')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>Facebook URL</label>
                        <input type="text" name="ece[social_facebook]"
                            value="<?php echo esc_attr(ece_general_get('social_facebook')); ?>">
                    </div>
                </div>
                <div class="ece-row">
                    <div class="ece-field">
                        <label>YouTube URL</label>
                        <input type="text" name="ece[social_youtube]"
                            value="<?php echo esc_attr(ece_general_get('social_youtube')); ?>">
                    </div>
                    <div class="ece-field">
                        <label>TikTok URL</label>
                        <input type="text" name="ece[social_tiktok]"
                            value="<?php echo esc_attr(ece_general_get('social_tiktok')); ?>">
                    </div>
                </div>
            </div>

            <div class="ece-card">
                <div class="ece-card-title">Footer — Bölgeler</div>
                <p class="ece-help">
                    Footer'daki "Bölgeler" sütununda görüntülenecek en fazla <strong>5</strong> bölgeyi seçin.
                </p>
                <?php
                $footer_region_ids = ece_general_get('footer_region_ids', []);
                if (!is_array($footer_region_ids)) { $footer_region_ids = []; }
                $footer_region_ids = array_slice($footer_region_ids, 0, 5);
                while (count($footer_region_ids) < 5) { $footer_region_ids[] = 0; }
                ?>
                <div class="ece-row-wrap" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="ece-field">
                            <label><?php printf(esc_html__('Bölge %d', 'eternal-content-editor'), $i + 1); ?></label>
                            <select name="ece[footer_region_ids][]" class="widefat">
                                <option value="0"><?php esc_html_e('— Seçim yok —', 'eternal-content-editor'); ?></option>
                                <?php foreach ($listing_region_terms as $term): ?>
                                    <option value="<?php echo (int) $term->term_id; ?>" <?php selected($footer_region_ids[$i], $term->term_id); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="ece-save-bar">
            <button type="submit" name="ece_save_general" class="ece-save-btn">
                <i class="fas fa-save"></i> Kaydet
            </button>
        </div>
    </form>
    <?php
}
