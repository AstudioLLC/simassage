@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-my-fundraiser.css') }}">
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>
            @if(count($fundraisers))
                <div class="profile-content-right fundraiser-page d-flex flex-column">
                    <span class="title-usual text-start">My fundraisers</span>
                    @foreach($fundraisers as $item)
                        <div class="fundraiser-block d-flex flex-column">
                            <div class="fundraiser-top">
                                @if($item->imageSmall)
                                    <img class="img-fluid"
                                         src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                                         alt="{{ $item->title }}"
                                         title="{{ $item->title }}">
                                @endif
                                <div class="d-flex flex-column fundraiser-top-progressbar">
                                    <span class="title-usual text-start">
                                        {{ $item->title ?? null }}
                                    </span>
                                    <span class="title-bottom text-start">{{ $item->start_date ? $item->start_date->format('d.m.Y') : null }}</span>
                                    @include('site.components.progressbar', ['item' => $item])
                                </div>
                            </div>
                            <div class="description-usual">
                                {!! $item->short ?? null !!}
                            </div>
                            <button class="button-orange">{{ __('frontend.cabinet.Donate') }}</button>
                            @if($item->files)
                                <button class="button-orange button-orange-white">{{ __('frontend.cabinet.Reports') }}</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
