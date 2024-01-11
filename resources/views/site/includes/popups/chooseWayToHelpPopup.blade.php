@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/demo-modals.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/demo-modals.js') }}"></script>
    <script>
        $('.open-chooseWayToHelpPopup').click(function () {
            $('.modal-corporate-btn').click();
        })
    </script>
@endpush

<button type="button" class="modal-corporate-btn donate-modal-btn d-none"></button>

<div class="donate-modal justify-content-center align-items-center corporate-partnership-donate">
    <div class="donate-modal-white donate-modal-white-corporate d-flex flex-column align-items-center position-relative">
        <div class="donate-modal-content w-100 d-flex flex-column align-items-center">
            <span class="title-usual text-center">{{ $item->title ?? null }}</span>
            <span class="description-usual text-center">{{ __('frontend.Choose your way to help') }}</span>
        </div>
        <div class="row w-100 mt-3">
            @if(isset($becomeSponsor))
                <div class="col-12 col-sm-6 p-2 p-md-3">
                    <a href="{{--{{ //TODO add become a sponsor route from cabinet }}--}}" class="d-flex justify-content-center flex-column align-items-center help-link text-decoration-none">
                        <div class="d-block help-picture">
                            @if($becomeSponsor->icon)
                                <img class="img-fluid"
                                     src="{{ $becomeSponsor->getImageUrl('thumbnail', $becomeSponsor->icon) }}"
                                     alt="{{ $becomeSponsor->title }}"
                                     title="{{ $becomeSponsor->title }}">
                            @endif
                        </div>
                        <span class="help-box-name">{{ $becomeSponsor->title ?? null }}</span>
                    </a>
                </div>
            @endif
            @if(isset($donate))
                <div class="col-12 col-sm-6 p-2 p-md-3">
                    <a href="{{ route('fundraisers.create', ['url' => $item->url ?? null]) }}" class="d-flex justify-content-center flex-column align-items-center help-link text-decoration-none">
                        <div class="d-block help-picture">
                            @if($donate->icon)
                                <img class="img-fluid"
                                     src="{{ $donate->getImageUrl('thumbnail', $donate->icon) }}"
                                     alt="{{ $donate->title }}"
                                     title="{{ $donate->title }}">
                            @endif
                        </div>
                        <span class="help-box-name">{{ $donate->title ?? null }}</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="donate-modal-close d-flex justify-content-center align-items-center position-absolute">
            <img class="w-100"
                 src="{{ asset('images/close.svg') }}"
                 alt="{{ __('frontend.cabinet.Close') }}"
                 title="{{ __('frontend.cabinet.Close') }}">
        </div>
    </div>
</div>
