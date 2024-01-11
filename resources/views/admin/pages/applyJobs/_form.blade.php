@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.applyJobs.edit', ['id' => $item->id]) : route('admin.applyJobs.store') !!}"
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
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Working hours'])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="working_hours"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('working_hours') ? ' is-invalid' : '' }}"
                           id="form_working_hours"
                           placeholder="Working hours"
                           value="{{ old('working_hours', $item->working_hours ?? null) }}">
                    @if ($errors->has('working_hours'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('working_hours') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Installation date'])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="created_at"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('created_at') ? ' is-invalid' : '' }}"
                           id="form_created_at"
                           placeholder="Installation date"
                           value="{{ old('created_at', ($edit)? $item->created_at->format('d.m.Y') : null) }}">
                    @if ($errors->has('created_at'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('created_at') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group border-bottom">
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
