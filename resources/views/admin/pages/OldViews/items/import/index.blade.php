@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="card p-2">
        <form id="form" action="{!! url()->current() !!}" method="post" enctype="multipart/form-data">@csrf
            <div>{{ t('Admin excel import.required columns') }}
                @foreach($columns as $row => $column)
                    '<b>{{ t('Admin excel import.' . $row) }}</b>',
                @endforeach
            </div>
            <div class="w-100 mt-2">
                <a href="{{ route('admin.items.import.downloadExample') }}" class="btn btn-sm btn-default">
                    {{ t('Admin excel import.download example') }}
                </a>
            </div>
            @if ($response)
                @if($response=='unvalidated')
                    <div class="alert alert-danger text-red text-2xl" role="alert">
                        {{ t('Admin excel import.choose excel file') }}
                    </div>
                @elseif($response=='failed')
                    <div class="alert alert-danger" role="alert">
                        {{ t('Admin excel import.incorrect format') }}
                    </div>
                @else
                    @php $multiple_sheets = count($response) > 1 @endphp
                    @foreach($response as $sheet)
                        @if($sheet['status'])
                            <div class="alert alert-info  my-2" role="alert">
                                {{ $multiple_sheets ? t('Admin excel import.list') . $loop->iteration . ': ' : null }}
                                <span class="text-greens">{{ t('Admin excel import.success elements') }} - </span>
                                {{ $sheet['imported'] }},
                                <span class="text-red ">{{ t('Admin excel import.failed elements') }} - </span>
                                {{ $sheet['failed'] }}.
                            </div>
                            @if($sheet['failed']>0)
                                <div class="alert alert-danger text-red text-2xl" role="alert">
                                    <p>{{ t('Admin excel import.errors') }}</p>
                                    @foreach($sheet['errors'] as $error)
                                        <p class="text-red text-2xl">
                                            {{ t('Admin excel import.line') }} {{ $error['row'] }} . {{ $error['reason'] }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="alert alert-danger" role="alert">
                                {{ t('Admin excel import.incorrect format') }}
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif
            <div class="mt-4">
                @file(['name'=>'file', 'title'=>t('Admin excel import.choose excel file')])@endfile

            </div>
            <div class="mt-2">
                <button type="submit">{{ t('Admin excel import.import') }}</button>
            </div>
        </form>

    </div>

    @if(count($categories))
        <h2 class="text-center">{{ t('Admin excel import.categories and filters') }}</h2>
        <ul id="accordion" class="flex flex-col items-center container mx-auto w-full accordion">
            @foreach($categories as $category)
                <li class="w-100 border border-cardBorder mt-3">
                    <div class="link" style="display: flex;align-items: center; justify-content: space-around;">
                        @if(!count($category->children) && $category->deep)
                            (id:{{ $category->id }})
                        @endif
                        {{ $category->name }}
                        @if(!empty($category->filters) && count($category->filters))
                            <a target="_blank" href="{{ route('admin.items.filterAndCategory.view', ['id' => $category->id]) }}" class="text-headerBg first_a">
                                {{ t('Admin excel import.see category filters') }}
                            </a>
                        @endif
                        <i class="fa fa-chevron-down" style="{{ (count($category->filters) ? 'top:23px' : null) }}"></i>
                    </div>
                    <div class="submenu bg-white " style="padding: 15px ; ">
                        <ul id="accordion1" class="flex flex-col items-center container mx-auto w-full accordion1">
                            @foreach($category->children as $child)
                                <li class="w-100 border border-cardBorder mt-3">
                                    <div class="link1" style="display: flex;align-items: center; justify-content: space-around;">
                                        @if(!count($child->children))
                                            (id:{{$child->id}})
                                        @endif
                                        {{$child->name}}
                                        @if(count($child->filters))
                                            <a target="_blank" href="{{ route('admin.items.filterAndCategory.view', ['id'=>$child->id]) }}" class="text-headerBg">
                                                {{ t('Admin excel import.see category filters') }}
                                            </a>
                                        @endif
                                        <i class="fa fa-chevron-down" style="{{ (count($child->filters) ? 'top:23px' : null) }}"></i>
                                    </div>
                                    <ul class="submenu1 bg-white" style="padding: 15px;">
                                        <div class="my-2">
                                            <div class="my-2 flex flex-col">
                                                @foreach($child->children as $child)
                                                    <div class="border border-cardBorder mt-3" style="display: flex;align-items: center; justify-content: space-around;padding: 15px 15px 15px 42px;">
                                                        (id:{{$child->id}})
                                                        {{$child->name}}
                                                        @if(count($child->filters))
                                                            <a target="_blank" href="{{ route('admin.items.filterAndCategory.view', ['id' => $child->id]) }}" class="text-headerBg">
                                                                {{ t('Admin excel import.see category filters') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
    @endif


@endsection
@push('js')
    <script>
        $('#form').on('submit', function (e) {
            $('#show-on-submit').show();
            $('#form-submit').attr('disabled', 'disabled');
            var stopwatch = $('#stopwatch'),
                seconds = 0,
                minutes = 0;
            setInterval(function () {
                if (seconds >= 59) {
                    seconds = 0;
                    ++minutes;
                } else ++seconds;
                var thisSeconds = seconds > 9 ? seconds : '0' + seconds.toString(),
                    thisMinutes = minutes > 9 ? minutes : '0' + minutes.toString();
                stopwatch.html(thisMinutes + ':' + thisSeconds);
            }, 1000);
        });
        $(function () {
            var Accordion = function (el, multiple) {
                this.el = el || {};
                this.multiple = multiple || false;

                // Variables privadas
                var links = this.el.find('.link');
                // Evento
                links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
            }

            Accordion.prototype.dropdown = function (e) {
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
        $(function () {
            var Accordion1 = function (el, multiple) {
                this.el = el || {};
                this.multiple = multiple || false;

                // Variables privadas
                var links = this.el.find('.link1');
                // Evento
                links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
            }

            Accordion1.prototype.dropdown = function (e) {

                var $el = e.data.el;
                $this = $(this);
                $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                    $el.find('.submenu1').not($next).slideUp().parent().removeClass('open');
                }
            }

            var Accordion1 = new Accordion1($('.accordion1'), false);
        });
    </script>
@endpush
@push('css')
    <style>
        #accordion {
            padding: 0;
        }

        ul li {
            list-style: none !important;
        }

        .first_a {
            display: block;
            text-decoration: none;
            color: #d9d9d9;
            padding: 5px 10px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .first_a:hover {
            background: #b63b4d;
            color: #FFF;
        }

        .accordion1 {
            width: 100%;
            margin: 30px auto 20px;
            background: #FFF;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        .link1 {
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

        .accordion1 li:last-child .link1 {
            border-bottom: 0;
        }

        .accordion1 li i {
            transform: rotate(0deg) !important;
            position: absolute;
            top: 16px;
            left: 12px;
            font-size: 18px;
            color: #595959 !important;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .accordion1 li i.fa-chevron-down {
            right: 12px;
            left: auto;
            font-size: 16px;
        }

        .accordion1 li.open .link1 {
            color: white;
        }

        .accordion1 li.open {
            background: red;
        }

        .accordion1 li.open i {
            color: white !important;
        }

        .accordion1 li.open i.fa-chevron-down {
            -webkit-transform: rotate(180deg) !important;
            -ms-transform: rotate(180deg) !important;
            -o-transform: rotate(180deg) !important;
            transform: rotate(180deg) !important;
        }

        /**
         * submenu1
         -----------------------------*/


        .submenu1 {
            display: none;
            font-size: 14px;
        }

        .submenu1 li {
            border-bottom: 1px solid #4b4a5e;
        }

        .submenu1 a {
            display: block;
            text-decoration: none;
            color: #d9d9d9;
            padding: 12px;
            padding-left: 42px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .submenu1 a:hover {
            background: #b63b4d;
            color: #FFF;
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
            background: #141619;
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
            background: #141619;
            color: #FFF;
        }
    </style>
@endpush

