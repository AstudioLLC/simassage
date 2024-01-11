var sortableUpdate = function(self, action){
    var data = [],
        trs = self.children();
    $.each(trs, function(index, elem){
        var id = parseInt($(elem).data('id'));
        if (id>0) data.push(id);
    });
    if (data.length>0) $.ajax({
        type:'post',
        url:action,
        dataType:'json',
        data: {
            _token:csrf,
            _method:'patch',
            data: data
        },
        error: function(e) {
            console.log(e.responseText);
        }
    });
};
$('.table-sortable').each(function(index,table) {
    var $table = $(table),
        action = $table.data('action');
    if (action) $table.sortable({
        axis:'y',
        helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
                // Set helper cell sizes to match the original sizes
                $(this).width($originals.eq(index).outerWidth());
            });
            return $helper;
        },
        update: function(){
            sortableUpdate($(this), action)
        }
    });
});
