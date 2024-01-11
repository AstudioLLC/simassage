@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small">
            <div class="step-pages-construction d-flex flex-column">
                <span class="title-usual">{{ $item->title ?? null }}</span>
                <div class="steps-breadcrumb-wrap d-flex justify-content-center align-items-center">
                    <div class="steps-breadcrumb d-flex align-items-center">
                        <div class="circle-wrap past-step d-flex flex-column align-items-center">
                            <div class="circle">
                                <span class="circle-number">1</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">
                                {{ __('frontend.Steps.General info') }}
                            </span>
                        </div>
                        <div class="steps-band past-step-band"></div>
                        <div class="circle-wrap active-step d-flex flex-column align-items-center">
                            <div class="circle circle-two">
                                <span class="circle-number">2</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">{{ __('frontend.Steps.Terms & Co') }}</span>
                            <span class="circle-bottom-text active-step-name d-sm-none">{{ __('frontend.Steps.Terms & Co') }}</span>
                        </div>
                        <div class="steps-band"></div>
                        <div class="circle-wrap d-flex flex-column align-items-center">
                            <div class="circle circle-two">
                                <span class="circle-number">3</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">{{ __('frontend.Steps.Billing Info') }}</span>
                        </div>
                    </div>
                </div>
                <div class="step-white-block-wrap w-100 d-flex justify-content-center align-items-center">
                    <form class="w-100 step-white-block d-flex flex-column justify-content-center align-items-center"
                          id="sponsored-child-terms-and-conditions-form"
                          action="{{ route('gifts.create.step2', ['url' => $item->url ?? null]) }}"
                          method="POST">
                        @csrf
                        <span class="step-group-names">{{ $terms->title ?? null }}</span>
                        <div class="step2-description text-default">
                            {!! $terms->content ?? null !!}
                        </div>
                        <div class="step-2-checkbox d-flex justify-content-center align-items-center">
                            <input type="checkbox" class="custom-checkbox" id="step-2-check" name="checkbox" required checked>
                            <label class="text-default" for="step-2-check">
                                {{ __('frontend.Steps.I agree to the Terms and Conditions') }}
                            </label>
                        </div>
                        <div class="w-100 d-flex justify-content-center align-items-center step-2-next-btn">
                            <button type="submit" class="button-orange">
                                {{ __('frontend.Steps.Next') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('site.components.donate_now')
@endsection
