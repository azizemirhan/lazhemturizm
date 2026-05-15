<?php
/**
 * Gizlilik Politikası Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Gizlilik Politikası varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_privacy_defaults() {
	return array(
		'privacy_hero_eyebrow' => 'Veri Güvenliği',
		'privacy_hero_title'   => 'Gizlilik <em>Politikası</em>',
		'privacy_last_updated' => '13 Mayıs 2024',
		'privacy_content'      => '<h2>1. Veri Toplama</h2><p>Web sitemizi ziyaret ettiğinizde, deneyiminizi iyileştirmek için anonim kullanım istatistikleri ve çerezler aracılığıyla bazı veriler toplanabilir.</p><h2>2. Verilerin Kullanımı</h2><p>Toplanan veriler, yalnızca hizmet kalitemizi artırmak ve size daha kişiselleştirilmiş bir deneyim sunmak amacıyla kullanılır.</p><h2>3. Üçüncü Taraf Paylaşımı</h2><p>Kişisel verileriniz, yasal zorunluluklar haricinde asla üçüncü şahıslarla paylaşılmaz veya satılmaz.</p><h2>4. Çerez Politikası</h2><p>Sitemiz, temel fonksiyonların çalışması için gerekli olan çerezleri kullanır. Tarayıcı ayarlarınızdan çerezleri yönetebilirsiniz.</p>',
	);
}
