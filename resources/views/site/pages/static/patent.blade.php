@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection
@section('content')
    <section class="story-section">
        <div class="container">
            @include('site.includes.breadcrumbs', ['page' => $page ?? null])
            <div class="title-block">
                <h1 class="title-block__title">{{$page->title}}</h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                    <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                        <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>
                    </g>
                </svg>
            </div>
            <div class="story-img">
                <img class="img" src="{{$page->getImageUrl('thumbnail', $page->imageBig)}}" alt="{{$page->title}}">
            </div>
            <div class="story-text editor">
                {!! $page->content !!}
            </div>
            @if(count($gallery) || count($videoGallery))
                <div class="title-block">
                    <h2 class="title-block__title">{{t('Page home.Media')}}</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>
                        </g>
                    </svg>
                </div>
                @include('site.includes.media')
            @endif
            <div class="shares-block">
                <div class=" text-center" >
                    <p class="share_title">{{t('Page home.Share')}}</p>
                    <div class="share text-center mb15 pt-0">
                        <div class="colblack fs-13 text-center mb5"></div>
                        <span title="Whatsapp" class="hidden_desk" onclick="shareToWhatsApp('{{ url()->current() }}', '{{$page->title}}', '{{ asset('image/'.$page->imageBig) }}', '{{ $page->seo_description }}')">
                            <button type="button" class="share-button wa-button">
                                <span class="sr-only">Whatsapp</span>
                                <i class="fa-brands fa-whatsapp"></i>
                            </button>
                        </span>
                        <span title="Facebook" onclick="Share.facebook('{{ url()->current() }}','{{$page->title}}','{{ $page->getImageUrl('thumbnail', $page->imageSmall) }}','{{ $page->seo_description }}')">
                            <button type="button"  class="share-button fb-button">
                                <span class="sr-only">Facebook</span>
                                <i class="fa-brands fa-facebook-f"></i>
                            </button>
                        </span>
                        <span title="Linkedin" onclick="Share.linkedin('{{ url()->current() }}','{{$page->title}}','{{$page->imageBig}}','{{ $page->seo_description }}')">
                            <button type="button"  class="share-button in-button">
                                <span class="sr-only">Linkedin</span>
                                <i class="fa-brands fa-linkedin"></i>
                            </button>
                        </span>
                        <span title="Vkontakte" onclick="Share.vkontakte('{{ url()->current() }}','{{$page->title}}','{{asset('image/'.$page->imageBig)}}','')">
                            <button type="button"  class="share-button vk-button">
                                <span class="sr-only">Vkontakte</span>
                                <i class="fa-brands fa-vk"></i>
                            </button>
                        </span>
                        <span title="Twitter" onclick="Share.twitter('{{ url()->current() }}','{{$page->title}}')">
                            <button type="button"  class="share-button tw-button">
                                <span class="sr-only">Twitter</span>
                                <i class="fa-brands fa-twitter"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection