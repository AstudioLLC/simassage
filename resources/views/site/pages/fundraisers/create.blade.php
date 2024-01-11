@extends('site.layouts.app')

@push('js')
    <script src="{{ asset('js/frontend/auth.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/auth.css') }}">
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])

    <div class="page-wrap">
        <div class="container-small auth-content">
            <div class="row w-100">
                @include('site.components.guest_block', ['url' => $createUrl ?? null])
                @include('site.components.login')
            </div>
        </div>
    </div>
@endsection
