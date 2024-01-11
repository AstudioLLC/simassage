<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Si-massage CMS</title>

    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('cms') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('cms') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('cms') }}/css/argon.min.css" rel="stylesheet">
    <link href="{{ asset('cms') }}/vendor/jquery-ui/jquery-ui.css" rel="stylesheet">

    <link type="text/css" href="{{ asset('cms') }}/css/theme-donate.css" rel="stylesheet">
    <style>
        .pointer {
            text-align: center;
            margin-left: 10px;
            display: block;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(218, 32, 32, 0.93);
            cursor: pointer;
            color: white;
            /*box-shadow: 0 0 0 rgb(140 34 191);*/
            animation: pulse 2s infinite;
        }
        @-webkit-keyframes pulse {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(72, 63, 63, 0.93);
            }
            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(72, 63, 63, 0.93);
            }
            100% {
                -webkit-box-shadow: 0 0 0 0 rgb(246, 4, 4);
            }
        }
        @keyframes pulse {
            0% {
                -moz-box-shadow: 0 0 0 0 rgba(72, 63, 63, 0.93);
                box-shadow: 0 0 0 0 rgba(72, 63, 63, 0.93);
            }
            70% {
                -moz-box-shadow: 0 0 0 10px rgba(244,157,22, 0);
                box-shadow: 0 0 0 10px rgba(244,157,22, 0);
            }
            100% {
                -moz-box-shadow: 0 0 0 0 rgba(244,157,22, 0);
                box-shadow: 0 0 0 0 rgba(244,157,22, 0);
            }
        }

    </style>
    @stack('css')
    {{--<link type="text/html" href="{{ asset('cms') }}/toastr/build/toastr.min.css" rel="stylesheet">--}}
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

<script>
    var dir = '{!! url(env('CMS_PREFIX', 'admin')) !!}',
        csrf = '{!! csrf_token() !!}';
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
<script src="{{ asset('cms') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('cms') }}/vendor/jquery-ui/jquery-ui.js"></script>
<script src="{{ asset('cms') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
{{--<script src="{{ asset('cms') }}/vendor/z-select/z-select.js"></script>--}}
{{--<script src="{{ asset('cms') }}/vendor/toastr/build/toastr.min.js"></script>
{!! App\Services\Notify\Facades\Notify::render() !!}--}}

@stack('js')

<!-- Argon JS -->
<script src="{{ asset('cms') }}/js/argon.js?v=1.0.0"></script>
<script src="{{ asset('cms') }}/js/app.js"></script>
</body>
</html>
