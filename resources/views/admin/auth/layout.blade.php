{{--
<!doctype html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="utf-8">
    <title>{{ t('Admin profile.Admin panel') }} - {!! env('CMS_AUTHOR') !!}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{ asset('cms/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('cms/css/auth.css') }}">
</head>
<body>
<div class="auth-form-section">
    <div class="auth-form-container">
        <div class="auth-form">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
--}}


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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('admin.layouts.navbars.sidebar')
@endauth

<div class="main-content">
    @include('admin.layouts.navbars.navbar')
    @yield('content')
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
