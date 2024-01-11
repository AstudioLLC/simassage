@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/fundraiser2.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/profile.js') }}"></script>
    <script>
        $('.open-createFundraiserPopup').click(function () {
            let itemId = $(this).data('id');
            let url = $(this).data('url');
            let title = $(this).find('.fundraiser-card-name').html();
            let content = $(this).find('.fundraiser-card-content').html();

            $('.donate-modal-white-fundraiser').find('.title-usual').html(title);
            $('.donate-modal-white-fundraiser').find('.description-usual').html(content);
            $('.create-fundraiser-url').attr('href', url);
            $('.modal-fundraiser-btn').click();
        })
    </script>
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>
            @if(count($fundraisers))
                @include('site.includes.popups.createFundraiserPopup')
                <div class="profile-content-right fundraiser-page d-flex flex-column">
                    <div class="fundraiser-block d-flex flex-column">
                    <span class="title-usual text-start">
                        {{ __('frontend.cabinet.Create fundraiser') }}
                    </span>
                        <span class="fundraiser-block-description">
                        {!! __('frontend.cabinet.Create fundraiser text') !!}
                    </span>
                        <div class="row mt-4">
                            @foreach($fundraisers as $item)
                                <div class="col-12 col-sm-6 p-3 open-createFundraiserPopup"
                                     data-id="{{ $item->id }}"
                                     data-url="{{ route('fundraisers.create.step1', ['url' => $item->url ?? null]) }}">
                                    <a href="javascript:void(0){{--{{ route('fundraisers.detail', ['url' => $item->url ?? null]) }}--}}" class="profile-fundraiser-card d-flex flex-column text-decoration-none">
                                        <span class="fundraiser-card-photo">
                                            @if($item->imageSmall)
                                                <img class="w-100 show-eyes input-password-img-2"
                                                     src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                                                     alt="{{ $item->title }}"
                                                     title="{{ $item->title }}">
                                            @endif
                                        </span>
                                        <div class="fundraiser-block-detail d-flex flex-column">
                                            <span class="fundraiser-card-name">
                                                {{ $item->title ?? null }}
                                            </span>
                                            <span class="fundraiser-card-description">
                                                {!! $item->short ?? null !!}
                                            </span>
                                            <span class="fundraiser-card-name d-none">
                                                {!! $item->content ?? null !!}
                                            </span>
                                            <span class="fundraiser-card-text-orange">
                                                {{ __('frontend.cabinet.Amount required') }} {{ $item->cost }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
