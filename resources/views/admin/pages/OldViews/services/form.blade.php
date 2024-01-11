@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit ? route('admin.services.edit', ['id'=>$item->id]) : route('admin.services.add') !!}" method="post" enctype="multipart/form-data">
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
                <div class="row cstm-input">
                    {{--<div class="col-12 p-b-5">
                        <input class="labelauty-reverse toggle-bottom-input on-unchecked"
                               type="checkbox"
                               name="generate_url"
                               value="1"
                               data-labelauty="{{ t('Admin pages form.generate url') }}" {!! oldCheck('generate_url', $edit ? false : true) !!}>
                        <div class="bottom-input">
                            <input type="text"
                                   maxlength="255"
                                   style="margin-top:3px;"
                                   name="url"
                                   class="form-control"
                                   id="form_url"
                                   placeholder="{{ t('Admin pages form.url') }}"
                                   value="{{ old('url', $item->url ?? null) }}">
                        </div>
                    </div>--}}
                    <div class="col-12 p-b-5">
                        <p>{{ t('Admin pages form.url') }}</p>
                        <input type="text"
                               name="url"
                               class="form-control"
                               placeholder="{{ t('Admin pages form.url') }}"
                               value="{{ (!empty($item->url) ? $item->url : old('url')) }}">
                    </div>
                </div>
                @labelauty(['id'=>'active', 'class'=>'mt-3', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=>oldCheck('active', ($edit && empty($item->active)) ? false : true)])@endlabelauty
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">{{ t('Admin pages form.icon') }} (22 x 25)</div>
                @if (!empty($item->icon))
                    <div class="p-2 text-center">
                        <img src="{{ $item->getIconUrl('thumbnail') }}" alt="" class="img-responsive">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'icon'])@endfile
                </div>
            </div>
            @if(!empty($item->icon))
                @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.services.deleteImage')])@endcomponent
            @endif
            {{--<div class="card">
                <div class="c-title">{{ t('Admin pages form.image alt') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="icon_alt"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.image alt') }}"
                           maxlength="255"
                           value="{{ old('icon_alt', $item->icon_alt ?? null) }}">
                </div>
            </div>--}}
            {{--<div class="card">
                <div class="c-title">{{ t('Admin pages form.image title') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="icon_title"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.image title') }}"
                           maxlength="255"
                           value="{{ old('icon_title', $item->icon_title ?? null) }}">
                </div>
            </div>--}}
            {{--<div class="card">
                <div class="c-title">{{ t('Admin pages form.image') }} (1440 x 727)</div>
                @if (!empty($item->image))
                    <div class="p-2 text-center">
                        <img src="{{ $item->getImageUrl('thumbnail') }}" alt="" class="img-responsive">
                    </div>
                @endif
                <div class="c-body">
                    @file(['name'=>'image'])@endfile
                </div>
            </div>--}}
            {{--<div class="card">
                <div class="c-title">{{ t('Admin pages form.image alt') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="image_alt"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.image alt') }}"
                           maxlength="255"
                           value="{{ old('image_alt', $item->image_alt ?? null) }}">
                </div>
            </div>--}}
            {{--<div class="card">
                <div class="c-title">{{ t('Admin pages form.image title') }}</div>
                <div class="little-p">
                    <input type="text"
                           name="image_title"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.image title') }}"
                           maxlength="255"
                           value="{{ old('image_title', $item->image_title ?? null) }}">
                </div>
            </div>--}}
        </div>
        {{--<div class="col-12">
            <div class="card">
                @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.content text')])
                    <textarea class="ckeditor" name="description[{!! $iso !!}]">
                        {!! old('description.'.$iso, tr($item, 'description', $iso)) !!}
                    </textarea>
                @endbylang
            </div>
        </div>--}}
    </div>
    {{--@seo(['item'=>$item ?? null])@endseo--}}
    <div class="col-12 save-btn-fixed">
        <button type="submit">{{ t('Admin action buttons.save') }}</button>
    </div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
