@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection
@section('content')
{{--    <section class="doctor-section">--}}
{{--        <div class="container">--}}
{{--            @include('site.includes.breadcrumbs', ['page' => $page ?? null])--}}
{{--            <div class="price-list-top">--}}
{{--                <div>--}}
{{--                    <div class="title-block">--}}
{{--                        <h1 class="title-block__title">{{$page->title}} </h1>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                            <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                                <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                                <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                                <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                    <div class="price-type">--}}
{{--                        <label for="price-list">{{t('Page home.Select doctors by department')}}</label>--}}
{{--                        <select name="department" id="price-list">--}}
{{--                            <option value="0" class="department">{{t('Page home.All')}}</option>--}}
{{--                            @foreach($departments as $department)--}}
{{--                                <option value="{{$department->title}}" class="department">{{ \Illuminate\Support\Str::limit($department->title, 25) }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="doctors-row">--}}
{{--                @foreach($doctors as $doctor)--}}
{{--                <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}"--}}
{{--                   data-id="[@foreach($doctor->department as $value) {{$value->department_id}} @endforeach]" class="doctors-row__item">--}}
{{--                   @if(!$doctor->imageBig)--}}
{{--                        <img class="img" src="{{asset('image/doctor_not_found.png')}}" alt="">--}}
{{--                    @else--}}
{{--                    <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}" alt="">--}}
{{--                    @endif--}}
{{--                    <h3 class="doctors-block__title">{{$doctor->title}}--}}
{{--                    <span class="doctors-block__line"></span>--}}
{{--                    </h3>--}}
{{--                    <p class="doctors-block__position">{{$doctor->position}}</p>--}}
{{--                </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--    </section>--}}
<section class="staff-page-section">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="staff-block">
            <div class="swiper product-card-slider">
                <div class="product-card">
                    @foreach($doctors as $doctor)
                    <div class="product-card-item">
                        <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}">
                            @if(!$doctor->imageBig)
                                <img class="img" src="{{asset('image/doctor_not_found.png')}}" alt="">
                                    @else
                                <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}" alt="">
                                    @endif
                            <div class="service-card-info">
                                <h3 class="staff-item-title">{{$doctor->title}}</h3>
                                <p class="staff-item-title">{{$doctor->position}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
        $('#price-list').on('change', function () {
                let department_id = $(this).val();
                let allDoctors = document.querySelectorAll('.doctors-row__item');

                allDoctors.forEach((item)=>{
                    var arr = item.getAttribute('data-id')
                    if(!!~arr.indexOf(department_id)){
                        item.style.display = 'block'
                    }else if(department_id == 0){
                        item.style.display = 'block'
                    }else{
                        item.style.display = 'none'
                    }
                })
            })
    </script>
@endpush
