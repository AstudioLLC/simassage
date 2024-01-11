@push('css')
    <style>
        textarea {
            resize: none;
        }
    </style>
@endpush

<div class="row">
    <div class="col-12 col-xl-6">
        <div class="form-group border-bottom">
            @bylang(['id' => 'seo_component', 'title' => __('app.SEO')])
            <div class="form-group">
                <div class="py-2">
                    <div class="">{{ __('app.Form.Title') }}</div>
                </div>
                <div>
                    <input type="text"
                           name="seo_title[{!! $iso !!}]"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('seo_title') ? ' is-invalid' : '' }}"
                           placeholder="{{ __('app.Form.Title') }}"
                           value="{{ old('seo_title.'.$iso, tr($item, 'seo_title', $iso)) }}">
                    @if ($errors->has('seo_title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('seo_title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="py-2">
                    <div class="">{{ __('app.Form.Description') }}</div>
                </div>
                <div>
                    <textarea name="seo_description[{!! $iso !!}]"
                              class="form-control form-control-sm form-control-alternative{{ $errors->has('seo_title') ? ' is-invalid' : '' }}"
                              rows="5"
                              placeholder="{{ __('app.Form.Description') }}">{{ old('seo_description.'.$iso, tr($item, 'seo_description', $iso)) }}</textarea>
                    @if ($errors->has('seo_description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('seo_description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

{{--            <div class="form-group">--}}
{{--                <div class="py-2">--}}
{{--                    <div class="">{{ __('app.Form.Keywords') }}</div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <textarea name="seo_keywords[{!! $iso !!}]"--}}
{{--                              class="form-control form-control-sm form-control-alternative{{ $errors->has('seo_title') ? ' is-invalid' : '' }}"--}}
{{--                              rows="5"--}}
{{--                              placeholder="{{ __('app.Form.Keywords') }}">{{ old('seo_keywords.'.$iso, tr($item, 'seo_keywords', $iso)) }}</textarea>--}}
{{--                    @if ($errors->has('seo_keywords'))--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('seo_keywords') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
            @endbylang
        </div>
    </div>
</div>
