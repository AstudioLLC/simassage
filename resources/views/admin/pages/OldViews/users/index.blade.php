@extends('admin.layouts.app')
@section('title', $title)

@section('content')
    <div class="card p-2">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 columns-middle my-datatable">
                <thead>
                <tr>
                    <th>{{ t('Admin users list.id') }}</th>
                    <th>{{ t('Admin users list.name') }}</th>
                    <th>{{ t('Admin users list.email') }}</th>
                    <th>{{ t('Admin users list.status') }}</th>
                    <th>{{ t('Admin users list.orders count') }}</th>
                    <th>{{ t('Admin users list.register date') }}</th>
                    <th>{{ t('Admin users list.action') }}</th>
                </tr>
                </thead>
                <tbody class="table-sortable" data-action="{{ route('admin.items.sort') }}">

                </tbody>
            </table>
        </div>
    </div>
    @modal([
    'id' => 'itemDeleteModal',
    'centered' => true,
    'loader' => true,
    'saveBtn' => t('Admin action buttons.delete'),
    'saveBtnClass' => 'btn-danger',
    'closeBtn' => t('Admin action buttons.cancel'),
    'form' => ['id' => 'itemDeleteForm', 'action' => 'javascript:void(0)']])
    @slot('title'){{ t('Admin action buttons.delete title') }}@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">{{ t('Admin action buttons.delete confirm title') }} {{ t('Admin action buttons.delete confirm question mark') }}</p>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        /*const editTooltip = '{!! tooltip(t('Admin action buttons.edit')) !!}';
        const editUrl = '{{ route('admin.items.edit', ['id' => ':slug']) }}';

        const recommendedUrl = '{{ route('admin.items.recommended', ['id' => ':slug']) }}';
        const recommendedTooltip = '{!! tooltip(t('Admin action buttons.recommended')) !!}';*/

        const deleteTooltip = '{!! tooltip(t('Admin action buttons.delete')) !!}';

        const userType = '{!! auth()->user()->type !!}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $('.my-datatable').dataTable({
            pageLength: 50,
            processing: true,
            serverSide: true,
            createdRow: function (row, data) {
                $(row).attr('data-id', data.id).addClass('item-row');
            },
            language: {
                // sProcessing: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span> </div>'
                processing: "<div id='datatable-loader'></div>"
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'active',
                    name: 'active',
                },
                {
                    data: 'ordersCount',
                    name: 'ordersCount',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'tools',
                    name: 'tools',
                    className: 'text-right',
                    orderable: false,
                    searchable: false,
                    render: function (id, q, row) {
                        let tools = '';

                        /*tools += '<a href="' + filtersUrl.replace(':slug', row.id) + '" ' + filtersTooltip + ' class="ml-3"><span>{{ t('Admin action buttons.filters') }}</span><sup>('+row.criteria.length+')</sup></a>' + "\n";

                        if (row.recommended) {
                            tools += '<a href="' + recommendedUrl.replace(':slug', row.id) + '" ' + recommendedTooltip + ' class="ml-3"><span>{{ t('Admin action buttons.recommended') }}</span><sup>('+row.recommended.length+')</sup></a>' + "\n";
                        }

                        tools += '<a href="' + editUrl.replace(':slug', row.id) + '" ' + editTooltip + ' class="icon-btn edit"></a>' + "\n";

                        if (parseInt(userType) === parseInt('{{ \App\Constants\UserRole::ADMIN }}')) {
                            tools += '<span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">' +
                                '<a href="javascript:void(0)" class="icon-btn delete" ' + deleteTooltip + '></a>' +
                            '</span>'
                        }*/

                        return tools;
                    }
                }
            ],
            order: [],
            "lengthMenu": [10, 25, 50, 100, 250, 500, 1000],
            ajax: {
                url: '{{ route('admin.users.listPortion') }}',
                type: 'POST',
                /*data: function (e) {
                    return getSearchParams(e)
                }*/
            },
            dom: 'lBfrtip',
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
            let url = "{!! route('admin.items.destroy', ['id' => ':slug']) !!}";
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
                        item_id: thisItemId,
                    },
                    error: function (e) {
                        modalError();
                    },
                    success: function (response) {
                        if (response) {
                            loader.removeClass('shown');
                            blocked = false;
                            toastr.success('{{ t('Admin action notify.success') }}');
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
