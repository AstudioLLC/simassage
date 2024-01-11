@extends('admin.layouts.app')
@section('title', 'Редактирование фильтра')
@section('content')
    <section class="addItem-container">
        <div class="container-fluid">
            <div class="row">
                <div class="w-100">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="form" action="{{ route('admin.countryFilters.edit', ['id' => $filter->id]) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="form-group">
                                            @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>'Название'])
                                            <input type="text" name="name[{!! $iso !!}]" class="form-control" placeholder="Название"
                                                   value="{{ old('name.'.$iso, tr($filter, 'name', $iso)) }}">
                                            @endbylang
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="c-title">Изоброжение (21 x 16)</div>
                                            @if (!empty($filter->image))
                                                <div class="p-2 text-center">
                                                    <img src="{{ $filter->getImageUrl('small') }}" alt="" class="img-responsive">
                                                </div>
                                            @endif
                                            <div class="c-body">
                                                @file(['name'=>'image'])@endfile
                                            </div>
                                        </div>
                                        @if(!empty($filter->image))
                                            @component('admin.components.imageDestroy', ['id' => $filter->id, 'action' => route('admin.countryFilters.deleteImage')])@endcomponent
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" name="addFilter">
                                                Сохранить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script type="text/javascript">
        var charContainer = $('.criteria-container');

        function charRow(index) {
            return '<tr class="added-criterion-row">' +
                '<td>' +
                '<input placeholder="Введите название" class="form-control characteristics-inputs" name="criterion[new][' + index + '][name]" type="text" value="">' +
                '</td>' +

                '<td class="text-center">' +
                '<i class="icon-btn delete delete-criterion-item"></i>' +
                '</td>' +
                '</tr>';
        }

        $(document).on('click', '.delete-criterion-item', function () {
            var that = $(this);
            console.log(that.parents('tr'));
            if (that.parents('tr').hasClass('added-criterion-row')) {
                $.get('/admin/items/filters/criterion/delete/' + that.data('id'), function (response) {
                    if (response) {
                        that.parents('tr').remove();
                    }
                });
            } else {
                that.parents('tr').remove();
            }
        });

        function addCriterionRow() {
            var index = charContainer.find('.added-criterion-row').length;
            charContainer.append(charRow(index));
        }
    </script>
@endpush
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
