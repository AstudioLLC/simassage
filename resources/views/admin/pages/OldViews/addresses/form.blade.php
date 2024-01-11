@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit ? route('admin.addresses.edit', ['id' => $item->id]) : route('admin.addresses.add') !!}" method="post" enctype="multipart/form-data">
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
            <div class="card px-3 py-2">
                @labelauty(['id'=>'active', 'class'=>'mt-3', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">{{ t('Admin pages form.image') }} (178 x 135)</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ $item->getImageUrl('thumbnail') }}" alt="" class="img-responsive">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                </div>
            </div>
            @if(!empty($item->image))
                @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.addresses.deleteImage')])@endcomponent
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="c-title">{{ t('Admin pages form.phone') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="phone"
                           class="form-control"
                           placeholder=""
                           maxlength="255"
                           value="{{ old('phone', $item->phone ?? null) }}">
                </div>

                <div class="c-title">{{ t('Admin pages form.fax') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="fax"
                           class="form-control"
                           placeholder=""
                           maxlength="255"
                           value="{{ old('fax', $item->fax ?? null) }}">
                </div>

                <div class="c-title">{{ t('Admin pages form.email') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="email"
                           class="form-control"
                           placeholder=""
                           maxlength="255"
                           value="{{ old('email', $item->email ?? null) }}">
                </div>

                <div class="c-title">{{ t('Admin pages form.coords') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="coords"
                           class="form-control"
                           placeholder=""
                           maxlength="255"
                           value="{{ old('coords', $item->coords ?? null) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed">
        <button type="submit">{{ t('Admin action buttons.save') }}</button>
    </div>
</form>
@endsection
