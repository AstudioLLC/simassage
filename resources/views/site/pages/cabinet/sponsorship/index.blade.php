@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/children-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/my_sponsorship.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/sliders-individual.js') }}"></script>
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
                    <span class="title-usual profile-title">{{ __('frontend.cabinet.My Sponsorship') }}</span>
                    <a href="{{ route('cabinet.sponsorship.create.step1') }}" class="button-orange text-decoration-none">
                        <img class="img-fluid"
                             src="{{ asset('images/add-size.svg') }}"
                             alt="{{ __('frontend.cabinet.New Sponsorship') }}"
                             title="{{ __('frontend.cabinet.New Sponsorship') }}">
                        <span>{{ __('frontend.cabinet.New Sponsorship') }}</span>
                    </a>
                </div>
                @if(count($childrens))
                    <div class="your-sponsor profile-right-block d-flex flex-column">
                        @foreach($childrens as $item)
                            @include('site.pages.cabinet.components.sponsor_card', ['item' => $item])
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
