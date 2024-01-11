<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.Name') }}</th>
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.file.sort') }}">
    @forelse ($items as $item)
        <tr data-id="{{ $item->id }}" class="item-row">
            <td class="item-title">{{ $item->title }}</td>
            <td class="text-right">
{{--                <a class="btn btn-sm btn-icon-only btn-outline-info"--}}
{{--                   href="{{ route('admin.file.show', ['file' => $file, 'key' => $key, 'id' => $item->id]) }}"--}}
{{--                   title="{{ __('app.View') }}">--}}
{{--                    <i class="fas fa-eye"></i>--}}
{{--                </a>--}}

                <a class="btn btn-sm btn-icon-only btn-outline-primary"
                   href="{{ route('admin.file.edit', ['file' => $file, 'key' => $key, 'id' => $item->id]) }}"
                   title="{{ __('app.Edit') }}">
                    <i class="far fa-edit"></i>
                </a>

                <a class="btn btn-sm btn-icon-only btn-outline-danger delete"
                   href="javascript:void(0)"
                   title="{{ __('app.Destroy') }}"
                   data-toggle="modal"
                   data-target="#itemDeleteModal">
                    <i class="fas fa-times"></i>
                </a>
            </td>
        </tr>
    @empty
        @include('admin.components._empty')
    @endforelse
    </tbody>
</table>
