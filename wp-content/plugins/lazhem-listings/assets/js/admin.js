jQuery(function($){
  $('.lazhem-repeater').each(function(){
    const $wrap = $(this);
    const name = $wrap.data('name');
    const $rows = $wrap.find('.rows');
    $wrap.on('click','.add-row',function(){
      const tpl = $('#tmpl-lazhem-' + name.replace('_','-')).html();
      if (tpl) { $rows.append(tpl); }
    });
    $wrap.on('click','.remove-row',function(){ $(this).closest('.lazhem-row').remove(); });
    $rows.sortable({ items:'.lazhem-row', handle:'strong' });
  });
});
