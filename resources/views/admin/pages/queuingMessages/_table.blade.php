<style>
    .thead-light th:nth-child(6){
        width: 200px !important;
    }
</style>
<table class="table align-items-center table-flush dataTable">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.ID') }}</th>
        <th>{{ __('app.List.Name') }}</th>
        <th>{{ __('app.List.Email') }}</th>
        <th>{{ __('app.List.Date') }}</th>
        <th>Status</th>
        {{-- <th>Comment</th> --}}
        <th>{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list">
        <div class="alert-container"></div>
    </tbody>    

    <div class="mb-3 ">
        <span>Filter by status</span>
        <select class="border border-none" id="statusFilter">
            <option value="0">All</option>
            @foreach ($statusData as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
</table>
