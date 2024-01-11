@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>{{ t('Admin users list.id') }}</th>
                        <th>{{ t('Admin pages list.name') }}</th>
                        <th>{{ t('Admin pages list.date') }}</th>
                        <th>{{ t('Admin pages list.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-title">{{ $item->id }}</td>
                            <td class="item-title">{{ $item->page }}</td>
                            <td class="item-title">{{ $item->created_at->format('d.m.Y') }}</td>
                            <td class="text-right">
                                {{--<a href="{{ route('admin.messages.edit', ['id' => $item->id]) }}"
                                   {!! tooltip(t('Admin action buttons.edit')) !!}
                                   class="icon-btn edit">

                                </a>--}}
                                <a href="{{ route('admin.messages.view', ['id' => $item->id]) }}" {!! tooltip(t('Admin users list.look')) !!} class="icon-btn view"></a>
                                <span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">
                                    <a href="javascript:void(0)" class="icon-btn delete" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
    @endif
    @modal([
        'id' => 'itemDeleteModal',
        'centered' => true,
        'loader' => true,
        'saveBtn' => t('Admin action buttons.delete'),
        'saveBtnClass' => 'btn-danger',
        'closeBtn' => t('Admin action buttons.cancel'),
        'form' => ['id' => 'itemDeleteForm', 'action' => 'javascript:void(0)']
    ])
    @slot('title'){{ t('Admin action buttons.delete title') }}@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">{{ t('Admin action buttons.delete confirm title') }} &Lt;<span id="pdm-title"></span>&Gt;{{ t('Admin action buttons.delete confirm question mark') }}</p>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        var itemId = $('#pdf-item-id'),
            modalTitle = $('#pdm-title'),
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
            var $this = $(this),
                button = $(e.relatedTarget),
                thisItemRow = button.parents('.item-row');
            itemId.val(thisItemRow.data('id'));
            modalTitle.html(thisItemRow.find('.item-title').html());

        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });
        $('#itemDeleteForm').on('submit', function(){
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: '{!! route('admin.messages.delete') !!}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        item_id: thisItemId,
                    },
                    error: function(e){
                        modalError();
                    },
                    success: function(e){
                        if (e.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            toastr.success('{{ t('Admin action notify.success') }}');
                            modal.modal('hide');
                            $('.item-row[data-id="'+thisItemId+'"]').fadeOut(function(){
                                $(this).remove();
                            });
                        }
                        else modalError();
                    }
                });
            }
            else modalError();
        });
        $('.init-dataTable').dataTable({
            pageLength: 50,
            order: ['0', 'desc'],
            "lengthMenu": [10, 25, 50, 100, 250, 500, 1000],
        });
    </script>
@endpush
