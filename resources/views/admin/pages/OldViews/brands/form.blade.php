@extends('admin.layouts.app')
@section('content')
    <form action="{!! $edit ? route('admin.brands.edit', ['id' => $item->id]) : route('admin.brands.add') !!}" method="post" enctype="multipart/form-data">
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
                        <div class="col-12 p-b-5">
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
                        </div>
                    </div>
                    @labelauty(['id'=>'active', 'class'=>'mt-3', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.icon') }} (252 x 112)</div>
                    @if (!empty($item->logo))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getLogoUrl('thumbnail') }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name' => 'logo'])@endfile
                    </div>
                </div>
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (1440 x 370)</div>
                    @if (!empty($item->image))
                        <div class="p-2 text-center">
                            <img src="{{ $item->getimageUrl('thumbnail') }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name' => 'image'])@endfile
                    </div>
                </div>
                @if(!empty($item->image))
                    @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.brands.deleteImage')])@endcomponent
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.content text')])
                    <textarea class="ckeditor" name="description[{!! $iso !!}]">
                        {!! old('description.'.$iso, tr($item, 'description', $iso)) !!}
                    </textarea>
                    @endbylang
                </div>
            </div>
        </div>
        @seo(['item'=>$item ?? null])@endseo
        <div class="col-12 save-btn-fixed">
            <button type="submit">{{ t('Admin action buttons.save') }}</button>
        </div>
    </form>
@endsection
@push('js')
    @ckeditor
@endpush
