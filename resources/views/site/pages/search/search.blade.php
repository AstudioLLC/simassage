@extends('site.layouts.app')
@section('title')
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:image" content="{{ asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection

@section('content')
    <main>
        <section class="information-section">
            <div class="container">
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item"><a class="bread-crumbs__link" href="/">Գլխավոր</a></li>
                    <li class="bread-crumbs__item"><a class="bread-crumbs__link bread-crumbs__link_active" href="">Որոնել</a>
                    </li>
                </ul>
                <div class="title-block">
                    <h1 class="title-block__title">{{t('Page home.Search results')}}</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2"
                                  transform="translate(925 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2"
                                  transform="translate(1001 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2"
                                  transform="translate(915 3479)" fill="#ef344e"></rect>
                        </g>
                    </svg>
                </div>
                <p class="search-result-count">{{t('Page home.Found')}} <span>{{$totalCount}}</span> {{t('Page home.result')}}</p>
                @if($totalCount)
                    <div class="search-result">
                        <div class="department-page-filter">
                            <button
                                class="department-page-filter__item department-page-filter__item_active department-filter" value="all" type="button">
                                {{t('Page home.All')}}
                            </button>
                            @if($allData['doctors']->count())
                            <button class="department-page-filter__item department-filter" value="doctors" type="button">
                                {{t('Page home.Doctors')}}
                            </button>
                            @endif
                            @if($allData['departments']->count())
                            <button class="department-page-filter__item department-filter" value="departments" type="button">
                                {{t('Page home.Departments')}}
                            </button>
                            @endif
                            @if($allData['prices']->count())
                            <button class="department-page-filter__item department-filter" value="prices" type="button">
                                {{t('Page home.Price list')}}
                            </button>
                            @endif
                            {{-- <button class="department-page-filter__item department-filter" value="questions" type="button"  data-target="questions">
                                {{t('Page home.FAQ')}}
                            </button> --}}
                        </div>
                    </div>
                @endif
                @if(isset($allData))
                <div class="doctors-row" style="margin: 0 0 25px 0">
                    @foreach($allData['doctors'] as $doctor)
                        <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}"
                            data-id="[@foreach($doctor->department as $value) {{$value->department_id}} @endforeach]" class="doctors-row__item doctors">
                            @if(!$doctor->imageBig)
                                <img class="img" src="{{asset('image/doctor_not_found.png')}}" alt="">
                            @else
                            <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}" alt="">
                            @endif
                            <h3 class="doctors-block__title">{{$doctor->title}}
                            <span class="doctors-block__line"></span>
                            </h3>
                            <p class="doctors-block__position">{{$doctor->position}}</p>
                        </a>
                    @endforeach
                </div>

                @foreach($allData['departments'] as $department)
                    <div class="search-result__info departments">
                        <h4 class="search-result__title">{{$department->title}}</h4>
                        <p class="search-result__text"></p>
                        <a href="{{route('subpage', ['url' => $department->url])}}" class="search-result__btn button" disabled="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                                <path id="Union_35" data-name="Union 35" d="M6.186,20V13.913h6.186V20Zm6.628-6.956V6.957H19v6.087ZM0,13.044V6.957H6.186v6.087ZM6.186,6.087V0h6.186V6.087Z" fill="#fff"></path>
                            </svg>
                            Տեսնել
                        </a>
                    </div>
                @endforeach

                @foreach($allData['prices'] as $price)
                    <div class="search-result__info prices">
                        <h4 class="search-result__title">{{$price->title}}</h4>
                        <p class="search-result__text">{{$price->price}}</p>
                        @if($price->price_code)
                        <p class="search-result__text">{{$price->price_code}}</p>
                        @endif
                    </div>
                @endforeach

                {{-- @foreach($allData['questions'] as $question)
                    <div class="search-result__info questions">
                        <h4 class="search-result__title">{{$question->title}}</h4>
                        <p class="search-result__text"></p>
                    </div>
                @endforeach --}}
                @endif
            </div>
        </section>
    </main>

@push('js')
    <script>
        window.onload = function(){
            document.querySelector('.department-filter').click();
        }
        $('.department-filter').on('click', function () {
            var name = $(this).val();
            if (name == 'doctors'){
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.doctors').show()
                $('.prices, .questions, .departments').hide()
            }else if (name == 'departments'){
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.departments').show()
                $('.prices, .questions, .doctors').hide()
            }else if (name == 'prices'){
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.prices').show()
                $('.questions, .doctors, .departments').hide()
            }else if (name == 'all'){
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.questions, .prices, .doctors, .departments' ).show()
            }
        })
    </script>
@endpush

@endsection
