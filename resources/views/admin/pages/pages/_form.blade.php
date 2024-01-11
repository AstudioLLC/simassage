@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.pages.edit', ['id' => $item->id]) : route('admin.pages.store') !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Title')])
                <input type="text"
                       name="title[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Title') }}"
                       value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
            @if(isset($item) && $item->parent_id == 1)
            <div class="form-group border-bottom">
                <label for="info_url">Enter Url for image and title</label>
                <input type="text"
                       id="info_url"
                       name="info_url"
                       class="form-control ml-3 mb-4 form-control-sm form-control-alternative{{ $errors->has('info_url') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Url') }}"
                       value="{{$item->info_url}}">
                @if ($errors->has('info_url'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('info_url') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Page depth')])@endformTitle
                <div class="card-body">
                    <select name="parent_id" id="parent_id" class="form-control form-control-sm form-control-alternative">
                        <option value="">-- {{ __('app.Form.Independent category') }} --</option>
                        @itemsAllList(['items' => $items, 'parentId' => $parentId, 'item' => $item, 'delimiter' => $delimiter])@enditemsAllList
                    </select>
                    @if ($errors->has('parent_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
{{--            @if(isset($item->static) == null || $item->static =='home' || $item->static =='partners' || $item->static =='about')--}}
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageSize])@endformTitle
                <div class="card-body">
                    @file(['name' => 'image'])@endfile
                    {{--@checkbox([
                        'id' => 'show_image',
                        'label' => __('app.Show image'),
                        'checked' => oldCheck('show_image', ($edit && empty($item->show_image)) ? false : true)
                    ])@endcheckbox--}}
                    @if (!empty($item->image))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail') }}" class="img-fluid img-center p-2" alt="">
                        </div>
                        <input type="hidden" name="old_image" value="{{ $item->image }}">
                        @imageDestroy([
                        'id' => $item->id,
                        'title' => __('app.Delete image'),
                        'action' => route('admin.pages.destroyImage')
                        ])@endimageDestroy
                    @endif
                </div>
            </div>
{{--            @endif--}}
        </div>
        <div class="col-12 col-lg-6">
            <!-- <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Url')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="url"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}"
                           id="form_url"
                           placeholder="{{ __('app.Form.Url') }}"
                           value="{{ old('url', $item->url ?? null) }}">
                    @if ($errors->has('url'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div> -->
            </div>
            @if( isset($item->static) == null || $item->static=='structure' || $item->static=='departments')
             <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Icon') . $iconSize])@endformTitle
                <div class="card-body">
                    @file(['name' => 'icon'])@endfile
                    @if (!empty($item->icon))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail', $item->icon) }}" class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_icon" value="{{ $item->icon }}">
                        @imageDestroy([
                        'id' => $item->id,
                        'title' => __('app.Delete image'),
                        'action' => route('admin.pages.deleteIcon')
                        ])@endimageDestroy
                    @endif
                </div>
            </div>
            @endif
            <div class="form-group border-bottom">
                @checkbox([
                    'id' => 'active',
                    'label' => __('app.Active'),
                    'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
            @if(isset($parentId) != 67)
            <div class="form-group border-bottom">
                @checkbox([
                    'id' => 'to_top',
                    'label' => __('app.Form.To top'),
                    'checked' => oldCheck('to_top', ($edit && empty($item->to_top)) ? false : true)
                ])@endcheckbox
            </div>
            @endif
            {{--<div class="form-group border-bottom">
                @checkbox([
                    'id' => 'to_menu',
                    'label' => __('app.Form.To menu'),
                    'checked' => oldCheck('to_menu', ($edit && empty($item->to_menu)) ? false : true)
                ])@endcheckbox
            </div>--}}
            @if(isset($item->static) == null || $item->static!='about')
            <div class="form-group border-bottom">
                @checkbox([
                    'id' => 'to_footer',
                    'label' => __('app.Form.To footer'),
                    'checked' => oldCheck('to_footer', ($edit && empty($item->to_footer)) ? false : true)
                ])@endcheckbox
            </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                {{-- @bylang([
                'id' => 'form_content_title',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Content title')])
                <input type="text"
                       name="title_content[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title_content') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Content title') }}"
                       value="{{ old('title_content.'.$iso, tr($item, 'title_content', $iso)) }}">
                @if ($errors->has('title_content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title_content') }}</strong>
                    </span>
                @endif
                @endbylang --}}
                @if(isset($parentId) != 67)
                    @bylang([
                    'id' => 'form_content',
                    'tp_classes' => 'little-p',
                    'title' => __('app.Form.Content text')])
                    <textarea name="content[{!! $iso !!}]"
                              class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                              rows="5"
                              placeholder="{{ __('app.Form.Content text') }}">{{ old('content.'.$iso, tr($item, 'content', $iso)) }}</textarea>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                    @endbylang
                @else
                    @bylang([
                    'id' => 'form_content',
                    'tp_classes' => 'little-p',
                    'title' => __('app.Form.Content text')])
                    <textarea name="content[{!! $iso !!}]"
                              class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                              rows="5"
                              placeholder="{{ __('app.Form.Content text') }}">{{ old('content.'.$iso, tr($item, 'content', $iso)) }}</textarea>
                    @if ($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                    @endbylang
                @endif
            </div>
        </div>

        @if($edit && $item->static == 'about')
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageSize])@endformTitle
                <div class="card-body">
                    @file(['name' => 'icon'])@endfile
                    {{--@checkbox([
                        'id' => 'show_image',
                        'label' => __('app.Show image'),
                        'checked' => oldCheck('show_image', ($edit && empty($item->show_image)) ? false : true)
                    ])@endcheckbox--}}
                    @if (!empty($item->icon))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail', $item->icon) }}" class="img-fluid img-center p-2" alt="">
                        </div>
                        <input type="hidden" name="old_icon" value="{{ $item->icon }}">
                        @imageDestroy([
                            'id' => $item->id,
                            'title' => __('app.Delete image'),
                            'action' => route('admin.pages.deleteIcon')
                            ])@endimageDestroy
                    @endif
                </div>
            </div>
        <div class="col-12">
            <div class="card">
                @bylang([
                'id' => 'form_content_title_second',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Content title') . ' second'])
                <input type="text"
                       name="title_content_second[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title_content_second') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Content title') }}"
                       value="{{ old('title_content_second.'.$iso, tr($item, 'title_content_second', $iso)) }}">
                @if ($errors->has('title_content_second'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title_content_second') }}</strong>
                    </span>
                @endif
                @endbylang

                @bylang([
                'id' => 'form_content_second',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Content text'). ' second'])
                <textarea name="content_second[{!! $iso !!}]"
                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content_second') ? ' is-invalid' : '' }}"
                          rows="5"
                          placeholder="{{ __('app.Form.Content text') }}">{{ old('content_second.'.$iso, tr($item, 'content_second', $iso)) }}</textarea>
                @if ($errors->has('content_second'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content_second') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
        </div>
        @endif

        @if(isset($item) && $item->parent_id == 67)
        <h2 class="mt-3">Departments Price Info</h2>
        <div class="form-group border-bottom d-flex flex-wrap">
            <div class="card-body">
                <input type="text"
                       name="phone"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                       id="phone"
                       placeholder="{{ __('Price') }}"
                       value="{{ old('phone', $item->phone ?? null) }}">
                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @bylang([
        'id' => 'form_content_title_second',
        'tp_classes' => 'little-p',
        'title' => __('app.Form.Content title') . ' second'])
        <input type="text"
               name="title_content_second[{!! $iso !!}]"
               class="form-control form-control-sm form-control-alternative{{ $errors->has('title_content_second') ? ' is-invalid' : '' }}"
               placeholder="{{ __('app.Form.Content title') }}"
               value="{{ old('title_content_second.'.$iso, tr($item, 'title_content_second', $iso)) }}">
        @if ($errors->has('title_content_second'))
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title_content_second') }}</strong>
                    </span>
        @endif
        @endbylang
        @endif
    @seo(['item' => $item ?? null])@endseo

    @submit(['title' => null])@endsubmit
</form>
