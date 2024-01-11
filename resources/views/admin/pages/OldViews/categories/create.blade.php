@extends('admin.layouts.app')
@section('title', $data['title'] = t('Admin pages titles.add') . ($parent ? ' ' . t('Admin categories.subcategory') . ' ' . $parent->name : '') )
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
                    <form class="form" action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                                   value="{{ old('name.'.$iso, tr($item, 'name', $iso)) }}">
                                        </label>
                                        @endbylang
                                        @if($categories->count())
                                            <div class="col-12 px-0">
                                                <div class="card p-2">
                                                    <label for="parent_id">{{ t('Admin categories.change category') }}</label>
                                                    <select id="parent_id" name="parent_id" class="select2">
                                                        <option value="" selected>
                                                            {{ t('Admin categories.make Category') }}
                                                        </option>
                                                        @foreach($categories as $category)
                                                            @if($category->parent_id == null)
                                                                <option value="{{ $category->id }}">
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

                                        @seo(['item'=>$categoryData??null])@endseo
                                        {{--@if(!empty($parent))

                                        @endif--}}
                                        {{--<input type="hidden" value="{{ $parent ? $parent->id : '' }}" name="parent_id">--}}
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="card">
                                            <div class="c-title">{{ t('Admin pages form.image') }} (360 x 210)</div>
                                            <div class="c-body">
                                                @file(['name'=>'image'])@endfile
                                            </div>
                                        </div>

                                        <div>
                                            <label for="is_home">{{ t('Admin categories.show home') }}</label>
                                            @labelauty(['id'=>'is_home', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=> oldCheck('is_home', false)])@endlabelauty
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
@endpush
