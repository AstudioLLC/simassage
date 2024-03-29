@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit ? route('admin.discountForUser.edit', ['id'=>$item->id]) : route('admin.discountForUser.add') !!}" method="post" enctype="multipart/form-data">
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
            <div class="card p-2">
                <label for="discount">{{ t('Admin pages form.discount percent') }}</label>
                    <input id="discount"
                           type="text"
                           name="discount"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.discount percent') }}"
                           value="{{( !empty($item))?$item->discount:old('discount') }}">
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed">
        <button type="submit"></button>
    </div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
