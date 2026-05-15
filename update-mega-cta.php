<?php
require_once __DIR__ . '/wp-load.php';

// First, fetch the regions again since my previous script put them in the wrong option
$regions = get_terms([
    'taxonomy' => 'listing_region',
    'hide_empty' => false,
    'number' => 10
]);

if (!empty($regions)) {
    $ids = wp_list_pluck($regions, 'term_id');
    
    $mega_ids = array_slice($ids, 0, 4);
    $footer_ids = array_slice($ids, 4, 5);
    
    update_option('eternal_general_mega_region_ids', $mega_ids);
    update_option('eternal_general_footer_region_ids', $footer_ids);
    
    echo "Assigned " . count($mega_ids) . " regions to mega menu and " . count($footer_ids) . " regions to footer.\n";
} else {
    echo "No regions found.\n";
}

// Update the CTA text and URL
update_option('eternal_general_mega_cta_text', 'Tüm bölgeleri keşfet');
update_option('eternal_general_mega_cta_url', '/ilanlar');

echo "Updated mega menu CTA text to 'Tüm bölgeleri keşfet' and URL to '/ilanlar'.\n";
