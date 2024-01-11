@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped m-b-0 columns-middle my-datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Дата</th>
                        <th>Сумма сайта</th>
                        <th>Детали заказа</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-id">{{ $item->id }}</td>
                            <td class="item-title">
                                @if($item->user)
                                    @if($item->user->admin == 0)
                                        <a href="{{ route('admin.users.view', ['id'=>$item->user->id]) }}" {!! tooltip('Посмотреть') !!} >
                                            {{ $item->user->email }}
                                        </a>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td class="item-title">{{ $item->created_at->format('d.m.Y H:i') }}</td>
                            <td class="item-title">{{ $item->sum }}</td>
                            <td class="item-title">
                                {!! $item->delivery === null ? '<span class="text-danger">нет</span>' : '<span class="text-success">да</span>' !!}
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.view', ['id'=>$item->id]) }}"
                                   {!! tooltip('Посмотреть') !!} class="icon-btn view ">

                                </a>
                                @empty($readonly)
                                    @if($item->status != 0)
                                        <span class="d-inline-block" style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal">
                                            <a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a>
                                        </span>
                                    @endif
                                @endempty
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">@lang('admin/all.empty')</h4>
    @endif
    @empty($readonly)
        @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
        'saveBtn'=>'Удалить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
        @slot('title')Удаление заказа@endslot
        <input type="hidden" id="pdf-item-id">
        <p class="font-14">Вы действительно хотите удалить данный заказ?</p>
        @endmodal
        @modal(['id'=>'clearHistoryModal', 'centered'=>true, 'loader'=>true,
        'saveBtn'=>'Очистить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'clearHistoryForm', 'action'=>route('admin.orders.clear')]])
        @slot('title')<span class="font-weight-bold text-danger">Очистка истории заказов</span>@endslot
        @csrf
        @method('delete')
        <input type="hidden" name="status" value="{{ $status }}">
        <p class="font-14 text-danger font-weight-bold">Вы действительно хотите очистить историю заказов?</p>
        @endmodal
    @endempty
@endsection
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        $('.my-datatable').dataTable({
            order: [[0, 'desc']]
        });
        @empty($readonly)
        var itemId = $('#pdf-item-id'),
            blocked = false,
            modal = $('#itemDeleteModal');
        loader = modal.find('.modal-loader');

        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            toastr.error('Возникла проблема!');
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
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: '{!! route('admin.orders.clear') !!}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        item_id: thisItemId,
                    },
                    error: function (e) {
                        modalError();
                        console.log(e.responseText);
                    },
                    success: function (e) {
                        if (e.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            toastr.success('Заказ успешно удален');
                            modal.modal('hide');
                            $('.item-row[data-id="' + thisItemId + '"]').fadeOut(function () {
                                $(this).remove();
                            });
                        } else modalError();
                    }
                });
            } else modalError();
        });
        @endempty
    </script>
@endpush
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
