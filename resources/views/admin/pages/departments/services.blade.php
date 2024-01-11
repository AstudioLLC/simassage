@extends('admin.layouts.app')
@push('js')
    @ckeditor
@endpush
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@section('content')
    <div class="header bg-primary py-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-12 col-12 text-left">
                        {{--                        <a href="{!! $backUrl !!}" class="btn btn-sm btn-neutral">--}}
                        {{--                            {{ __('app.Back') }}--}}
                        {{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">Department</h3>
            </div>
            <div class="card-body border-0">
                <form action="{!! route('admin.departments.service.add',['id'=>$parentId]) !!}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_title',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.Title')])
                                <input type="text"
                                       name="title[{!! $iso !!}]"
                                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('app.Form.Title') }}"
                                       value="{{ old('title.'.$iso, tr($departmentService, 'title', $iso)) }}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                                @endif
                                @endbylang
                            </div>
                            <div class="form-group border-bottom">
                                @formTitle(['title' => 'Services'])@endformTitle
                                <div class="card-body">
                                    <label for="filters_ids">Choose services</label>
                                    <select class="js-example-basic-multiple" style="width: 100%" name="service_ids[]"
                                            id="service_ids" multiple="multiple">
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}"
                                                  {{ (in_array($service->id,$departmentsCategory))?'selected':'null'}}
                                            > {{$service->title}} </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{$parentId}}" name="parentId">
                                    @if ($errors->has('parent_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @submit(['title' => null])@endsubmit
                </form>
            </div>
        </div>
    </div>
    @include('admin.layouts.footers.auth')
    @include('admin.pages.departments._script')
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endpush
