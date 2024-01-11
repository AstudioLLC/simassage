@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.collections.edit', ['id'=>$item->id]):route('admin.collections.add') !!}" method="post" enctype="multipart/form-data">
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
            <div class="card">
                @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                <input type="text"
                       name="title[{!! $iso !!}]"
                       class="form-control"
                       placeholder="{{ t('Admin pages form.title') }}"
                       value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                @endbylang
            </div>
            <div class="card p-2">
                <label for="code">{{ t('Admin collections.code') }}</label>
                <input type="text"
                       id="code"
                       name="code"
                       class="form-control"
                       value="{{ !empty($item->code) ? $item->code : old('code') }}"
                       placeholder="{{ t('Admin collections.code') }}">
            </div>
            <div class="card px-3 py-2">
                {{--<div class="row cstm-input">
                    <div class="col-12 p-b-5">
                        <input class="labelauty-reverse toggle-bottom-input on-unchecked" type="checkbox" name="generate_url" value="1" data-labelauty="Вставить ссылку вручную" {!! oldCheck('generate_url', $edit?false:true) !!}>
                        <div class="bottom-input">
                            <input type="text" maxlength="255" style="margin-top:3px;" name="url" class="form-control" id="form_url" placeholder="Ссылка" value="{{ old('url', $item->url??null) }}">
                        </div>
                    </div>
                </div>--}}
                @labelauty(['id'=>'active', 'class'=>'mt-3', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">{{ t('Admin pages form.image') }} (800 x 800)</div>
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
                @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.collections.deleteImage')])@endcomponent
            @endif
            {{--<div class="card">
                <div class="c-title">Alt</div>
                <div class="little-p">
                    <input type="text" name="image_alt" class="form-control" placeholder="Alt" maxlength="255" value="{{ old('image_alt', $item->image_alt??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Title</div>
                <div class="little-p">
                    <input type="text" name="image_title" class="form-control" placeholder="Title" maxlength="255" value="{{ old('image_title', $item->image_title??null) }}">
                </div>
            </div>--}}
        </div>
        {{--<div class="col-12">
            <div class="card">
                @bylang(['id'=>'form_short', 'tp_classes'=>'little-p', 'title'=>'Короткое описание'])
                    <textarea class="form-control form-textarea" name="short[{!! $iso !!}]">{!! old('short.'.$iso, tr($item, 'short', $iso)) !!}</textarea>
                @endbylang
            </div>
            <div class="card">
                @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>'Контент'])
                    <textarea class="ckeditor" name="content[{!! $iso !!}]">{!! old('content.'.$iso, tr($item, 'content', $iso)) !!}</textarea>
                @endbylang
            </div>
        </div>--}}
    </div>
    {{--@seo(['item'=>$item??null])@endseo--}}
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection

{{--@push('js')
    @ckeditor
@endpush--}}
