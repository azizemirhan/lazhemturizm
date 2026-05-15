<?php
/**
 * Plugin Name: Next Content
 * Plugin URI:  https://eternalyangin.com
 * Description: Next Content ile anasayfa, header ve footer içeriklerini yönetin.
 * Version:     2.1.0
 * Author:      Eternal Yangın
 * Text Domain: eternal-content-editor
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ECE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ECE_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!function_exists('ece_home')) {
    function ece_home($key, $default = '')
    {
        return get_option('eternal_home_' . sanitize_key($key), $default);
    }
}

require_once ECE_PLUGIN_DIR . 'includes/general-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/home-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/home-save.php';
require_once ECE_PLUGIN_DIR . 'includes/about-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/about-save.php';
require_once ECE_PLUGIN_DIR . 'includes/contact-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/contact-save.php';
require_once ECE_PLUGIN_DIR . 'includes/kvkk-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/kvkk-save.php';
require_once ECE_PLUGIN_DIR . 'includes/terms-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/terms-save.php';
require_once ECE_PLUGIN_DIR . 'includes/privacy-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/privacy-save.php';
require_once ECE_PLUGIN_DIR . 'includes/cookies-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/cookies-save.php';
require_once ECE_PLUGIN_DIR . 'includes/sales-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/sales-save.php';
require_once ECE_PLUGIN_DIR . 'includes/refund-settings.php';
require_once ECE_PLUGIN_DIR . 'includes/refund-save.php';

function ece_get_pages()
{
    return [
        'home' => ['label' => 'Anasayfa', 'icon' => 'fas fa-home', 'callback' => 'ece_home_settings_page'],
        'about' => ['label' => 'Hakkımızda', 'icon' => 'fas fa-info-circle', 'callback' => 'ece_about_settings_page'],
        'contact' => ['label' => 'İletişim', 'icon' => 'fas fa-phone', 'callback' => 'ece_contact_settings_page'],
        'kvkk' => ['label' => 'KVKK Aydınlatma', 'icon' => 'fas fa-file-contract', 'callback' => 'ece_kvkk_settings_page'],
        'terms' => ['label' => 'Kullanım Koşulları', 'icon' => 'fas fa-gavel', 'callback' => 'ece_terms_settings_page'],
        'privacy' => ['label' => 'Gizlilik Politikası', 'icon' => 'fas fa-user-shield', 'callback' => 'ece_privacy_settings_page'],
        'cookies' => ['label' => 'Çerez Politikası', 'icon' => 'fas fa-cookie-bite', 'callback' => 'ece_cookies_settings_page'],
        'sales' => ['label' => 'Satış Sözleşmesi', 'icon' => 'fas fa-file-invoice-dollar', 'callback' => 'ece_sales_settings_page'],
        'refund' => ['label' => 'İptal & İade', 'icon' => 'fas fa-undo-alt', 'callback' => 'ece_refund_settings_page'],
        'general' => ['label' => 'Genel Ayarlar', 'icon' => 'fas fa-cogs', 'callback' => 'ece_general_settings_page'],
    ];
}

function ece_main_editor_page()
{
    $pages = ece_get_pages();
    $active_page = isset($_GET['ece_page']) ? sanitize_key($_GET['ece_page']) : 'general';
    if (empty($active_page) || !isset($pages[$active_page])) {
        $active_page = 'general';
    }
    ?>
    <div class="ece-wrap">
        <div class="ece-top-bar">
            <div class="ece-top-bar-left">
                <img src="<?php echo esc_url(ECE_PLUGIN_URL . 'assets/images/next-logo.png'); ?>" alt="Next Content">
                <span class="ece-version">v2.1</span>
            </div>
            <div class="ece-top-bar-right">
                <select id="ece-page-select" class="ece-page-select">
                    <option value="" disabled><?php esc_html_e('Sayfalar', 'eternal-content-editor'); ?></option>
                    <?php foreach ($pages as $key => $page): ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php selected($active_page, $key); ?>>
                            <?php echo esc_html($page['label']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="ece-content">
            <?php
            if (isset($_GET['updated']) && $_GET['updated'] === 'true') {
                echo '<div class="ece-success"><i class="fas fa-check-circle"></i> Değişiklikler başarıyla kaydedildi!</div>';
            }

            if (isset($pages[$active_page]) && is_callable($pages[$active_page]['callback'])) {
                call_user_func($pages[$active_page]['callback']);
            } else {
                echo '<div class="notice notice-error"><p>Sayfa yüklenemedi.</p></div>';
            }
            ?>
        </div>
    </div>
    <?php
}

add_action('admin_menu', function () {
    add_menu_page(
        'Next Content',
        'Next Content',
        'manage_options',
        'eternal-content',
        'ece_main_editor_page',
        'dashicons-edit',
        30
    );
});

add_action('admin_enqueue_scripts', function ($hook) {
    if (strpos($hook, 'eternal-content') === false) {
        return;
    }

    wp_enqueue_style(
        'ece-fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        [],
        '6.5.1'
    );
    wp_enqueue_media();
    wp_enqueue_style('ece-admin-style', ECE_PLUGIN_URL . 'assets/admin.css', [], '2.1.0');
    wp_enqueue_script('ece-admin-script', ECE_PLUGIN_URL . 'assets/admin.js', ['jquery'], '2.1.0', true);
});

function ece_filter_repeater_rows($rows)
{
    if (!is_array($rows)) {
        return [];
    }
    $rows = array_values($rows);
    return array_values(array_filter($rows, static function ($item) {
        if (!is_array($item)) {
            return trim((string) $item) !== '';
        }
        foreach ($item as $v) {
            if (is_array($v)) {
                foreach ($v as $vv) {
                    if (trim((string) $vv) !== '') {
                        return true;
                    }
                }
            } elseif (trim((string) $v) !== '') {
                return true;
            }
        }
        return false;
    }));
}

add_action('admin_init', function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['ece_save_general'])) {
        if (!wp_verify_nonce($_POST['ece_general_nonce'] ?? '', 'ece_save_general_action')) {
            wp_die('Güvenlik doğrulaması başarısız.');
        }

        $fields = isset($_POST['ece']) && is_array($_POST['ece']) ? $_POST['ece'] : [];
        $fields = stripslashes_deep($fields);

        foreach ($fields as $key => $value) {
            $sanitized_key = sanitize_key($key);

            if ($sanitized_key === 'legal_links' || $sanitized_key === 'mega_destinations') {
                if (!is_array($value)) {
                    update_option('eternal_general_' . $sanitized_key, []);
                    continue;
                }
                $value = array_values($value);
                $sanitized_value = array_map(static function ($item) use ($sanitized_key) {
                    if (!is_array($item)) {
                        return [];
                    }
                    $out = [];
                    foreach ($item as $subk => $subv) {
                        $sk = sanitize_key((string) $subk);
                        if ($sanitized_key === 'mega_destinations' && $sk === 'image') {
                            $out[$sk] = esc_url_raw((string) $subv);
                        } elseif ($sanitized_key === 'mega_destinations' && $sk === 'url') {
                            $out[$sk] = sanitize_text_field((string) $subv);
                        } elseif ($sanitized_key === 'legal_links' && $sk === 'url') {
                            $out[$sk] = sanitize_text_field((string) $subv);
                        } else {
                            $out[$sk] = sanitize_text_field((string) $subv);
                        }
                    }
                    return $out;
                }, $value);
                $sanitized_value = $ece_filter_repeater_rows($sanitized_value);
                update_option('eternal_general_' . $sanitized_key, $sanitized_value);
                continue;
            }

            if ($sanitized_key === 'mega_region_ids' || $sanitized_key === 'footer_region_ids') {
                if (!is_array($value)) {
                    update_option('eternal_general_' . $sanitized_key, []);
                    continue;
                }
                $limit = ($sanitized_key === 'mega_region_ids') ? 4 : 5;
                $ids = array_map('absint', array_values($value));
                $ids = array_values(array_unique(array_filter($ids)));
                $ids = array_slice($ids, 0, $limit);
                update_option('eternal_general_' . $sanitized_key, $ids);
                continue;
            }

            if (is_array($value)) {
                $value = array_values($value);
                $sanitized_value = array_map(static function ($item) {
                    if (is_array($item)) {
                        return array_map('sanitize_text_field', $item);
                    }
                    return sanitize_text_field($item);
                }, $value);
                update_option('eternal_general_' . $sanitized_key, $sanitized_value);
                continue;
            }

            $url_keys = [
                'header_logo',
                'footer_logo',
                'header_whatsapp_url',
                'social_instagram',
                'social_facebook',
                'social_youtube',
                'social_tiktok',
            ];
            if (in_array($sanitized_key, $url_keys, true)) {
                update_option('eternal_general_' . $sanitized_key, esc_url_raw($value));
                continue;
            }

            if ($sanitized_key === 'mega_cta_url') {
                $v = trim((string) $value);
                if ($v === '' || $v === '#') {
                    update_option('eternal_general_mega_cta_url', '#');
                } else {
                    update_option('eternal_general_mega_cta_url', esc_url_raw($v));
                }
                continue;
            }

            $html_keys = ['footer_about_text', 'mega_desc', 'newsletter_desc', 'footer_bottom_copy', 'footer_address_line'];
            if (in_array($sanitized_key, $html_keys, true)) {
                update_option('eternal_general_' . $sanitized_key, wp_kses_post($value));
                continue;
            }

            if ($sanitized_key === 'newsletter_note') {
                update_option('eternal_general_' . $sanitized_key, sanitize_textarea_field($value));
                continue;
            }

            if ($sanitized_key === 'footer_email') {
                update_option('eternal_general_footer_email', sanitize_email($value));
                continue;
            }

            update_option('eternal_general_' . $sanitized_key, sanitize_text_field($value));
        }

        $active_tab = isset($_POST['ece_active_tab']) ? sanitize_key($_POST['ece_active_tab']) : 'header';

        wp_redirect(add_query_arg([
            'page' => 'eternal-content',
            'ece_page' => 'general',
            'tab' => $active_tab,
            'updated' => 'true',
        ], admin_url('admin.php')));
        exit;
    }
});
