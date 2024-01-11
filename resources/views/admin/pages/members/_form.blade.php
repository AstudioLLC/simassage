@push('js')
    @ckeditor
@endpush
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<form action="{!! $edit ? route('admin.doctors.edit', ['id' => $item->id]) : route('admin.doctors.store') !!}" method="post" enctype="multipart/form-data">
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
                @bylang([
                'id' => 'form_position',
                'tp_classes' => 'little-p',
                'title' => 'Position'])
                <input type="text"
                       name="position[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('position') ? ' is-invalid' : '' }}"
                       placeholder="Position"
                       value="{{ old('position.'.$iso, tr($item, 'position', $iso)) }}">
                @if ($errors->has('position'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
{{--            <div class="form-group border-bottom">--}}
{{--                @bylang([--}}
{{--                'id' => 'form_title',--}}
{{--                'tp_classes' => 'little-p',--}}
{{--                'title' => 'Name of department'])--}}
{{--                <input type="text"--}}
{{--                       name="name_of_department[{!! $iso !!}]"--}}
{{--                       class="form-control form-control-sm form-control-alternative{{ $errors->has('name_of_department') ? ' is-invalid' : '' }}"--}}
{{--                       placeholder="Name of department"--}}
{{--                       value="{{ old('name_of_department.'.$iso, tr($item, 'name_of_department', $iso)) }}">--}}
{{--                @if ($errors->has('name_of_department'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('name_of_department') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--                @endbylang--}}
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
            {{-- <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Url')])@endformTitle
                <div class="card-body">
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
            </div> --}}
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
        <div class="col-12">
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Departments'])@endformTitle
                <div class="card-body">

                    <select class="js-example-basic-multiple" style="width: 100%" required name="department_ids[]"
                            id="department_ids" multiple="multiple">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}"
                                {{ (in_array($department->id,$MembersCategory))?'selected':'null'}}
                            > {{$department->title}} </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->has('member'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('member') }}</strong>
                        </span>
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="card">
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
            </div>
        </div>
    </div>

    @submit(['title' => null])@endsubmit
</form>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endpush
