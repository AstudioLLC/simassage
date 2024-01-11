<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.Language form.Short name') }}</th>
        <th>{{ __('app.Language form.Name') }}</th>
        <th>{{ __('app.Language form.Page language') }}</th>
        <th>{{ __('app.Language form.Admin language') }}</th>
        <th>{{ __('app.Language form.Url language') }}</th>
        <th>{{ __('app.Active') }}</th>
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.languages.sort') }}">
    @forelse ($items as $item)
        <tr data-id="{{ $item->id }}" class="item-row">
            <td>{{ $item->iso }}</td>
            <td>{{ $item->title }}</td>
            <td>
                <label class="custom-toggle language-default">
                    <input type="checkbox" value="{{ $item->default }}" {{ $item->default ? ' checked' : '' }}>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </td>
            <td>
                <label class="custom-toggle language-admin">
                    <input type="checkbox" value="{{ $item->admin }}" {{ $item->admin ? ' checked' : '' }}>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </td>
            <td>
                <label class="custom-toggle language-url">
                    <input type="checkbox" value="{{ $item->url }}" {{ $item->url ? ' checked' : '' }}>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </td>
            <td>
                <label class="custom-toggle language-active">
                    <input type="checkbox" value="{{ $item->active }}" {{ $item->active ? ' checked' : '' }}>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>
            </td>
            <td class="text-right">
                <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only btn-outline-info"
                       href="{{ route('admin.languages.show', ['id' => $item->id]) }}"
                       title="{{ __('app.View') }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-icon-only btn-outline-primary"
                       href="{{ route('admin.languages.edit', ['id' => $item->id]) }}"
                       title="{{ __('app.Edit') }}">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(!$item->default && !$item->admin && !$item->url)
                        <a class="btn btn-sm btn-icon-only btn-outline-danger delete"
                           href="javascript:void(0)"
                           title="{{ __('app.Destroy') }}"
                           data-toggle="modal"
                           data-target="#itemDeleteModal">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </td>
        </tr>
    @empty
        @include('admin.admin.components._empty')
    @endforelse
    </tbody>
</table>
