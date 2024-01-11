@php
    $name = $name ?? 'file';
    $id = $id ?? $name ?? 'file';
    $title = $title ?? __('app.Form.Select File');
    $browse = $browse ?? __('app.Form.Browse');
@endphp
@push('css')
    <style>
        .custom-file-input#{{ $id }} ~ .custom-file-label::after{
            content: '{{ $browse }}';
        }
    </style>
@endpush

{{--<div class="custom-file">--}}
    <input type="file" class="dropify" data-height="200" id="{{ $id }}" name="{{ $name }}" @if(!empty($multiple)) multiple="multiple" @endif>
{{--    <label class="custom-file-label" for="{{ $id }}">{{ $title }}</label>--}}
{{--</div>--}}

