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
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_title',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.Title')])
                                <div class="card-body">{!! tr($item, 'title', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        @if($item->button_title)
                            <div class="form-group border-bottom">
                                @bylang([
                                'id' => 'form_button_title',
                                'tp_classes' => 'little-p',
                                'title' => __('app.Form.Button title')])
                                <div class="card-body">{!! tr($item, 'button_title', $iso) !!}</div>
                                @endbylang
                            </div>
                        @endif
                        @if($item->url)
                            <div class="form-group border-bottom">
                                @formTitle(['title' => __('app.Form.Url')])@endformTitle
                                <div class="card-body">
                                    <a href="{!! $item->url !!}" class="text-decoration-none text-muted" target="_blank">
                                        {!! $item->url !!}
                                    </a>
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
                        <div class="form-group border-bottom">
                            @formTitle(['title' => __('app.Active')])@endformTitle
                            <label class="custom-toggle active-changer">
                                <input type="checkbox" value="{{ $item->active }}" {{ $item->active ? ' checked' : '' }} disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                            </label>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footers.auth')
@endsection
