@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/children-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/swiper.min.js') }}"></script>
    <script src="{{ asset('js/frontend/slider-profile.js') }}"></script>
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>

            <div class="profile-content-right">
                <div class="profile-content-right-top">
                    <span class="title-usual profile-title">
                        {{ __('frontend.cabinet.My Sponsorship') }}
                    </span>
                    <a href="{{ route('cabinet.sponsorship.create.step1') }}" type="button" class="button-orange text-decoration-none">
                        <img class="img-fluid"
                             src="{{ asset('images/add-size.svg') }}"
                             alt="{{ __('frontend.cabinet.New Sponsorship') }}"
                             title="{{ __('frontend.cabinet.New Sponsorship') }}">
                        <span>{{ __('frontend.cabinet.New Sponsorship') }}</span>
                    </a>
                </div>

                @if(count($childrens))
                    <div class="your-sponsor profile-right-block d-flex flex-column">
                        <div class="profile-swiper">
                            <div class="swiper-wrapper">
                                @foreach($childrens as $item)
                                    <div class="swiper-slide">
                                        @include('site.pages.cabinet.components.sponsor_card', ['item' => $item])
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endif
                <div class="create-fundraiser-block d-flex flex-column">
                    <span class="title-usual profile-title">Create fundraiser</span>

                    <div class="text-default text-left create-fundraiser-description">
                        You can start your own fundraising campaign by choosing the cause and setting the goal. Make sure to tell about it to the world.
                    </div>

                    <div class="create-fundraiser-buttons-group">

                        <a class="button-orange text-decoration-none">Create</a>

                        <a class="button-orange button-orange-white text-decoration-none">Details</a>
                    </div>
                </div>

                @include('site.components.home1')
            </div>
        </div>
    </div>

    @include('site.components.donate_now')
@endsection
