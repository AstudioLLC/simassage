@push('css')
    @css(aAdmin('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css'))
@endpush

@push('js')
    @js(aAdmin('vendor/datatables.net/js/jquery.dataTables.min.js'))
    @js(aAdmin('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/dataTables.buttons.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.html5.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.flash.min.js'))
    @js(aAdmin('vendor/datatables.net-buttons/js/buttons.print.min.js'))
    @js(aAdmin('vendor/datatables.net-select/js/dataTables.select.min.js'))
    <script>
        const showTooltip = '{!! __('app.View') !!}';
        const showUrl = '{{ route('admin.departments.show', ['id' => ':slug']) }}';

        const showGallery = '{!! __('app.Gallery') !!}';
        const addGallery = '{{ route('admin.gallery.index', ['gallery' => 'departments', 'key' => ':slug']) }}';
        const editTooltip = '{!! __('app.Edit') !!}';
        const editUrl = '{{ route('admin.departments.edit', ['id' => ':slug']) }}';

        const deleteTooltip = '{!! __('app.Destroy') !!}';

        //const userType = '{!! auth()->user()->type !!}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });


        /**
         * Item active changer
         */
        $(document).on('click', '.active-changer span', function() {
            let value = $(this).parent().find('input').val();
            if (value == 1) {
                $(this).parent().find('input').val(0);
            } else {
                $(this).parent().find('input').val(1);
            }

            let url = "{!! route('admin.departments.active', ['id' => ':slug']) !!}";
            var thisItemId = $(this).parents('tr').data('id');

            $.ajax({
                url: url.replace(':slug', thisItemId),
                type: 'post',
                dataType: 'json',
                data: {
                    _token: csrf,
                    _method: 'post',
                    itemId: thisItemId,
                    value: $(this).parent().find('input').val(),
                },
                error: function (e) {
                    return false;
                },
                success: function (response) {
                    if (response) {
                        //toastr.success('asdasdasd');
                    } else {
                        return false;
                    }
                }
            });
        });


        var itemId = $('#pdf-item-id'),
            blocked = false,
            modal = $('#itemDeleteModal');
        loader = modal.find('.modal-loader');

        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            //toastr.error('{{ t('Admin action notify.error') }}');
            modal.modal('hide');
        }

        modal.on('show.bs.modal', function (e) {
            if (blocked) return false;
            var $this = $(this),
                button = $(e.relatedTarget),
                thisItemRow = button.parents('.item-row');
            itemId.val(thisItemRow.data('id'));
        }).on('hide.bs.modal', function (e) {
            if (blocked) return false;
        });
        $('#itemDeleteForm').on('submit', function () {
            let url = "{!! route('admin.departments.delete', ['id' => ':slug']) !!}";
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: url.replace(':slug', thisItemId),
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        itemId: thisItemId,
                    },
                    error: function (e) {
                        modalError();
                    },
                    success: function (response) {
                        if (response) {
                            loader.removeClass('shown');
                            blocked = false;
                            //toastr.success('{{ t('Admin action notify.success') }}');
                            modal.modal('hide');
                            $('.item-row[data-id="' + thisItemId + '"]').fadeOut(function () {
                                $(this).remove();
                            });
                        } else modalError();
                    }
                });
            } else modalError();
        });
    </script>
@endpush
