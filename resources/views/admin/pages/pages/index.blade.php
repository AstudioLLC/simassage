@extends('admin.layouts.app')

{{--@push('css')
    @css(aAdmin('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'))
    @css(aAdmin('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css'))
@endpush

@push('js')
    <script src="{{ asset('cms') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('cms') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <script>
        //$('#datatable-basic').dataTable();
    </script>
@endpush--}}

@section('content')
    <div class="header bg-primary py-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    {{--<div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Tables</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tables
                                </li>
                            </ol>
                        </nav>
                    </div>--}}
                    <div class="col-lg-12 col-12 text-right">
                        <a href="{{ route('admin.pages.onlyTrashed') }}" class="btn btn-sm btn-neutral">
                            {{ __('app.Trash') }}
                        </a>
                        <a href="{{ route('admin.pages.create', ['parentId' => $parentId]) }}" class="btn btn-sm btn-neutral">
                            {{ __('app.Create') }}
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
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ __('app.Pages') }}</h3>
                    </div>
                    <div class="table-responsive p-4">
                        @include('admin.pages.pages._table', ['items' => $items ?? null])
                    </div>
                </div>
                @include('admin.components._modal', [
                    'id' => 'itemDeleteModal',
                    'centered' => true,
                    'loader' => true,
                    'saveBtn' => __('app.Delete'),
                    'saveBtnClass' => 'btn-danger',
                    'closeBtn' => __('app.Close'),
                    'slot' => [
                        'title' => __('app.Destroy'),
                        'input' => '<input type="hidden" id="pdf-item-id">',
                        'question' => '<p class="mb-0">' . __('app.Are you sure? The page will be deleted permanently!') . '</p>'],
                    'form' => [
                        'id'=>'itemDeleteForm',
                        'action'=>'javascript:void(0)']
                ])
                {{--@slot('title'){{ 'asdasdasda' }}
                <input type="hidden" id="pdf-page-id">
                <p class="font-14">Delete Question</p>
                @endslot--}}
            </div>
        </div>
    </div>
    @include('admin.layouts.footers.auth')
    @include('admin.pages.pages._script')
@endsection
