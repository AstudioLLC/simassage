@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <section class="addItem-container">
        <div class="container-fluid">
            <div class="row w-100">
                <div class="w-100">
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="form" action="{{ route('admin.filters.add') }}" method="post">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="w-100">
                                        <div class="form-group">
                                            @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                                            <input type="text"
                                                   name="name[{{$iso}}]"
                                                   class="form-control"
                                                   id="name[{{$iso}}]"
                                                   placeholder="{{ t('Admin pages form.title') }}"
                                                   value="{{ old('name.'.$iso) }}">
                                            @endbylang
                                        </div>
                                        @labelauty(['id'=>'is_active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'), 'checked'=> (bool) old('is_active', true)])@endlabelauty
                                    </div>
                                </div>
                                <div class="row w-100">
                                    <div class="col-xs-12">
                                        <div class="char-add-row p-2">
                                            <span>{{ t('Admin filters.criterions') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card card-underline m-0">
                                            @if(old('criterion') && count(old('criterion')['new']) > 0)
                                                @bylang(['id'=>'criteria-container', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                                                    @foreach(old('criterion')['new'] as $i => $criterion)
                                                        <div class="inputs_for_index d-flex">
                                                            <input placeholder="{{ t('Admin filters.title') }}"
                                                                   class="form-control characteristics-inputs"
                                                                   name="criterion[new][{{$loop->index}}][{!! $iso !!}]"
                                                                   type="text"
                                                                   data-index="{{$loop->index}}"
                                                                   value="{{($criterion[$iso]) ?? null }}">
                                                            <a class="icon-btn delete delete-criterion-item" data-id="1" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                                        </div>
                                                    @endforeach
                                                @endbylang
                                            @else
                                                @bylang(['id'=>'criteria-container', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                                                    <div class="inputs_for_index d-flex">
                                                        <input placeholder="{{ t('Admin filters.title') }}"
                                                               class="form-control characteristics-inputs"
                                                               name="criterion[new][0][{!! $iso !!}]"
                                                               type="text"
                                                               data-index="0"
                                                               value="">
                                                        <a class="icon-btn delete delete-criterion-item" data-id="1" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                                    </div>
                                                @endbylang
                                            @endif
                                            <div class="char-add-row" onclick="addCriterionRow()">
                                                <i class="icon-btn add"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <button type="submit" class="btn ink-reaction btn-raised btn-primary" name="addFilter">
                                    {{ t('Admin action buttons.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')


    <script>
        var isos = '{!! json_encode($isos) !!}';
        isos = JSON.parse(isos);

        function charRow(index, iso) {
            return '<div  class="inputs_for_index d-flex">' +
                    '<input placeholder="{{ t('Admin filters.title') }}" ' +
                        'class="form-control characteristics-inputs" ' +
                        'name="criterion[new][' + index + '][' + iso + ']" ' +
                        'type="text" ' +
                        'value="" ' +
                        'data-index="' + index + '">' +
                    '<a class="icon-btn delete delete-criterion-item" data-id="1" {!! tooltip(t('Admin action buttons.delete')) !!}></a>' +
                '</div>';
        }

        $(document).on('click', '.delete-criterion-item', function () {
            var dataIndex = $(this).prev().data('index');
            for (var j = 0; j < isos.length; j++) {
                $('.characteristics-inputs').each(function () {
                    if ($(this).data('index') == dataIndex) {
                        $(this).parent().remove();
                    }
                })
            }
        });

        function addCriterionRow() {
            var index = 0;
            $('.characteristics-inputs').each(function () {
                if ($(this).data('index') > index) {
                    index = $(this).data('index');
                }
            })
            index++
            for (var j = 0; j < isos.length; j++) {
                $('#criteria-container_' + isos[j]).append(charRow(index, isos[j]))
            }
        }
    </script>
@endpush
@push('css')
    <style>
        .characteristics-inputs {
            padding: 10px;
            margin: 10px 0;
        }
        .inputs_for_index {
            align-items: center;
        }
        .inputs_for_index a {
            margin-left: 15px !important;
        }
        .char-add-row{
            font-size: 22px;
            float: left;
        }
    </style>
@endpush
