@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/mydetails.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/profile.js') }}"></script>
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>

            <div class="profile-content-right fundraiser-page d-flex flex-column">
                <div class="mydetails-block d-flex flex-column">
                    <span class="title-usual text-start">
                        {{ __('frontend.cabinet.My details') }}
                    </span>
                    <form action="{{ route('cabinet.profile.updateUserInfo') }}" method="post" id="my-details-form" class="my-detail-form w-100">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-12 col-sm-6 p-2">
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
                            @if(count($countries))
                                <div class="col-12 col-sm-6 p-2">
                                    <div class="select-group mt-0">
                                        <select class="select" name="country_id">
                                            <option value="" selected disabled>
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
                                </div>
                            @endif

                            {{--<div class="col-12 col-sm-6 p-2">
                                <input type="text" class="input-default" name="Surname" placeholder="Surname">
                            </div>--}}

                            {{--<div class="col-12 col-sm-6 p-2">
                                <input type="text" class="input-default" name="City" placeholder="City">
                            </div>--}}

                            <div class="col-12 col-sm-6 p-2">
                                <input type="text"
                                       class="input-default"
                                       name="phone"
                                       placeholder="{{ __('frontend.login.Phone number') }}"
                                       value="{{ old('phone', $user->phone ?? null) }}">
                                @if($errors->has('phone'))
                                    <span class="input-alert">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            {{--<div class="col-12 col-sm-6 p-2">
                                <input type="text" class="input-default" name="Address" placeholder="Address">
                            </div>--}}

                            <div class="col-12 col-sm-6 p-2">
                                <input type="email"
                                       class="input-default"
                                       name="email"
                                       required
                                       placeholder="{{ __('frontend.login.Email') }}"
                                       value="{{ old('email', $user->email ?? null) }}">
                                @if($errors->has('email'))
                                    <span class="input-alert">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            {{--<div class="col-12 col-sm-6 p-2">
                                <input type="text" class="input-default" name="Address 2" placeholder="Address 2">
                            </div>--}}

                            <div class="col-12 p-2 d-flex justify-content-start mt-2">
                                <button class="button-orange">
                                    {{ __('frontend.login.Save changes') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('cabinet.profile.updateUserPassword') }}" method="post" class="password-form w-100">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-12 col-sm-6 p-2 d-flex justify-content-center align-items-center position-relative show-inp">
                                <input class="input-default input-password"
                                       type="password"
                                       name="current_password"
                                       required
                                       placeholder="{{ __('frontend.login.Current password') }}">
                                <img class="img-fluid show-eyes input-password-img" src="{{ asset('images/show.svg') }}" alt="{{ __('frontend.login.Current password') }}" title="{{ __('frontend.login.Current password') }}">
                                @if($errors->has('current_password'))
                                    <span class="input-alert">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6 p-2 d-flex flex-column justify-content-center align-items-center position-relative show-inp">
                                <input class="input-default input-password-2"
                                       type="password"
                                       name="password"
                                       required
                                       placeholder="{{ __('frontend.login.New password') }}">
                                <img class="img-fluid show-eyes input-password-img-2" src="{{ asset('images/show.svg') }}" alt="{{ __('frontend.login.New password') }}" title="{{ __('frontend.login.New password') }}">
                                <span class="character">{{ __('frontend.login.5 to 20 characters') }}</span>
                                @if($errors->has('password'))
                                    <span class="input-alert">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="col-12 col-sm-6 p-2 d-flex flex-column justify-content-center align-items-center position-relative show-inp">
                                <input class="input-default input-password-2"
                                       type="password"
                                       name="repeatPass"
                                       required
                                       placeholder="{{ __('frontend.login.Confirm Password') }}">
                                <img class="img-fluid show-eyes input-password-img-2" src="{{ asset('images/show.svg') }}" alt="{{ __('frontend.login.New password') }}" title="{{ __('frontend.login.Confirm Password') }}">
                                @if($errors->has('repeatPass'))
                                    <span class="input-alert">{{ $errors->first('repeatPass') }}</span>
                                @endif
                            </div>

                            <div class="col-12 p-2 d-flex justify-content-start mt-5 mt-sm-3">
                                <button class="button-orange">
                                    {{ __('frontend.login.Save password') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
