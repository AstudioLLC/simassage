@extends('admin.layouts.app')
@section('content')

    <div class="card">
        @if(!empty($item))
            <div class="card-body">

                <div class="view-line"><span class="view-label">Номер заказа:</span> N{{ $item->id }}</div>
                @if ($item->user)
                    <div class="view-line"><span class="view-label">Пользователь:</span> <a
                            href="{{ route('admin.users.view', ['id' => $item->user->id]) }}">{{ $item->user->email }}</a>
                    </div>
                @endif
                <div class="view-line"><span class="view-label">ФИО:</span> {{ $item->name??'-' }}</div>
                <div class="view-line"><span class="view-label">Телефон:</span> {{ $item->phone??'-' }}</div>
                <div class="view-line"><span
                        class="view-label">Дата:</span> {{ $item->created_at->format('d.m.Y H:i')??'-' }}</div>
                <div class="view-line"><span class="view-label">Метод доставки:</span> {{ $item->delivery_method_name }}
                </div>
                @if($item->delivery)
                    <div class="view-line"><span class="view-label">Регион:</span> {{ $item->region_name }}</div>
                    <div class="view-line"><span class="view-label">Населенный пункт:</span> {{ $item->city_name }}
                    </div>
                    <div class="view-line"><span class="view-label">Адрес:</span> {{ $item->address }}</div>
                    <div class="view-line"><span class="view-label">Цена доставки:</span> {{ $item->delivery_price ?: 'Бесплатно' }}
                    </div>
                @else
                    <div class="view-line"><span class="view-label">Точка самовывоза:</span>
                        @if ($item->pickup_point)
                            <a href="{{ route('admin.pickup_points.edit', ['id'=>$item->pickup_point->id]) }}">{{ $item->pickup_point_address }}</a>
                        @else
                            {{ $item->pickup_point_address }}
                        @endif
                    </div>
                @endif
                <div class="view-line">
                    <span class="view-label">Метод оплаты:</span>
                    {{ $item->payment_method_name }}
                    @if ($item->payment_method=='bank' && $item->paid==0 && $item->paid_request==1)
                        <span class="text-warning">(Ожидание подверждения)</span>
                    @endif
                </div>
                <div class="view-line"><span class="view-label">Сумма:</span> {{ $item->total }}</div>
                <div class="view-line"><span class="view-label">Статус:</span> {!! $item->status_html !!}</div>
                @if($item->status_type=='new')
                    <div class="pt-2">
                        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#acceptOrderModal">
                            Принять
                        </button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#denyOrderModal">Отклонить
                        </button>
                    </div>
                    @push('modals')
                        @modal(['id'=>'acceptOrderModal', 'saveBtn'=>'Принять', 'saveBtnClass'=>'btn-success','closeBtn'
                        => 'Отменить', 'centered'=>true,
                        'form'=>['method'=>'post','action'=>route('admin.orders.respond', ['id'=>$item->id])]])
                        @slot('title')Принять заказ?@endslot
                        <input type="hidden" name="status" value="1">
                        @csrf @method('patch')
                        <p class="font-weight-bold text-success">Принять заказ?</p>
                        @endmodal
                        @modal(['id'=>'denyOrderModal', 'saveBtn'=>'Откланить', 'saveBtnClass'=>'btn-danger', 'closeBtn'
                        => 'Отменить', 'centered'=>true,
                        'form'=>['method'=>'post','action'=>route('admin.orders.respond', ['id'=>$item->id])]])
                        @slot('title')Откланить заказ?@endslot
                        <input type="hidden" name="status" value="0">
                        @csrf @method('patch')
                        <p class="text-danger font-weight-bold">Откланить заказ?</p>
                        @endmodal
                    @endpush
                @elseif($item->status_type=='pending')
                    <div class="view-line"><span
                            class="view-label">Статус оплаты:</span> {!! $item->paid?'<span class="text-success">оплачен</span>':'<span class="text-danger">не оплачен</span>' !!}
                    </div>
                    <div class="pt-2">
                        <button class="btn btn-info" data-toggle="modal" data-target="#changeOrderStatusModal">Изменить
                            процесс
                        </button>
                    </div>
                    @push('modals')
                        @modal(['id'=>'changeOrderStatusModal', 'saveBtn'=>'Сохранить', 'saveBtnClass'=>'btn-success',
                        'closeBtn' => 'Отменить', 'centered'=>true,
                        'form'=>['method'=>'post','action'=>route('admin.orders.change_process', ['id'=>$item->id])]])
                        @slot('title')Изменение процесса заказа@endslot
                        @csrf @method('patch')
                        <div>
                            <div>Статус</div>
                            <select id="process-select" name="process" class="select2" style="width:100%;">
                                @foreach($process as $process_status=>$process_name)
                                    <option
                                        value="{{ $process_status }}" {!! $item->process==$process_status?'selected':null !!}>{{ $process_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-2">
                            @labelauty(['id'=>'paid', 'label'=>'Оплачен',
                            'checked'=>$item->paid?true:false])@endlabelauty
                        </div>
                        <div id="ifAllChecked" class="text-danger font-14 pt-2" style="display: none">Заказ станет
                            выполненным
                        </div>
                        @push('js')
                            <script>
                                var paidCheckbox = $('#paid'),
                                    processSelect = $('#process-select'),
                                    ifAllChecked = $('#ifAllChecked'),
                                    checkProcess = function () {
                                        if (paidCheckbox.is(':checked') && processSelect.val() === '3') ifAllChecked.show();
                                        else ifAllChecked.hide();
                                    };
                                paidCheckbox.on('change', checkProcess);
                                processSelect.on('change', checkProcess);
                            </script>
                        @endpush
                        @endmodal
                    @endpush
                @endif
                <div class="pt-3">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Артикул</th>
                            <th>Название</th>
                            <th>Компания</th>
                            <th>Цена</th>
                            <th>Кол-во в заказе</th>
                            <th>Кол-во на складе</th>
                            <th>Сумма сайта</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item->items as $part)
                            {{--                            @dd($part)--}}
                            <tr>
                                <td>{{ $part->code }}</td>
                                <td>
                                    @if(Gate::check('admin'))
                                        <a href="{{ route('admin.parts.edit', ['id'=>$part->part->id]) }}">{{ $part->name }}</a>
                                    @else
                                        <a href="{{ route('admin.items.edit', ['id'=>$part->id]) }}">{{ $part->title }}</a>
                                    @endif
                                </td>
                                <td>
                                    @if(count($part->company))
                                        <a href="{{ route('admin.users.view', ['id'=> $part->company->first()->users->first()->id]) }}" {!! tooltip('Посмотреть') !!}>{{ $part->company->first()->users->first()->name }}</a>
                                    @endif
                                </td>
                                <td>{{ $part->pivot->price }} @if($part->pivot->price < $part->pivot->real_price)
                                        <del>{{ $part->pivot->real_price.'.00' }}</del> @endif</td>
                                <td>{{ $part->pivot->count }}</td>
                                <td>{{ $part->count }}</td>
                                <td>{{ $part->pivot->sum }} @if($part->pivot->sum < ($part->pivot->real_price * $part->pivot->count))
                                        <del>{{ ($part->pivot->real_price * $part->pivot->count) }}</del> @endif
a                                </td>
                            </tr>
                        @endforeach
                        <tr class="font-weight-bold">
                            <td>Сумма</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $item->sum }} @if($item->sum!=$item->real_sum)
                                    <del>{{ $item->real_sum }}</del> @endif</td>
                        </tr>

                        @if($item->delivery)
                            <tr class="font-weight-bold">
                                <td>Цена доставки</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ ($item->delivery_price==0)?'Бесплатная доставка':$item->delivery_price }}
                                </td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td>Итого</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                @if(Gate::check('admin') && ($item->status_type=='new' || $item->status_type=='declined'))
                    <div class="pt-5">
                        <button class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#deleteUserModal">
                            Удалить заказ
                        </button>
                    </div>
                    @push('modals')
                        @modal(['id'=>'deleteUserModal', 'saveBtn'=>'УДАЛИТЬ НАВСЕГДА', 'saveBtnClass'=>'btn-danger',
                        'closeBtn' => 'Отменить', 'centered'=>true,
                        'form'=>['method'=>'post','action'=>route('admin.orders.delete')]])
                        @slot('title')<span class="text-danger font-weight-bold">УДАЛЕНИЕ ЗАКАЗА</span>@endslot
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        @csrf @method('delete')
                        <p>Вы дейстительно хотите <span
                                class="text-danger font-weight-bold">УДАЛИТЬ ЗАКАЗ НАВСЕГДА</span>?</p>
                        @endmodal
                    @endpush
                @endif
            </div>
        @else


        @endif
    </div>
    @stack('modals')
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $('.select2').select2();
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
