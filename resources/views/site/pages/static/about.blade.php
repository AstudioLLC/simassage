@extends('site.layouts.app')

@section('content')
<section class="about-page-section">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="about-section">
            <div class="about-all-info">
                <div class="about-block" style="background: url({{asset('image/about-bg.png')}})">
                    <div class="about-section-info">
                        <div class="flower">
                            <img src="{{asset('image/flower-2.png')}}" alt="" class="img">
                        </div>

                        <p class="about-title">{{__('app.welcome')}}</p>
                        <div class="about-text-foto">
                            <div class="flower-under-foto">
                                <img src="{{ $page->getImageUrl('thumbnail') }}" alt="">
                                <div class="flower-one">
                                    <img src="{{asset('image/flower.png')}}" alt="" class="flower-web">
                                    <div class="flower-two">
                                        <img src="{{asset('image/flower.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="about-info">
                                <h1 class="about-block-title">{{$page->title_content_second}}</h1>
                                <p class="editor">
                                    {!!$page->content_second!!}
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
                                            <a href="{{$social->url}}" class=""
                                               target="_blank">
                                                <img src="{{ $social->getImageUrl('thumbnail') }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="about-btn">
                                <button type="button">Запись на прием</button>
                            </div>
                        </div>

                    </div>
                    <div class="addres-only-foto">
                        <img src="{{asset('image/about-2-info-shape-bg 1.png')}}" alt="">
                    </div>
                </div>
            </div>

            <div class="about-page-block">
                <div class="page-block-two">
                    <img src="{{asset('image/about-bg-2 2.png')}}" alt="" class="img bg-foto">
                    <div class="about-page-block-foto">
                        <img src="{{ $page->getImageUrl('thumbnail', $page->icon) }}" alt="" class="img">
                    </div>

                </div>
                <div class="page-block-one">
                    <p class="editor">{!!$page->content!!}</p>
                </div>


            </div>

        </div>
    </div>
</section>
@endsection
