<tr class="page-row" data-id="{{ $category->id }}">
    <td class="page-title">{{ $category->name }}</td>
    <td class="text-right">
        @if($category->deep < env('CATEGORY_DEEP'))
            <a href="{{ route('admin.categories.index', ['parentId' => $category->id]) }}">
                <span>{{ t('Admin action buttons.sub pages') }}</span>
                <sup>({{ count($category->children) }})</sup>
            </a>
        @endif
        <a href="{{ route('admin.categories.filters', ['id' => $category->id]) }}" class="ml-3">
            <span>{{ t('Admin action buttons.filters') }}</span>
            <sup>({{ count($category->filters) }})</sup>
        </a>
        <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}"
           {!! tooltip(t('Admin action buttons.edit')) !!} class="ml-2 icon-btn text-success fas fa-pencil-alt"> </a>
        <a href="javascript:void(0)" class="fa fa-trash  deleteTrigger icon-btn delete"
           {!! tooltip(t('Admin action buttons.delete')) !!} data-id="{{ $category->id }}"
           aria-hidden="true"></a>
    </td>
</tr>


@modal(['id' => 'pageDeleteModal', 'centered' => true, 'loader' => true,
    'saveBtn'=> t('Admin action buttons.delete'),
    'saveBtnClass'=>'btn-danger',
    'closeBtn' => t('Admin action buttons.cancel'),
    'form' => ['id' => 'pageDeleteForm', 'action' => 'javascript:void(0)']])
@slot('title')Удаление страницы@endslot
<input type="hidden" id="pdf-page-id">
<p class="font-14">{{ t('Admin action buttons.delete confirm title') }} &Lt;<span id="pdm-title"></span>&Gt;{{ t('Admin action buttons.delete confirm question mark') }}</p>
@endmodal

@push('css')
@endpush
@push('js')
@endpush
