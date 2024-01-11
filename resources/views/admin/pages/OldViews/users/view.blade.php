@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.name') }}:</span>
                {{ $item->name }}
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.email') }}:</span>
                {{ $item->email }}
                @if($item->verification)
                    <span class="text-danger">({{ t('Admin users list.not confiremd') }})</span>
                @else
                    <span class="text-success">({{ t('Admin users list.confiremd') }})</span>
                @endif
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.phone') }}:</span>
                {{ $item->phone }}
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.address') }}:</span>
                {{ $item->address }}
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.register date') }}:</span>
                {{ $item->created_at->format('d/m/Y') }}
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.last sign') }}:</span>
                {{ ($item->last_sign) ? $item->last_sign : t('Admin users list.not signed') }}
            </div>
            <div class="view-line">
                <span class="view-label">{{ t('Admin users list.status') }}:</span>
                @if($item->active)
                    <span class="text-success">{{ t('Admin pages list.active') }}</span>
                @else
                    <span class="text-danger">{{ t('Admin pages list.inactive') }}</span>
                @endif
            </div>
            <div class="m-t-10">
                <button type="button" data-toggle="modal" data-target="#blockUserModal" class="btn btn-{{ $item->active ? 'danger' : 'success' }}">
                    {{ $item->active ? t('Admin pages list.lock') : t('Admin pages list.unlock') }}
                </button>
            </div>
        </div>
    </div>

    @if(auth()->user()->role == 1)
        @if(!$item->admin)
            @bannerBlock(['title'=>'Заказы'])
            @if(count($orders))
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-striped m-b-0 columns-middle">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Дата</th>
                                <th>Сумма</th>
                                <th>С доставкой</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($all_total_sum = 0)
                            @foreach($orders as $order)
                                @php($all_total_sum += $order->total)

                                <tr class="item-row" data-id="{!! $order->id !!}">
                                    <td class="item-id">{{ $order->id }}</td>
                                    <td class="item-title">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="item-title">{{ $order->total }}</td>
                                    <td class="item-title">
                                        {!! $order->delivery === null ? '<span class="text-danger">нет</span>' : '<span class="text-success">да</span>' !!}
                                    </td>
                                    <td>
                                        {!! $order->status_html !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.view', ['id'=>$order->id]) }}" {!! tooltip('Посмотреть') !!} class="icon-btn view"></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="item-row">
                                <td class="item-id"></td>
                                <td class="item-id"></td>
                                <td class="item-id">Итого: <strong>{{$all_total_sum }}</strong></td>
                                <td class="item-id"></td>
                                <td class="item-id"></td>
                                <td class="item-id"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
            @endif
            @endbannerBlock
        @endif
    @endif

    @modal(['id'=>'blockUserModal', 'centered'=>true,
        'saveBtn' => $item->active ? t('Admin pages list.lock') : t('Admin pages list.unlock'),
        'saveBtnClass' => 'btn-'.($item->active ? 'danger' : 'success'),
        'closeBtn' => t('Admin action buttons.cancel'),
        'form' => ['id'=>'', 'method'=>'post', 'action'=>route('admin.users.toggleActive')]
    ])
    @slot('title'){{ t('Admin action buttons.block user') }} @endslot
    <input type="hidden" name="active" value="{{ $item->active ? 0 : 1 }}">
    <input type="hidden" name="id" value="{{ $item->id }}">
    @csrf
    @method('patch')
    <p class="font-14">
        {{ t('Admin users list.delete confirm title') }} {{ $item->active ? t('Admin pages list.lock') : t('Admin pages list.unlock') }} {{ t('Admin users list.this user') }}{{ t('Admin action buttons.delete confirm question mark') }}
    </p>
    @endmodal
@endsection
@push('js')
    <script>
        $(function() {
            var Accordion = function(el, multiple) {
                this.el = el || {};
                this.multiple = multiple || false;

                // Variables privadas
                var links = this.el.find('.link');
                // Evento
                links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
            }

            Accordion.prototype.dropdown = function(e) {
                var $el = e.data.el;
                $this = $(this);
                $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                    $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
                }
            }

            var accordion = new Accordion($('#accordion'), false);
        });
    </script>
@endpush
@push('css')
    <style>
        ul li{
            text-decoration: none;
            list-style: none;
        }
        #accordion{
            padding: 0;

        }
        .accordion {
            width: 100%;
            margin: 30px auto 20px;
            background: #FFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        .accordion .link {
            cursor: pointer;
            display: block;
            padding: 15px 15px 15px 42px;
            color: #4D4D4D;
            font-size: 14px;
            font-weight: 700;
            border-bottom: 1px solid #CCC;
            position: relative;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }
        .accordion li:last-child .link {
            border-bottom: 0;
        }
        .accordion li i {
            position: absolute;
            top: 16px;
            left: 12px;
            font-size: 18px;
            color: #595959;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }
        .accordion li i.fa-chevron-down {
            right: 12px;
            left: auto;
            font-size: 16px;
        }
        .accordion li.open .link {
            color: white;
        }
        .accordion li.open {
            background: red;
        }
        .accordion li.open i {
            color: white;
        }
        .accordion li.open i.fa-chevron-down {
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        /**
         * Submenu
         -----------------------------*/
        .submenu {
            display: none;
            font-size: 14px;
        }
        .submenu li {
            border-bottom: 1px solid #4b4a5e;
        }
        .submenu a {
            display: block;
            text-decoration: none;
            color: #d9d9d9;
            padding: 5px 10px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }
        .submenu a:hover {
            background: #b63b4d;
            color: #FFF;
        }
    </style>
@endpush
