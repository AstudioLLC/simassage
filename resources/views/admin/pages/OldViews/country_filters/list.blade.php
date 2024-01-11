@extends('admin.layouts.app')
@section('title', 'Страны производства продуктов')
@section('content')
    <section class="style-default-bright">
        <div class="section-header">
            <div class="newProd-toggle">
                <a href="{{ route('admin.countryFilters.add') }}"
                   class="text-cyan"><i class="mdi mdi-plus-box"></i>Добавить</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="w-100">
                    <ul style="padding: 0; margin: 0; margin-top: 15px" class="k-accordion-container">
                        @if(count($filters) > 0)
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0 columns-middle">
                                        <thead>
                                        <tr>
                                            <th class="text-left">Флаг</th>
                                            <th class="text-left">Название</th>
                                            <th class="text-right">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-sortable" data-action="{{ route('admin.countryFilters.sort') }}">
                                        @foreach($filters as $filter)
                                            <tr class="page-row" data-id="{{ $filter->id }}">
                                                <td class="text-left">
                                                    <img src="{{ $filter->getImageUrl('small') }}" alt="" style="width:21px; height:auto;">
                                                </td>
                                                <td class="text-left page-title">{{ $filter->name }}</td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.countryFilters.edit', ['id' => $filter->id]) }}">
                                                        <i class="icon-btn edit" aria-hidden="true"></i>
                                                    </a>
                                                    <i class="icon-btn delete clt-tool clt-delete-tool deleteTrigger"
                                                       title="Удалить"
                                                       data-id="{{ $filter->id }}"
                                                       aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <h3 class="text-center my-3">Нет информации</h3>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="simpleModalLabel">Вниамние!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены, что хотите удалить данный фильтр?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                    <button type="button" class="btn btn-primary deleteCategory">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        'use strict';
        var cid = '';
        var that;
        var deleteModal = $('#deleteModal');
        $('.deleteTrigger').click(function () {
            that = $(this);
            cid = that.data('id');
            deleteModal.modal('show');
        });
        $('.deleteCategory').click(function () {
            $.get('/admin/country-filters/delete/' + cid, function (response) {
                if (response) {
                    that.parent().parent().remove();
                    deleteModal.modal('hide');
                }
            });
        });

        $(document).ready(function () {

        });

        function changeItemsOrder(element) {
            var elements = element.parent().children('li');
            var orderedItems = [];
            elements.each(function (i, e) {
                var that = $(e);
                var pushable = {
                    id: that.data('id'),
                    sortable: i + 1,
                    deep: that.parents('li').length
                };
                orderedItems.push(pushable)
            });
        }


    </script>
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jquery-multilevel-accordion/accordion.css') }}">
@stop

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
