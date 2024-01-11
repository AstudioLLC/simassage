<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.ID') }}</th>
        <th>{{ __('app.List.Name') }}</th>
        <th>{{ __('app.List.Show in home') }}</th>
        <th>{{ __('app.List.Date') }}</th>
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.departments.sort') }}">

    @forelse($items as $item)

        <tr data-id="{{ $item->id }}" class="item-row">
            <td class="item-title">{{ $item->id }}</td>
            <td class="item-title">{{ $item->title }}</td>
            <td>
                <label class="custom-toggle active-changer">
                    <input type="checkbox" value="{{ $item->active }}" {{ $item->active ? ' checked' : '' }}>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </td>
            <td class="item-title">{{ $item->created_at->format('d/m/Y') }}</td>
            <td class="text-right">

                @if($item->id == 3)
                <a class="btn btn-sm btn-icon-only btn-outline-default"
                   href="{{ route('admin.departments.service', ['parentId' => $parentId]) }}"
                   title="Main content" >
                    <i class="fas fa-eye-dropper"></i>
                </a>
                @elseif($item->id == 5)
                    <a class="btn btn-sm btn-icon-only btn-outline-default"
                       href="{{ route('admin.departments.personnel', ['parentId' => $parentId]) }}"
                       title="Main content">
                        <i class="fas fa-eye-dropper"></i>
                    </a>
                @elseif($item->id == 4)
                    <a class="btn btn-sm btn-icon-only btn-outline-default"
                       href="{{ route('admin.departments.price', ['parentId' => $parentId]) }}"
                       title="Main content">
                        <i class="fas fa-eye-dropper"></i>
                    </a>
                @elseif($item->id == 1)
                    <a class="btn btn-sm btn-icon-only btn-outline-default"
                       href="{{ route('admin.departmentsInformation.edit', ['id' => $parentId]) }}"
                       title="Main content">
                        <i class="fas fa-eye-dropper"></i>
                    </a>
                @endif
                <a class="btn btn-sm btn-icon-only btn-outline-default"
                   href="{{ route('admin.gallery.index', ['gallery' => 'departments', 'key' => $item->id]) }}"
                   title="{{ __('app.Gallery') }} ({{ $item->gallery_count }})">
                    <i class="far fa-images"></i>
                </a>
                @if($item->static == null)
                    <a class="btn btn-sm btn-icon-only btn-outline-primary"
                       href="{{ route('admin.departments.edit', ['id' => $item->id]) }}"
                       title="{{ __('app.Edit') }}">
                        <i class="far fa-edit"></i>
                    </a>
                @endif
                @if($item->id >5)
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
