@extends('site.layouts.app')

@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection

@section('content')
{{--<section class="department-section">--}}
{{--    <div class="container">--}}
{{--        @include('site.includes.breadcrumbs', ['page' => $page ?? null])--}}
{{--        <div class="title-block">--}}
{{--            <h1 class="title-block__title">{{$page->title}} </h1>--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                    <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                    <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                    <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                </g>--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--        <div class="departments-row">--}}
{{--            @foreach($departments as $department)--}}
{{--                <div class="departments-row__item">--}}
{{--                    <a href="{{route('subpage', ['url' => $department->url])}}" class="departments-block">--}}
{{--                        <img class="departments-block__img img" src="{{ $department->getImageUrl('thumbnail', $department->icon) }}" alt="">--}}
{{--                        <p class="departments-block__title">{{$department->title}}</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="title-block">--}}
{{--            <h2 class="title-block__title">{{$page->title_content}}</h2>--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                    <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                    <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                    <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                </g>--}}
{{--            </svg>--}}
{{--        </div>--}}
{{--        <div class="departments-info editor">{!! $page->content !!}</div>--}}
{{--    </div>--}}
{{--</section>--}}
<section class="services-section-page">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="service-page">
            <div class="services-block">
                <div class="swiper product-card-slider">
                    <div class="product-card">
                        @foreach($departments as $department)
                        <div class="product-card-item">
                            <a href="{{route('subpage', ['url' => $department->url])}}">
                                <img src="{{ $department->getImageUrl('thumbnail', $department->icon) }}" alt="" class="img">
                                <div class="service-card-info">
                                    <h3 class="service-item-title">{{$department->title}}</h3>
                                    <p class="service-card-text">{!! $department->title_content_second !!}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
