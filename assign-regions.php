<?php
require_once __DIR__ . '/wp-load.php';

$regions = get_terms([
    'taxonomy' => 'listing_region',
    'hide_empty' => false,
    'number' => 10
]);

if (!empty($regions)) {
    $ids = wp_list_pluck($regions, 'term_id');
    
    $mega_ids = array_slice($ids, 0, 4);
    $footer_ids = array_slice($ids, 4, 5);
    
    $settings = get_option('ece_general_settings', []);
    if (!is_array($settings)) $settings = [];
    
    $settings['mega_region_ids'] = $mega_ids;
    $settings['footer_region_ids'] = $footer_ids;
    $settings['mega_cta_url'] = home_url('/ilanlar');
    
    update_option('ece_general_settings', $settings);
    
    echo "Assigned " . count($mega_ids) . " regions to mega menu and " . count($footer_ids) . " regions to footer.\n";
} else {
    echo "No regions found.\n";
}
