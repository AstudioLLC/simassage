@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit?route('admin.main_slider.edit', ['id'=>$item->id]):route('admin.main_slider.add') !!}" method="post" enctype="multipart/form-data">
        @csrf
        @method($edit ? 'patch' : 'put')
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card px-3 pt-3">
                    @labelauty(['id'=>'active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked' => oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (1920 x 500)</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getImageUrl() }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                    </div>
                </div>
                @if(!empty($item->image))
                    @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.main_slider.deleteImage')])@endcomponent
                @endif
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin main slider form.top text')])
                    <input type="text"
                           name="top_text[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin main slider form.top text') }}"
                           value="{{ old('top_text.'.$iso, tr($item, 'top_text', $iso)) }}">
                    @endbylang
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title1', 'tp_classes'=>'little-p', 'title'=>t('Admin main slider form.bottom text')])
                    <input type="text"
                           name="bottom_text[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin main slider form.bottom text') }}"
                           value="{{ old('bottom_text.'.$iso, tr($item, 'bottom_text', $iso)) }}">
                    @endbylang
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card p-2 mb-2">
                    <p>{{ t('Admin pages form.url') }}</p>
                    <input type="text"
                           name="url"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.url') }}"
                           value="{{ (!empty($item->url) ? $item->url : old('url')) }}">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title2', 'tp_classes'=>'little-p', 'title'=>t('Admin main slider form.button text')])
                    <input type="text"
                           name="url_text[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin main slider form.button text') }}"
                           value="{{ old('url_text.'.$iso, tr($item, 'url_text', $iso)) }}">
                    @endbylang
                </div>
            </div>
            <input type="hidden" name="slider_type" value="1">
            <div class="col-12 save-btn-fixed">
                <button type="submit">{{ t('Admin action buttons.save') }}</button>
            </div>
        </div>
    </form>


@endsection
{{--@push('js')
    @include('ckfinder::setup')
@endpush--}}
