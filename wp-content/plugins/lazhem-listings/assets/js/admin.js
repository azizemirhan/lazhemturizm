jQuery(document).ready(function($) {
    // --- Tabs Logic ---
    $('.lazhem-tabs-nav a').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.lazhem-tabs-nav li').removeClass('active');
        $(this).parent().addClass('active');
        $('.lazhem-tab-content').removeClass('active');
        $(target).addClass('active');
    });

    // --- Media Uploader ---
    $(document).on('click', '.lazhem-media-upload', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var isMulti = $btn.attr('data-multi') === 'true';
        var $input = $btn.siblings('.lazhem-media-id');
        var $preview = $btn.siblings('.lazhem-media-preview');

        var frame = wp.media({
            title: isMulti ? 'Görsel Seç / Galeri Oluştur' : 'Görsel Seç',
            button: { text: 'Kullan' },
            multiple: isMulti
        });

        frame.on('select', function() {
            var selection = frame.state().get('selection');
            var existing_ids = $input.val() ? $input.val().split(',') : [];
            var ids = [...existing_ids];

            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                var thumb = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
                if (ids.indexOf(attachment.id.toString()) === -1) {
                    ids.push(attachment.id.toString());
                    $preview.append('<div class="lazhem-preview-item" data-id="' + attachment.id + '"><img src="' + thumb + '"><span class="remove-img">×</span></div>');
                }
            });

            $input.val(ids.join(','));
        });

        frame.open();
    });

    $(document).on('click', '.remove-img', function() {
        var $item = $(this).parent();
        var $preview = $item.parent();
        var $input = $preview.siblings('.lazhem-media-id');
        
        $item.remove();
        
        var newIds = [];
        $preview.find('.lazhem-preview-item').each(function() {
            newIds.push($(this).data('id').toString());
        });
        $input.val(newIds.join(','));
    });

    // --- Variation & Custom Tabs Repeater ---
    $(document).on('click', '.add-repeater-row', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var type = $btn.data('type'); // 'variation' or 'section' or 'var_section'
        var template = $('#tmpl-lazhem-' + type).html();
        
        var $container = $btn.siblings('.lazhem-list-container');
        var count = $container.children().length;
        
        // Handle nested replacement for variation sections
        if (type === 'var_section') {
            var varIdx = $btn.closest('.lazhem-variation-item').data('index');
            template = template.replace(/{{v_index}}/g, varIdx);
        }
        
        template = template.replace(/{{index}}/g, count);
        $container.append(template);
    });

    $(document).on('click', '.remove-repeater-row', function(e) {
        if(confirm('Bu bölümü silmek istediğinize emin misiniz?')) {
            $(this).closest('.lazhem-repeater-item').remove();
        }
    });
});
