@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/background-gray.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/faq.css') }}">
@endpush

@section('content')
    <div class="background-gray">
        <div class="container-small">
            @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
            <span class="title-usual">{{ $page->title ?? null }}</span>
            <span class="gray-description privacy-policy text-default">
                {!! $page->content ?? null !!}
            </span>
        </div>
    </div>

    @if(count($items))
        <div class="container-small faq-content">
            <div class="left-panel-wrap">
                @include('site.pages.faq.left', ['items' => $items ?? null, 'active' => $active ?? null])
            </div>
            <div class="d-flex flex-column question-block">
                @include('site.pages.faq.content', ['items' => $active ?? null])
            </div>
        </div>
    @endif
    @include('site.components.donate_now')
@endsection
