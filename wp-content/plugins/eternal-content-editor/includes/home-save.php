<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_init', function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['ece_save_home'])) {
        if (!wp_verify_nonce($_POST['ece_home_nonce'] ?? '', 'ece_save_home_action')) {
            wp_die('Güvenlik doğrulaması başarısız.');
        }

        $fields = isset($_POST['ece']) && is_array($_POST['ece']) ? $_POST['ece'] : [];
    $fields = stripslashes_deep($fields);

        foreach ($fields as $key => $value) {
            $sanitized_key = sanitize_key($key);
            
            // Repeater fields
            $repeater_keys = ['home_slider_cards', 'home_bungalow_showcases', 'home_honeymoon_days', 'home_manifesto_principles'];
            
            if (in_array($sanitized_key, $repeater_keys, true)) {
                if (!is_array($value)) {
                    update_option('eternal_home_' . $sanitized_key, []);
                    continue;
                }
                $value = array_values($value);
                $sanitized_value = array_map(static function ($item) use ($sanitized_key) {
                    if (!is_array($item)) return [];
                    $out = [];
                    foreach ($item as $subk => $subv) {
                        $sk = sanitize_key((string)$subk);
                        // Specific field handling
                        if ($sk === 'title' || $sk === 'name' || $sk === 'lede' || $sk === 'items') {
                            $out[$sk] = wp_kses_post((string)$subv);
                        } elseif ($sk === 'image' || $sk === 'hero_image' || $sk === 'url') {
                            $out[$sk] = esc_url_raw((string)$subv);
                        } else {
                            $out[$sk] = sanitize_text_field((string)$subv);
                        }
                    }
                    return $out;
                }, $value);
                $sanitized_value = ece_filter_repeater_rows($sanitized_value);
                update_option('eternal_home_' . $sanitized_key, $sanitized_value);
                continue;
            }

            // HTML allowed fields
            $html_keys = ['hero_title', 'intro_title', 'bn_title', 'bly_title', 'nd_title', 'cta_title', 'blog_title'];
            // URL fields
            $url_keys = ['hero_image', 'hero_cta_1_url', 'hero_cta_2_url'];
            // Numeric fields
            $int_keys = ['bn_featured_id', 'bly_featured_id'];

            if (in_array($sanitized_key, $html_keys, true)) {
                update_option('eternal_home_' . $sanitized_key, wp_kses_post($value));
            } elseif (in_array($sanitized_key, $url_keys, true)) {
                update_option('eternal_home_' . $sanitized_key, esc_url_raw($value));
            } elseif (in_array($sanitized_key, $int_keys, true)) {
                update_option('eternal_home_' . $sanitized_key, absint($value));
            } else {
                update_option('eternal_home_' . $sanitized_key, sanitize_text_field($value));
            }
        }

        $active_tab = isset($_POST['ece_active_tab']) ? sanitize_key($_POST['ece_active_tab']) : 'hero';

        wp_redirect(add_query_arg([
            'page' => 'eternal-content',
            'ece_page' => 'home',
            'tab' => $active_tab,
            'updated' => 'true',
        ], admin_url('admin.php')));
        exit;
    }
});
