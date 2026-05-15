<?php
/**
 * Gizlilik Politikası içeriğini kaydet.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ece_privacy_handle_save()
{
    if (!isset($_POST['ece_save_privacy']) || !current_user_can('manage_options')) {
        return;
    }

    if (!wp_verify_nonce($_POST['ece_privacy_nonce'] ?? '', 'ece_save_privacy_settings')) {
        wp_die('Güvenlik doğrulaması başarısız.');
    }

    $fields = isset($_POST['ece']) && is_array($_POST['ece']) ? $_POST['ece'] : [];

    foreach ($fields as $key => $value) {
        $sk = sanitize_key($key);
        
        if ($sk === 'privacy_content') {
            update_option('eternal_privacy_' . $sk, wp_kses_post($value));
            continue;
        }

        update_option('eternal_privacy_' . $sk, sanitize_text_field((string) $value));
    }

    $active_tab = isset($_POST['ece_active_tab']) ? sanitize_key($_POST['ece_active_tab']) : 'hero';

    wp_redirect(add_query_arg([
        'page' => 'eternal-content',
        'ece_page' => 'privacy',
        'tab' => $active_tab,
        'updated' => 'true',
    ], admin_url('admin.php')));
    exit;
}

add_action('admin_init', 'ece_privacy_handle_save', 25);
