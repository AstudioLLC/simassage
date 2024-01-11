<div class="banner-block">
    <div class="row">
        <div class="col-12 col-dxl-6">
            <div class="card">
                @bylang(['id'=>'seo_component', 'title'=>'SEO'])
                <div class="form-group">
                    <div class="bylang-header">
                        <div class="bylang-title has-title">{{ t('Admin seo.title') }}</div>
                    </div>
                    <div class="little-p">
                        <input type="text"
                               name="seo_title[{!! $iso !!}]"
                               class="form-control"
                               placeholder="{{ t('Admin seo.title') }}"
                               value="{{ old('seo_title.'.$iso, tr($item, 'seo_title', $iso)) }}">
                    </div>
                </div>
{{--                <div class="form-group">--}}
{{--                    <div class="bylang-header">--}}
{{--                        <div class="bylang-title has-title">{{ t('Admin seo.keywords') }}</div>--}}
{{--                    </div>--}}
{{--                    <div class="little-p">--}}
{{--                        <input type="text" name="seo_keywords[{!! $iso !!}]" class="form-control" placeholder="{{ t('Admin seo.keywords') }}" value="{{ old('seo_keywords.'.$iso, tr($item, 'seo_keywords', $iso)) }}">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group">
                    <div class="bylang-header">
                        <div class="bylang-title has-title">{{ t('Admin seo.description') }}</div>
                    </div>
                    <div class="little-p">
                        <textarea name="seo_description[{!! $iso !!}]"
                                  class="form-control form-textarea"
                                  placeholder="{{ t('Admin seo.description') }}">{{ old('seo_description.'.$iso, tr($item, 'seo_description', $iso)) }}</textarea>
                    </div>
                </div>
                @endbylang
            </div>
        </div>
    </div>
</div>
