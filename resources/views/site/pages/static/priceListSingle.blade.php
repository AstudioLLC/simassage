@extends('site.layouts.app')

@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{ $page->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ asset('image/og_default.jpg')}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{asset('image/og_default.jpg')}}">
@endsection


@section('content')
    <section class="price-list-page-section">
        <div class="container">
            @include('site.includes.breadcrumbs', ['page' => $page ?? null])
            <div class="price-list-top">
                <div>
                    <div class="title-block">
                        <h1 class="title-block__title">{{$page->title}} </h1>
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                            <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                                <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>
                                <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>
                                <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>
                            </g>
                        </svg>
                    </div>
                </div>
                <button type="button" class="selected-services-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                        <path id="Union_36" data-name="Union 36" d="M6.186,20V13.913h6.186V20Zm6.628-6.956V6.957H19v6.087ZM0,13.044V6.957H6.186v6.087ZM7.512,10a2.21,2.21,0,1,1,2.209,2.174A2.192,2.192,0,0,1,7.512,10ZM6.186,6.087V0h6.186V6.087Z" fill="#fff"/>
                    </svg>
                    {{t('Page home.Selected Services')}}   &nbsp;(&nbsp;<span class="basket-view-count">{{$cart_data ?count($cart_data):0}}</span>&nbsp;)
                </button>
            </div>
            <div class="price-list">
                <div class="price-list__item">
                    @foreach($prices as $price)
                        @if(($cart_data))
                            @php $active = 'false' @endphp
                            @foreach($cart_data as $elmInd => $elm)
                                @if($elm['item_id'] == $price->id)
                                    @php $active = 'true' @endphp
                                @endif
                            @endforeach
                        @endif
                        <div class="price-list-names">
                            @if($price->price_code)&nbsp;@endif
                            <div  class="price-list-name">
                                <p class="price-list-name__title" data-id="{{$price->id}}">{{$price->price_code}}@if($price->price_code)&nbsp;@endif{{$price->title}}</p>
                                <p class="price-list-name__price"  data-pricelist="{{$price->price}}">{{formatPrice($price->price)}} &#x58F</p>
                            </div>
                            <button type="button" class="price-list-names-plus"
                                    style="{{ isset($active) && $active == 'true' ?'display:none': '' }}"
                                    data-item-id="{{ $price->id }}"
                                    data-isset="1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#57556A" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                            <button type="button" class="price-list-names-checked"
                                    style="{{ isset($active) && $active == 'true' ?'display:block': '' }}"
                                    data-item-id="{{ $price->id }}"
                                    data-isset="1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#149E00" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('site.includes.getInLineModal')
    </section>
@endsection
@push('js')
    <script>
        favoritesBundle.removeCallback = function (itemId) {
            let element = $(`[data-id="${itemId}"].queued-text`);

            element.fadeOut(200);

            setTimeout(function () {
                element.remove()
            }, 250);
        };

    </script>
@endpush
