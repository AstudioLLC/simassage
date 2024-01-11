@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/demo-modals.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/demo-modals.js') }}"></script>
@endpush

<button type="button" class="modal-fundraiser-btn donate-modal-btn d-none"></button>
<div class="donate-modal justify-content-center align-items-center fundraiser">
    <div class="donate-modal-white donate-modal-white-fundraiser d-flex align-items-center position-relative">
        <div class="donate-modal-content d-flex flex-column align-items-center">
            <span class="title-usual text-center"></span>
            <span class="description-usual"></span>
            <div class="fundraiser-btn-group">
                <a class="button-orange text-decoration-none create-fundraiser-url" href="javscript:void(0)">
                    {{ __('frontend.cabinet.Create') }}
                </a>
                <a class="button-orange text-decoration-none ms-1 ms-md-3 fundraiser-button-2">
                    {{ __('frontend.cabinet.Close') }}
                </a>
            </div>
        </div>
        <div class="donate-modal-close d-flex justify-content-center align-items-center position-absolute">
            <img class="w-100" src="{{ asset('images/close.svg') }}" alt="{{ __('frontend.cabinet.Close') }}" title="{{ __('frontend.cabinet.Close') }}">
        </div>
    </div>
</div>
