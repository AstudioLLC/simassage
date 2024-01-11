@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/care-center-individual.css') }}">
@endpush

{{--@push('js')
    <script src="{{ asset('js/frontend/care-center.js') }}"></script>
@endpush--}}

@section('content')
    @include('site.includes.popups.chooseWayToHelpPopup', ['becomeSponsor' => $becomeSponsor ?? null, 'donate' => $donate ?? null])
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <span class="title-usual text-start">{{ $item->title ?? null }}</span>
                    <div class="care-individual-description text-default">
                        {!! $item->short ?? null !!}
                    </div>
                    @include('site.components.share')
                </div>
                <div class="col-12 col-lg-4 offset-lg-2 individual-page-right">
                    @include('site.components.progressbar', ['item' => $item])
                    <button type="button" class="button-orange open-chooseWayToHelpPopup">
                        <a class="text-decoration-none text-white" href="javascript:void(0)">
                            {{ __('frontend.Donate') }}
                        </a>
                        {{--<button type="button" href="#" class="button-orange">Donate</button>--}}
                    </button>
                </div>
            </div>
            @if($item->imageBig)
                <div class="care-center-individual-picture slider">
                    <div class="swiper-container care-center-slider">
                        <div class="news-image-wrap">
                            <img class="img-fluid"
                                 src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}"
                                 alt="{{ $item->title }}"
                                 title="{{ $item->title }}">
                        </div>
                    </div>
                </div>
            @endif
            <div class="care-center-description editor text-default">
                {!! $item->content !!}
            </div>
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
