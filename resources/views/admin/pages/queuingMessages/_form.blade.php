@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.queuing_message.edit', ['id' => $item->id]) : route('admin.queuing_message.store') !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if (isset($item->doctor_name))
        <p>Booked to the masseuse {{ $item->doctor_name }}</p>
    @endif
    <div class="col-12 col-lg-6">
        <div class="form-group d-flex">
            <span class="mt-2 mr-2">Status </span>
            <div class="ststus-select mt-2"></div>
        </div>
    </div>
    <div class="row flex-column">
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.List.Name')])@endformTitle
                <div class="card-body p-2">
                    <input type="text" name="name"
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                        id="name" disabled placeholder="{{ __('app.List.Name') }}"
                        value="{{ old('name', $item->name ?? null) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Email')])@endformTitle
                <div class="card-body p-2">
                    <input type="email" name="email" disabled
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        id="email" placeholder="{{ __('app.Form.Email') }}"
                        value="{{ old('email', $item->email ?? null) }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Form.Phone')])@endformTitle
                <div class="card-body p-2">
                    <input type="text" name="phone" disabled
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                        id="phone" placeholder="{{ __('app.Form.Phone') }}"
                        value="{{ old('phone', $item->phone ?? null) }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Day'])@endformTitle
                <div class="card-body p-2">
                    <input type="text" name="day" disabled
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('day') ? ' is-invalid' : '' }}"
                        id="day" placeholder="Day" value="{{ old('day', $item->day ?? null) }}">
                    @if ($errors->has('day'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('day') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Time'])@endformTitle
                <div class="card-body p-2">
                    <input type="text" name="time" disabled
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('time') ? ' is-invalid' : '' }}"
                        id="time" placeholder="Time" value="{{ old('time', $item->time ?? null) }}">
                    @if ($errors->has('time'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-6">
            <div class="form-group border-bottom">
                @formTitle(['title' => 'Service'])@endformTitle
                <div class="card-body p-2">
                    <input type="text" disabled name="service"
                        class="form-control form-control-sm form-control-alternative{{ $errors->has('service') ? ' is-invalid' : '' }}"
                        id="service" placeholder="Service" value="{{ old('service', $item->service ?? null) }}">
                    @if ($errors->has('service'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('service') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            @formTitle(['title' => __('app.Form.Message')])@endformTitle
            <div class="card-body p-2">
                <textarea name="message"
                    class=" form-control form-control-sm form-control-alternative{{ $errors->has('message') ? ' is-invalid' : '' }}"
                    rows="5" disabled placeholder="{{ __('app.Form.Message') }}">{{ old('message', $item->message ?? null) }}</textarea>
                @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6 mt-3">
        <div class="card">
            @formTitle(['title' => __('app.Form.Add Comment')])@endformTitle
            <div class="card-body p-2">
                <textarea name="comment"
                    class=" form-control form-control-sm form-control-alternative{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                    rows="5" placeholder="{{ __('app.Form.Add Comment') }}">{{ old('comment', $item->comment ?? null) }}</textarea>
                @if ($errors->has('comment'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        @submit(['title' => null])@endsubmit
    </div>

    </div>
</form>

@push('js')
    <script>
        $(document).ready(function() {
            // Fetch the statuses
            $.ajax({
                url: "{{ route('admin.queuing_message.listStatus') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var selectOptions =
                        '<select name="status_id" class="status_select" style="border:none;">';
                    for (var i = 0; i < response.length; i++) {
                        var status = response[i];
                        var selected = "{{ $item->status_id ?? null }}" == status.id ? "selected" : "";
                        selectOptions += '<option class="option" value="' + status.id + '" ' +
                            selected + '>' + status.name + '</option>';
                    }
                    selectOptions += '</select>';
                    $('.ststus-select').html(selectOptions);
                }
            });

            // Update the status when the select option changes
            $(document).on('change', '.status_select', function() {
                var selectedStatus = $(this).val();
                var rowId = {{ $item->id }};
                // Perform the update logic using Ajax
                $.ajax({
                    url: '{{ route('admin.queuing_message.updateStatus') }}',
                    type: 'POST',
                    data: {
                        id: rowId,
                        status_id: selectedStatus
                    },
                    success: function(response) {
                        setTimeout(function() {
                            location.reload();
                        }, 10);
                    },
                    error: function(xhr, status, error) {
                        console.log('Status update request error:', error);
                    }
                });
            });

        });
    </script>
@endpush
