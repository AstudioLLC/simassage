@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/demo-modals.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/demo-modals.js') }}"></script>
@endpush

<button type="button" class="modal-thank-you-btn donate-modal-btn d-none"></button>

<div class="donate-modal justify-content-center align-items-center thank-you">
    <div class="donate-modal-white donate-modal-white-thank-you d-flex align-items-center position-relative">
        <div class="modal-image">
            <img class="w-100" src="{{ asset('images/thank-you.png') }}" alt="" title="">
        </div>
        <div class="donate-modal-content d-flex flex-column align-items-center thank-you-modal-content">
            <span class="title-usual">{{ __('frontend.Payment.Thank you') }}</span>
            <span class="description-usual">
                {!! __('frontend.Payment.Success text') !!}
            </span>
            @include('site.components.share')
        </div>
        <div class="donate-modal-close d-flex justify-content-center align-items-center position-absolute">
            <img class="w-100" src="{{ asset('images/close.svg') }}" alt="{{ __('frontend.cabinet.Close') }}" title="{{ __('frontend.cabinet.Close') }}">
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $(".modal-thank-you-btn").click();
        });
    </script>
@endpush
