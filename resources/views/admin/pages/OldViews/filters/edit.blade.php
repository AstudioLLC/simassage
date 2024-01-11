@extends('admin.layouts.app')
@section('title', $title)
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
                    <form class="form" action="{{ route('admin.filters.edit', ['id' => $filter->id]) }}" method="post">
                        {{csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="w-100">
                                        <div class="form-group">
                                            @bylang(['id'=>'form_title', 'tp_classes'=>'little-p', 'title'=>t('Admin pages form.title')])
                                            <input type="text"
                                                   name="name[{{$iso}}]"
                                                   class="form-control"
                                                   id="name"
                                                   placeholder="{{ t('Admin pages form.title') }}"
                                                   value="{{ old('name.'.$iso, tr($filter, 'name', $iso)) }}">
                                            @endbylang
                                        </div>
                                        @labelauty(['id'=>'is_active', 'label'=>t('Admin pages form.inactive')."|".t('Admin pages form.active'),
                                        'checked' => old('is_active') ?? $filter->is_active])@endlabelauty
                                    </div>
                                </div>
                                <div class="row w-100">
                                    @if($filter->criteria)
                                        <div class="w-100">
                                            @bylang(['id'=>'criteria-container', 'class'=>'w-100' ,'tp_classes'=>'little-p','title'=>t('Admin pages form.title')])
                                                @foreach($filter->criteria as $i => $criterion)
                                                    <div class="inputs_for_index d-flex">
                                                        <input placeholder="{{ t('Admin filters.title') }}"
                                                               class="form-control characteristics-inputs"
                                                               name="criterion[old][{{$criterion->id}}][{!! $iso !!}]"
                                                               type="text"
                                                               data-index="{{$criterion->id}}"
                                                               value="{{ $criterion->getTranslation('name', $iso) }}">
                                                        <a class="icon-btn delete delete-criterion-item" data-id="1" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                                    </div>
                                                @endforeach
                                            @endbylang
                                        </div>
                                    @else
                                        @bylang(['id'=>'criteria-container', 'tp_classes'=>'little-p','title'=>t('Admin pages form.title')])
                                        <div class="inputs_for_index d-flex"></div>
                                        @endbylang
                                    @endif
                                    <i class="icon-btn add char-add-row" onclick="addCriterionRow()"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <button type="submit" class="btn ink-reaction btn-raised btn-primary" name="editFilter">
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

    <script type="text/javascript">
        var isos = '{!! json_encode($isos) !!}';
        isos = JSON.parse(isos);

        function charRow(index,iso) {
            return '<div class="inputs_for_index d-flex">' +
                '<input placeholder="{{ t('Admin filters.title') }}" ' +
                    'class="form-control characteristics-inputs" ' +
                    'name="criterion[new][' + index + ']['+ iso +']" ' +
                    'type="text" ' +
                    'value="" ' +
                    'data-index="'+index+'">' +
                '<a class="icon-btn delete delete-criterion-item" data-id="1" {!! tooltip(t('Admin action buttons.delete')) !!}></a>' +
                '</div>';
        }
        $(document).on('click', '.delete-criterion-item', function () {
            var dataIndex=$(this).prev().data('index');
            for (var j = 0; j < isos.length; j++) {
                $('.characteristics-inputs').each(function () {
                    if($(this).data('index') ==dataIndex){
                        $(this).parent().remove();
                    }
                })
            }
        });
        function addCriterionRow() {
            var index =0;
            $('.characteristics-inputs').each(function () {
                if($(this).data('index') > index){
                    index=$(this).data('index');
                }
            })
            index++
            for (var j = 0; j < isos.length; j++) {
                $('#criteria-container_'+isos[j]).append(charRow(index,isos[j]))
            }
        }
    </script>
@endpush
@push('css')
    <style>
        .characteristics-inputs{
            padding: 10px;
            margin: 10px 0;
        }
        .inputs_for_index{
            align-items: center;
        }
        .inputs_for_index a{
            margin-left: 15px !important;
        }
    </style>
@endpush
