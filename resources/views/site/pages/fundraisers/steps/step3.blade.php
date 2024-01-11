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
                        <div class="circle-wrap past-step d-flex flex-column align-items-center">
                            <div class="circle circle-two">
                                <span class="circle-number">2</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">{{ __('frontend.Steps.Terms & Co') }}</span>
                            <span class="circle-bottom-text active-step-name d-sm-none">{{ __('frontend.Steps.Billing Info') }}</span>
                        </div>
                        <div class="steps-band past-step-band"></div>
                        <div class="circle-wrap active-step d-flex flex-column align-items-center">
                            <div class="circle circle-two">
                                <span class="circle-number">3</span>
                            </div>
                            <span class="circle-bottom-text d-none d-sm-block">{{ __('frontend.Steps.Billing Info') }}</span>
                        </div>
                    </div>
                </div>
                <div class="step-white-block-wrap w-100 d-flex justify-content-center align-items-center">
                    <div class="step-white-block">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="step-group-names">{{ __('frontend.Steps.Billing Info') }}</span>
                        </div>
                        <form class="row w-100 mt-4"
                              id="billing-info-form-page-1"
                              action="{{ route('fundraisers.create.step3', ['url' => $item->url ?? null]) }}"
                              method="POST">
                            @csrf
                            <div class="col-12 col-md-6 col-left">
                                <div class="default-form-group">
                                    <input type="text"
                                           class="input-default"
                                           name="name"
                                           required
                                           placeholder="{{ __('frontend.login.Name') }}"
                                           value="{{ old('name', $user->name ?? null) }}">
                                    @if($errors->has('name'))
                                        <span class="input-alert">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                {{--<div class="default-form-group">
                                    <input name="surname" type="text" class="input-default" placeholder="Surname*">
                                </div>--}}
                                <div class="default-form-group">
                                    <input type="text"
                                           class="input-default"
                                           name="phone"
                                           required
                                           placeholder="{{ __('frontend.login.Phone number') }}"
                                           value="{{ old('phone', $user->phone ?? null) }}">
                                    @if($errors->has('phone'))
                                        <span class="input-alert">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="default-form-group">
                                    <input type="email"
                                           class="input-default"
                                           name="email"
                                           placeholder="{{ __('frontend.login.Email') }}"
                                           value="{{ old('email', $user->email ?? null) }}">
                                    @if($errors->has('email'))
                                        <span class="input-alert">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-right billing-info-col-right">
                                @if(count($countries))
                                    <div class="select-group mt-0 select-country">
                                        <select class="select" name="country_id">
                                            <option value="" selected>
                                                {{ __('frontend.cabinet.Choose country') }}
                                            </option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" @if(isset($user->options->country_id) && $user->options->country_id == $country->id) selected @endif>
                                                    {{ $country->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('country_id'))
                                            <span class="input-alert">{{ $errors->first('country_id') }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="default-form-group">
                                    <input type="text"
                                           class="input-default"
                                           name="city"
                                           placeholder="{{ __('frontend.login.City') }}"
                                           value="{{ old('city') }}">
                                    @if($errors->has('city'))
                                        <span class="input-alert">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                                <div class="default-form-group">
                                    <input type="text"
                                           class="input-default"
                                           name="address"
                                           placeholder="{{ __('frontend.login.Address') }}"
                                           value="{{ old('address') }}">
                                    @if($errors->has('address'))
                                        <span class="input-alert">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="step-3-checkbox d-flex justify-content-center align-items-center mt-3">
                                <input type="checkbox" class="custom-checkbox" id="step-3-check" name="subscriber_checkbox">
                                <label class="text-default" for="step-3-check">
                                    {{ __('frontend.Steps.Please send me the latest news from donate am') }}
                                </label>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                                <button type="submit" class="button-orange">
                                    {{ __('frontend.Steps.Pay') }}
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
