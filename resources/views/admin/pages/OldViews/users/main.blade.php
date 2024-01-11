@extends('admin.layouts.app')
@section('content')
    @if(isset($role))
        <a href="{{ route('admin.users.add.admin', ['role' => $role]) }}" class="text-cyan">
            <i class="mdi mdi-plus-box"></i> {{ t('Admin action buttons.add') }}
        </a>
    @else
        <a href="{{ route('admin.users.add', ['type' => $type]) }}" class="text-cyan">
            <i class="mdi mdi-plus-box"></i> {{ t('Admin action buttons.add') }}
        </a>
    @endif
    @if(count($items))
        <div class="card mt-2">
            <div class="card-body table-responsive">
                <table class="table table-striped m-b-0 columns-middle my-datatable">
                    <thead>
                    <tr>
                        <th>{{ t('Admin users list.id') }}</th>
                        <th>{{ t('Admin users list.name') }}</th>
                        <th>{{ t('Admin users list.email') }}</th>
                        <th>{{ t('Admin users list.status') }}</th>
                        @if(isset($type))
                            @if((int) auth()->user()->admin == 1)
                                <th>{{ t('Admin users list.orders count') }}</th>
                            @endif
                        @endif
                        <th>{{ t('Admin users list.register date') }}</th>
                        <th>{{ t('Admin users list.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-id">{{ $item->id }}</td>
                            <td class="item-title">{{ $item->name }}</td>
                            <td class="item-title">{{ $item->email }}</td>
                            @if($item->active)
                                <td class="text-success">{{ t('Admin pages list.active') }}</td>
                            @else
                                <td class="text-danger">{{ t('Admin pages list.inactive') }}</td>

                            @endif
                            @if(isset($type))
                                @if((int) auth()->user()->admin == 1)
                                    <td>{{ count($item->orders) }}</td>
                                @endif
                            @endif
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.discount', ['id'=>$item->id]) }}" {!! tooltip(t('Admin action buttons.discounts')) !!} style="font-size: 20px">
                                    <span style="color: #28b779!important">%</span>
                                </a>
                                @if(isset($type) && $type == 1)
                                    <a href="{{ route('admin.users.accept.email', ['id'=>$item->id]) }}" {!! tooltip(t('Admin action buttons.confirm')) !!} style="font-size: 14px">
                                        <span style="color:{{ (!empty($item->verification)) ? 'red' : 'green' }}">
                                            {{ (!empty($item->verification)) ? t('Admin users list.confirm') : t('Admin users list.confirmed') }}
                                        </span>
                                    </a>
                                @endif
                                <a href="{{ route('admin.users.view', ['id'=>$item->id]) }}" {!! tooltip(t('Admin users list.look')) !!} class="icon-btn view"></a>
                                @if(auth()->user()->role == 1)
                                    <span class="d-inline-block" data-toggle="modal" data-target="#itemDeleteModal">
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
        @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
           'saveBtn' => t('Admin action buttons.delete'),
           'saveBtnClass' => 'btn-danger',
           'closeBtn' => t('Admin action buttons.cancel'),
           'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
        @slot('title'){{ t('Admin action buttons.delete title') }}@endslot
        <input type="hidden" id="pdf-item-id">
        <p class="font-14">{{ t('Admin action buttons.delete confirm title') }} &Lt;<span id="pdm-title"></span>&Gt;{{ t('Admin action buttons.delete confirm question mark') }}</p>
        @endmodal
    @else
        <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
    @endif

@endsection
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        var type= "{!! $title !!}";
        $('.my-datatable').dataTable();
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
                    url: '{!! route('admin.users.delete') !!}',
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
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
