@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.policy.edit', ['id' => $item->id]) : route('admin.policy.store') !!}"
      method="post" enctype="multipart/form-data">
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
            {{--                @formTitle(['title' => __('app.List.Creation date')])@endformTitle--}}
            {{--                <div class="card-body">--}}
            {{--                    <input type="datetime-local"--}}
            {{--                           name="created_at"--}}
            {{--                           class="form-control"--}}
            {{--                           id="created_at"--}}
            {{--                           placeholder="{{ __('app.List.Creation date') }}"--}}
            {{--                           value="{{ (isset($item) && $item->created_at) ? $item->created_at->format('Y-m-d') .'T'. $item->created_at->format('H:i:s') : date('Y-m-d') .'T'.date('H:i:s') }}">--}}
            {{--                    @if ($errors->has('created_at'))--}}
            {{--                        <span class="invalid-feedback" role="alert">--}}
            {{--                            <strong>{{ $errors->first('created_at') }}</strong>--}}
            {{--                        </span>--}}
            {{--                    @endif--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="form-group border-bottom">--}}
            {{--                @formTitle(['title' => __('app.Form.Image') . $imageBigSize])@endformTitle--}}
            {{--                <div class="card-body">--}}
            {{--                    @file(['name'=>'imageBig'])@endfile--}}

            {{--                    @if (!empty($item->imageBig))--}}
            {{--                        <div class="border">--}}

            {{--                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}" class="img-fluid img-center p-2">--}}
            {{--                        </div>--}}
            {{--                        <input type="hidden" name="old_imageBig" value="{{ $item->imageBig }}">--}}
            {{--                        @imageDestroy([--}}
            {{--                        'id' => $item->id,--}}
            {{--                        'title' => __('app.Delete image'),--}}
            {{--                        'action' => route('admin.policy.deleteImage')--}}
            {{--                        ])@endimageDestroy--}}
            {{--                    @endif--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Icon') . $imageSmallSize])@endformTitle
                <div class="card-body">
                    @file(['name'=>'imageSmall'])@endfile
                    @if (!empty($item->imageSmall))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                                 class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_imageSmall" value="{{ $item->imageSmall }}">
                        @imageDestroy([
                        'id' => $item->id,
                        'title' => __('app.Delete image'),
                        'action' => route('admin.activity.deleteImage')
                        ])@endimageDestroy
                    @endif
                </div>
            </div>
            <div class="p-2 has-title">
                File
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="file">File</label>
            </div>
            @if(!empty($item->file))
                <a class="text-center" href="{{ route('admin.policy.download',[$item->id])}}"><img alt="file"
                                                                               src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                                                                               class="img-fluid p-2"><span>{{$item->file}}</span></a>
            @endif
        </div>
        <div class="col-12 col-lg-6">

            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
        <div class="col-12">
            {{--            <div class="card">--}}
            {{--                @bylang([--}}
            {{--                'id' => 'form_short_content',--}}
            {{--                'tp_classes' => 'little-p',--}}
            {{--                'title' => __('app.Form.Short description')])--}}
            {{--                <textarea name="short[{!! $iso !!}]"--}}
            {{--                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('short') ? ' is-invalid' : '' }}"--}}
            {{--                          rows="5"--}}
            {{--                          placeholder="{{ __('app.Form.Content short text') }}">{{ old('short.'.$iso, tr($item, 'short', $iso)) }}</textarea>--}}
            {{--                @if ($errors->has('short'))--}}
            {{--                    <span class="invalid-feedback" role="alert">--}}
            {{--                        <strong>{{ $errors->first('short') }}</strong>--}}
            {{--                    </span>--}}
            {{--                @endif--}}
            {{--                @endbylang--}}

            {{--                @bylang([--}}
            {{--                'id' => 'form_content',--}}
            {{--                'tp_classes' => 'little-p',--}}
            {{--                'title' => __('app.Form.Content text')])--}}
            {{--                <textarea name="content[{!! $iso !!}]"--}}
            {{--                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"--}}
            {{--                          rows="5"--}}
            {{--                          placeholder="{{ __('app.Form.Content text') }}">{{ old('content.'.$iso, tr($item, 'content', $iso)) }}</textarea>--}}
            {{--                @if ($errors->has('content'))--}}
            {{--                    <span class="invalid-feedback" role="alert">--}}
            {{--                        <strong>{{ $errors->first('content') }}</strong>--}}
            {{--                    </span>--}}
            {{--                @endif--}}
            {{--                @endbylang--}}
            {{--            </div>--}}
        </div>
    </div>
    {{--    @seo(['item' => $item ?? null])@endseo--}}

    @submit(['title' => null])@endsubmit
</form>
