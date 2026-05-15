<?php
/**
 * Çerez Politikası Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Çerez Politikası varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_cookies_defaults() {
	return array(
		'cookies_hero_eyebrow' => 'Çerez Kullanımı',
		'cookies_hero_title'   => 'Çerez <em>Politikası</em>',
		'cookies_last_updated' => '13 Mayıs 2024',
		'cookies_content'      => '<h2>1. Çerez Nedir?</h2><p>Çerezler, web sitemizi ziyaret ettiğinizde cihazınıza kaydedilen küçük metin dosyalarıdır. Sitemizin düzgün çalışması ve size daha iyi bir deneyim sunmak için kullanılırlar.</p><h2>2. Hangi Çerezleri Kullanıyoruz?</h2><p>Sitemizde; temel fonksiyonlar için gerekli çerezler, performans analizi çerezleri ve tercihlerinizi hatırlayan fonksiyonel çerezler kullanılmaktadır.</p><h2>3. Çerezleri Nasıl Kontrol Edebilirsiniz?</h2><p>Tarayıcı ayarlarınız üzerinden çerezleri dilediğiniz zaman silebilir veya engelleyebilirsiniz. Ancak bu durum sitemizin bazı özelliklerinin çalışmasını etkileyebilir.</p>',
	);
}
