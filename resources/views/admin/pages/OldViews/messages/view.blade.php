@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.name') }}:</span>
                {{ $item->page }}
            </div>
            @if($item->message)
                @foreach($item->message as $key => $value)
                    @if($key !== 'file' && $key !== 'page')
                        <div class="view-line">
                            <span class="view-label">{{ $key }}:</span>
                            {{ $value }}
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="view-line">
                <span class="view-label">{{ t('Admin pages list.date') }}:</span>
                {{ $item->created_at->format('d/m/Y') }}
            </div>

            {{--<div class="m-t-10">
                <button type="button" data-toggle="modal" data-target="#itemDeleteModal" class="btn btn-danger">
                    {{ t('Admin action buttons.delete') }}
                </button>
            </div>--}}
        </div>
    </div>

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
    </script>
@endpush
