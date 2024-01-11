@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit ? route('admin.pages.edit', ['id'=>$page->id]) : route('admin.pages.add') !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'patch' : 'put')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if($edit)
        <div class="py-2 h5">{{ t('Admin pages form.url') }} - {{ $page->static==$homepage ? '/' : route('page', ['url'=>$page['url']], false) }}</div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                    <input type="text"
                           name="title[{!! $iso !!}]"
                           class="form-control"
                           placeholder="{{ t('Admin pages form.title') }}"
                           value="{{ old('title.'.$iso, tr($page, 'title', $iso)) }}">
                @endbylang
            </div>
            @if (!$edit || !$page->static)
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (1440 X 600)</div>
                    @if (!empty($page->image))
                        <div class="p-2 text-center">
                            <img src="{{ asset('u/pages/'.$page->image) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                        @labelauty(['id'=>'show_image', 'label'=>t('Admin pages form.image show'), 'class'=>'mt-2', 'checked'=>oldCheck('to_menu', ($edit && empty($page->show_image))?false:true)])@endlabelauty
                    </div>
                </div>
                @if(!empty($page->image))
                    @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.pages.deleteImage')])@endcomponent
                @endif
            @endif
        </div>
        <div class="col-12 col-lg-6">
            <div class="card px-3 p-t-5">
                <div class="form-group">
                    @if(!$edit || (!empty($page) && $page->static != $homepage))
                    <div class="row cstm-input">
                        <div class="col-12 p-b-5" >
                            <input class="labelauty-reverse toggle-bottom-input on-unchecked"
                                   type="checkbox"
                                   name="generate_url"
                                   value="1"
                                   data-labelauty="{{ t('Admin pages form.generate url') }}"
                                {!! oldCheck('generate_url', $edit ? false : true) !!}>
                            <div class="bottom-input">
                                <input type="text"
                                       style="margin-top:3px;"
                                       name="url"
                                       class="form-control"
                                       id="form_url"
                                       placeholder="{{ t('Admin pages form.url') }}"
                                       value="{{ old('url', $page->url ?? null) }}">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


                <div class="c-body">
                    @if(!$edit || ($page && $page->static != $homepage))
                        @labelauty(['id'=>'active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=>oldCheck('active', ($edit && empty($page->active))?false:true)])@endlabelauty
                    @endif
                    @labelauty(['id'=>'to_top', 'label'=>t('Admin pages form.to top'), 'class'=>'mt-2', 'checked'=>oldCheck('to_top', ($edit && empty($page->to_top)) ? false : true)])@endlabelauty
                    @labelauty(['id'=>'to_menu', 'label'=>t('Admin pages form.to menu'), 'checked'=>oldCheck('to_menu', ($edit && empty($page->to_menu)) ? false : true)])@endlabelauty
                    @labelauty(['id'=>'to_footer', 'label'=>t('Admin pages form.to footer'), 'checked'=>oldCheck('to_footer', ($edit && empty($page->to_footer)) ? false : true)])@endlabelauty
                </div>
            </div>
        </div>
        @if(!$edit || !$page->static)
        <div class="col-12">
            <div class="card">
                @bylang(['id'=>'form_content_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.content title')])
                <input class="form-control"
                       name="title_content[{!! $iso !!}]"
                       value="{!! old('title_content.'.$iso, tr($page, 'title_content', $iso)) !!}">
                @endbylang
                @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.content text')])
                    <textarea class="ckeditor" name="content[{!! $iso !!}]">
                        {!! old('content.'.$iso, tr($page, 'content', $iso)) !!}
                    </textarea>
                @endbylang
            </div>
        </div>
        @endif
    </div>
    @seo(['item'=>$page??null])@endseo
    <div class="col-12 save-btn-fixed">
        <button type="submit">{{ t('Admin action buttons.save') }}</button>
    </div>
</form>
@endsection
@push('js')
    @ckeditor
@endpush
