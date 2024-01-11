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
    <section class="gallery-page-section">
        <div class="container">
            @include('site.includes.breadcrumbs', ['page' => $page ?? null])
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h1 class="section-title-text">{{$page->title}}</h1>
            </div>
            @if(count($gallery) || count($videoGallery))
                @include('site.includes.media')
            @endif
        </div>
    </section>

@endsection
