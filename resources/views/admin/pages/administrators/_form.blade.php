@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.administrators.edit', ['id' => $item->id]) : route('admin.administrators.store') !!}" method="post" enctype="multipart/form-data">
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
                @formTitle(['title' => __('app.Form.Role')])@endformTitle
                <div class="card-body">
                    <select name="role" id="role" class="form-control form-control-sm form-control-alternative">
                        @foreach($roles as $role)
                            <option value="{{ $loop->index }}" @if($loop->index == 1 || ($edit && $loop->index == $item->role)) selected @endif>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Username')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           placeholder="{{ __('app.Form.Username') }}"
                           value="{{ old('name', $item->name ?? null) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Email')])@endformTitle
                <div class="card-body">
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="{{ __('app.Form.Email') }}"
                           value="{{ old('email', $item->email ?? null) }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Phone')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="phone"
                           id="phone"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                           placeholder="{{ __('app.Form.Phone') }}"
                           value="{{ old('phone', $item->phone ?? null) }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @if(!$item)
                <div class="form-group border-bottom">
                    @formTitle(['title' => __('app.Form.Password')])@endformTitle
                    <div class="card-body">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control form-control-sm form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('app.Form.Password') }}"
                               value="{{ $item->password ?? null }}">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group border-bottom">
                    @formTitle(['title' => __('app.Form.Password repeat')])@endformTitle
                    <div class="card-body">
                        <input type="password"
                               name="password_repeat"
                               id="password_repeat"
                               class="form-control form-control-sm form-control-alternative{{ $errors->has('password_repeat') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('app.Form.Password repeat') }}"
                               value="{{ $item->password_repeat ?? null }}">
                        @if ($errors->has('password_repeat'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_repeat') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            @endif
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
