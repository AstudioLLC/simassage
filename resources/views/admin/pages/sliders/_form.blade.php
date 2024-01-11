@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.sliders.edit', ['id' => $item->id]) : route('admin.sliders.store') !!}" method="post" enctype="multipart/form-data">
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
{{--            <div class="form-group border-bottom">--}}
{{--                @bylang([--}}
{{--                'id' => 'form_description',--}}
{{--                'tp_classes' => 'little-p',--}}
{{--                'title' => __('app.Form.Short description')])--}}
{{--                <input type="text"--}}
{{--                       name="description[{!! $iso !!}]"--}}
{{--                       class="form-control form-control-sm form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"--}}
{{--                       placeholder="{{ __('app.Form.Short description') }}"--}}
{{--                       value="{{ old('description.'.$iso, tr($item, 'description', $iso)) }}">--}}
{{--                @if ($errors->has('description'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('description') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--                @endbylang--}}
{{--            </div>--}}
            <div class="form-group border-bottom">
                <div class="card-body">
                    <label for="">Url</label>
                    <input type="text"
                           name="url"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}"
                           id="form_url"
                           placeholder="{{ __('app.Form.Url') }}"
                           value="{{ old('url', $item->url ?? null) }}">
                    @if ($errors->has('url'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
{{--            <div class="form-group border-bottom">--}}
{{--                @bylang([--}}
{{--                'id' => 'form_button_title',--}}
{{--                'tp_classes' => 'little-p',--}}
{{--                'title' => __('app.Form.Button title')])--}}
{{--                <input type="text"--}}
{{--                       name="button_title[{!! $iso !!}]"--}}
{{--                       class="form-control form-control-sm form-control-alternative{{ $errors->has('button_title') ? ' is-invalid' : '' }}"--}}
{{--                       placeholder="{{ __('app.Form.Button title') }}"--}}
{{--                       value="{{ old('button_title.'.$iso, tr($item, 'button_title', $iso)) }}">--}}
{{--                @if ($errors->has('button_title'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('button_title') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--                @endbylang--}}
{{--            </div>--}}

            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
{{--        </div>--}}
        <div class="col-12">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageSize])@endformTitle
                <div class="card-body">
                    @file(['name'=>'image'])@endfile
                    @if (!empty($item->image))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail') }}" class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_image" value="{{ $item->image }}">
{{--                        @imageDestroy([--}}
{{--                        'id' => $item->id,--}}
{{--                        'title' => __('app.Delete image'),--}}
{{--                        'action' => route('admin.sliders.deleteImage')--}}
{{--                        ])@endimageDestroy--}}
                    @endif
                </div>
            </div>
        </div>
    </div>

    @submit(['title' => null])@endsubmit
</form>
