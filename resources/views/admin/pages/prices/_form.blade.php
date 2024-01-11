@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.prices.edit', ['id' => $item->id]) : route('admin.prices.store') !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Title')])
                <input type="text"
                       name="title[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Title') }}"
                       value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
            <div class="form-group border-bottom">
                <select name="department_id" id="" class="form-control form-control-sm form-control-alternative">
                    <option value="">Choose department</option>
                    @foreach($allDepartment  as $department)
                        <option value="{{$department->id}}" @if($edit && $item->department_id == $department->id) selected @endif>{{$department->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Price'])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="price"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('price') ? ' is-invalid' : '' }}"
                           id="form_url"
                           placeholder="Price"
                           value="{{ old('price', $item->price ?? null) }}">
                    @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
        <div class="col-12 col-lg-6">
{{--        <input type="text" --}}
{{--            name="price_code"--}}
{{--            class="form-control form-control-sm form-control-alternative{{ $errors->has('price_code') ? ' is-invalid' : '' }}"--}}
{{--            placeholder="Price Code"--}}
{{--            value="{{ old('price_code', $item->price_code ?? null) }}">--}}
{{--        </div>--}}
    </div>

    @submit(['title' => null])@endsubmit
</form>
