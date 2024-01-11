@extends('admin.layouts.app')

@section('content')
    <div class="header bg-primary py-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-12 col-12 text-right">
                        <a href="{!! $backUrl !!}" class="btn btn-sm btn-neutral">
                            {{ __('app.Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">{{ __('app.Sliders') }}</h3>
            </div>
            <div class="card-body border-0">
                <div class="row">
                    <div class="col">
                        @if($item->title)
                            @include('admin.components.show._title', ['id' => 'form_title', 'formTitle' => __('app.Form.Title'), 'title' => 'title'])
                        @endif
                        @if($item->url)
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Url')])@endformTitle
                                <div class="card-body">
                                    {!! $item->url !!}
                                </div>
                            </div>
                        @endif
                        @if(!empty($item->image))
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Image')])@endformTitle
                                <div class="card-body">
                                    <img src="{{ $item->getImageUrl('thumbnail') }}" class="img-fluid img-center p-2">
                                </div>
                            </div>
                        @endif
                        @if(!empty($item->icon))
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Icon')])@endformTitle
                                <div class="card-body">
                                    <img src="{{ $item->getImageUrl('thumbnail', $item->icon) }}" class="img-fluid img-center p-2">
                                </div>
                            </div>
                        @endif
                        @if($item->title_content)
                            @include('admin.components.show._title', ['id' => 'form_content_title', 'formTitle' => __('app.Form.Content title'), 'title' => 'title_content'])
                        @endif
                        @if($item->content)
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_content',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.Content text')])
                                <div class="card-body">{!! tr($item, 'content', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        <div class="form-group border-bottom">
                            @formTitle(['title' => __('app.Active')])@endformTitle
                            <label class="custom-toggle">
                                <input type="checkbox" value="{{ $item->active }}" {{ $item->active ? ' checked' : '' }} disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <div class="form-group border-bottom">
                            @formTitle(['title' => __('app.Form.To top')])@endformTitle
                            <label class="custom-toggle">
                                <input type="checkbox" value="{{ $item->to_top }}" {{ $item->to_top ? ' checked' : '' }} disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        <div class="form-group border-bottom">
                            @formTitle(['title' => __('app.Form.To footer')])@endformTitle
                            <label class="custom-toggle">
                                <input type="checkbox" value="{{ $item->to_footer }}" {{ $item->to_footer ? ' checked' : '' }} disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
                        @if($item->seo_title)
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_content',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.SEO title')])
                                <div class="card-body">{!! tr($item, 'seo_title', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        @if($item->seo_description)
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_content',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.SEO description')])
                                <div class="card-body">{!! tr($item, 'seo_description', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        @if($item->seo_keywords)
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_content',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.SEO keywords')])
                                <div class="card-body">{!! tr($item, 'seo_keywords', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        @if($item->created_at)
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Created at')])@endformTitle
                                <div class="card-body">
                                    {!! $item->created_at->format('d/m/Y') !!}
                                </div>
                            </div>
                        @endif
                        @if($item->updated_at)
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Updated at')])@endformTitle
                                <div class="card-body">
                                    {!! $item->updated_at->format('d/m/Y') !!}
                                </div>
                            </div>
                        @endif
                        @if($item->deleted_at)
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Deleted at')])@endformTitle
                                <div class="card-body">
                                    {!! $item->deleted_at->format('d/m/Y') !!}
                                </div>
                            </div>
                        @endif
                        @if(count($item->gallery))
                            @push('css')
                                @css(aAdmin('vendor/fancybox/fancybox.css'))
                            @endpush
                            @push('js')
                                @js(aAdmin('vendor/fancybox/fancybox.js'))
                            @endpush
                            @include('admin.pages.gallery._list', ['items' => $item->gallery ?? null])
                        @endif
                        @if(count($item->files))

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footers.auth')
@endsection
