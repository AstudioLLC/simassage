@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit ? route('admin.file.edit', ['file' => $file, 'key' => $key, 'id' => $item->id]) : route('admin.file.add', ['file' => $file, 'key' => $key]) !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'patch' : 'put')
    @if($file)
    <input type="hidden" name="fileModel" value="{{ $file }}">
    @endif
    @if($key)
        <input type="hidden" name="key" value="{{ $key }}">
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
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
            <div class="card">
                <div class="c-title">{{ t('Admin pages form.file') }}</div>
                @if (!empty($item->name))
                    <div class="p-2 text-center">
                        <a href="{{ asset('u/file/' . $item->name) }}" download>
                            {{ t('Admin file.download') }}
                        </a>
                    </div>
                @endif
                <div class="c-body">
                    @file(['name' => 'file', 'title' => t('Admin pages form.file')])@endfile
                </div>
            </div>
        </div>
        @if($file == 'catalog')
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (480 x 416)</div>
                    @if (!empty($item->imageSmall))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name' => 'imageSmall'])@endfile
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (829 x 622)</div>
                    @if (!empty($item->imageBig))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name' => 'imageBig'])@endfile
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="col-12 save-btn-fixed">
        <button type="submit">{{ t('Admin action buttons.save') }}</button>
    </div>
</form>
@endsection
