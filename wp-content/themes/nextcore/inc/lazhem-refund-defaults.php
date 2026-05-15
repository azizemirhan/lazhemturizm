<?php
/**
 * İptal & İade Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * İptal & İade varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_refund_defaults() {
	return array(
		'refund_hero_eyebrow' => 'Müşteri Hakları',
		'refund_hero_title'   => 'İptal ve <em>İade Koşulları</em>',
		'refund_last_updated' => '13 Mayıs 2024',
		'refund_content'      => '<h2>1. İptal Koşulları</h2><p>Satın alınan tur veya konaklama hizmetinin iptali, hizmetin başlama tarihine kalan süreye göre değişiklik göstermektedir. Detaylı süreler tur bazlı olarak ilan edilmektedir.</p><h2>2. İade Süreci</h2><p>Onaylanan iade işlemleri, ödemenin yapıldığı kredi kartına veya banka hesabına 7-14 iş günü içerisinde yansıtılmaktadır.</p><h2>3. Mücbir Sebepler</h2><p>Hava muhalefeti, doğal afet veya resmi kısıtlamalar gibi mücbir sebepler nedeniyle gerçekleştirilemeyen turlarda tam iade veya tarih değişikliği hakkı sunulmaktadır.</p>',
	);
}
