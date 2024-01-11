@extends('admin.layouts.app')
@section('titleSuffix')
    | <a href="{!! route('admin.discountForUser.add') !!}" class="text-cyan">
        <i class="mdi mdi-plus-box"></i> {{ t('Admin action buttons.add') }}
    </a>
@endsection
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped m-b-0 columns-middle">
                    <thead>
                    <tr>
                        <th>{{ t('Admin pages list.name') }}</th>
                        <th>{{ t('Admin pages list.discount') }}</th>
                        <th>{{ t('Admin pages list.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-title">{{ $item->a('title') }}</td>
                            <td class="item-title">{{ $item->discount.'%' }}</td>
                            <td>
                                <a href="{{ route('admin.discountForUser.edit', ['id'=>$item->id]) }}" {!! tooltip(t('Admin action buttons.edit')) !!} class="icon-btn edit"></a>
                                @if(authUser()->isAdmin())
                                     <span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">
                                         <a href="javascript:void(0)" class="icon-btn delete" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                     </span>
                                @endif
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
    @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
        'saveBtn' => t('Admin action buttons.delete'),
        'saveBtnClass' => 'btn-danger',
        'closeBtn' => t('Admin action buttons.cancel'),
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title'){{ t('Admin action buttons.delete title') }}@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14"><p class="font-14">{{ t('Admin action buttons.delete confirm title') }} &Lt;<span id="pdm-title"></span>&Gt;{{ t('Admin action buttons.delete confirm question mark') }}</p></p>
    @endmodal
@endsection
@push('css')
@endpush
@push('js')
    <script>
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
            var $this = $(this),
                button = $(e.relatedTarget),
                thisItemRow = button.parents('.item-row');
            itemId.val(thisItemRow.data('id'));
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
                    url: '{!! route('admin.discountForUser.delete') !!}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        item_id: thisItemId,
                    },
                    error: function(e){
                        modalError();
                        console.log(e.responseText);
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