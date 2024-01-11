<table class="table align-items-center table-flush dataTable">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.ID') }}</th>
        <th>{{ __('app.List.Name') }}</th>
        <th>{{ __('app.List.Status') }}</th>
        <th>{{ __('app.List.Date') }}</th>
        <th>{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.news.sort') }}">

    </tbody>
</table>
