<?php
require_once __DIR__ . '/wp-load.php';

$posts = get_posts([
    'post_type' => 'tur',
    'posts_per_page' => -1,
    'post_status' => 'any'
]);

$categories = get_terms([
    'taxonomy' => 'listing_cat',
    'hide_empty' => false,
]);

$regions = get_terms([
    'taxonomy' => 'listing_region',
    'hide_empty' => false,
]);

if (empty($posts)) {
    die("No listings found.\n");
}

$cat_ids = !empty($categories) ? wp_list_pluck($categories, 'term_id') : [];
$reg_ids = !empty($regions) ? wp_list_pluck($regions, 'term_id') : [];

$assigned = 0;

foreach ($posts as $p) {
    // Randomize categories
    if (!empty($cat_ids)) {
        shuffle($cat_ids);
        $num_cats = rand(1, min(2, count($cat_ids)));
        $selected_cats = array_slice($cat_ids, 0, $num_cats);
        wp_set_object_terms($p->ID, $selected_cats, 'listing_cat');
    }

    // Randomize regions
    if (!empty($reg_ids)) {
        shuffle($reg_ids);
        $num_regs = rand(1, min(2, count($reg_ids)));
        $selected_regs = array_slice($reg_ids, 0, $num_regs);
        wp_set_object_terms($p->ID, $selected_regs, 'listing_region');
    }
    
    $assigned++;
}

echo "Successfully assigned random categories and regions to $assigned listings.\n";
