<?php
require_once __DIR__ . '/wp-load.php';

$regions_meta = [
    'Artvin Merkez' => 'ARTVİN',
    'Ardanuç' => 'ARTVİN · 550M',
    'Arhavi' => 'ARTVİN · SAHİL',
    'Hopa' => 'ARTVİN · LİMAN',
    'Kemalpaşa' => 'ARTVİN · SINIR',
    'Murgul' => 'ARTVİN · MADEN',
    'Şavşat' => 'ARTVİN · 1.100M',
    'Yusufeli' => 'ARTVİN · 600M',
    'Rize Merkez' => 'RİZE',
    'Çamlıhemşin' => 'RİZE · 1.350M',
    'İkizdere' => 'RİZE · 1.200M',
    'Fındıklı' => 'RİZE · SAHİL',
    'Pazar' => 'RİZE · LİMAN',
    'Ardeşen' => 'RİZE · VADİ',
    'Çayeli' => 'RİZE · 100M',
    'Trabzon Merkez' => 'TRABZON',
    'Akçaabat' => 'TRABZON · SAHİL',
    'Of' => 'TRABZON · 50M',
    'Sürmene' => 'TRABZON · DENİZ',
    'Vakfıkebir' => 'TRABZON · LİMAN'
];

$count = 0;
foreach ($regions_meta as $region => $short_desc) {
    $term = get_term_by('name', $region, 'listing_region');
    if ($term && !is_wp_error($term)) {
        update_term_meta($term->term_id, '_lazhem_short_description', $short_desc);
        // Taksonomi description kısmına da ekleyelim (seeder böyle yapıyor)
        wp_update_term($term->term_id, 'listing_region', array('description' => $short_desc));
        $count++;
    } else {
        echo "Region not found: $region\n";
    }
}

echo "Updated short descriptions for $count regions.\n";
