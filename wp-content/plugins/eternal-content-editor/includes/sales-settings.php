<?php
/**
 * Next Content — Mesafeli Satış Sözleşmesi ayarları
 */

if (!defined('ABSPATH')) {
    exit;
}

function ece_sales($key, $default = '')
{
    return get_option('eternal_sales_' . sanitize_key($key), $default);
}

function ece_sales_settings_page()
{
    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'hero';

    $tabs = [
        'hero' => ['label' => 'Hero', 'icon' => 'fas fa-bolt'],
        'content' => ['label' => 'İçerik', 'icon' => 'fas fa-align-left'],
    ];
    ?>
    <form method="post" action="">
        <?php wp_nonce_field('ece_save_sales_settings', 'ece_sales_nonce'); ?>
        <input type="hidden" name="ece_save_sales" value="1">
        <input type="hidden" name="ece_active_tab" id="eceActiveTab" value="<?php echo esc_attr($active_tab); ?>">

        <div class="ece-page-header">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Next Content — Mesafeli Satış Sözleşmesi</span>
        </div>

        <div class="ece-tabs">
            <?php foreach ($tabs as $key => $tab): ?>
                <button type="button" class="ece-tab <?php echo $active_tab === $key ? 'ece-tab--active' : ''; ?>"
                    data-tab="<?php echo esc_attr($key); ?>">
                    <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                    <?php echo esc_html($tab['label']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div id="tab-hero" class="ece-tab-content <?php echo $active_tab === 'hero' ? 'ece-tab-content--active' : ''; ?>">
            <div class="ece-card">
                <div class="ece-card-title">Sayfa Başlığı & Breadcrumb</div>
                <div class="ece-field">
                    <label>Eyebrow (Üst Başlık)</label>
                    <input type="text" class="ece-input" name="ece[sales_hero_eyebrow]" value="<?php echo esc_attr(ece_sales('sales_hero_eyebrow')); ?>">
                </div>
                <div class="ece-field">
                    <label>Ana Başlık (H1)</label>
                    <input type="text" class="ece-input" name="ece[sales_hero_title]" value="<?php echo esc_attr(ece_sales('sales_hero_title')); ?>">
                </div>
            </div>
        </div>

        <div id="tab-content" class="ece-tab-content <?php echo $active_tab === 'content' ? 'ece-tab-content--active' : ''; ?>">
            <div class="ece-card">
                <div class="ece-card-title">Sözleşme Metni</div>
                <div class="ece-field">
                    <label>Son Güncelleme Tarihi</label>
                    <input type="text" class="ece-input" name="ece[sales_last_updated]" value="<?php echo esc_attr(ece_sales('sales_last_updated')); ?>" placeholder="Örn: 13 Mayıs 2024">
                </div>
                <div class="ece-field">
                    <label>Metin İçeriği</label>
                    <?php
                    $content = ece_sales('sales_content');
                    wp_editor($content, 'ece_sales_content', [
                        'textarea_name' => 'ece[sales_content]',
                        'media_buttons' => true,
                        'textarea_rows' => 20,
                        'tinymce' => [
                            'toolbar1' => 'bold,italic,underline,separator,bullist,numlist,separator,link,unlink,undo,redo',
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="ece-save-bar">
            <button type="submit" class="ece-save-btn"><i class="fas fa-save"></i> Kaydet</button>
        </div>
    </form>
    <?php
}
