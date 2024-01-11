@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <section class="style-default-bright">
        <div class="section-header">
            <div class="newProd-toggle">
                <a style="display: flex; align-items: center;" href="{{ route('admin.filters.add')}}">
                    <i class="icon-btn add"></i>
                    <span style="margin-left: 10px">{{ t('Admin action buttons.add') }}</span>
                </a>
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
                                            <th class="text-left">{{ t('Admin pages list.name') }}</th>
                                            <th class="text-center">{{ t('Admin pages list.satus') }}</th>
                                            <th class="text-right">{{ t('Admin pages list.action') }}</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td class="text-left page-title">{{ t('Admin filters.country') }}</td>
                                            <td></td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.countryFilters.list') }}"
                                                   {!! tooltip(t('Admin action buttons.edit')) !!}
                                                   class="icon-btn edit">

                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left page-title">{{ t('Admin filters.color') }}</td>
                                            <td></td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.colorFilters.list') }}"
                                                   {!! tooltip(t('Admin action buttons.edit')) !!}
                                                   class="icon-btn edit">

                                                </a>
                                            </td>
                                        </tr>
                                        <tbody class="table-sortable" data-action="{{ route('admin.filters.sort') }}">
                                        @foreach($filters as $filter)
                                            <tr class="page-row" data-id="{{ $filter->id }}">
                                                <td class="text-left page-title">{{ $filter->name }}</td>
                                                <td class="text-center {{ $filter->is_active ? 'text-success' : 'text-danger' }}">
                                                    {{ $filter->is_active ? t('Admin pages list.active') : t('Admin pages list.inactive') }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.filters.edit', ['id' => $filter->id]) }}"
                                                       {!! tooltip(t('Admin action buttons.edit')) !!}
                                                       class="icon-btn edit">

                                                    </a>
                                                    <i class="icon-btn delete  clt-tool clt-delete-tool deleteTrigger "
                                                       {!! tooltip(t('Admin action buttons.delete')) !!} data-id="{{ $filter->id }}"
                                                       aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <h3 class="text-center my-3">{{ t('Admin pages list.empty') }}</h3>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="simpleModalLabel">{{ t('Admin action notify.attention') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{ t('Admin action notify.data will lost') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ t('Admin action buttons.cancel') }}</button>
                    <button type="button" class="btn btn-primary deleteCategory">{{ t('Admin action buttons.confirm') }}</button>
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
            $.get('/admin/filters/delete/' + cid, function (response) {
                if (response) {
                    that.parent().parent().remove();
                    deleteModal.modal('hide');
                }
            });
        });

        $(document).ready(function () {
            $('.k-accordion-container').sortable({
                forcePlaceholderSize: true,
                axis: 'y',
                items: 'li',
                handle: 'a',
                listType: 'ul',
                placeholder: 'menu-highlight',
                maxLevels: 4,
                opacity: .6,
                update: function (event, ui) {
                    var element = ui.item;
                    var id = element.data('id');
                    var parent_id = 0;
                    if (element.parent().parent('li').length > 0) {
                        parent_id = element.parent().parent('li').data('id');
                    }
                    //changeItemParent(id, parent_id);
                    changeItemsOrder(element);
                }
            });
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

{{--@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jquery-multilevel-accordion/accordion.css') }}">
@stop--}}

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
