<?php
/**
 * KVKK Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * KVKK varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_kvkk_defaults() {
	return array(
		'kvkk_hero_eyebrow' => 'Yasal Bilgilendirme',
		'kvkk_hero_title'   => 'KVKK Aydınlatma <em>Metni</em>',
		'kvkk_last_updated' => '13 Mayıs 2024',
		'kvkk_content'      => '<h2>1. Veri Sorumlusu</h2><p>Lazhem Turizm olarak, kişisel verilerinizin güvenliğine önem veriyoruz. 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") uyarınca, veri sorumlusu sıfatıyla hareket etmekteyiz.</p><h2>2. Kişisel Verilerin İşlenme Amacı</h2><p>Kişisel verileriniz, size sunduğumuz hizmetlerin kalitesini artırmak, rezervasyon süreçlerini yönetmek ve yasal yükümlülüklerimizi yerine getirmek amacıyla işlenmektedir.</p><h2>3. İşlenen Kişisel Veriler</h2><p>Hizmetlerimizden faydalanırken paylaştığınız ad-soyad, iletişim bilgileri ve konaklama tercihleri gibi veriler işleme alınmaktadır.</p><h2>4. Veri Sahibi Hakları</h2><p>KVKK’nın 11. maddesi kapsamında, kişisel verilerinizin işlenip işlenmediğini öğrenme, düzeltilmesini talep etme ve verilerinizin silinmesini isteme haklarına sahipsiniz.</p>',
	);
}
