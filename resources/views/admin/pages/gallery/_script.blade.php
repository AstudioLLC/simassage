@push('js')
    <script>
        $(document).ready(function(){
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
        });

        /**
         * Gallery sort
         *
         * @type {string}
         */
        var action = "{{ route('admin.gallery.sort') }}";
        $('.gallery-row').sortable({
            handle: '.gallery-item-move',
            update: function(){
                sortableUpdate($(this), action);
            }
        });

        var itemId = $('#pdf-item-id'),
            blocked = false,
            modal = $('#itemDeleteModal');
        loader = modal.find('.modal-loader');

        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            toastr.error('{{ t('Admin action notify.error') }}');
            modal.modal('hide');
        }

        modal.on('show.bs.modal', function(e){
            if (blocked) return false;
            var button = $(e.relatedTarget),
                thisItemContainer = button.parents('.item-container');
            itemId.val(thisItemContainer.data('id'));
        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });

        $('#itemDeleteForm').on('submit', function(){
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                let url = "{!! route('admin.gallery.delete', ['id' => ':slug']) !!}";

                $.ajax({
                    url: url.replace(':slug', thisItemId),
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        itemId: thisItemId,
                    },
                    error: function(response) {
                        modalError();
                    },
                    success: function(response) {
                        if (response.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            //toastr.success('{{ t('Admin action notify.success') }}');
                            modal.modal('hide');
                            $('.item-container[data-id="'+thisItemId+'"]').fadeOut(function(){
                                $(this).remove();
                            });
                        }
                        else modalError();
                    }
                });
            }
            else modalError();
        });

        var images = {!! $items->mapWithKeys(function($item) {
                            return [$item['id'] => ['alt' => $item->getTranslations('alt'), 'title' => $item->getTranslations('title')]];
                        })->toJson(JSON_FORCE_OBJECT) !!},
            isos = {!! json_encode($isos, JSON_UNESCAPED_UNICODE) !!},
            editModal = $('#itemEditModal'),
            galleryBylangFirst = $('#gallery-bylang .bylang-nav-tabs .nav-item:first-child>.nav-link');
        editModal.on('show.bs.modal', function(e) {
            $(this).find('.modal-changer').html($('.gallery-edit').html());
            var itemId = $(e.relatedTarget).parents('.item-container').data('id');
            if (!itemId) {
                e.preventDefault();
                return false;
            }
            var item = images[itemId];
            if (!item) {
                e.preventDefault();
                return false;
            }
            galleryBylangFirst.click();
            $('#edit-item-id').val(itemId);
            for (var i in isos) {
                var iso = isos[i];
                $('#edit-alt-'+iso).val(item.alt[iso] || null);
                $('#edit-title-'+iso).val(item.title[iso] || null);
            }
        });
        var editModalError = function(loader){
            loader.removeClass('shown');
            blocked = false;
            toastr.error('{{ t('Admin action notify.error') }}');
            editModal.modal('hide');
        };

        $('#itemEditForm').on('submit', function(){
            if (blocked) return false;
            blocked = true;
            var loader = editModal.find('.modal-loader');
            var thisItemId = $(this).find('#edit-item-id').val();

            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                var alts = {},
                    titles = {};
                for (var i in isos) {
                    var iso = isos[i];
                    alts[iso] = $.trim($('#edit-alt-'+iso).val());
                    titles[iso] = $.trim($('#edit-title-'+iso).val());
                }
                loader.addClass('shown');
                let url = "{!! route('admin.gallery.update', ['id' => ':slug']) !!}";

                $.ajax({
                    url: url.replace(':slug', thisItemId),
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'put',
                        itemId: thisItemId,
                        alt: alts,
                        title: titles
                    },
                    error: function(response){
                        console.error(response.responseText);
                        editModalError(loader);
                    },
                    success: function(response){
                        if (response.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            //toastr.success('{{ t('Admin action notify.success saved') }}');
                            editModal.modal('hide');
                            images[thisItemId] = {
                                alt: alts,
                                title: titles
                            }
                        }
                        else editModalError(loader);
                    }
                });
            }
            else editModalError(loader);
        });
    </script>
@endpush
