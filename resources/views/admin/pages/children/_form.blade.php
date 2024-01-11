@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.children.edit', ['id' => $item->id]) : route('admin.children.store') !!}" method="post" enctype="multipart/form-data">
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
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Children ID')])@endformTitle
                <div class="card-body">
                    <input type="text"
                           name="child_id"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('child_id') ? ' is-invalid' : '' }}"
                           id="child_id"
                           placeholder="{{ __('app.Form.Children ID') }}"
                           value="{{ old('child_id', $item->child_id ?? null) }}">
                    @if ($errors->has('child_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('child_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Date of birth')])@endformTitle
                <div class="card-body">
                    <input type="date"
                           name="date_of_birth"
                           class="form-control form-control-sm form-control-alternative{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                           id="date_of_birth"
                           placeholder="{{ __('app.Form.Date of birth') }}"
                           value="{{ old('date_of_birth', $item->date_of_birth ?? null) }}">
                    @if ($errors->has('date_of_birth'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Image') . $imageSize])@endformTitle
                <div class="card-body">
                    @file(['name'=>'image'])@endfile
                    @if (!empty($item->image))
                        <div class="border">
                            <img src="{{ $item->getImageUrl('thumbnail') }}" class="img-fluid img-center p-2">
                        </div>
                        <input type="hidden" name="old_imageBig" value="{{ $item->image }}">
                        @imageDestroy([
                        'id' => $item->id,
                        'title' => __('app.Delete image'),
                        'action' => route('admin.children.deleteImage')
                        ])@endimageDestroy
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Gender')])@endformTitle
                <div class="card-body">
                    <select name="gender" id="gender" class="form-control form-control-sm form-control-alternative">
                        <option selected value="">
                            -- {{ __('app.Form.Not selected') }} --
                        </option>
                        <option value="0" @if($item && $item->gender == 0) selected @endif>
                            - {{ __('app.Gender.0') }} -
                        </option>
                        <option value="1" @if($item && $item->gender == 1) selected @endif>
                            - {{ __('app.Gender.1') }} -
                        </option>
                    </select>
                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Region')])@endformTitle
                <div class="card-body">
                    <select name="region_id" id="region_id" class="form-control form-control-sm form-control-alternative">
                        <option value="">-- {{ __('app.Form.Not selected') }} --</option>
                        @itemsAllList(['items' => $regions, 'parentId' => $item->region_id ?? null, 'item' => $item, 'delimiter' => '-'])@enditemsAllList
                    </select>
                    @if ($errors->has('region_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('region_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Sponsor')])@endformTitle
                <div class="card-body">
                    <select name="sponsor_id" id="sponsor_id" class="form-control form-control-sm form-control-alternative">
                        <option value="">-- {{ __('app.Form.Not selected') }} --</option>
                        @foreach($sponsors as $sponsor)
                            <option value="{{ $sponsor->id }}" @if($item && $item->sponsor_id == $sponsor->id) selected @endif>
                                - {{ $sponsor->name }}
                                @if($sponsor->options && isset($sponsor->options->sponsor_id))
                                    {{ ', ' . $sponsor->options->sponsor_id }}
                                @endif
                                -
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('sponsor_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sponsor_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
        <div class="col-12">
            <div class="card">
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
            </div>
        </div>
        @if(count($needs))
            <div class="col-12">
                @foreach($needs as $need)
                    <div class="card">
                        @if(count($need->children))
                            @formTitle(['title' => $need->title])@endformTitle
                            @foreach($need->children as $children)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           name="needs[]"
                                           class="custom-control-input"
                                           id="childrenNeed{{ $children->id }}" @if(isset($item) && in_array($children->id, $item->getChildrenNeedsIdsAttribute())) checked @endif
                                           value="{{ $children->id }}">
                                    <label class="custom-control-label" for="childrenNeed{{ $children->id }}">{{ $children->title }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @submit(['title' => null])@endsubmit
</form>
