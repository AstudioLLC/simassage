<div class="footer-menu-wrap">
    <span class="footer-menu-name">{{ __('frontend.footer.Receive news from us') }}</span>
    <div class="footer-menu d-flex flex-column">
        <form class="footer-form d-flex align-items-center"
              id="footerform"
              method="POST"
              action="{{ route('subscriber.create') }}">
            @csrf
            <input class="footer-input"
                   type="email"
                   name="email"
                   required
                   value="{{ old('email') }}"
                   placeholder="{{ __('frontend.footer.Your e-mail address') }}">
            <button type="submit" class="footer-submit-btn d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22">
                    <g transform="translate(0 -4.688)">
                        <g transform="translate(0 4.688)">
                            <g transform="translate(0 0)">
                                <path d="M21.774,13.68,3.481,4.928A2.437,2.437,0,0,0,.242,6.04,2.372,2.372,0,0,0,.174,7.977l2.858,7.061H23A2.387,2.387,0,0,0,21.774,13.68Z" transform="translate(0 -4.688)" fill="#f86a04"/>
                            </g>
                        </g>
                        <g transform="translate(0.001 16.335)">
                            <path d="M3.062,259.9.2,266.966a2.394,2.394,0,0,0,1.36,3.12,2.435,2.435,0,0,0,1.947-.07L21.8,261.262A2.387,2.387,0,0,0,23.03,259.9Z" transform="translate(-0.032 -259.904)" fill="#f86a04"/>
                        </g>
                    </g>
                </svg>
            </button>
        </form>
    </div>
</div>
