<?php
/**
 * Mesafeli Satış Sözleşmesi Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Mesafeli Satış Sözleşmesi varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_sales_defaults() {
	return array(
		'sales_hero_eyebrow' => 'Yasal Bilgilendirme',
		'sales_hero_title'   => 'Mesafeli Satış <em>Sözleşmesi</em>',
		'sales_last_updated' => '13 Mayıs 2024',
		'sales_content'      => '<h2>1. Taraflar</h2><p>İşbu sözleşme, bir tarafta Lazhem Turizm (Satıcı) ile diğer tarafta sitemiz üzerinden hizmet satın alan kullanıcı (Alıcı) arasında akdedilmiştir.</p><h2>2. Sözleşmenin Konusu</h2><p>İşbu sözleşmenin konusu, Satıcı\'nın Alıcı\'ya satışını yaptığı, nitelikleri ve satış fiyatı belirtilen hizmetin satışı ve teslimi ile ilgili olarak 6502 sayılı Tüketicinin Korunması Hakkında Kanun hükümleri gereğince tarafların hak ve yükümlülüklerinin saptanmasıdır.</p><h2>3. Hizmet Bedeli ve Ödeme</h2><p>Hizmetin toplam bedeli, Alıcı tarafından seçilen tur veya konaklama paketine göre belirlenir ve ödeme anında tahsil edilir.</p><h2>4. Cayma Hakkı</h2><p>Turizm ve konaklama hizmetlerinde cayma hakkı, hizmetin başlama tarihine kalan süreye göre belirlenen iptal ve iade koşullarına tabidir.</p>',
	);
}
