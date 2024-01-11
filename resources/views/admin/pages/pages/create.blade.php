@extends('admin.layouts.app')

@section('content')
    <div class="header bg-primary py-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-12 col-12 text-left">
                        <a href="{!! $backUrl !!}" class="btn btn-sm btn-neutral">
                            {{ __('app.Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">{{ __('app.Pages') }}</h3>
            </div>
            <div class="card-body border-0">
                @include('admin.pages.pages._form', ['item' => $item ?? null])
            </div>
        </div>
    </div>
    @include('admin.layouts.footers.auth')
    @include('admin.pages.pages._script')
@endsection
