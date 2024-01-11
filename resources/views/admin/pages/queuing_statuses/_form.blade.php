@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.queuing_statuses.edit', ['id' => $item->id]) : route('admin.queuing_statuses.store') !!}" method="post" enctype="multipart/form-data">
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
                        <div>
                            <input type="text" name="name"
                                class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                id="form_url" placeholder="{{ __('app.Appointment status') }}"
                                value="{{ old('name', $item->name ?? null) }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @submit(['name' => null])
    @endsubmit
</form>
