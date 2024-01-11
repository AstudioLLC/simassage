@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ asset('image/og_default.jpg') }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current() }}" />
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ asset('image/og_default.jpg') }}">
@endsection

@section('content')
    @if (session()->has('open_modal_contact'))
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" id="myModal">
            <div class="modal-content" >
                <div class="modal-body">
                    {{$notifyText->contact_message }}
                    <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
  @endif

<section class="contact-page-section">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="contact-page-info">
            <div style="position:relative;overflow:hidden;" class="map contact-page-map">
                <iframe src="{{ $information->map }}"
                        width="100%" height="400" frameborder="1" allowfullscreen="true"
                        style="position:relative;">
                </iframe>
            </div>
            <div class="contact-page-soc-div">
                <div class="contact-page-text">
                    <p>{!! $information->short !!} </p>
                </div>
                <div class="contact-page-soc-item geo-mail">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 17 17" fill="none">
                        <g clip-path="url(#clip0_47_1482)">
                            <path d="M8.50019 17C8.37979 17.0005 8.26047 16.9774 8.14903 16.9318C8.0376 16.8862 7.93623 16.8191 7.85074 16.7343L3.48386 12.3675C2.79438 11.6818 2.2486 10.8655 1.87847 9.96625C1.50835 9.06705 1.32131 8.10305 1.32831 7.13068C1.32534 6.18923 1.51023 5.25665 1.87215 4.38755C2.23407 3.51844 2.76575 2.73027 3.43605 2.06919C4.78984 0.746428 6.60745 0.00585937 8.50019 0.00585938C10.3929 0.00585938 12.2105 0.746428 13.5643 2.06919C14.2346 2.73027 14.7663 3.51844 15.1282 4.38755C15.4901 5.25665 15.675 6.18923 15.6721 7.13068C15.6791 8.10305 15.492 9.06705 15.1219 9.96625C14.7518 10.8655 14.206 11.6818 13.5165 12.3675L9.14964 16.7264C9.0648 16.8126 8.96373 16.8811 8.85227 16.9281C8.7408 16.9751 8.62114 16.9995 8.50019 17ZM8.50019 0.79685C6.81491 0.792968 5.19611 1.45395 3.99519 2.6363C3.40024 3.22369 2.92842 3.92384 2.60732 4.69578C2.28623 5.46773 2.12232 6.29595 2.12519 7.13201C2.11881 7.99926 2.2855 8.85908 2.61548 9.66113C2.94547 10.4632 3.43213 11.1914 4.04699 11.803L8.41253 16.1619C8.42381 16.1736 8.43732 16.1829 8.45227 16.1893C8.46721 16.1956 8.48329 16.1989 8.49953 16.1989C8.51576 16.1989 8.53184 16.1956 8.54678 16.1893C8.56173 16.1829 8.57524 16.1736 8.58652 16.1619L12.9534 11.803C13.5682 11.1914 14.0549 10.4632 14.3849 9.66113C14.7149 8.85908 14.8816 7.99926 14.8752 7.13201C14.8781 6.29595 14.7141 5.46773 14.3931 4.69578C14.072 3.92384 13.6001 3.22369 13.0052 2.6363C11.8043 1.45395 10.1855 0.792968 8.50019 0.79685Z" fill="white"/>
                            <path d="M8.50027 10.8125C7.66319 10.8121 6.85212 10.5216 6.2052 9.99034C5.55828 9.45911 5.1155 8.72006 4.95228 7.89904C4.78906 7.07802 4.91549 6.22581 5.31004 5.48754C5.70459 4.74927 6.34285 4.17059 7.11613 3.85006C7.88942 3.52953 8.7499 3.48696 9.55105 3.72961C10.3522 3.97225 11.0445 4.48511 11.5099 5.18084C11.9754 5.87657 12.1853 6.71214 12.104 7.54526C12.0226 8.37838 11.6549 9.15752 11.0636 9.75C10.7273 10.0871 10.3277 10.3545 9.88787 10.5369C9.44799 10.7192 8.97644 10.8129 8.50027 10.8125ZM8.50027 4.37242C7.84716 4.37346 7.2146 4.60088 6.71033 5.01594C6.20607 5.431 5.86128 6.00804 5.7347 6.64878C5.60813 7.28951 5.70758 7.95431 6.01613 8.52995C6.32467 9.10558 6.82323 9.55646 7.42689 9.80578C8.03055 10.0551 8.70197 10.0874 9.32679 9.8973C9.95162 9.70716 10.4912 9.30629 10.8537 8.76298C11.2161 8.21966 11.379 7.5675 11.3146 6.91757C11.2502 6.26763 10.9625 5.66013 10.5004 5.19852C10.2378 4.936 9.9259 4.7279 9.58267 4.58615C9.23945 4.44439 8.87162 4.37176 8.50027 4.37242Z" fill="white"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_47_1482">
                                <rect width="17" height="17" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <div>
                        <p class="address-title">{{t('Page home.Our address')}}</p>
                        <p class="address-text">{{$information->address}}</p>
                    </div>
                </div>
                <div class="contact-page-soc-item geo-mail">
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 15 15" fill="none">
                        <g clip-path="url(#clip0_47_1489)">
                            <path d="M13.6797 3.7297C13.6521 3.69268 13.6174 3.66146 13.5778 3.63782C13.5381 3.61419 13.4941 3.59861 13.4484 3.59197C13.4027 3.58534 13.3561 3.58777 13.3114 3.59913C13.2666 3.6105 13.2245 3.63058 13.1875 3.65822L7.51681 7.89103C7.49652 7.90624 7.47185 7.91447 7.4465 7.91447C7.42114 7.91447 7.39647 7.90624 7.37618 7.89103L1.81681 3.63947C1.78011 3.61146 1.73824 3.59095 1.69362 3.57912C1.64899 3.56729 1.60247 3.56437 1.55671 3.57051C1.51095 3.57666 1.46685 3.59176 1.42693 3.61495C1.38701 3.63815 1.35204 3.66897 1.32404 3.70568C1.29603 3.74238 1.27552 3.78424 1.26369 3.82887C1.25186 3.8735 1.24894 3.92002 1.25508 3.96578C1.26123 4.01153 1.27633 4.05563 1.29952 4.09556C1.32272 4.13548 1.35354 4.17044 1.39025 4.19845L5.76134 7.54181L1.43829 10.7996C1.40105 10.8274 1.36965 10.8622 1.34587 10.9022C1.32209 10.9421 1.30641 10.9863 1.29972 11.0323C1.29302 11.0782 1.29545 11.1251 1.30686 11.1701C1.31828 11.2151 1.33845 11.2575 1.36622 11.2947C1.394 11.332 1.42884 11.3634 1.46876 11.3872C1.50867 11.4109 1.55288 11.4266 1.59886 11.4333C1.64483 11.44 1.69168 11.4376 1.73671 11.4262C1.78175 11.4148 1.8241 11.3946 1.86134 11.3668L6.34142 7.98478L6.94845 8.45353C7.08999 8.56187 7.26297 8.62116 7.44122 8.62243C7.61946 8.6237 7.79327 8.56688 7.93634 8.46056L8.57384 7.98478L13.1067 11.3668C13.1437 11.3944 13.1858 11.4145 13.2305 11.4259C13.2753 11.4372 13.3218 11.4396 13.3676 11.433C13.4133 11.4264 13.4572 11.4108 13.4969 11.3872C13.5366 11.3635 13.5712 11.3323 13.5988 11.2953C13.6265 11.2583 13.6465 11.2162 13.6579 11.1715C13.6692 11.1267 13.6717 11.0801 13.665 11.0344C13.6584 10.9887 13.6428 10.9448 13.6192 10.9051C13.5956 10.8654 13.5644 10.8308 13.5274 10.8031L9.16095 7.54064L13.6082 4.21837C13.682 4.16267 13.7308 4.08016 13.7442 3.9887C13.7576 3.89724 13.7344 3.8042 13.6797 3.7297Z" fill="white"/>
                            <path d="M13.2422 2.22656H1.75781C1.29161 2.22656 0.844505 2.41176 0.514851 2.74141C0.185198 3.07107 0 3.51817 0 3.98438L0 11.0156C0 11.4818 0.185198 11.9289 0.514851 12.2586C0.844505 12.5882 1.29161 12.7734 1.75781 12.7734H13.2422C13.7084 12.7734 14.1555 12.5882 14.4851 12.2586C14.8148 11.9289 15 11.4818 15 11.0156V3.98438C15 3.51817 14.8148 3.07107 14.4851 2.74141C14.1555 2.41176 13.7084 2.22656 13.2422 2.22656ZM14.2969 11.0156C14.2969 11.2953 14.1858 11.5636 13.988 11.7614C13.7902 11.9592 13.5219 12.0703 13.2422 12.0703H1.75781C1.47809 12.0703 1.20983 11.9592 1.01204 11.7614C0.814244 11.5636 0.703125 11.2953 0.703125 11.0156V3.98438C0.703125 3.70465 0.814244 3.43639 1.01204 3.2386C1.20983 3.04081 1.47809 2.92969 1.75781 2.92969H13.2422C13.5219 2.92969 13.7902 3.04081 13.988 3.2386C14.1858 3.43639 14.2969 3.70465 14.2969 3.98438V11.0156Z" fill="white"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_47_1489">
                                <rect width="15" height="15" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <div>
                        <p class="address-title">{{t('Page home.Email address')}}</p>
                        <p class="address-text">{{$information->email}}</p>
                    </div>
                </div>
                <div class="contact-page-soc-item geo-mail">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <g clip-path="url(#clip0_47_1496)">
                            <path d="M17.1354 12.906L14.9574 10.71C14.5974 10.35 14.1114 10.134 13.6614 10.134C13.1754 10.134 12.7434 10.332 12.3654 10.71L11.1054 11.97C11.0514 11.934 10.9794 11.898 10.9254 11.88C10.9254 11.88 10.9074 11.88 10.9074 11.862L10.8894 11.844C10.7274 11.736 10.5474 11.628 10.3314 11.538C9.23342 10.854 8.20742 9.89995 7.16342 8.62195C6.67742 8.00995 6.33542 7.46995 6.06542 6.87595C6.35342 6.64195 6.56942 6.40795 6.73142 6.22795L7.28942 5.66995C7.72142 5.27395 7.93742 4.82395 7.93742 4.35595C7.93742 3.86995 7.72142 3.41995 7.30742 2.98795L5.59742 1.27795C5.43542 1.11595 5.27342 0.953953 5.09342 0.791953C4.73342 0.449953 4.28342 0.251953 3.81542 0.251953C3.29342 0.251953 2.86142 0.431953 2.46542 0.827953L1.15142 2.14195C0.629424 2.62795 0.323424 3.23995 0.251424 3.99595V4.01395C0.215424 4.94995 0.359423 5.81395 0.755423 6.89395C1.38542 8.58595 2.33942 10.17 3.76142 11.916C5.61542 14.004 7.70342 15.624 10.0254 16.74L10.0794 16.758C10.7634 17.064 12.0594 17.64 13.4994 17.73H13.6974C14.6514 17.73 15.3714 17.424 15.9654 16.776C16.1814 16.524 16.4154 16.29 16.6134 16.074C16.7754 15.948 16.8834 15.822 16.9914 15.696L17.1354 15.552L17.1714 15.516C17.9274 14.688 17.9274 13.68 17.1354 12.906ZM16.5054 14.904L16.3254 15.084L16.3074 15.12C16.2174 15.228 16.1454 15.318 16.0554 15.39L16.0014 15.444C15.7854 15.66 15.5334 15.912 15.2814 16.2C14.8674 16.65 14.3994 16.848 13.6974 16.848H13.5534C12.2934 16.758 11.1414 16.254 10.4574 15.948L10.4214 15.93C8.20742 14.868 6.20942 13.32 4.46342 11.34C3.09542 9.68395 2.19542 8.17195 1.60142 6.58795C1.24142 5.59795 1.11542 4.87795 1.15142 4.06795C1.20542 3.54595 1.40342 3.13195 1.76342 2.80795L3.09542 1.47595C3.31142 1.25995 3.52742 1.16995 3.79742 1.16995C4.03142 1.16995 4.24742 1.27795 4.44542 1.45795L4.46342 1.47595C4.62542 1.61995 4.78742 1.78195 4.94942 1.94395L6.65942 3.65395C6.98342 3.97795 7.03742 4.22995 7.03742 4.37395C7.03742 4.51795 7.00142 4.73395 6.65942 5.03995L6.08342 5.61595C5.88542 5.83195 5.65142 6.06595 5.34542 6.31795L5.30942 6.35395L5.27342 6.40795C5.11142 6.62395 5.09342 6.82195 5.18342 7.10995L5.20142 7.18195L5.21942 7.25395C5.52542 7.91995 5.90342 8.53195 6.44342 9.21595C7.55942 10.584 8.67542 11.61 9.86342 12.348L9.91742 12.384C10.0614 12.456 10.2054 12.528 10.3314 12.6C10.3854 12.654 10.4574 12.69 10.5114 12.708C10.5834 12.744 10.6374 12.762 10.6734 12.798L10.7994 12.888H10.8354L10.8894 12.906C10.9974 12.942 11.0694 12.942 11.1234 12.942C11.3034 12.942 11.4654 12.87 11.6274 12.708L12.9774 11.358C13.1934 11.142 13.3914 11.052 13.6434 11.052C13.9134 11.052 14.1654 11.214 14.3094 11.358L16.5054 13.554C16.9374 13.986 16.9554 14.436 16.5054 14.904Z" fill="white"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_47_1496">
                                <rect width="18" height="18" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <div>
                        <p class="address-title">{{t('Page home.Phone')}}</p>
                        <p class="address-text">{{$information->phone}}</p>
                    </div>

                </div>
                <div class="footer-soc-icon">
                    @if(isset($socials))
                        @foreach($socials as $social)
                            <div class="footer-soc-item">
                                <a class="soc-icon-item" href="{{$social->url}}" target="_blank">
                                    <img src="{{ $social->getImageUrl('thumbnail') }}" alt="{{$social->title}}" title="{{$social->title}}">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
        <form class="contacts__form form" method="post" action="{{ route('contact.send_message') }}"
              name="contacts">
            @csrf
            <div class="form__body">
                <div class="form__input group">
                    <input class="group__field" name="name" type="text" required>
                    <label class="group__label" for="name">{{ t('Page home.Name surname') }}<span>*</span></label>
                    @if ($errors->has('name'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form__input group">
                    <input class="group__field" name="phone" type="number" required>
                    <label class="group__label" for="phone">{{ t('Page home.Phone') }}<span>*</span></label>
                    @if ($errors->has('phone'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form__input group">
                    <input class="group__field" name="email" type="email" required>
                    <label class="group__label" for="email">{{ t('Page home.Email address') }}<span>*</span></label>
                    @if ($errors->has('email'))
                        <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form__textarea group">
                    <textarea class="group__field" name="message" rows="1"></textarea>
                    <label class="group__label" for="message">{{t('Page static contacts.message')}}</label>
                    @if ($errors->has('message'))
                        <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
            <div class="form__footer">
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_Key') }}"></div>
                <button class="form__submit">
                    <p>{{ t('Page home.Send') }}</p>
                </button>
            </div>
        </form>
    </div>
</section>
@push('js')
    <script>
        // Use JavaScript to show the modal when the page loads
        $(document).ready(function(){
            $('#exampleModalCenter').removeClass('fade');

            $('#exampleModalCenter').addClass('show');
        });
        window.addEventListener('click', function(e) {
            $('#exampleModalCenter').addClass('fade');

            $('#exampleModalCenter').removeClass('show');
        })
    </script>
@endpush
@endsection
