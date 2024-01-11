@extends('admin.layouts.app')

@push('css')
    @css(aAdmin('vendor/fancybox/fancybox.css'))
@endpush
@push('js')
    @js(aAdmin('vendor/fancybox/fancybox.js'))
@endpush

@section('content')
    <div class="header bg-primary py-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-12 col-12 text-right">
                        <a href="{!! $backUrl !!}" class="btn btn-sm btn-neutral">
                            {{ __('app.Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ __('app.Gallery') }}</h3>
                    </div>
                    <div class="table-responsive p-4">
                        @include('admin.pages.gallery._form', ['gallery' => $gallery, 'key' => $key])
                        @if(count($items))
                            @include('admin.pages.gallery._list', ['items' => $items ?? null])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footers.auth')
    @include('admin.pages.gallery._script')
@endsection
