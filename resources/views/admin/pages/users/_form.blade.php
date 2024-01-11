@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.users.edit', ['id' => $item->id]) : route('admin.users.store') !!}" method="post" enctype="multipart/form-data">
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
            <div class="form-group">
                <div class="card-body">
                    <label for="form_name">Name</label>
                    <input type="text"
                      name="name"
                      class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                      id="form_name"
                      placeholder="{{ __('Name') }}"
                      value="{{ old('name', $item->name ?? null) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <label for="">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           id="form_email"
                           placeholder="{{ __('app.Form.Email') }}"
                           value="{{ old('email', $item->email ?? null) }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <label for="">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           id="form_password"
                           placeholder="{{ __('Password') }}"
                            >
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <label for="">Password Conformation</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           id="form_password_confirmation"
                           placeholder="{{ __('Password Conformation') }}"
                           value="{{ old('password_confirmation', $item->password_confirmation ?? null) }}">
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
    </div>
    @submit(['title' => null])@endsubmit
</form>
