@if($sliders)
    <div class="home-slide-block">
        <div class="swiper home-slide">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                    <div class="swiper-slide  home-slide__item">
                        <img class="img" src="{{ $slider->getImageUrl('thumbnail') }}" alt="{{$page->title}}"
                             class="img">
                        @if(!$slider->url )
                        @else
                            <div class="home-slide__info-bg">
                                <div class="home-slide-info">
                                    <h1 class="home-slide-info__title">{{ $slider->{'title'} }}</h1>
                                    <a href="{{ $slider->{'url'} }}" class="home-slide-info__btn button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                                             viewBox="0 0 19 20">
                                            <path id="Union_35" data-name="Union 35"
                                                  d="M6.186,20V13.913h6.186V20Zm6.628-6.956V6.957H19v6.087ZM0,13.044V6.957H6.186v6.087ZM6.186,6.087V0h6.186V6.087Z"
                                                  fill="#fff"/>
                                        </svg>
                                        Հերթագրվեք օնլայն
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
