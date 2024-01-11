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
        const showUrl = '{{ route('admin.children.show', ['id' => ':slug']) }}';

        const chatTooltip = '{!! __('app.Chat') !!}';
        const chatUrl = '{{ route('admin.chat.index', ['childrenId' => ':slug']) }}';

        const galleryTooltip = '{!! __('app.Gallery') !!}';
        const galleryUrl = '{{ route('admin.gallery.index', ['gallery' => 'children', 'key' => ':slug']) }}';

        const fileTooltip = '{!! __('app.Files') !!}';
        const fileUrl = '{{ route('admin.file.index', ['file' => 'children', 'key' => ':slug']) }}';

        const videoTooltip = '{!! __('app.Video gallery') !!}';
        const videoUrl = '{{ route('admin.videos.index', ['video' => 'children', 'key' => ':slug']) }}';

        const editTooltip = '{!! __('app.Edit') !!}';
        const editUrl = '{{ route('admin.children.edit', ['id' => ':slug']) }}';

        const deleteTooltip = '{!! __('app.Destroy') !!}';

        //const userType = '{!! auth()->user()->type !!}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $('.dataTable').dataTable({
            pageLength: 100,
            order: ['0', 'asc'],
            lengthMenu: [10, 25, 50, 100, 250],
            orderCellsTop: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            createdRow: function (row, data) {
                $(row).attr('data-id', data.id).addClass('item-row');
            },
            language: {
                // sProcessing: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span> </div>'
                //processing: "<div id='datatable-loader'></div>",
                paginate: {
                    next: '<i class="fas fa-angle-right" title="{{ __('app.List.Next') }}"></i>',
                    previous: '<i class="fas fa-angle-left title="{{ __('app.List.Previous') }}"></i>'
                }
            },
            columns: [
                {
                    data: 'ordering',
                    name: 'ordering',
                    visible: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'child_id',
                    name: 'child_id'
                },
                {
                    data: 'sponsor_id',
                    name: 'sponsor_id'
                },
                {
                    data: 'region_id',
                    name: 'region_id'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'date_of_birth',
                    name: 'date_of_birth',
                },
                /*{
                    data: 'active',
                    name: 'active',
                },*/
                {
                    data: 'tools',
                    name: 'tools',
                    className: 'text-right',
                    orderable: false,
                    searchable: false,
                    render: function (id, q, row) {
                        let tools = '';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-info" ' +
                            'href="' + showUrl.replace(':slug', row.id) + '" ' +
                            'title="' + showTooltip +'">' +
                            '<i class="fas fa-eye"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-primary" ' +
                            'href="' + chatUrl.replace(':slug', row.id) + '" ' +
                            'title="' + chatTooltip +'">' +
                            '<i class="fas fa-comments"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-default" ' +
                            'href="' + galleryUrl.replace(':slug', row.id) + '" ' +
                            'title="' + galleryTooltip +' ('+row.gallery_count+')">' +
                            '<i class="far fa-images"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-default" ' +
                            'href="' + fileUrl.replace(':slug', row.id) + '" ' +
                            'title="' + fileTooltip +' ('+row.files_count+')">' +
                            '<i class="far fa-copy"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-default" ' +
                            'href="' + videoUrl.replace(':slug', row.id) + '" ' +
                            'title="' + videoTooltip +' ('+row.videos_count+')">' +
                            '<i class="fab fa-youtube"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-primary" ' +
                            'href="' + editUrl.replace(':slug', row.id) + '" ' +
                            'title="' + editTooltip +'">' +
                            '<i class="far fa-edit"></i>' +
                            '</a>';

                        tools += '<a class="btn btn-sm btn-icon-only btn-outline-danger delete" ' +
                            'href="javascript:void(0)" ' +
                            'title="' + deleteTooltip +'" ' +
                            'data-toggle="modal" ' +
                            'data-target="#itemDeleteModal">' +
                            '<i class="fas fa-times"></i>' +
                            '</a>';

                        /*if (parseInt(userType) === parseInt('{{ \App\Constants\UserRole::ADMIN }}')) {
                            tools += '<span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">' +
                                '<a href="javascript:void(0)" class="icon-btn delete" ' + deleteTooltip + '></a>' +
                            '</span>'
                        }*/

                        return tools;
                    }
                }
            ],
            //order: [],
            ajax: {
                url: '{{ route('admin.children.listPortion') }}',
                type: 'POST',
                /*data: function (e) {
                    return getSearchParams(e)
                }*/
            },
            dom: 'lBfrtip',
            buttons: [],
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

            let url = "{!! route('admin.children.active', ['id' => ':slug']) !!}";
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
            let url = "{!! route('admin.children.delete', ['id' => ':slug']) !!}";
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
