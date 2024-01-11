@extends('admin.layouts.app')
@section('title', ($parent ? $parent->name.' - ' : '') . t('Admin Sidebar.Categories'))

@section('titleSuffix')
    | <a href="{!! route('admin.categories.create', ['parentId' => $parent ? $parent->id : null]) !!}" class="text-cyan">
        <i class="mdi mdi-plus-box"></i>
        {{ t('Admin action buttons.add') }}
    </a>
@endsection

@section('content')
    <section class="style-default-bright">
        <div class="section-header">
            @if($parent)
                @include('admin.pages.categories.breadcrumbs', [
                    'parent' => $parent,
                    'nestedParents' => $nestedParents ?? []
                ])
            @endif
        </div>
        <ul class="k-accordion-container p-0">
            @if(count($categories))
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 columns-middle">
                            <thead>
                            <tr>
                                <th>{{ t('Admin pages list.name') }}</th>
                                <th class="text-right">{{ t('Admin pages list.action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="table-sortable" data-action="{{ route('admin.categories.sort') }}">
                            @foreach($categories as $category)
                                @include('admin.partials.category-row', ['category' => $category])
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <h3 class="text-center my-3">{{ t('Admin pages list.empty') }}</h3>
            @endif
        </ul>
    </section>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ t('Admin action buttons.cancel') }}</button>
                    <button type="button" class="btn btn-cyan deleteCategory">{{ t('Admin action buttons.confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    {{--    <script src="{{ asset('assets/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/jquery-multilevel-accordion/accordion.js') }}"></script>--}}
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
        const categoryDeletingUrl = '{{ route('admin.categories.delete', ['id' => ':slug']) }}';
        $('.deleteCategory').click(function () {
            $.ajax({
                type: 'DELETE',
                url: categoryDeletingUrl.replace(':slug', cid),
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response)
                    if (response) {
                        that.parent().parent().remove();
                        deleteModal.modal('hide');
                    }
                }
            })
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
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                    orderedItems: orderedItems
                },
                url: '/admin/items/categories/change/order',
                success: function (response) {
                    console.log(response);
                }
            });
        }
    </script>
@endpush

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
