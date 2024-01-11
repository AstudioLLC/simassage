@push('js')
    @ckeditor
@endpush
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<form action="{!! $edit ? route('admin.directorate.edit', ['id' => $item->id]) : route('admin.directorate.store') !!}" method="post" enctype="multipart/form-data">
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
                'title' => __('app.Form.Name')])
                <input type="text"
                       name="name[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Name') }}"
                       value="{{ old('name.'.$iso, tr($item, 'name', $iso)) }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
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

            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageBigSize])@endformTitle
                <div class="card-body">
                    @file(['name'=>'image'])@endfile
                    @if (!empty($item->image))
                        <div class="border">

                            <img src="{{ $item->getImageUrl('thumbnail', $item->image) }}" class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_image" value="{{ $item->image }}">
                        @imageDestroy([
                            'id' => $item->id,
                            'title' => __('app.Delete image'),
                            'action' => route('admin.directorate.deleteImage')
                            ])@endimageDestroy
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
            <div class="card">
                @bylang([
                'id' => 'form_content',
                'tp_classes' => 'little-p',
                'name' => __('app.Form.Content text')])
                <textarea name="description[{!! $iso !!}]"
                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                          rows="5"
                          placeholder="{{ __('app.Form.Content text') }}">{{ old('description.'.$iso, tr($item, 'description', $iso)) }}</textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
        </div>
    </div>

    @submit(['name' => null])@endsubmit
</form>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endpush
