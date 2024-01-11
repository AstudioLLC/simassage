@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit?route('admin.home_banner.edit', ['id'=>$item->id]):route('admin.home_banner.add') !!}"
          method="post" enctype="multipart/form-data">
        @csrf @method($edit?'patch':'put')
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
                    <div class="c-title">{{ t('Admin pages form.image') }} (360 x 210)</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getImageUrl() }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                    <input type="text"
                           name="title[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.title') }}"
                           value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                    @endbylang
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card p-2 mb-2">
                    <p>{{ t('Admin pages form.url') }}</p>
                    <input
                        type="text"
                        name="url"
                        class="form-control"
                        placeholder="{{ t('Admin pages form.url') }}"
                        value="{{(!empty($item->url)?$item->url:old('url'))}}">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title2', 'tp_classes'=>'little-p', 'title'=>t('Admin main slider form.button text')])
                    <input
                        type="text"
                        name="button_title[{!! $iso !!}]"
                        class="form-control"
                        placeholder="{{ t('Admin main slider form.button text') }}"
                        value="{{ old('button_title.'.$iso, tr($item, 'button_title', $iso)) }}">
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
