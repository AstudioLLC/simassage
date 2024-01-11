<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.queuing_statuses.sort') }}">
    @forelse($items as $item)
        <tr data-id="{{ $item->id }}" class="item-row">
            <td class="item-title">{{ $item->id }}</td>
            <td>
               {{$item->name}}
            </td>
        
            <td class="text-right">
{{--                <a class="btn btn-sm btn-icon-only btn-outline-info"--}}
{{--                   href="{{ route('admin.time.show', ['id' => $item->id]) }}"--}}
{{--                   title="{{ __('app.View') }}">--}}
{{--                    <i class="fas fa-eye"></i>--}}
{{--                </a>--}}

                <a class="btn btn-sm btn-icon-only btn-outline-primary"
                   href="{{ route('admin.queuing_statuses.edit', ['id' => $item->id]) }}"
                   title="{{ __('app.Edit') }}">
                    <i class="far fa-edit"></i>
                </a>
                @if($item->id !== 1)
                <a class="btn btn-sm btn-icon-only btn-outline-danger delete"
                   href="javascript:void(0)"
                   title="{{ __('app.Destroy') }}"
                   data-toggle="modal"
                   data-target="#itemDeleteModal">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </td>
        </tr>
    @empty
        @include('admin.components._empty')
    @endforelse
    </tbody>
</table>
