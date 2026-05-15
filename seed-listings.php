<?php
require_once __DIR__ . '/wp-load.php';

// Find an image attachment to use
$attachments = get_posts([
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => 1,
    'post_status' => 'inherit',
]);

$img_id = !empty($attachments) ? $attachments[0]->ID : 0;
$gallery_ids = $img_id ? "$img_id,$img_id" : "";

$titles = [
    "Ayder Yaylası Hafta Sonu Turu",
    "Batum Günübirlik Keşif",
    "Uzungöl ve Çevre Yaylalar",
    "Doğu Karadeniz Fotoğraf Safarisi",
    "Fırtına Deresi Rafting ve Zipline",
    "Rize Çay Bahçeleri Mistik Tur",
    "Artvin Karagöl Kamp Turu",
    "Pokut ve Sal Yaylaları Yürüyüş Ritası",
    "Sümela Manastırı Tarih Yolculuğu",
    "Karadeniz Gurme Lezzetler Turu",
    "Macahel Biyosfer Rezervi Doğa Yürüyüşü",
    "Gito ve Badara Yaylaları Seyahatı",
    "Kaçkar Dağları Zirve Tırmanışı",
    "Zilkale ve Palovit Şelalesi Turu",
    "Trabzon Şehir İçi Kültür Turu",
    "Huser Yaylası Gün Batımı Seyri",
    "Hıdırnebi Yaylası Kar Festivali",
    "Çamlıhemşin Taş Köprüler Turu",
    "Karadeniz Sahil Boyu Bisiklet Turu",
    "Boztepe Teleferik ve Giresun Adası"
];

$inserted = 0;

foreach ($titles as $index => $title) {
    $price = rand(3000, 15000);
    $sale = rand(0, 1) ? $price - rand(500, 1000) : '';

    $post_id = wp_insert_post([
        'post_title' => $title,
        'post_status' => 'publish',
        'post_type' => 'tur',
        'post_content' => '<p>Karadeniz’in eşsiz doğasında, yeşilin her tonunu görebileceğiniz unutulmaz bir deneyime hazır olun. Profesyonel rehberlerimiz eşliğinde, yöresel lezzetleri tadacak ve doğanın kalbinde huzur bulacaksınız.</p><p>Detaylı tur programımız her yaş grubuna uygundur ve konforunuz için tüm detaylar düşünülmüştür.</p>',
    ]);

    if ($post_id) {
        if ($img_id) {
            set_post_thumbnail($post_id, $img_id);
        }

        $meta_data = [
            'regular_price' => (string) $price,
            'sale_price' => (string) $sale,
            'short_desc' => 'Yeşilin ve mavinin kucaklaştığı bu eşsiz rotada doğanın gizli kalmış köşelerini keşfedin. Unutulmaz anılar biriktirmek için harika bir fırsat.',
            'main_gallery' => $gallery_ids,
            'sections' => [
                [
                    'title' => 'Ücrete Dahil Olan Hizmetler',
                    'content' => '<ul><li>Lüks araçlarla ulaşım</li><li>Profesyonel kokartlı rehberlik hizmeti</li><li>1 Gece yarım pansiyon konaklama</li><li>Zorunlu seyahat sigortası</li></ul>'
                ],
                [
                    'title' => 'İptal ve İade Şartları',
                    'content' => '<p>Tur tarihinden 15 gün öncesine kadar yapılan iptallerde ücretin tamamı kesintisiz olarak iade edilir. Son 14 gün içinde yapılan iptallerde %50 kesinti uygulanır.</p>'
                ],
                [
                    'title' => 'Önemli Bilgiler',
                    'content' => '<p>Turlarımızda hava muhalefeti vb. durumlarda rehberimiz programda değişiklik yapma hakkına sahiptir. Yürüyüşe uygun ayakkabı ve yağmurluk bulundurmanız tavsiye edilir.</p>'
                ]
            ],
            'variations' => [
                [
                    'name' => 'Standart Çift Kişilik Oda (Kişi Başı)',
                    'price' => (string) $price,
                    'gallery' => $gallery_ids,
                    'sections' => [
                        [
                            'title' => 'Oda Özellikleri',
                            'content' => 'Doğa manzaralı, balkonlu, 22 metrekare genişliğinde konforlu oda.'
                        ]
                    ]
                ],
                [
                    'name' => 'Single Farkı (Tek Kişilik Konaklama)',
                    'price' => (string) ($price + 1500),
                    'gallery' => $gallery_ids,
                    'sections' => [
                        [
                            'title' => 'Oda Özellikleri',
                            'content' => 'Tek başınıza rahatça konaklayabileceğiniz, çift kişilik yataklı konforlu oda.'
                        ]
                    ]
                ]
            ]
        ];

        update_post_meta($post_id, '_lazhem_listing_data', $meta_data);
        $inserted++;
    }
}

echo "Successfully inserted $inserted listings with detailed meta fields using image ID: $img_id\n";
