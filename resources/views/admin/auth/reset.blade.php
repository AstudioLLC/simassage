<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! env('APP_NAME') !!} - {!! env('CMS_AUTHOR') !!}</title>
    <!-- Favicon -->
    <link href="{{ asset('cms') }}/img/brand/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('cms') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('cms') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('cms') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <link type="text/css" href="{{ asset('cms') }}/css/theme-donate.css" rel="stylesheet">
</head>

<body class="{{ $class ?? '' }}">
    @auth()
        {{--    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
        {{--        @csrf --}}
        {{--    </form> --}}
        {{--    @include('admin.layouts.navbars.sidebar') --}}
    @endauth

    <div class="main-content">

        <div class="header bg-gradient-white pt-5">
            <div class="container">
                <div class="header-body text-center mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <img src="{{ asset('/image/adminlogo.svg') }}" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Update Login') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.login.reset_login') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $user->email ?? old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn ">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">{{ __('Reset Password') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.password.reset_password') }}">

                                @csrf

                                <div class="row mb-3">
                                    <label for="old_password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" required autocomplete="old_password">
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn ">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest()
        @include('admin.layouts.footers.guest')
    @endguest

    <script src="{{ asset('cms') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')

    <!-- Argon JS -->
    <script src="{{ asset('cms') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>
