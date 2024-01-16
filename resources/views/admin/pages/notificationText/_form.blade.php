@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.notificationText.edit', ['id' => $item->id]) : route('admin.notificationText.store') !!}" method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title',
                'tp_classes' => 'little-p',
                'title' => __('app.Thanks Notification')])
                <input type="text"
                       name="thanks_message[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('thanks_message') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Thanks Notification') }}"
                       value="{{ old('thanks_message.'.$iso, tr($item, 'thanks_message', $iso)) }}">
                @if ($errors->has('contact_message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('thanks_message') }}</strong>
                    </span>
                @endif
                @endbylang

            </div>

            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title1',
                'tp_classes' => 'little-p',
                'title' => __('app.Contact Notification')])
                <input type="text"
                       name="contact_message[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('contact_message') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Contact Notification') }}"
                       value="{{ old('contact_message.'.$iso, tr($item, 'contact_message', $iso)) }}">
                @if ($errors->has('contact_message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_message') }}</strong>
                    </span>
                @endif
                @endbylang

            </div>
            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title3',
                'tp_classes' => 'little-p',
                'title' => __('app.Thanks Notification')])
                <input type="text"
                       name="adult_message[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('adult_message') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('Adult Notification') }}"
                       value="{{ old('adult_message.'.$iso, tr($item, 'adult_message', $iso)) }}">
                @if ($errors->has('adult_message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('adult_message') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
            @submit(['title' => null])@endsubmit
        </div>
</form>
