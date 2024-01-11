@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.departments.edit', ['id' => $item->id]) : route('admin.departments.store') !!}" method="post" enctype="multipart/form-data">
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
{{--                @formTitle(['title' => 'Members'])@endformTitle--}}
{{--                <div class="card-body">--}}
{{--                    <select name="member" id="member" class="form-control form-control-sm form-control-alternative">--}}
{{--                        <option value="">-- {{ __('app.Members category') }} --</option>--}}
{{--                        <option {{ isset($item) && $item->member == 'presidency' ? 'selected' : '' }} value="presidency">-- {{ __('app.Presidency') }} --</option>--}}
{{--                        <option {{ isset($item) && $item->member == 'clinic' ? 'selected' : '' }} value="clinic">-- {{ __('app.Clinics') }} --</option>--}}
{{--                        <option {{ isset($item) && $item->member == 'member' ? 'selected' : '' }} value="member">-- {{ __('app.Member') }} --</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                @if ($errors->has('member'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('member') }}</strong>--}}
{{--                        </span>--}}
{{--                @endif--}}
{{--            </div>--}}
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageBigSize])@endformTitle
                <div class="card-body">
                    @file(['name'=>'imageBig'])@endfile

                    @if (!empty($item->imageBig))
                        <div class="border">

                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}" class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_imageBig" value="{{ $item->imageBig }}">
{{--                        @imageDestroy([--}}
{{--                        'id' => $item->id,--}}
{{--                        'title' => __('app.Delete image'),--}}
{{--                        'action' => route('admin.members.deleteImage')--}}
{{--                        ])@endimageDestroy--}}
                    @endif
                </div>
            </div>
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
            <div class="card">
                @bylang([
                'id' => 'form_short_content',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Short description')])
                <textarea name="short[{!! $iso !!}]"
                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('short') ? ' is-invalid' : '' }}"
                          rows="5"
                          placeholder="{{ __('app.Form.Content short text') }}">{{ old('short.'.$iso, tr($item, 'short', $iso)) }}</textarea>
                @if ($errors->has('short'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('short') }}</strong>
                    </span>
                @endif
                @endbylang

                @bylang([
                'id' => 'form_content',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Content text')])
                <textarea name="content[{!! $iso !!}]"
                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                          rows="5"
                          placeholder="{{ __('app.Form.Content text') }}">{{ old('content.'.$iso, tr($item, 'content', $iso)) }}</textarea>
                @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
                @endbylang
                <input type="hidden" name="parentId" value="{{$parentId}}">
            </div>
        </div>
    </div>

    @submit(['title' => null])@endsubmit
</form>
