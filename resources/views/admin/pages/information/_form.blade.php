@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.information.edit', ['id' => $item->id]) : route('admin.information.store') !!}" method="post" enctype="multipart/form-data">
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
                'title' => __('app.Form.Address')])
                <input type="text"
                       name="address[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Address') }}"
                       value="{{ old('address.'.$iso, tr($item, 'address', $iso)) }}">
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
                @endbylang
                {{--<div class="text-right card-body">
                    <i class="icon-btn add char-add-row fas fa-plus" onclick="addCriterionRow()"></i>
                </div>--}}
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Phone')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="phone"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                           id="phone"
                           placeholder="{{ __('app.Form.Phone') }}"
                           value="{{ old('phone', $item->phone ?? null) }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Phone')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="phone2"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                           id="phone"
                           placeholder="{{ __('app.Form.Phone') }}"
                           value="{{ old('phone2', $item->phone2 ?? null) }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Email')])@endformTitle
                <div class="card-body">
                    <input type="email"
                           name="email"
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
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Email')])@endformTitle
                <div class="card-body">
                    <input type="email"
                           name="email_2"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('email_2') ? ' is-invalid' : '' }}"
                           id="email"
                           placeholder="{{ __('app.Form.Email') }}"
                           value="{{ old('email_2', $item->email_2 ?? null) }}">
                    @if ($errors->has('email_2'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email_2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Map')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="map"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('map') ? ' is-invalid' : '' }}"
                           id="map"
                           placeholder="{{ __('app.Form.Map') }}"
                           value="{{ old('map', $item->map ?? null) }}">
                    @if ($errors->has('map'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('map') }}</strong>
                        </span>
                    @endif
                </div>

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
            </div>
        </div>
    </div>
    @submit(['title' => null])@endsubmit
</form>
