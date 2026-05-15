<?php
/**
 * İletişim sayfası içeriğini kaydet.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ece_contact_save_url_field($sk, $str, $allow_hash = false)
{
    $v = trim((string) $str);
    if ($allow_hash && ($v === '' || $v === '#')) {
        update_option('eternal_contact_' . $sk, '#');
        return;
    }
    update_option('eternal_contact_' . $sk, esc_url_raw($v));
}

function ece_contact_handle_save()
{
    if (!isset($_POST['ece_save_contact']) || !current_user_can('manage_options')) {
        return;
    }

    if (!wp_verify_nonce($_POST['ece_contact_nonce'] ?? '', 'ece_save_contact_settings')) {
        wp_die('Güvenlik doğrulaması başarısız.');
    }

    $fields = isset($_POST['ece']) && is_array($_POST['ece']) ? $_POST['ece'] : [];
    $fields = stripslashes_deep($fields);

    $wp_kses_keys = [
        'ct_hero_h1',
        'ct_hero_lede',
        'ct_office_address',
    ];

    foreach ($fields as $key => $value) {
        $sk = sanitize_key($key);
        if (is_array($value)) {
            continue;
        }
        $str = (string) $value;

        if ($sk === 'ct_email') {
            update_option('eternal_contact_ct_email', sanitize_email($str));
            continue;
        }

        if ($sk === 'ct_form_action' || preg_match('/^ct_social_(ig|fb|yt)_url$/', $sk)) {
            ece_contact_save_url_field($sk, $str, true);
            continue;
        }

        if ($sk === 'ct_wa_url' || $sk === 'ct_map_bg') {
            ece_contact_save_url_field($sk, $str, false);
            continue;
        }

        if (in_array($sk, $wp_kses_keys, true)) {
            update_option('eternal_contact_' . $sk, wp_kses_post($str));
            continue;
        }

        update_option('eternal_contact_' . $sk, sanitize_text_field($str));
    }

    $active_tab = isset($_POST['ece_active_tab']) ? sanitize_key($_POST['ece_active_tab']) : 'hero';

    wp_redirect(add_query_arg([
        'page' => 'eternal-content',
        'ece_page' => 'contact',
        'tab' => $active_tab,
        'updated' => 'true',
    ], admin_url('admin.php')));
    exit;
}

add_action('admin_init', 'ece_contact_handle_save', 26);
