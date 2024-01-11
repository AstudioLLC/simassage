@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.messages.edit', ['id' => $item->id]) : route('admin.messages.store') !!}" method="post" enctype="multipart/form-data">
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
                @formTitle(['title' => __('app.List.Name')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="name"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           id="name"
                           disabled
                           placeholder="{{ __('app.List.Name') }}"
                           value="{{ old('name', $item->name ?? null) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Email')])@endformTitle
                <div class="card-body">
                    <input type="email"
                           name="email"
                           disabled
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           id="email"
                           placeholder="{{ __('app.Form.Email') }}"
                           value="{{ old('email', $item->email ?? null) }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                @formTitle(['title' => __('app.Form.Message')])@endformTitle
                <div class="card-body">
                    <textarea name="message"
                              class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('message') ? ' is-invalid' : '' }}"
                              rows="5"
                              disabled
                              placeholder="{{ __('app.Form.Message') }}">{{ old('message', $item->message ?? null) }}</textarea>
                    @if ($errors->has('message'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- @submit(['title' => null])@endsubmit --}}
</form>
