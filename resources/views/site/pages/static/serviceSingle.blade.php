@extends('site.layouts.app')

@section('content')
    <section class="services-page-section">
        <div class="container">
            <ul class="bread-crumbs">
                @include('site.includes.breadcrumbs', ['page' => $page ?? null])
            </ul>
            <div class="title-block">
                <h1 class="title-block__title">{{$service->title}}</h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                    <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                        <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>
                    </g>
                </svg>
            </div>
            <div class="services-page__img">
                <img class="img" src="{{ $service->getImageUrl('thumbnail', $service->imageBig) }}" alt="">
            </div>
            <div class="services-page__info editor">
                {!! $service->content !!}
            </div>
            @if(count($gallery))
                <div class="title-block">
                    <h2 class="title-block__title">Պատկերասրահ</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2" transform="translate(925 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2" transform="translate(1001 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2" transform="translate(915 3479)" fill="#ef344e"></rect>
                        </g>
                    </svg>
                </div>
                <div class="gallery-row">
                    @foreach($gallery as $key)
                        <div class="gallery-row__item">
                            <a data-fancybox="gallery" data-src="{{$key->getImageUrl('thumbnail')}}">
                                <img class="img" src="{{$key->getImageUrl('small')}}" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
