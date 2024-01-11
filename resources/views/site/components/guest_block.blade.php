<div class="col-12 col-md-6">
    <div class="auth-form-block guest d-flex flex-column align-items-center">
        <span class="title-usual">{{ __('frontend.Guest') }}</span>
        <div class="guest-image-wrap">
            <img class="img-fluid"
                 src="{{ asset('images/guest.png') }}"
                 alt="{{ __('frontend.Guest') }}"
                 title="{{ __('frontend.Guest') }}">
        </div>
        <button type="button" class="button-orange">
            <a href="{{ isset($url) ? $url : null }}" class="text-decoration-none text-white">
                {{ __('frontend.Continue as guest') }}
            </a>
        </button>
    </div>
</div>
