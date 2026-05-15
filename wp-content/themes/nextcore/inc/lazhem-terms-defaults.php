<?php
/**
 * Kullanım Koşulları Sayfası Varsayılan İçerikler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Kullanım Koşulları varsayılanlarını döner.
 *
 * @return array<string, string>
 */
function lazhem_terms_defaults() {
	return array(
		'terms_hero_eyebrow' => 'Yasal Bilgilendirme',
		'terms_hero_title'   => 'Kullanım <em>Koşulları</em>',
		'terms_last_updated' => '13 Mayıs 2024',
		'terms_content'      => '<h2>1. Kabul Edilme</h2><p>Bu web sitesini kullanarak, aşağıda belirtilen kullanım koşullarını kabul etmiş sayılırsınız. Eğer bu koşullardan herhangi birini kabul etmiyorsanız, lütfen siteyi kullanmayınız.</p><h2>2. Fikri Mülkiyet Hakları</h2><p>Sitede yer alan tüm içerikler, metinler, grafikler ve logolar Lazhem Turizm’in mülkiyetindedir ve telif hakkı yasalarıyla korunmaktadır.</p><h2>3. Kullanım Sınırlandırmaları</h2><p>Kullanıcılar, site içeriğini ticari olmayan, kişisel amaçlar doğrultusunda kullanabilirler. İçeriğin kopyalanması veya izinsiz dağıtılması yasaktır.</p><h2>4. Sorumluluk Reddi</h2><p>Lazhem Turizm, site içeriğindeki hatalardan veya eksikliklerden sorumlu tutulamaz. Bilgiler önceden haber verilmeksizin değiştirilebilir.</p>',
	);
}
