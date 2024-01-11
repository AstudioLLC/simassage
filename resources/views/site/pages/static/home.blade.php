@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $page->seo_title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->seo_title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection
@section('content')
    @if (session()->has('open_modal'))
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" id="myModal">
                <div class="modal-content" >
                    <div class="modal-body">
                        {{$notifyText->thanks_message }}
                        <button type="button" class="close ml-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="slider-scetion">
        <div class="container-fluid" id="home">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="swiper-container parallaxSlider">
                        <div class="div-row">
                            <div class="div-row-two"></div>
                        </div>
                        <div class="swiper-wrapper">
                            @foreach($sliders as $slider)
                                <div class="swiper-slide">
                                    <div class="img-container one"
                                         style="background: url({{ $slider->getImageUrl('thumbnail') }})"></div>

                                    <div class="container h-100">
                                        <div class="row h-100">
                                            <div
                                                class="slider-text col-md-6 h-100 d-flex flex-column justify-content-end">
                                                <div class="display-2 bolder-900 text-uppercase text-white"
                                                     data-swiper-parallax="-200">
                                                    {{$slider->title}}
                                                </div>
                                                <div class="sld-btn">
                                                    <a href="{{$slider->url}}">
                                                        <button class="slider-btn" type="button">{{__('app.show_price')}}</button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="our-projects__btns">
                            <div class="our-projects__prev swiper-button-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.106" height="15.844"
                                     viewBox="0 0 18.106 15.844">
                                    <g id="Group_13095" data-name="Group 13095" transform="translate(-1595.488 -2390)">
                                        <g id="Group_6034" data-name="Group 6034" transform="translate(1595.488 2390)">
                                            <g id="Group_6033" data-name="Group 6033">
                                                <path id="Path_12704" data-name="Path 12704"
                                                      d="M1.621,10.546a.708.708,0,0,1,0-1l6.2-6.214a.707.707,0,0,0-1-1L.621,8.546a2.124,2.124,0,0,0,0,3l6.2,6.214a.707.707,0,0,0,1-1Z"
                                                      transform="translate(0 -2.124)" fill="#fff"/>
                                            </g>
                                        </g>
                                        <g id="Group_6036" data-name="Group 6036"
                                           transform="translate(1599.342 2397.215)">
                                            <g id="Group_6035" data-name="Group 6035">
                                                <path id="Path_12705" data-name="Path 12705"
                                                      d="M20.782,15.672H7.944a.707.707,0,0,0,0,1.415H20.782a.707.707,0,0,0,0-1.415Z"
                                                      transform="translate(-7.237 -15.672)" fill="#fff"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="our-projects__next swiper-button-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18.107" height="15.844"
                                     viewBox="0 0 18.107 15.844">
                                    <g id="Group_13094" data-name="Group 13094" transform="translate(-1648.406 -2390)">
                                        <g id="Group_6030" data-name="Group 6030" transform="translate(1658.486 2390)">
                                            <g id="Group_6029" data-name="Group 6029">
                                                <path id="Path_12702" data-name="Path 12702"
                                                      d="M6.406,10.546a.708.708,0,0,0,0-1L.207,3.331a.707.707,0,0,1,1-1l6.2,6.214a2.124,2.124,0,0,1,0,3l-6.2,6.214a.707.707,0,0,1-1-1Z"
                                                      transform="translate(0 -2.124)" fill="#fff"/>
                                            </g>
                                        </g>
                                        <g id="Group_6032" data-name="Group 6032"
                                           transform="translate(1648.406 2397.215)">
                                            <g id="Group_6031" data-name="Group 6031">
                                                <path id="Path_12703" data-name="Path 12703"
                                                      d="M7.944,15.672H20.782a.707.707,0,0,1,0,1.415H7.944a.707.707,0,0,1,0-1.415Z"
                                                      transform="translate(-7.237 -15.672)" fill="#fff"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-all-info">
                <div class="about-block" style="background: url({{asset('image/about-bg.png')}})">
                    <div class="about-section-info">
                        <div class="flower">
                            <img src="{{asset('image/flower-2.png')}}" alt="" class="img">
                        </div>

                        <p class="about-title">{{__('app.welcome')}}</p>
                        <div class="about-text-foto">
                            <div class="flower-under-foto">
                                <img src="{{ $about->getImageUrl('thumbnail') }}" alt="">
                                <div class="flower-one">
                                    <img src="{{asset('image/flower.png')}}" alt="" class="flower-web">
                                    <div class="flower-two">
                                        <img src="{{asset('image/flower.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="about-info">
                                <h1 class="about-block-title">{{$about->title_content_second}}</h1>
                                <p class="editor">
                                    {!!$about->content_second!!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-right-block">
                    <div class="about-small-block">
                        <p>{{$information->address}}</p>
                    </div>
                    <div class="about-flower">
                        <img src="{{asset('image/about-2-flower 1 1.png')}}" alt="">
                    </div>
                    <div class="address-block">
                        <div class="address-item">
                            <p class="address-title">{{__('app.working time')}}</p>
                            <p class="address-text">{{__('app.working day')}} 09-00 - 21-00</p>
                        </div>
                        <div class="address-item">
                            <p class="address-title">{{t('Page home.Phone')}}</p>
                            <p class="address-text">{{$information->phone}}</p>
                        </div>
                        <div class="address-item">
                            <p class="address-title">{{t('Page home.Email address')}}</p>
                            <p class="address-text">{{$information->email}}</p>
                        </div>
                        <div class="for-mob">
                            <div class="about-soc-item">
                                @if(isset($socials))
                                    @foreach($socials as $social)
                                        <div class="about-item">
                                            <a class="soc-icon-item" href="{{$social->url}}" target="_blank">
                                                <img src="{{ $social->getImageUrl('thumbnail') }}" alt="{{$social->title}}" title="{{$social->title}}">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="about-btn">
                                <button type="button">{{t('Page home.Online  Appointment')}}</button>
                            </div>
                        </div>

                    </div>
                    <div class="addres-only-foto">
                        <img src="{{asset('image/about-2-info-shape-bg 1.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{__('app.services')}}</h2>
            </div>
            <div class="services-block">
                <div class="swiper product-card-slider">
                    <div class="product-card swiper-wrapper">
                        @foreach($departments as $department)
                            <div class="product-card-item swiper-slide">
                                <a href="{{route('subpage', ['url' => $department->url])}}">
                                    <img src="{{ $department->getImageUrl('thumbnail', $department->icon) }}" alt=""
                                         class="img">
                                    <div class="service-card-info">
                                        <h3 class="service-item-title">{{$department->title}}</h3>
                                        <p class="service-card-text">{!! $department->title_content_second !!}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section">
        <div class="video-block">
            <img src="{{ $home->getImageUrl('thumbnail', $home->image) }}" alt="" class="img">
            <div class="video-info-block">
                <h3 class="video-title">{{__('app.relax')}}</h3>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="89" height="89" viewBox="0 0 89 89" fill="none">
                        <path
                            d="M32.0295 27.8578L58.0722 42.8934C59.1219 43.4996 59.1219 45.0153 58.0722 45.6214L32.0295 60.657C30.9797 61.2632 29.667 60.5053 29.667 59.293V29.2218C29.667 28.0095 30.9791 27.2517 32.0295 27.8578Z"
                            fill="white"/>
                        <path
                            d="M58.072 42.8938L32.0294 27.8582C31.8723 27.7679 31.7098 27.7166 31.5467 27.6836L56.7236 42.2196C57.7733 42.8257 57.7733 44.3414 56.7236 44.9476L30.6809 59.9832C30.4456 60.1187 30.1982 60.1774 29.9541 60.1861C30.3964 60.8186 31.2763 61.0916 32.0294 60.6574L58.072 45.6218C59.1218 45.0157 59.1218 43.5 58.072 42.8938Z"
                            fill="white"/>
                        <path
                            d="M32.0295 27.8578L58.0722 42.8934C59.1219 43.4996 59.1219 45.0153 58.0722 45.6214L32.0295 60.657C30.9797 61.2632 29.667 60.5053 29.667 59.293V29.2218C29.667 28.0095 30.9791 27.2517 32.0295 27.8578Z"
                            fill="white" stroke="black" stroke-miterlimit="10"/>
                        <rect x="0.5" y="0.5" width="88" height="88" stroke="white"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="staff-section">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{__('app.masseuses')}}</h2>
            </div>
            <div class="staff-block">
                <div class="swiper product-card-slider">
                    <div class="product-card swiper-wrapper">
                        @foreach($doctors as $doctor)
                            <div class="product-card-item swiper-slide">
                                <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}">
                                    @if(!$doctor->imageBig)
                                        <img class="img" src="{{asset('image/doctor_not_found.png')}}" alt="">
                                    @else
                                        <img src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}" alt=""
                                             class="img">
                                    @endif
                                    <div class="service-card-info">
                                        <h3 class="staff-item-title">{{$doctor->title}}</h3>
                                        <p class="staff-item-title">{{$doctor->position}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-block-foto">
                <img src="{{ $contact->getImageUrl('thumbnail', $contact->image)}}" alt="" class="img ">
                <div class="contact-info-block">
                    <div class="contact-item-first">
                        <img src="{{asset('image/contact-block.png')}}" alt="" class="img">
                        <div class="section-title">
                            <img src="{{asset('image/flower-2.png')}}" alt="">
                            <h2 class="section-title-text">{{__('app.Contact us')}}</h2>
                        </div>
                        <div class="editor">
                            {!! $information->short !!}
                        </div>
                        <div class="contact-address-block">
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_218)">
                                            <path
                                                d="M8.50019 17C8.37979 17.0005 8.26047 16.9774 8.14903 16.9318C8.0376 16.8862 7.93623 16.8191 7.85074 16.7343L3.48386 12.3675C2.79438 11.6818 2.2486 10.8655 1.87847 9.96625C1.50835 9.06705 1.32131 8.10305 1.32831 7.13068C1.32534 6.18923 1.51023 5.25665 1.87215 4.38755C2.23407 3.51844 2.76575 2.73027 3.43605 2.06919C4.78984 0.746428 6.60745 0.00585937 8.50019 0.00585938C10.3929 0.00585938 12.2105 0.746428 13.5643 2.06919C14.2346 2.73027 14.7663 3.51844 15.1282 4.38755C15.4901 5.25665 15.675 6.18923 15.6721 7.13068C15.6791 8.10305 15.492 9.06705 15.1219 9.96625C14.7518 10.8655 14.206 11.6818 13.5165 12.3675L9.14964 16.7264C9.0648 16.8126 8.96373 16.8811 8.85227 16.9281C8.7408 16.9751 8.62114 16.9995 8.50019 17ZM8.50019 0.79685C6.81491 0.792968 5.19611 1.45395 3.99519 2.6363C3.40024 3.22369 2.92842 3.92384 2.60732 4.69578C2.28623 5.46773 2.12232 6.29595 2.12519 7.13201C2.11881 7.99926 2.2855 8.85908 2.61548 9.66113C2.94547 10.4632 3.43213 11.1914 4.04699 11.803L8.41253 16.1619C8.42381 16.1736 8.43732 16.1829 8.45227 16.1893C8.46721 16.1956 8.48329 16.1989 8.49953 16.1989C8.51576 16.1989 8.53184 16.1956 8.54678 16.1893C8.56173 16.1829 8.57524 16.1736 8.58652 16.1619L12.9534 11.803C13.5682 11.1914 14.0549 10.4632 14.3849 9.66113C14.7149 8.85908 14.8816 7.99926 14.8752 7.13201C14.8781 6.29595 14.7141 5.46773 14.3931 4.69578C14.072 3.92384 13.6001 3.22369 13.0052 2.6363C11.8043 1.45395 10.1855 0.792968 8.50019 0.79685Z"
                                                fill="#800020"/>
                                            <path
                                                d="M8.50027 10.8125C7.66319 10.8121 6.85212 10.5216 6.2052 9.99034C5.55828 9.45911 5.1155 8.72006 4.95228 7.89904C4.78906 7.07802 4.91549 6.22581 5.31004 5.48754C5.70459 4.74927 6.34285 4.17059 7.11613 3.85006C7.88942 3.52953 8.7499 3.48696 9.55105 3.72961C10.3522 3.97225 11.0445 4.48511 11.5099 5.18084C11.9754 5.87657 12.1853 6.71214 12.104 7.54526C12.0226 8.37838 11.6549 9.15752 11.0636 9.75C10.7273 10.0871 10.3277 10.3545 9.88787 10.5369C9.44799 10.7192 8.97644 10.8129 8.50027 10.8125ZM8.50027 4.37242C7.84716 4.37346 7.2146 4.60088 6.71033 5.01594C6.20607 5.431 5.86128 6.00804 5.7347 6.64878C5.60813 7.28951 5.70758 7.95431 6.01613 8.52995C6.32467 9.10558 6.82323 9.55646 7.42689 9.80578C8.03055 10.0551 8.70197 10.0874 9.32679 9.8973C9.95162 9.70716 10.4912 9.30629 10.8537 8.76298C11.2161 8.21966 11.379 7.5675 11.3146 6.91757C11.2502 6.26763 10.9625 5.66013 10.5004 5.19852C10.2378 4.936 9.9259 4.7279 9.58267 4.58615C9.23945 4.44439 8.87162 4.37176 8.50027 4.37242Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_218">
                                                <rect width="17" height="17" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Our address')}}</p>
                                    <p class="address-text">{{$information->address}}</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_227)">
                                            <path
                                                d="M13.6797 3.7297C13.6521 3.69268 13.6174 3.66146 13.5778 3.63782C13.5381 3.61419 13.4941 3.59861 13.4484 3.59197C13.4027 3.58534 13.3561 3.58777 13.3114 3.59913C13.2666 3.6105 13.2245 3.63058 13.1875 3.65822L7.51681 7.89103C7.49652 7.90624 7.47185 7.91447 7.4465 7.91447C7.42114 7.91447 7.39647 7.90624 7.37618 7.89103L1.81681 3.63947C1.78011 3.61146 1.73824 3.59095 1.69362 3.57912C1.64899 3.56729 1.60247 3.56437 1.55671 3.57051C1.51095 3.57666 1.46685 3.59176 1.42693 3.61495C1.38701 3.63815 1.35204 3.66897 1.32404 3.70568C1.29603 3.74238 1.27552 3.78424 1.26369 3.82887C1.25186 3.8735 1.24894 3.92002 1.25508 3.96578C1.26123 4.01153 1.27633 4.05563 1.29952 4.09556C1.32272 4.13548 1.35354 4.17044 1.39025 4.19845L5.76134 7.54181L1.43829 10.7996C1.40105 10.8274 1.36965 10.8622 1.34587 10.9022C1.32209 10.9421 1.30641 10.9863 1.29972 11.0323C1.29302 11.0782 1.29545 11.1251 1.30686 11.1701C1.31828 11.2151 1.33845 11.2575 1.36622 11.2947C1.394 11.332 1.42884 11.3634 1.46876 11.3872C1.50867 11.4109 1.55288 11.4266 1.59886 11.4333C1.64483 11.44 1.69168 11.4376 1.73671 11.4262C1.78175 11.4148 1.8241 11.3946 1.86134 11.3668L6.34142 7.98478L6.94845 8.45353C7.08999 8.56187 7.26297 8.62116 7.44122 8.62243C7.61946 8.6237 7.79327 8.56688 7.93634 8.46056L8.57384 7.98478L13.1067 11.3668C13.1437 11.3944 13.1858 11.4145 13.2305 11.4259C13.2753 11.4372 13.3218 11.4396 13.3676 11.433C13.4133 11.4264 13.4572 11.4108 13.4969 11.3872C13.5366 11.3635 13.5712 11.3323 13.5988 11.2953C13.6265 11.2583 13.6465 11.2162 13.6579 11.1715C13.6692 11.1267 13.6717 11.0801 13.665 11.0344C13.6584 10.9887 13.6428 10.9448 13.6192 10.9051C13.5956 10.8654 13.5644 10.8308 13.5274 10.8031L9.16095 7.54064L13.6082 4.21837C13.682 4.16267 13.7308 4.08016 13.7442 3.9887C13.7576 3.89724 13.7344 3.8042 13.6797 3.7297Z"
                                                fill="#800020"/>
                                            <path
                                                d="M13.2422 2.22656H1.75781C1.29161 2.22656 0.844505 2.41176 0.514851 2.74141C0.185198 3.07107 0 3.51817 0 3.98438L0 11.0156C0 11.4818 0.185198 11.9289 0.514851 12.2586C0.844505 12.5882 1.29161 12.7734 1.75781 12.7734H13.2422C13.7084 12.7734 14.1555 12.5882 14.4851 12.2586C14.8148 11.9289 15 11.4818 15 11.0156V3.98438C15 3.51817 14.8148 3.07107 14.4851 2.74141C14.1555 2.41176 13.7084 2.22656 13.2422 2.22656ZM14.2969 11.0156C14.2969 11.2953 14.1858 11.5636 13.988 11.7614C13.7902 11.9592 13.5219 12.0703 13.2422 12.0703H1.75781C1.47809 12.0703 1.20983 11.9592 1.01204 11.7614C0.814244 11.5636 0.703125 11.2953 0.703125 11.0156V3.98438C0.703125 3.70465 0.814244 3.43639 1.01204 3.2386C1.20983 3.04081 1.47809 2.92969 1.75781 2.92969H13.2422C13.5219 2.92969 13.7902 3.04081 13.988 3.2386C14.1858 3.43639 14.2969 3.70465 14.2969 3.98438V11.0156Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_227">
                                                <rect width="15" height="15" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Email address')}}</p>
                                    <p class="address-text">{{$information->email}}</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_236)">
                                            <path
                                                d="M17.1364 12.906L14.9584 10.71C14.5984 10.35 14.1124 10.134 13.6624 10.134C13.1764 10.134 12.7444 10.332 12.3664 10.71L11.1064 11.97C11.0524 11.934 10.9804 11.898 10.9264 11.88C10.9264 11.88 10.9084 11.88 10.9084 11.862L10.8904 11.844C10.7284 11.736 10.5484 11.628 10.3324 11.538C9.2344 10.854 8.2084 9.89995 7.1644 8.62195C6.6784 8.00995 6.3364 7.46995 6.0664 6.87595C6.3544 6.64195 6.5704 6.40795 6.7324 6.22795L7.2904 5.66995C7.7224 5.27395 7.9384 4.82395 7.9384 4.35595C7.9384 3.86995 7.7224 3.41995 7.3084 2.98795L5.5984 1.27795C5.4364 1.11595 5.2744 0.953953 5.0944 0.791953C4.7344 0.449953 4.2844 0.251953 3.8164 0.251953C3.2944 0.251953 2.8624 0.431953 2.4664 0.827953L1.1524 2.14195C0.6304 2.62795 0.3244 3.23995 0.2524 3.99595V4.01395C0.2164 4.94995 0.3604 5.81395 0.7564 6.89395C1.3864 8.58595 2.3404 10.17 3.7624 11.916C5.6164 14.004 7.7044 15.624 10.0264 16.74L10.0804 16.758C10.7644 17.064 12.0604 17.64 13.5004 17.73H13.6984C14.6524 17.73 15.3724 17.424 15.9664 16.776C16.1824 16.524 16.4164 16.29 16.6144 16.074C16.7764 15.948 16.8844 15.822 16.9924 15.696L17.1364 15.552L17.1724 15.516C17.9284 14.688 17.9284 13.68 17.1364 12.906ZM16.5064 14.904L16.3264 15.084L16.3084 15.12C16.2184 15.228 16.1464 15.318 16.0564 15.39L16.0024 15.444C15.7864 15.66 15.5344 15.912 15.2824 16.2C14.8684 16.65 14.4004 16.848 13.6984 16.848H13.5544C12.2944 16.758 11.1424 16.254 10.4584 15.948L10.4224 15.93C8.2084 14.868 6.2104 13.32 4.4644 11.34C3.0964 9.68395 2.1964 8.17195 1.6024 6.58795C1.2424 5.59795 1.1164 4.87795 1.1524 4.06795C1.2064 3.54595 1.4044 3.13195 1.7644 2.80795L3.0964 1.47595C3.3124 1.25995 3.5284 1.16995 3.7984 1.16995C4.0324 1.16995 4.2484 1.27795 4.4464 1.45795L4.4644 1.47595C4.6264 1.61995 4.7884 1.78195 4.9504 1.94395L6.6604 3.65395C6.9844 3.97795 7.0384 4.22995 7.0384 4.37395C7.0384 4.51795 7.0024 4.73395 6.6604 5.03995L6.0844 5.61595C5.8864 5.83195 5.6524 6.06595 5.3464 6.31795L5.3104 6.35395L5.2744 6.40795C5.1124 6.62395 5.0944 6.82195 5.1844 7.10995L5.2024 7.18195L5.2204 7.25395C5.5264 7.91995 5.9044 8.53195 6.4444 9.21595C7.5604 10.584 8.6764 11.61 9.8644 12.348L9.9184 12.384C10.0624 12.456 10.2064 12.528 10.3324 12.6C10.3864 12.654 10.4584 12.69 10.5124 12.708C10.5844 12.744 10.6384 12.762 10.6744 12.798L10.8004 12.888H10.8364L10.8904 12.906C10.9984 12.942 11.0704 12.942 11.1244 12.942C11.3044 12.942 11.4664 12.87 11.6284 12.708L12.9784 11.358C13.1944 11.142 13.3924 11.052 13.6444 11.052C13.9144 11.052 14.1664 11.214 14.3104 11.358L16.5064 13.554C16.9384 13.986 16.9564 14.436 16.5064 14.904Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_236">
                                                <rect width="18" height="18" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Phone')}}</p>
                                    <p class="address-text">{{$information->phone}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="contact-item-two">
                        <div class="section-title">
                            <img src="{{asset('image/flower-2.png')}}" alt="">
                            <h2 class="section-title-text">{{__('app.help')}}</h2>
                        </div>
                        <div class="contact-form-block">
                            <form action="{{ route('queuing.send_queuing') }}" method="post">
                                @csrf
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Name surname')}}
                                        <input type="text" name="name" class="contact-form-input">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Phone')}}
                                        <input type="number" name="phone" class="contact-form-input">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item calendar-div">
                                    <div class="calendat-item">

                                        <label class="contact-form-label">{{t('Page home.Desired day of visit')}}
                                            <input type="date" name="date" class="contact-form-input">
                                            @if ($errors->has('date'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="calendat-item">
                                        <label class="contact-form-label">{{t('Page home.Select desired time')}}
                                            <select id="time" name="time" class="contact-form-input">
                                                <option value="0" selected disabled></option>
                                                @if(isset($time))
                                                    @foreach($time as $item)
                                                        <option style="background:rgb(160 88 106)"
                                                                value='{{$item->hour}} : {{$item->minute}}'
                                                                name='time'>{{$item->hour}}: {{$item->minute}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>

                                </div>
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Email address')}}
                                        <input type="email" name="email" class="contact-form-input">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item">
                                    <textarea name="message" class="contact-form-input"
                                              placeholder="{{t('Page static contacts.message')}}"></textarea>
                                    </label>
                                </div>
                                <div class="cntact-form-btn">
                                    <button type="submit">{{t('Page home.Submit application')}}</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
                <div class="mob-contact-info-block">
                    <div class="contact-item-first">
                        <!-- <img src="./Images/contact-block.png" alt="" class="img"> -->
                        <div class="section-title">
                            <img src="{{asset('image/flower-2.png')}}" alt="">
                            <h2 class="section-title-text">{{__('app.Contact us')}}</h2>
                        </div>
                        <div class="editor">
                            {!!$information->short!!}
                        </div>
                        <div class="contact-address-block">
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_218)">
                                            <path
                                                d="M8.50019 17C8.37979 17.0005 8.26047 16.9774 8.14903 16.9318C8.0376 16.8862 7.93623 16.8191 7.85074 16.7343L3.48386 12.3675C2.79438 11.6818 2.2486 10.8655 1.87847 9.96625C1.50835 9.06705 1.32131 8.10305 1.32831 7.13068C1.32534 6.18923 1.51023 5.25665 1.87215 4.38755C2.23407 3.51844 2.76575 2.73027 3.43605 2.06919C4.78984 0.746428 6.60745 0.00585937 8.50019 0.00585938C10.3929 0.00585938 12.2105 0.746428 13.5643 2.06919C14.2346 2.73027 14.7663 3.51844 15.1282 4.38755C15.4901 5.25665 15.675 6.18923 15.6721 7.13068C15.6791 8.10305 15.492 9.06705 15.1219 9.96625C14.7518 10.8655 14.206 11.6818 13.5165 12.3675L9.14964 16.7264C9.0648 16.8126 8.96373 16.8811 8.85227 16.9281C8.7408 16.9751 8.62114 16.9995 8.50019 17ZM8.50019 0.79685C6.81491 0.792968 5.19611 1.45395 3.99519 2.6363C3.40024 3.22369 2.92842 3.92384 2.60732 4.69578C2.28623 5.46773 2.12232 6.29595 2.12519 7.13201C2.11881 7.99926 2.2855 8.85908 2.61548 9.66113C2.94547 10.4632 3.43213 11.1914 4.04699 11.803L8.41253 16.1619C8.42381 16.1736 8.43732 16.1829 8.45227 16.1893C8.46721 16.1956 8.48329 16.1989 8.49953 16.1989C8.51576 16.1989 8.53184 16.1956 8.54678 16.1893C8.56173 16.1829 8.57524 16.1736 8.58652 16.1619L12.9534 11.803C13.5682 11.1914 14.0549 10.4632 14.3849 9.66113C14.7149 8.85908 14.8816 7.99926 14.8752 7.13201C14.8781 6.29595 14.7141 5.46773 14.3931 4.69578C14.072 3.92384 13.6001 3.22369 13.0052 2.6363C11.8043 1.45395 10.1855 0.792968 8.50019 0.79685Z"
                                                fill="#800020"/>
                                            <path
                                                d="M8.50027 10.8125C7.66319 10.8121 6.85212 10.5216 6.2052 9.99034C5.55828 9.45911 5.1155 8.72006 4.95228 7.89904C4.78906 7.07802 4.91549 6.22581 5.31004 5.48754C5.70459 4.74927 6.34285 4.17059 7.11613 3.85006C7.88942 3.52953 8.7499 3.48696 9.55105 3.72961C10.3522 3.97225 11.0445 4.48511 11.5099 5.18084C11.9754 5.87657 12.1853 6.71214 12.104 7.54526C12.0226 8.37838 11.6549 9.15752 11.0636 9.75C10.7273 10.0871 10.3277 10.3545 9.88787 10.5369C9.44799 10.7192 8.97644 10.8129 8.50027 10.8125ZM8.50027 4.37242C7.84716 4.37346 7.2146 4.60088 6.71033 5.01594C6.20607 5.431 5.86128 6.00804 5.7347 6.64878C5.60813 7.28951 5.70758 7.95431 6.01613 8.52995C6.32467 9.10558 6.82323 9.55646 7.42689 9.80578C8.03055 10.0551 8.70197 10.0874 9.32679 9.8973C9.95162 9.70716 10.4912 9.30629 10.8537 8.76298C11.2161 8.21966 11.379 7.5675 11.3146 6.91757C11.2502 6.26763 10.9625 5.66013 10.5004 5.19852C10.2378 4.936 9.9259 4.7279 9.58267 4.58615C9.23945 4.44439 8.87162 4.37176 8.50027 4.37242Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_218">
                                                <rect width="17" height="17" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Our address')}}</p>
                                    <p class="address-text">{{$information->address}}</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_227)">
                                            <path
                                                d="M13.6797 3.7297C13.6521 3.69268 13.6174 3.66146 13.5778 3.63782C13.5381 3.61419 13.4941 3.59861 13.4484 3.59197C13.4027 3.58534 13.3561 3.58777 13.3114 3.59913C13.2666 3.6105 13.2245 3.63058 13.1875 3.65822L7.51681 7.89103C7.49652 7.90624 7.47185 7.91447 7.4465 7.91447C7.42114 7.91447 7.39647 7.90624 7.37618 7.89103L1.81681 3.63947C1.78011 3.61146 1.73824 3.59095 1.69362 3.57912C1.64899 3.56729 1.60247 3.56437 1.55671 3.57051C1.51095 3.57666 1.46685 3.59176 1.42693 3.61495C1.38701 3.63815 1.35204 3.66897 1.32404 3.70568C1.29603 3.74238 1.27552 3.78424 1.26369 3.82887C1.25186 3.8735 1.24894 3.92002 1.25508 3.96578C1.26123 4.01153 1.27633 4.05563 1.29952 4.09556C1.32272 4.13548 1.35354 4.17044 1.39025 4.19845L5.76134 7.54181L1.43829 10.7996C1.40105 10.8274 1.36965 10.8622 1.34587 10.9022C1.32209 10.9421 1.30641 10.9863 1.29972 11.0323C1.29302 11.0782 1.29545 11.1251 1.30686 11.1701C1.31828 11.2151 1.33845 11.2575 1.36622 11.2947C1.394 11.332 1.42884 11.3634 1.46876 11.3872C1.50867 11.4109 1.55288 11.4266 1.59886 11.4333C1.64483 11.44 1.69168 11.4376 1.73671 11.4262C1.78175 11.4148 1.8241 11.3946 1.86134 11.3668L6.34142 7.98478L6.94845 8.45353C7.08999 8.56187 7.26297 8.62116 7.44122 8.62243C7.61946 8.6237 7.79327 8.56688 7.93634 8.46056L8.57384 7.98478L13.1067 11.3668C13.1437 11.3944 13.1858 11.4145 13.2305 11.4259C13.2753 11.4372 13.3218 11.4396 13.3676 11.433C13.4133 11.4264 13.4572 11.4108 13.4969 11.3872C13.5366 11.3635 13.5712 11.3323 13.5988 11.2953C13.6265 11.2583 13.6465 11.2162 13.6579 11.1715C13.6692 11.1267 13.6717 11.0801 13.665 11.0344C13.6584 10.9887 13.6428 10.9448 13.6192 10.9051C13.5956 10.8654 13.5644 10.8308 13.5274 10.8031L9.16095 7.54064L13.6082 4.21837C13.682 4.16267 13.7308 4.08016 13.7442 3.9887C13.7576 3.89724 13.7344 3.8042 13.6797 3.7297Z"
                                                fill="#800020"/>
                                            <path
                                                d="M13.2422 2.22656H1.75781C1.29161 2.22656 0.844505 2.41176 0.514851 2.74141C0.185198 3.07107 0 3.51817 0 3.98438L0 11.0156C0 11.4818 0.185198 11.9289 0.514851 12.2586C0.844505 12.5882 1.29161 12.7734 1.75781 12.7734H13.2422C13.7084 12.7734 14.1555 12.5882 14.4851 12.2586C14.8148 11.9289 15 11.4818 15 11.0156V3.98438C15 3.51817 14.8148 3.07107 14.4851 2.74141C14.1555 2.41176 13.7084 2.22656 13.2422 2.22656ZM14.2969 11.0156C14.2969 11.2953 14.1858 11.5636 13.988 11.7614C13.7902 11.9592 13.5219 12.0703 13.2422 12.0703H1.75781C1.47809 12.0703 1.20983 11.9592 1.01204 11.7614C0.814244 11.5636 0.703125 11.2953 0.703125 11.0156V3.98438C0.703125 3.70465 0.814244 3.43639 1.01204 3.2386C1.20983 3.04081 1.47809 2.92969 1.75781 2.92969H13.2422C13.5219 2.92969 13.7902 3.04081 13.988 3.2386C14.1858 3.43639 14.2969 3.70465 14.2969 3.98438V11.0156Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_227">
                                                <rect width="15" height="15" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Email address')}}</p>
                                    <p class="address-text">{{$information->email}}</p>
                                </div>
                            </div>
                            <div class="address-item">
                                <div class="contact-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                         fill="none">
                                        <g clip-path="url(#clip0_47_236)">
                                            <path
                                                d="M17.1364 12.906L14.9584 10.71C14.5984 10.35 14.1124 10.134 13.6624 10.134C13.1764 10.134 12.7444 10.332 12.3664 10.71L11.1064 11.97C11.0524 11.934 10.9804 11.898 10.9264 11.88C10.9264 11.88 10.9084 11.88 10.9084 11.862L10.8904 11.844C10.7284 11.736 10.5484 11.628 10.3324 11.538C9.2344 10.854 8.2084 9.89995 7.1644 8.62195C6.6784 8.00995 6.3364 7.46995 6.0664 6.87595C6.3544 6.64195 6.5704 6.40795 6.7324 6.22795L7.2904 5.66995C7.7224 5.27395 7.9384 4.82395 7.9384 4.35595C7.9384 3.86995 7.7224 3.41995 7.3084 2.98795L5.5984 1.27795C5.4364 1.11595 5.2744 0.953953 5.0944 0.791953C4.7344 0.449953 4.2844 0.251953 3.8164 0.251953C3.2944 0.251953 2.8624 0.431953 2.4664 0.827953L1.1524 2.14195C0.6304 2.62795 0.3244 3.23995 0.2524 3.99595V4.01395C0.2164 4.94995 0.3604 5.81395 0.7564 6.89395C1.3864 8.58595 2.3404 10.17 3.7624 11.916C5.6164 14.004 7.7044 15.624 10.0264 16.74L10.0804 16.758C10.7644 17.064 12.0604 17.64 13.5004 17.73H13.6984C14.6524 17.73 15.3724 17.424 15.9664 16.776C16.1824 16.524 16.4164 16.29 16.6144 16.074C16.7764 15.948 16.8844 15.822 16.9924 15.696L17.1364 15.552L17.1724 15.516C17.9284 14.688 17.9284 13.68 17.1364 12.906ZM16.5064 14.904L16.3264 15.084L16.3084 15.12C16.2184 15.228 16.1464 15.318 16.0564 15.39L16.0024 15.444C15.7864 15.66 15.5344 15.912 15.2824 16.2C14.8684 16.65 14.4004 16.848 13.6984 16.848H13.5544C12.2944 16.758 11.1424 16.254 10.4584 15.948L10.4224 15.93C8.2084 14.868 6.2104 13.32 4.4644 11.34C3.0964 9.68395 2.1964 8.17195 1.6024 6.58795C1.2424 5.59795 1.1164 4.87795 1.1524 4.06795C1.2064 3.54595 1.4044 3.13195 1.7644 2.80795L3.0964 1.47595C3.3124 1.25995 3.5284 1.16995 3.7984 1.16995C4.0324 1.16995 4.2484 1.27795 4.4464 1.45795L4.4644 1.47595C4.6264 1.61995 4.7884 1.78195 4.9504 1.94395L6.6604 3.65395C6.9844 3.97795 7.0384 4.22995 7.0384 4.37395C7.0384 4.51795 7.0024 4.73395 6.6604 5.03995L6.0844 5.61595C5.8864 5.83195 5.6524 6.06595 5.3464 6.31795L5.3104 6.35395L5.2744 6.40795C5.1124 6.62395 5.0944 6.82195 5.1844 7.10995L5.2024 7.18195L5.2204 7.25395C5.5264 7.91995 5.9044 8.53195 6.4444 9.21595C7.5604 10.584 8.6764 11.61 9.8644 12.348L9.9184 12.384C10.0624 12.456 10.2064 12.528 10.3324 12.6C10.3864 12.654 10.4584 12.69 10.5124 12.708C10.5844 12.744 10.6384 12.762 10.6744 12.798L10.8004 12.888H10.8364L10.8904 12.906C10.9984 12.942 11.0704 12.942 11.1244 12.942C11.3044 12.942 11.4664 12.87 11.6284 12.708L12.9784 11.358C13.1944 11.142 13.3924 11.052 13.6444 11.052C13.9144 11.052 14.1664 11.214 14.3104 11.358L16.5064 13.554C16.9384 13.986 16.9564 14.436 16.5064 14.904Z"
                                                fill="#800020"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_236">
                                                <rect width="18" height="18" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="address-title">{{t('Page home.Phone')}}</p>
                                    <p class="address-text">{{$information->phone}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="contact-item-two">
                        <div class="section-title">
                            <img src="{{asset('image/flower-2.png')}}" alt="">
                            <h2 class="section-title-text">{{__('app.help')}}</h2>
                        </div>
                        <div class="contact-form-block">
                            <form action="{{ route('queuing.send_queuing') }}" method="post">
                                @csrf
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Name surname')}}
                                        <input type="text" name="name" class="contact-form-input">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Phone')}}
                                        <input type="number" name="phone" class="contact-form-input">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item calendar-div">
                                    <div class="calendat-item">
                                        <label class="contact-form-label">{{t('Page home.Desired day of visit')}}
                                            <input type="date" name="date" class="contact-form-input">
                                            @if ($errors->has('date'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="calendat-item">
                                        <label class="contact-form-label">{{t('Page home.Select desired time')}}
                                            <select id="time" name="time" class="contact-form-input">
                                                <option value="0" selected disabled></option>
                                                @if(isset($time))
                                                    @foreach($time as $item)
                                                        <option style="background:rgb(160 88 106)"
                                                                value='{{$item->hour}} : {{$item->minute}}'
                                                                name='time'>{{$item->hour}}: {{$item->minute}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </label>
                                    </div>

                                </div>
                                <div class="contact-form-item">
                                    <label class="contact-form-label">{{t('Page home.Email address')}}
                                        <input type="email" name="email" class="contact-form-input">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <div class="contact-form-item">
                                    <textarea name="message" class="contact-form-input"
                                              placeholder="{{t('Page static contacts.message')}}"></textarea>
                                    </label>
                                </div>
                                <div class="cntact-form-btn">
                                    <button type="submit">{{t('Page home.Submit application')}}</button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="question-section">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{__('app.faq')}}</h2>
            </div>
            <div class="qusetion-block">
                <div class="wrapper">
                    <div class="acordeon-core">
                        @foreach($questions as $question)
                            <div class="acordeon">
                                <input id="{{$question->id}}" type="checkbox" name="acordeons">
                                <label for="{{$question->id}}">
                                    <p>{{$question->title}}</p>
                                </label>
                                <div class="acordeon-content">
                                    <p>{!! $question->content !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
    </section>

    <section class="gallery-section">
        <div class="container">
            <div class="gallery-block">
                <div class="section-title">
                    <img src="{{asset('image/flower-2.png')}}" alt="">
                    <h2 class="section-title-text">{{__('app.gallery')}}</h2>
                </div>
                <div class="gallery-foto-div">
                    <a href="{{ route('page', ['url' => $galleryPage->url] )}}">
                        <img src="{{ $galleryPage->getImageUrl('thumbnail', $galleryPage->image)}}" alt="" class="img">
                    </a>
                    <div class="gallery-flower">
                        <img src="{{asset('image/gallery-flower.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="end-slider-section">
        <div class="end-slider-block">
            <swiper-container class="mySwiper"
                              autoplay-delay="2500">
                @foreach($galleryPageMedia as $media)
                    <swiper-slide class="slider-item">
                        <img src="{{ $media->getImageUrl('small', $media->image)}}" alt="" class="img">
                    </swiper-slide>
                @endforeach
            </swiper-container>
        </div>

    </section>
@endsection
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

