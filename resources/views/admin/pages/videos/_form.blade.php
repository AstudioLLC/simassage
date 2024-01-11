@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.videos.edit', ['video' => $video, 'key' => $key, 'id' => $item->id]) : route('admin.videos.store', ['video' => $video, 'key' => $key]) !!}"
      method="post"
      enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if($video)
        <input type="hidden" name="video" value="{{ $video }}">
    @endif
    @if($key)
        <input type="hidden" name="key" value="{{ $key }}">
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
{{--                @formTitle(['title' => __('app.Form.Type')])@endformTitle--}}
{{--                <div class="card-body">--}}
{{--                    <select name="type" id="type" class="form-control form-control-sm form-control-alternative">--}}
{{--                        <option selected value="">--}}
{{--                            -- {{ __('app.Form.Not selected') }} ----}}
{{--                        </option>--}}
{{--                        <option value="0" @if($item && $item->type == 0) selected @endif>--}}
{{--                            - {{ __('app.Type.0') }} ---}}
{{--                        </option>--}}
{{--                        <option value="1" @if($item && $item->type == 1) selected @endif>--}}
{{--                            - {{ __('app.Type.1') }} ---}}
{{--                        </option>--}}
{{--                    </select>--}}
{{--                    @if ($errors->has('type'))--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('type') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="col-12 col-lg-6">
{{--            <div class="form-group border-bottom">--}}
{{--                @formTitle(['title' => __('app.Form.Select File')])@endformTitle--}}
{{--                <div class="card-body">--}}
{{--                    @file(['name' => 'name'])@endfile--}}
{{--                    @if (!empty($item->name))--}}
{{--                        <div class="my-2">--}}
{{--                            <a href="{{ $item->getImageUrl('thumbnail', $item->name) }}" class="btn btn-sm btn-icon btn-info" download>--}}
{{--                                <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>--}}
{{--                                <span class="btn-inner--text">{{ __('app.Download') }}</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <input type="hidden" name="old_name" value="{{ $item->name }}">--}}
{{--                        @imageDestroy([--}}
{{--                        'id' => $item->id,--}}
{{--                        'title' => __('app.Delete image'),--}}
{{--                        'action' => route('admin.pages.deleteImage')--}}
{{--                        ])@endimageDestroy--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Link')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="link"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('link') ? ' is-invalid' : '' }}"
                           id="link"
                           placeholder="{{ __('app.Form.Link') }}"
                           value="{{ old('link', $item->link ?? null) }}">
                    @if ($errors->has('link'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @submit(['title' => null])@endsubmit
</form>
