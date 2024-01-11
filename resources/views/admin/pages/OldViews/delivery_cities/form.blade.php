@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit ? route('admin.delivery_cities.edit', ['id' => $item->id]) : route('admin.delivery_cities.add', ['id' => $region->id]) !!}"
        method="post">
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
                    @bylang(['id' => 'form_title', 'tp_classes' => 'little-p', 'title' => t('Admin pages form.title')])
                    <input type="text"
                           name="title[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.title') }}"
                           value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                    @endbylang
                </div>
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.delivery price') }}</div>
                    <div class="little-p">
                        <input type="text"
                               name="price"
                               class="form-control"
                               placeholder="{{ t('Admin pages form.delivery price') }}"
                               value="{{ old('price', $item->price ?? null) }}">
                    </div>
                </div>
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.minimum amount for free shipping') }}</div>
                    <div class="little-p">
                        <input type="text"
                               name="min_price"
                               class="form-control"
                               placeholder="{{ t('Admin pages form.minimum amount for free shipping') }}"
                               value="{{ old('min_price', $item->min_price ?? null) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 save-btn-fixed">
            <button type="submit"></button>
        </div>
    </form>
@endsection
