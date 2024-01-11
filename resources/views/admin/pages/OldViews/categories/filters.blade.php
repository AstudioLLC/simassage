@extends('admin.layouts.app')
@section('title', t('Admin categories.filter add') . ' ' . $category->name)
@section('content')
    @if($category)
        @include('admin.pages.categories.breadcrumbs', [
            'parent' => $category,
            'nestedParents' => $category->getNestedParents() ?? []
        ])
    @endif
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
                    <form class="form"
                          action="{{ route('admin.categories.filters.sync', ['id' => $category->id]) }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                @if(count($filters))
                                    <div class="form-group">
                                        <label for="filters_ids">{{ t('Admin categories.filter add') }}</label>
                                        <select class="form-control js-example-basic-multiple" name="filters[]" id="filters" multiple="multiple">
                                            @foreach($filters as $filter)
                                                <option value="{{ $filter->id }}" {{ $category->filters->contains($filter) ? 'selected' : '' }}>
                                                    {{ $filter->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <h3 class="text-center">{{ t('Admin pages list.empty') }}</h3>
                                @endif
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
    @js(aApp('select2/select2.js'))
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
@css(aApp('select2/select2.css'))

