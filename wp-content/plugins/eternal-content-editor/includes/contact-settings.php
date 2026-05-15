<?php
/**
 * İletişim sayfası — tüm bölümler (Next Content).
 */

if (!defined('ABSPATH')) {
    exit;
}

function ece_contact_val($key, $default = '')
{
    $k = 'eternal_contact_' . sanitize_key($key);
    $v = get_option($k, '__ece_missing__');
    if ($v === '__ece_missing__') {
        return $default;
    }
    return $v;
}

function ece_contact_media_field_row($label, $opt_key, $default = '')
{
    $val = ece_contact_val($opt_key, $default);
    $preview = '';
    if ($val !== '') {
        $preview = '<img src="' . esc_url($val) . '" alt="" style="max-width:220px;height:auto;border-radius:8px;margin-top:8px;display:block;">';
    }
    ?>
    <tr>
        <th scope="row"><?php echo esc_html($label); ?></th>
        <td>
            <div class="ece-field">
                <div class="ece-field-group">
                    <input type="text" name="ece[<?php echo esc_attr($opt_key); ?>]" class="large-text" style="flex:1;min-width:0;" value="<?php echo esc_attr($val); ?>" />
                    <button type="button" class="ece-upload-btn"><i class="fas fa-upload"></i> <?php esc_html_e('Ortamdan seç', 'eternal-content-editor'); ?></button>
                </div>
                <div class="ece-image-preview"><?php echo $preview; ?></div>
            </div>
        </td>
    </tr>
    <?php
}

function ece_contact_settings_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'hero';
    $tabs = [
        'hero' => ['label' => 'Hero', 'icon' => 'fas fa-heading'],
        'info' => ['label' => 'Bilgi & kanallar', 'icon' => 'fas fa-address-card'],
        'form' => ['label' => 'Form', 'icon' => 'fas fa-envelope'],
        'map' => ['label' => 'Harita / görsel', 'icon' => 'fas fa-map-marked-alt'],
    ];

    $t = get_template_directory_uri();

    ?>
    <form method="post" action="">
        <?php wp_nonce_field('ece_save_contact_settings', 'ece_contact_nonce'); ?>
        <input type="hidden" name="ece_save_contact" value="1" />
        <input type="hidden" name="ece_active_tab" id="eceActiveTab" value="<?php echo esc_attr($active_tab); ?>" />

        <div class="ece-page-header">
            <i class="fas fa-phone"></i>
            <span>Next Content — İletişim</span>
        </div>

        <div class="ece-tabs">
            <?php foreach ($tabs as $key => $tab) : ?>
                <button type="button" class="ece-tab <?php echo $active_tab === $key ? 'ece-tab--active' : ''; ?>"
                    data-tab="<?php echo esc_attr($key); ?>">
                    <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div id="tab-hero" class="ece-tab-content <?php echo $active_tab === 'hero' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Üst etiket</th><td><input type="text" name="ece[ct_hero_eyebrow]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_hero_eyebrow', 'Bize Ulaşın')); ?>" /></td></tr>
                <tr><th>Başlık (H1, HTML)</th><td><textarea name="ece[ct_hero_h1]" class="large-text" rows="3"><?php echo esc_textarea(ece_contact_val('ct_hero_h1', 'Size yardımcı olmaktan <em>mutluluk</em> duyarız.')); ?></textarea></td></tr>
                <tr><th>Özet</th><td><textarea name="ece[ct_hero_lede]" class="large-text" rows="3"><?php echo esc_textarea(ece_contact_val('ct_hero_lede', 'Rize\'deki merkez ofisimizde veya yaylalardaki bungalovlarımızda Karadeniz misafirperverliğiyle sizi bekliyoruz.')); ?></textarea></td></tr>
            </table>
        </div>

        <div id="tab-info" class="ece-tab-content <?php echo $active_tab === 'info' ? 'ece-tab-content--active' : ''; ?>">
            <h3 class="ece-card-title" style="margin:0 0 12px;">Merkez ofis</h3>
            <table class="form-table">
                <tr><th>Başlık</th><td><input type="text" name="ece[ct_office_h3]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_office_h3', 'Merkez Ofis')); ?>" /></td></tr>
                <tr><th>Adres (HTML, &lt;br&gt; kullanılabilir)</th><td><textarea name="ece[ct_office_address]" class="large-text" rows="3"><?php echo esc_textarea(ece_contact_val('ct_office_address', 'Lazhem Turizm, Merkez Mah. No:42<br>Ardeşen, Rize / Türkiye')); ?></textarea></td></tr>
            </table>
            <h3 class="ece-card-title" style="margin:24px 0 12px;">İletişim kanalları</h3>
            <table class="form-table">
                <tr><th>Bölüm başlığı</th><td><input type="text" name="ece[ct_channels_h3]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_channels_h3', 'İletişim Kanalları')); ?>" /></td></tr>
                <tr><th>Telefon (görünen)</th><td><input type="text" name="ece[ct_phone_display]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_phone_display', '+90 464 000 00 00')); ?>" /><p class="description">tel: bağlantısı rakamlardan otomatik üretilir.</p></td></tr>
                <tr><th>E-posta</th><td><input type="email" name="ece[ct_email]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_email', 'info@lazhem.com')); ?>" /></td></tr>
                <tr><th>WhatsApp URL</th><td><input type="text" name="ece[ct_wa_url]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_wa_url', 'https://wa.me/904640000000')); ?>" /></td></tr>
                <tr><th>WhatsApp metni</th><td><input type="text" name="ece[ct_wa_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_wa_label', 'WhatsApp Hattı →')); ?>" /></td></tr>
            </table>
            <h3 class="ece-card-title" style="margin:24px 0 12px;">Sosyal medya</h3>
            <table class="form-table">
                <tr><th>Bölüm başlığı</th><td><input type="text" name="ece[ct_social_h3]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_h3', 'Sosyal Medya')); ?>" /></td></tr>
                <tr><th>Instagram URL</th><td><input type="text" name="ece[ct_social_ig_url]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_ig_url', '#')); ?>" placeholder="#" /></td></tr>
                <tr><th>Instagram aria-label</th><td><input type="text" name="ece[ct_social_ig_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_ig_label', 'Instagram')); ?>" /></td></tr>
                <tr><th>Facebook URL</th><td><input type="text" name="ece[ct_social_fb_url]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_fb_url', '#')); ?>" /></td></tr>
                <tr><th>Facebook aria-label</th><td><input type="text" name="ece[ct_social_fb_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_fb_label', 'Facebook')); ?>" /></td></tr>
                <tr><th>YouTube URL</th><td><input type="text" name="ece[ct_social_yt_url]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_yt_url', '#')); ?>" /></td></tr>
                <tr><th>YouTube aria-label</th><td><input type="text" name="ece[ct_social_yt_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_social_yt_label', 'YouTube')); ?>" /></td></tr>
            </table>
        </div>

        <div id="tab-form" class="ece-tab-content <?php echo $active_tab === 'form' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <tr><th>Form kutusu başlığı</th><td><input type="text" name="ece[ct_form_h2]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_h2', 'Hızlı İletişim Formu')); ?>" /></td></tr>
                <tr><th>Form gönderim adresi</th><td><input type="text" name="ece[ct_form_action]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_action', '#')); ?>" /><p class="description">Yer tutucu: <code>#</code> (şimdilik örnek form).</p></td></tr>
                <tr><th>Ad — etiket</th><td><input type="text" name="ece[ct_form_name_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_name_label', 'Adınız Soyadınız')); ?>" /></td></tr>
                <tr><th>Ad — placeholder</th><td><input type="text" name="ece[ct_form_name_ph]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_name_ph', 'Örn: Mehmet Karadeniz')); ?>" /></td></tr>
                <tr><th>E-posta — etiket</th><td><input type="text" name="ece[ct_form_email_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_email_label', 'E-posta Adresiniz')); ?>" /></td></tr>
                <tr><th>E-posta — placeholder</th><td><input type="text" name="ece[ct_form_email_ph]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_email_ph', 'orn@mail.com')); ?>" /></td></tr>
                <tr><th>Telefon — etiket</th><td><input type="text" name="ece[ct_form_phone_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_phone_label', 'Telefon Numaranız')); ?>" /></td></tr>
                <tr><th>Telefon — placeholder</th><td><input type="text" name="ece[ct_form_phone_ph]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_phone_ph', '0 5xx xxx xx xx')); ?>" /></td></tr>
                <tr><th>Mesaj — etiket</th><td><input type="text" name="ece[ct_form_message_label]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_message_label', 'Mesajınız')); ?>" /></td></tr>
                <tr><th>Mesaj — placeholder</th><td><input type="text" name="ece[ct_form_message_ph]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_message_ph', 'Size nasıl yardımcı olabiliriz?')); ?>" /></td></tr>
                <tr><th>Gönder butonu</th><td><input type="text" name="ece[ct_form_submit_txt]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_form_submit_txt', 'Gönder')); ?>" /></td></tr>
            </table>
        </div>

        <div id="tab-map" class="ece-tab-content <?php echo $active_tab === 'map' ? 'ece-tab-content--active' : ''; ?>">
            <table class="form-table">
                <?php ece_contact_media_field_row(__('Arka plan görseli', 'eternal-content-editor'), 'ct_map_bg', $t . '/assets/images/sumela-monastery.png'); ?>
                <tr><th>Harita üstü başlık</th><td><input type="text" name="ece[ct_map_h3]" class="large-text" value="<?php echo esc_attr(ece_contact_val('ct_map_h3', 'Rize\'nin kalbindeyiz.')); ?>" /></td></tr>
            </table>
        </div>

        <?php submit_button('Kaydet'); ?>
    </form>
    <?php
}

