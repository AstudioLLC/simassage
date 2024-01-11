<div class="search-block d-flex justify-content-center align-items-center">
    <div class="search-form-wrap">
        <form class="search-form" id="search" method="get" action="{{--{{ route('search') }}--}}">
            <button type="submit" class="search-submit-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M23.707,22.3l-6.825-6.825a9.518,9.518,0,1,0-1.414,1.414l6.825,6.825A1,1,0,1,0,23.707,22.3ZM9.5,17A7.5,7.5,0,1,1,17,9.5,7.508,7.508,0,0,1,9.5,17Z" transform="translate(0 -0.003)" fill="#0A0A0A"/>
                </svg>
            </button>
            <input type="text"
                   name="searchQuery"
                   class="search-input"
                   placeholder="{{ __('frontend.What can we help you find?') }}"
                   value="{{ request()->query('searchQuery') }}">
        </form>
        <div class="search-form-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <path d="M11.1,10l8.666-8.666a.781.781,0,0,0-1.1-1.1L10,8.9,1.333.23a.781.781,0,0,0-1.1,1.1L8.895,10,.229,18.667a.781.781,0,0,0,1.1,1.1L10,11.106l8.666,8.666a.781.781,0,0,0,1.1-1.1Z"                                                          transform="translate(0 -0.001)" fill="#0a0a0a"/>
            </svg>
        </div>
    </div>
</div>
