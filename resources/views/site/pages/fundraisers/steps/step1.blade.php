@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <style>
        input[name=radio_amount] {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script>
        $('input[name=radio_amount]').click(function () {
            let val = $(this).val();
            if (val === 'other') {
                $('.other-amount-input').removeClass('d-none');
                $('input[name=other_amount]').attr('required', true).focus();
            } else {
                $('.other-amount-input').addClass('d-none');
                $('input[name=other_amount]').removeAttr('required');
            }
        })
    </script>
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small">
            <div class="step-pages-construction d-flex flex-column">
                <span class="title-usual">{{ $item->title ?? null }}</span>
                <div class="steps-breadcrumb-wrap d-flex justify-content-center align-items-center">
                    <div class="steps-breadcrumb d-flex align-items-center">
                        <div class="circle-wrap active-step d-flex flex-column align-items-center">
                            <div class="circle">
                                <span class="circle-number">1</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">
                                {{ __('frontend.Steps.General info') }}
                            </span>
                        </div>
                        <div class="steps-band"></div>
                        <div class="circle-wrap d-flex flex-column align-items-center">
                            <div class="circle circle-two">
                                <span class="circle-number">2</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">{{ __('frontend.Steps.Terms & Co') }}</span>
                            <span class="circle-bottom-text active-step-name d-sm-none">{{ __('frontend.Steps.General info') }}</span>
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
                    <div class="step-white-block step-white-block-donate">
                        <form class="row w-100"
                              id="sponsored-child-general-info-form" action="{{ route('fundraisers.create.step1', ['url' => $item->url ?? null]) }}"
                              method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="col-12 col-left">
                                <div class="white-group-main w-100 d-flex flex-column">
                                    <span class="step-group-names">{{ __('frontend.Steps.Donation Amount') }}</span>
                                    <div class="mt-1 donate-step-buttons row">
                                        <div class="p-2 col-6 col-md-4">
                                            <div class="step-button">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="radio_amount"
                                                           required
                                                           value="3000">
                                                    3000 <span>&nbsp;{{ __('frontend.Gifts.AMD') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="p-2 col-6 col-md-4">
                                            <div class="step-button">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="radio_amount"
                                                           required
                                                           checked
                                                           value="5000">
                                                    5000 <span>&nbsp;{{ __('frontend.Gifts.AMD') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="p-2 col-6 col-md-4">
                                            <div class="step-button">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="radio_amount"
                                                           required
                                                           value="10000">
                                                    10000 <span>&nbsp;{{ __('frontend.Gifts.AMD') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="p-2 col-6 col-md-4">
                                            <div class="step-button">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="radio_amount"
                                                           required
                                                           value="20000">
                                                    20000 <span>&nbsp;{{ __('frontend.Gifts.AMD') }}</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="p-2 col-6 col-md-4">
                                            <div class="step-button">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="radio_amount"
                                                           required
                                                           value="other">
                                                    {{ __('frontend.Steps.Other') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2 other-amount-input d-none">
                                        <input class="input-default"
                                               min="1"
                                               type="number"
                                               name="other_amount"
                                               value="{{ old('other_amount') }}">
                                    </div>
                                </div>


                                {{--<div class="white-group-main">
                                    <span class="step-group-names d-flex align-items-center">
                                            Frequency
                                        </span>

                                    <div class="step-group step-group-right">
                                        <label class="text-default custom-radio"><input name="do-you-want-to-donate-anonymously" type="radio" value="one-time"><span>One time</span></label>
                                        <label class="text-default custom-radio"><input name="do-you-want-to-donate-anonymously" type="radio" value="monthly"><span>Monthly</span></label>
                                    </div>
                                </div>--}}

                                <div class="white-group-main">
                                    <span class="step-group-names d-flex align-items-center">
                                        {{ __('frontend.Fundraisers.Do you want to donate anonymously?') }}
                                    </span>
                                    <div class="step-group step-group-right">
                                        <label class="text-default custom-radio">
                                            <input type="radio" name="anonymous" required value="1">
                                            <span>{{ __('frontend.Fundraisers.Yes') }}</span>
                                        </label>
                                        <label class="text-default custom-radio">
                                            <input type="radio" name="anonymous" required checked value="0">
                                            <span>{{ __('frontend.Fundraisers.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="white-group-main">
                                    <textarea class="input-default textarea-default"
                                              name="message"
                                              placeholder="{{ __('frontend.Fundraisers.Comment') }}">{{ old('message') ?? null }}</textarea>
                                </div>

                                {{--<div class="white-group-main donate-markup d-flex align-items-start">
                                    <img class="img-fluid" src="{{ asset('images/attention.png') }}" alt="" title="">
                                    <span class="markup-text ms-2">
                                        Նվիրաբերած գումարն օգտագործվելու է առաջին անհրաժեշտության կարիքների համար
                                    </span>
                                </div>--}}

                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                                <button type="submit" class="button-orange">
                                    {{ __('frontend.Steps.Next') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
