@if(isset($title))
    @formTitle(['title' => $title])@endformTitle
@endif
<div class="card-body">
    <div class="custom-control custom-checkbox">
        <input type="checkbox"
               class="custom-control-input{{ $errors->has($name ?? $id) ? ' is-invalid' : '' }}"
               {!! exists('id="', $id, '"') !!}
               name="{{ $name ?? $id }}" {{ $checked }}>
        <label class="custom-control-label" for="{{ $id ?? '' }}">{{ $label ?? '' }}</label>
    </div>
    @if ($errors->has($name ?? $id))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name ?? $id) }}</strong>
        </span>
    @endif
</div>
