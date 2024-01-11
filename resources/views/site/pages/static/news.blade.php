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
<div class="blog-page-info">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="news-card-block">
            @foreach($news as $item)
            <div class="news-card-item">
                <a href="{{ route('news.detail', ['url' => $item->url ?? null]) }}">
                    <div class="news-foto">
                        <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}" alt="" class="img">
                    </div>
                    <div class="news-info">
                        <p class="news-title">{{ $item->title ?? null }}</p>
                        <p class="news-text">{!! $item->short !!}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
