@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.languages.edit', ['id' => $item->id]) : route('admin.languages.store') !!}" method="post" enctype="multipart/form-data">
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
                @formTitle(['title' => __('app.Language form.Short name')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="iso"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('iso') ? ' is-invalid' : '' }}"
                           id="iso"
                           required
                           placeholder="{{ __('app.Language form.Short name') }}"
                           value="{{ old('iso', $item->iso ?? null) }}">
                    @if ($errors->has('iso'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('iso') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Language form.Name')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="title"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           id="title"
                           required
                           placeholder="{{ __('app.Language form.Name') }}"
                           value="{{ old('title', $item->title ?? null) }}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            {{--<div class="form-group border-bottom">
                @checkbox([
                'id' => 'default',
                'label' => __('app.Language form.Page language'),
                'checked' => oldCheck('default', ($edit && !empty($item->default)) ? true : false)
                ])@endcheckbox
            </div>
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'admin',
                'label' => __('app.Language form.Admin language'),
                'checked' => oldCheck('admin', ($edit && !empty($item->admin)) ? true : false)
                ])@endcheckbox
            </div>
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'url',
                'label' => __('app.Language form.Url language'),
                'checked' => oldCheck('url', ($edit && !empty($item->url)) ? true : false)
                ])@endcheckbox
            </div>--}}
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
    </div>

    @submit(['title' => null])@endsubmit
</form>
