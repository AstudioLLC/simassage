@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    @include('admin.components.errors')
    <form action="{{ route('admin.items.update', ['id' => $item->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                    @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                    <label class="w-100">
                        <input type="text"
                               name="title[{!! $iso !!}]"
                               class="form-control"
                               placeholder="{{ t('Admin pages form.title') }}"
                               value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                    </label>
                    @endbylang
                </div>
                <div class="card px-3 pt-3">
                    <div class="row cstm-input">
                        <div class="col-12 p-b-5">
                            <input class="labelauty custom-labelauty toggle-bottom-input on-unchecked"
                                   type="checkbox"
                                   name="generate_url"
                                   value="1"
                                   data-labelauty="{{ t('Admin pages form.generate url') }}"
                                {!! oldCheck('generate_url', false) !!}>
                            <div class="bottom-input">
                                <input type="text"
                                       style="margin-top:3px;"
                                       name="alias"
                                       class="form-control"
                                       id="form_url"
                                       placeholder="{{ t('Admin pages form.url') }}"
                                       value="{{ old('alias') ?? $item->alias }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <div class="mr-2">
                            @labelauty(['id'=>'active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=> oldCheck('active', $item->active)])@endlabelauty
                        </div>
                        <div class="mr-2">
                            @labelauty(['id'=>'is_new', 'label'=>t('Admin pages form.new'), 'checked'=> oldCheck('is_new', $item->is_new)])@endlabelauty
                        </div>
                        <div class="mr-2">
                            @labelauty(['id'=>'is_promotion', 'label'=>t('Admin pages form.promotion'), 'checked'=> oldCheck('is_promotion', $item->is_promotion)])@endlabelauty
                        </div>
                    </div>
                </div>

                @if($categories->count())
                    <div class="col-12">
                        <div class="card p-2">
                            <label for="category">{{ t('Admin items.associate with category') }}</label>
                            <select id="category" name="category" class="select2Collection">
                                <option value="" selected>
                                    {{ t('Admin items.without category') }}
                                </option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {!! $item->category_id == $category->id ? 'selected' : null !!}>
                                        {{ $category->name }}
                                    </option>
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" {!! $item->category_id == $child->id ? 'selected' : null !!}>
                                            -- {{ $child->name }} --
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                @if($collections->count())
                    <div class="col-12">
                        <div class="card p-2">
                            <label for="collection">{{ t('Admin items.associate with collection') }}</label>
                            <select id="collection" name="collection" class="select2">
                                <option value="" selected>
                                    {{ t('Admin items.without collection') }}
                                </option>
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}" {!! $item->collection_id == $collection->id ? 'selected' : null !!}>
                                        {{ $collection->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                @if($brands->count())
                    <div class="col-12">
                        <div class="card p-2">
                            <label for="brand">{{ t('Admin items.associate with brand') }}</label>
                            <select id="brand" name="brand" class="select2">
                                <option value="" selected>
                                    {{ t('Admin items.without brand') }}
                                </option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {!! count($item->brands) && $item->brands[0]->id == $brand->id ? 'selected' : null !!}>
                                        {{ $brand->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="c-title">{{ t('Admin pages form.image') }} (800 x 800)</div>
                    <div class="p-2 text-center">
                        <img src="{{ $item->getImageUrl('thumbnail') }}" alt="" class="img-responsive">
                    </div>
                    <div class="c-body">
                        @file(['name'=>'image'])@endfile
                    </div>
                </div>
                @if($item->image)
                    @component('admin.components.imageDestroy', ['id' => $item->id, 'action' => route('admin.items.deleteImage')])@endcomponent
                @endif
                <div class="card p-2">
                    <label for="code">{{ t('Admin pages form.code') }}</label>
                    <input type="text"
                           id="code"
                           name="code"
                           class="form-control"
                           value="{{ old('code') ?? $item->code }}"
                           placeholder="{{ t('Admin pages form.code') }}">
                </div>
                <div class="card p-2">
                    <label for="count">{{ t('Admin pages form.count') }}</label>
                    <input type="text"
                           id="count"
                           name="count"
                           class="form-control"
                           value="{{ old('count') ?? $item->count }}"
                           placeholder="{{ t('Admin pages form.count') }}">
                </div>
                <div class="card p-2">
                    @bylang(['id'=>'unit_of_measurement', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.unit of measurement')])
                    <label class="w-100">
                        <input type="text"
                               name="unit_of_measurement[{!! $iso !!}]"
                               class="form-control"
                               placeholder="{{ t('Admin pages form.unit of measurement') }}"
                               value="{{ old('unit_of_measurement.'.$iso, tr($item, 'unit_of_measurement', $iso)) }}">
                    </label>
                    @endbylang
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    @bylang(['id'=>'form_short', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.short content text')])
                    <label class="w-100">
                        <textarea class="form-control form-textarea" name="short[{!! $iso !!}]">{!! old('short.'.$iso, tr($item, 'short_description', $iso)) !!}</textarea>
                    </label>
                    @endbylang
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    @bylang(['id'=>'form_content', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.content text')])
                    <label class="w-100">
                        <textarea class="ckeditor" name="description[{!! $iso !!}]">{!! old('description.'.$iso, tr($item, 'description', $iso)) !!}</textarea>
                    </label>
                    @endbylang
                </div>
            </div>
            <div class="col-12">
                <div class="card p-2">
                    <label>{{ t('Admin items.specifications') }}</label>
                    <div class="row w-100 px-2">
                        @if($item->options)
                            <div class="w-100">
                                @bylang(['id'=>'criteria-container', 'class'=>'w-100' ,'tp_classes'=>'little-p','title'=>t('Admin pages form.title')])
                                @foreach($item->options as $i => $option)
                                    <div class="inputs_for_index d-flex">
                                        <div class="col-12 col-lg-6">
                                            <input placeholder="{{ t('Admin items.specifications name') }}"
                                                   class="form-control characteristics-inputs"
                                                   name="options[name][{{$option->id}}][{!! $iso !!}]"
                                                   type="text"
                                                   data-index="{{$option->id}}"
                                                   value="{{ $option->getTranslation('name', $iso) }}">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <input placeholder="{{ t('Admin items.specifications value') }}"
                                                   class="form-control characteristics-inputs"
                                                   name="options[value][{{$option->id}}][{!! $iso !!}]"
                                                   type="text"
                                                   data-index="{{$option->id}}"
                                                   value="{{ $option->getTranslation('value', $iso) }}">
                                        </div>
                                        <a class="icon-btn delete delete-criterion-item" data-id="1"></a>
                                    </div>
                                @endforeach
                                @endbylang
                            </div>
                        @else
                            <div class="w-100">
                                @bylang(['id'=>'criteria-container', 'tp_classes'=>'little-p','title'=>t('Admin pages form.title')])
                                <div class="inputs_for_index d-flex"></div>
                                @endbylang
                            </div>
                        @endif
                        <i class="icon-btn add char-add-row" onclick="addCriterionRow()"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card p-2">
                    <label for="price">{{ t('Admin items.price') }}</label>
                    <input type="number"
                           min="0"
                           id="price"
                           class="form-control"
                           name="price"
                           value="{{ old('price') ?? $item->realPrice }}">
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card p-2">
                    <label for="bulk_price">{{ t('Admin items.price 2') }}</label>
                    <input type="number"
                           min="0"
                           id="bulk_price"
                           class="form-control"
                           name="bulk_price"
                           value="{{ old('bulk_price') ?? $item->bulk_price }}">
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card p-2">
                    <label for="discount">{{ t('Admin pages form.discount percent') }}</label>
                    <input type="number"
                           min="0"
                           class="form-control"
                           max="99"
                           step="0.5"
                           id="discount"
                           name="discount"
                           value="{{ old('discount') ?? $item->discount }}">
                </div>
            </div>
            <div class="col-12">
                @seo(['item' => $item])@endseo
            </div>
            <div class="col-12 save-btn-fixed">
                <button type="submit">{{ t('Admin action buttons.save') }}</button>
            </div>
        </div>
    </form>
@endsection
@push('js')
    @ckeditor
    @js(aApp('smartSelect/smartSelect.min.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var isos='{!! json_encode($isos) !!}';
        isos=JSON.parse(isos);

        function charRow(index,iso) {
            return '<div class="inputs_for_index d-flex">' +
                '<div class="col-12 col-lg-6">' +
                    '<input placeholder="{{ t('Admin items.specifications name') }}" class="form-control characteristics-inputs" name="options[name][' + index + ']['+ iso +']" type="text" value="" data-index="'+index+'">' +
                '</div>' +
                '<div class="col-12 col-lg-6">' +
                    '<input placeholder="{{ t('Admin items.specifications value') }}" class="form-control characteristics-inputs" name="options[value][' + index + ']['+ iso +']" type="text" value="" data-index="'+index+'">' +
                '</div>' +
                '<a class="icon-btn delete delete-criterion-item" data-id="1"></a> ' +
            '</div>';
        }
        $(document).on('click', '.delete-criterion-item', function () {
            var dataIndex = $(this).prev().data('index');
            for (var j = 0; j < isos.length; j++) {
                $('.characteristics-inputs').each(function () {
                    if($(this).data('index') == dataIndex){
                        $(this).parent().remove();
                    }
                })
            }
        });
        function addCriterionRow() {
            var index = 0;
            $('.characteristics-inputs').each(function () {
                if($(this).data('index') > index){
                    index = $(this).data('index');
                }
            })
            index++
            for (var j = 0; j < isos.length; j++) {
                $('#criteria-container_'+isos[j]).append(charRow(index,isos[j]))
            }
        }

        $(document).ready(function() {
            $("select#demo-3b").smartselect({
                toolbar: false,
                defaultView: 'root+selected',
                multiple: false
            });
        });

        $('.select2').select2();
        $('.select2Collection').select2();
    </script>
@endpush

@push('css')
    @css(aApp('smartSelect/smartSelect.min.css'))
    @css(aApp('select2/select2.css'))

    <style>
        .characteristics-inputs{
            padding: 10px;
            margin: 10px 0;
        }
        .inputs_for_index{
            align-items: center;
        }
        .inputs_for_index a{
            margin-left: 0 !important;
        }
        .char-add-row{
            padding-left: 10px;
        }
        #itemDeleteModal{
            opacity: 1;
        }
    </style>
@endpush
