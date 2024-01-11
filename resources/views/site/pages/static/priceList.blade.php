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
    <section class="work-page-section">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h1 class="section-title-text">{{$page->title}}</h1>
            </div>
            <div class="price-page-block">
                <div class="editor">{!! $page->content !!}</div>
                <div class="massage-price-block">
                    @foreach($allDepartments as $department)
                        @if(in_array($department->id, $allDepartmentsPriceIds))
                            <div class="massage-div">
                                <p class="massage-name">{{$department->title}}</p>
                                @foreach($allDepartmentsPrice as $price)
                                    @if($department->id==$price->department_id)
                                    <div class="massage-price-item">
                                        <p class="massage-title">{{$price->title}}</p>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
