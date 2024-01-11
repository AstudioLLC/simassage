@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit ? route('admin.videos.edit', ['id' => $item->id]) : route('admin.videos.add') !!}" method="post" enctype="multipart/form-data">
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
            {{--<div class="col-12 col-lg-6">
                <div class="card px-3 pt-3">
                    @labelauty(['id'=>'active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked' => oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>--}}
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.file') }}</div>
                    @if (!empty($item->name))
                        <div class="p-2 text-center">
                            <video width="500" controls autoplay muted>
                                <source src="{{ asset('u/video/' . $item->name) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            {{--<img src="{{ $item->getVideoUrl() }}" alt="" class="img-responsive">--}}
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'video', 'title'=>t('Admin pages form.file')])@endfile
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card p-2 mb-2">
                    <p>{{ t('Admin pages form.url') }}</p>
                    <input type="text"
                           name="link"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.url') }}"
                           value="{{ (!empty($item->link) ? $item->link : old('link')) }}">
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
