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
{{--    <section class="information-section">--}}
{{--        <div class="container">--}}
{{--            @include('site.includes.breadcrumbs', ['page' => $page ?? null])--}}
{{--            <div class="title-block">--}}
{{--                <h1 class="title-block__title">{{$page->title}} </h1>--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                    <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                        <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                        <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                        <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                    </g>--}}
{{--                </svg>--}}
{{--            </div>--}}

{{--            <div class="information-row">--}}
{{--                @if($page->imageBig)--}}
{{--                    <div class="queuing-page-img">--}}
{{--                        <img class="img" src="{{$page->getImageUrl('thumbnail', $page->imageBig)}}" alt="">--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <div class="information-text editor">--}}
{{--                    {!! $page->content ?? null !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clear-both"></div>--}}

{{--            <div class="report-row">--}}
{{--                @foreach($file as $value)--}}
{{--                    <a href="{{ $value->getImageUrl('thumbnail', $value->name) }}" class="report-row__item" download>--}}
{{--                        <img src="{{ $value->getImageUrl('thumbnail', $value->imageSmall) }}" alt="">--}}
{{--                        <p class="report-row__title">{{$value->title}}</p>--}}
{{--                    </a>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            @if(count($gallery) || count($videoGallery))--}}
{{--                <div class="title-block">--}}
{{--                    <h2 class="title-block__title">{{t('Page home.Media')}}</h2>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                        </g>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                @include('site.includes.media')--}}
{{--            @endif--}}
{{--            @if(isset($subPage) && count($subPage))--}}
{{--                <!-- <div class="title-block">--}}
{{--                    <h2 class="title-block__title">Ենթաբաժիններ</h2>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">--}}
{{--                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">--}}
{{--                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>--}}
{{--                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>--}}
{{--                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>--}}
{{--                        </g>--}}
{{--                    </svg>--}}
{{--                </div> -->--}}
{{--                <div class="department-services">--}}
{{--                    @foreach($subPage as $sub)--}}
{{--                        <div class="department-services__item">--}}
{{--                            <a href="{{$sub->url}}" class="department-services-block">--}}
{{--                                <img class="img" src="{{ $sub->getImageUrl('thumbnail', $sub->imageSmall) }}" alt="">--}}
{{--                                <div class="department-services-info">--}}
{{--                                    <h3 class="department-services-title">{{$sub->title}}</h3>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </section>--}}
    <div class="news-ditail-page-info info-page">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{$page->title}}</h2>
            </div>
            <div class="news-ditail-info">
                <div class="news-ditail-foto">
                    <img src="{{$page->getImageUrl('thumbnail', $page->imageBig)}}" alt="" class="img">
                </div>
                <p class="editor">{!! $page->content !!}</p>
            </div>
            @if(count($gallery) || count($videoGallery))
                @include('site.includes.media')
            @endif
            @foreach($file as $value)
                <div class="download-input">
                    <a href="{{ $value->getImageUrl('thumbnail', $value->name) }}" class="download-btn" download="">
                        <img src="{{asset('image/download.png')}}" alt="">
                        файлы для скачивания - {{$value->title}}
                    </a>
                </div>
            @endforeach
            @if(isset($subPage) && count($subPage))
            <div class="sub-cotegory-block">
                @foreach($subPage as $sub)
                <div class="sub-category-item">
                    <a href="{{$sub->url}}">
                        <img src="{{ $sub->getImageUrl('thumbnail', $sub->icon) }}" alt="" class="img">
                        <div class="sub-category-name">
                            {{$sub->title}}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
@endsection
