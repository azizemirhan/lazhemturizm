<?php
/**
 * Hakkımızda içeriğini kaydet.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ece_about_handle_save()
{
    if (!isset($_POST['ece_save_about']) || !current_user_can('manage_options')) {
        return;
    }

    if (!wp_verify_nonce($_POST['ece_about_nonce'] ?? '', 'ece_save_about_settings')) {
        wp_die('Güvenlik doğrulaması başarısız.');
    }

    $fields = isset($_POST['ece']) && is_array($_POST['ece']) ? $_POST['ece'] : [];
    $fields = stripslashes_deep($fields);

    if (isset($fields['philosophy_cards']) && is_array($fields['philosophy_cards'])) {
        $out = [];
        foreach (array_values($fields['philosophy_cards']) as $row) {
            if (!is_array($row)) {
                continue;
            }
            $out[] = [
                'num' => sanitize_text_field($row['num'] ?? ''),
                'title' => sanitize_text_field($row['title'] ?? ''),
                'text' => wp_kses_post($row['text'] ?? ''),
            ];
        }
        update_option('eternal_about_philosophy_cards', $out);
        unset($fields['philosophy_cards']);
    }

    if (isset($fields['comfort_bullets']) && is_array($fields['comfort_bullets'])) {
        $bul = [];
        foreach ($fields['comfort_bullets'] as $line) {
            $line = sanitize_text_field((string) $line);
            if ($line !== '') {
                $bul[] = $line;
            }
        }
        update_option('eternal_about_comfort_bullets', $bul);
        unset($fields['comfort_bullets']);
    }

    $wp_kses_keys = [
        'ab_hero_h1',
        'ab_hero_lede',
        'ab_story1_h2',
        'ab_story1_p1',
        'ab_story1_p2',
        'ab_story1_quote',
        'ab_phil_h2',
        'ab_comf_h2',
        'ab_comf_p',
        'ab_cta_h2',
        'ab_cta_p',
    ];

    foreach ($fields as $key => $value) {
        $sk = sanitize_key($key);
        if (is_array($value)) {
            continue;
        }
        $str = (string) $value;
        if ($sk === 'ab_cta_sec_url') {
            $v = trim($str);
            if ($v === '' || $v === '#') {
                update_option('eternal_about_' . $sk, '#');
            } else {
                update_option('eternal_about_' . $sk, esc_url_raw($v));
            }
            continue;
        }
        if (preg_match('/_img$|_url$|^ab_gal_/', $sk)) {
            update_option('eternal_about_' . $sk, esc_url_raw($str));
            continue;
        }
        if (in_array($sk, $wp_kses_keys, true)) {
            update_option('eternal_about_' . $sk, wp_kses_post((string) $value));
            continue;
        }
        update_option('eternal_about_' . $sk, sanitize_text_field((string) $value));
    }

    $active_tab = isset($_POST['ece_active_tab']) ? sanitize_key($_POST['ece_active_tab']) : 'hero';

    wp_redirect(add_query_arg([
        'page' => 'eternal-content',
        'ece_page' => 'about',
        'tab' => $active_tab,
        'updated' => 'true',
    ], admin_url('admin.php')));
    exit;
}

add_action('admin_init', 'ece_about_handle_save', 25);
