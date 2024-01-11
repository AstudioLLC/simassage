<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.ID') }}</th>
        <th>{{ __('app.List.Name') }}</th>
        <th>{{ __('app.Form.Children ID') }}</th>
        <th>{{ __('app.Form.Region') }}</th>
        <th>{{ __('app.List.Last edit') }}</th>
        <th>{{ __('app.Form.Date of birth') }}</th>
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list">
        @forelse ($items as $item)
            <tr data-id="{{ $item->id }}" class="item-row">
                <td class="item-title">{{ $item->id }}</td>
                <td class="item-title">{{ $item->title }}</td>
                <td class="item-title">{{ $item->child_id }}</td>
                <td class="item-title">{{ $item->region->title ?? null }}</td>
                <td class="item-title">
                    {{ $item->updated_at ? $item->updated_at->format('d/m/Y') : $item->created_at->format('d/m/Y') }}
                </td>
                <td class="item-title">{{ $item->date_of_birth }}</td>
                <td class="text-right">
                    <a class="btn btn-sm btn-icon-only btn-outline-info"
                       href="{{ route('admin.news.show', ['id' => $item->id]) }}"
                       title="{{ __('app.View') }}">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a class="btn btn-sm btn-icon-only btn-outline-success item-restore"
                       href="javascript:void(0)"
                       title="{{ __('app.Restore') }}">
                        <i class="fas fa-redo"></i>
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
