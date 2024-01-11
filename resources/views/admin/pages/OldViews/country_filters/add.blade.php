@extends('admin.layouts.app')
@section('title', 'Добавление фильтра')
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
                    <form class="form" action="{{ route('admin.countryFilters.add') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="form-group">
                                            @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>'Название'])
                                            <input type="text" name="name[{{ $iso }}]" class="form-control" id="name"
                                                   placeholder="Название Фильтра" value="{{ old('name.'.$iso, tr($item, 'name', $iso)) }}">
                                            @endbylang
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="c-title">Изоброжение (21 x 16)</div>
                                            @if (!empty($item->image))
                                                <div class="p-2 text-center">
                                                    <img src="{{ $item->getImageUrl('small') }}" alt="" class="img-responsive">
                                                </div>
                                            @endif
                                            <div class="c-body">
                                                @file(['name'=>'image'])@endfile
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary" name="addFilter">
                                                Создать фильтр
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
                '<a class="icon-btn delete delete-criterion-item"></a>' +
                '</td>' +
                '</tr>';
        }

        $(document).on('click', '.delete-criterion-item', function () {
            $(this).parents('tr').remove();
        });

        function addCriterionRow() {
            var index = charContainer.find('tr').length;
            charContainer.append(charRow(index));
        }
    </script>
@endpush
