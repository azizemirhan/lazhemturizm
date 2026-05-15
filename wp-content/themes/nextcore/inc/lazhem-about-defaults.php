<?php
/**
 * Hakkımızda sayfası — varsayılan içerik (Next Content yokken).
 *
 * @package nextcore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @return array<int, array{num:string,title:string,text:string}>
 */
function lazhem_about_default_philosophy_cards() {
	return array(
		array(
			'num'   => '01.',
			'title' => 'Sürdürülebilirlik',
			'text'  => 'Yaylalarımızı korumak en büyük önceliğimiz. İnşa ettiğimiz her bungalovda yerel ahşap tekniklerini ve doğaya en az müdahale eden yöntemleri kullanıyoruz.',
		),
		array(
			'num'   => '02.',
			'title' => 'Küratörlük',
			'text'  => 'Sıradan turlar yerine, Karadeniz\'in ruhuna dokunan özel rotalar küratörlüğü yapıyoruz. Kalabalıklardan uzak, sadece size özel anlar tasarlıyoruz.',
		),
		array(
			'num'   => '03.',
			'title' => 'Kusursuzluk',
			'text'  => 'VIP araçlarımızdan oda içindeki ikramlarımıza kadar her noktada lüksü ve Karadeniz\'in sıcaklığını bir arada hissetmenizi sağlıyoruz.',
		),
	);
}

/**
 * @return array<int, string>
 */
function lazhem_about_default_comfort_bullets() {
	return array(
		'%100 Doğal Ahşap Mimarisi',
		'Panoramik Yayla Manzaralı Teraslar',
		'Sürdürülebilir Enerji ve Su Sistemleri',
	);
}
