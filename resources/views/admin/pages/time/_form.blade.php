@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.time.edit', ['id' => $item->id]) : route('admin.time.store') !!}" method="post" enctype="multipart/form-data">
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
            <div class="card-body">
                <div class="form-row">
                <div style="width: 100px;">
                    <input type="text" name="hour" class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" id="form_url" placeholder="{{ __('app.Form.Hour') }}" value="{{ old('hour', $item->hour ?? null) }}">
                    @if ($errors->has('hour'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hour') }}</strong>
                    </span>
                    @endif
                </div>
                <div class='ml-2 mr-2'>:</div>
                <div style="width: 100px;">
                    <input type="text" name="minute" class="form-control form-control-sm form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}" id="form_url" placeholder="{{ __('app.Form.Minute') }}" value="{{ old('minute', $item->minute ?? null) }}">
                    @if ($errors->has('minute'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('minute') }}</strong>
                    </span>
                    @endif
                </div>
                </div>
            </div>
</div>
        </div>
    </div>

    

    @submit(['hour' => null])@endsubmit
</form>
