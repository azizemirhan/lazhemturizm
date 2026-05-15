jQuery(document).ready(function ($) {
    $('#ece-page-select').on('change', function () {
        var val = $(this).val();
        if (val) {
            window.location.href = 'admin.php?page=eternal-content&ece_page=' + encodeURIComponent(val);
        }
    });

    // Tab switching
    $(document).on('click', '.ece-tab', function () {
        var tab = $(this).data('tab');

        // Update active tab button
        $('.ece-tab').removeClass('ece-tab--active');
        $(this).addClass('ece-tab--active');

        // Update active tab content
        $('.ece-tab-content').removeClass('ece-tab-content--active');
        $('#tab-' + tab).addClass('ece-tab-content--active');

        // Store active tab in hidden field
        $('#eceActiveTab').val(tab);
    });

    // =========================================
    // Repeater: Add New Item
    // =========================================
    $(document).on('click', '.ece-add-repeater', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $btn = $(this);
        var $card = $btn.closest('.ece-card');
        var $container = $card.find('.ece-repeater-container');

        if ($container.length === 0) {
            // Fallback: look for sibling
            $container = $btn.siblings('.ece-repeater-container');
        }

        var $items = $container.find('> .ece-repeater-item');
        var $lastItem = $items.last();

        if ($lastItem.length === 0) {
            alert('Hata: Klonlanacak öğe bulunamadı.');
            return;
        }

        // Clone the last item
        var $clone = $lastItem.clone(false);

        // Clear all input values in clone
        $clone.find('input[type="text"], input[type="url"], input[type="tel"]').val('');
        $clone.find('textarea').val('');
        $clone.find('.ece-image-preview').html('');

        // Update index in name attributes
        var newIndex = $items.length;
        $clone.find('[name]').each(function () {
            var name = $(this).attr('name');
            // Replace [N] with [newIndex] — only the first numeric index in brackets
            name = name.replace(/\[(\d+)\]/, '[' + newIndex + ']');
            $(this).attr('name', name);
        });

        // Update the number badge
        $clone.find('.ece-repeater-num').text(newIndex + 1);

        // Append to container
        $container.append($clone);

        // Scroll to the new item
        $('html, body').animate({
            scrollTop: $clone.offset().top - 100
        }, 400);
    });

    // =========================================
    // Repeater: Remove Item
    // =========================================
    $(document).on('click', '.ece-remove-repeater', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $item = $(this).closest('.ece-repeater-item');
        var $container = $item.closest('.ece-repeater-container');
        var $items = $container.find('> .ece-repeater-item');

        // Don't allow removing the last item
        if ($items.length <= 1) {
            alert('En az bir öğe kalmalıdır.');
            return;
        }

        if (!confirm('Bu öğeyi silmek istediğinize emin misiniz?')) {
            return;
        }

        // Remove the item
        $item.remove();

        // Re-index all remaining items
        $container.find('> .ece-repeater-item').each(function (index) {
            // Update number badge
            $(this).find('.ece-repeater-num').first().text(index + 1);

            // Update name attributes
            $(this).find('[name]').each(function () {
                var name = $(this).attr('name');
                name = name.replace(/\[(\d+)\]/, '[' + index + ']');
                $(this).attr('name', name);
            });
        });
    });

    // =========================================
    // Media Uploader
    // =========================================
    $(document).on('click', '.ece-upload-btn', function (e) {
        e.preventDefault();
        var button = $(this);
        var inputField = button.closest('.ece-field-group').find('input');
        var previewContainer = button.closest('.ece-field').find('.ece-image-preview');

        var customUploader = wp.media({
            title: 'Görsel Seç',
            button: {
                text: 'Görseli Kullan'
            },
            multiple: false
        });

        customUploader.on('select', function () {
            var attachment = customUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);

            // Update preview if exists
            if (previewContainer.length) {
                previewContainer.html('<img src="' + attachment.url + '" style="max-width: 100%; height: auto; border-radius: 8px; margin-top: 10px;">');
            }
        });

        customUploader.open();
    });
});
