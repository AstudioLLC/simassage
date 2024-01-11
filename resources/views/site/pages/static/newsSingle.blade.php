@extends('site.layouts.app')

@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $item->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $item->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}">
@endsection
@section('content')
<div class="blog-ditail-page-info">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h2 class="section-title-text">{{$item->title}}</h2>
        </div>
        <div>
            <p class="blog-date">{{$item->created_at->format('d.m.Y')}}</p>
        </div>
        <div class="blog-ditail-info">
            <div class="blog-ditail-foto">
                <img src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}" alt="" class="img">
            </div>
            <p class="editor">
                {!! $item->content !!}
            </p>
        </div>
    </div>
</div>
@endsection


