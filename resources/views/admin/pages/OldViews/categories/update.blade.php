@extends('admin.layouts.app')
@section('title', t('Admin pages titles.edit') .  ' ' . $categoryData->name)
@section('content')
    <section class="addItem-container">
        <div class="container-fluid">
            <div class="row">
                <div class="w-100">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form" action="{{ route('admin.categories.update', ['id' => $categoryData->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-7">
                                        @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                                        <label class="w-100">
                                            <input type="text"
                                                   name="name[{!! $iso !!}]"
                                                   class="form-control"
                                                   placeholder="{{ t('Admin pages form.title') }}"
                                                   value="{{ old('name.'.$iso, tr($item, 'name', $iso)) ?? $categoryData->getTranslation('name', $iso) }}">
                                        </label>
                                        @endbylang

                                        @if($categories->count())
                                            <div class="col-12 px-0">
                                                <div class="card p-2">
                                                    <label for="parent_id">
                                                        {{ t('Admin categories.change category') }}
                                                    </label>
                                                    <select id="parent_id" name="parent_id" class="select2">
                                                        <option value="" selected>
                                                            {{ t('Admin categories.make Category') }}
                                                        </option>
                                                        @foreach($categories as $category)
                                                            @if($category->parent_id == null)
                                                                <option value="{{ $category->id }}" {!! $categoryData->parent_id==$category->id?'selected':null !!}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endif
                                                            {{--@foreach($category->children as $child)
                                                                <option value="{{ $child->id }}">
                                                                    -- {{ $child->name }} --
                                                                </option>
                                                            @endforeach--}}
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        @seo(['item' => $categoryData ?? null])@endseo
                                        {{--@if(!empty($parent))

                                        @endif--}}
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="card">
                                            <div class="c-title">{{ t('Admin pages form.image') }} (360 x 210)</div>
                                            @if($categoryData->image)
                                                <div class="p-2 text-center">
                                                    <img src="{{ $categoryData->getImageUrl('small') }}" alt=""
                                                         class="img-responsive">
                                                </div>
                                            @endif
                                            <div class="c-body">
                                                @file(['name'=>'image'])@endfile
                                            </div>
                                        </div>
                                        @if($categoryData->image)
                                            @component('admin.components.imageDestroy', ['id' => $categoryData->id, 'action' => route('admin.categories.deleteImage')])@endcomponent
                                        @endif

                                        <div>
                                            <label for="is_home">{{ t('Admin categories.show home') }}</label>
                                            @labelauty(['id'=>'is_home', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=> oldCheck('is_home', $categoryData->is_home)])@endlabelauty
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 save-btn-fixed">
                                <button type="submit">{{ t('Admin action buttons.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    @js(aApp('smartSelect/smartSelect.min.js'))
    @js(aApp('select2/select2.js'))
    <script>
        $('.select2').select2();
    </script>
@endpush

@push('css')
    @css(aApp('smartSelect/smartSelect.min.css'))
    @css(aApp('select2/select2.css'))
    <style>
        #itemDeleteModal{
            opacity: 1;
        }
    </style>
@endpush
