@if($items)
    <div class="section-event my-margin">
        <div class="container-small">
            <div class="swiper-container events-swiper-container d-flex justify-content-center">
                <div class="swiper-wrapper">
                    @foreach($items as $item)
                        <div class="swiper-slide events-swiper-slide-box">
                            <div class="row">
                                <div class="col-12 col-lg-6 event-picture">
                                    @if($item->imageSmall)
                                        <img class="w-100"
                                             src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                                             alt="{{ $item->title }}"
                                             title="{{ $item->title }}">
                                    @endif
                                </div>
                                <div class="col-12 col-lg-6 d-flex flex-column event-details">
                                    <span class="event-name">
                                        {{ $item->title ?? null }}
                                    </span>
                                    <span class="event-date">
                                        {{ $item->start_date ? $item->start_date->format('d.m.Y') : null }}
                                    </span>
                                    <span class="event-title">
                                        {{ __('frontend.Give a gift. Make a change!') }}
                                    </span>
                                    <div class="event-description">
                                        {!! $item->short !!}
                                    </div>
                                    <div class="progressbar-wrap">
                                        @include('site.components.progressbar', ['item' => $item])
                                    </div>
                                    <a href="#" class="button-orange text-decoration-none">Give Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="event-swiper-buttons">
                    <div class="swiper-button-prev events-swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11">
                            <g transform="translate(0 11) rotate(-90)">
                                <path d="M5.5,0a.786.786,0,0,0-.545.216L.226,4.742a.715.715,0,0,0,0,1.042.8.8,0,0,0,1.089,0l4.185-4,4.185,4a.8.8,0,0,0,1.089,0,.715.715,0,0,0,0-1.042L6.045.216A.786.786,0,0,0,5.5,0Z" transform="translate(0)" fill="#0a0a0a"/>
                            </g>
                        </svg>

                    </div>
                    <div class="swiper-button-next events-swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11">
                            <g transform="translate(-97.141 11.001) rotate(-90)">
                                <path d="M5.5,103.141a.786.786,0,0,1-.545-.216L.226,98.4a.715.715,0,0,1,0-1.042.8.8,0,0,1,1.089,0l4.185,4,4.185-4a.8.8,0,0,1,1.089,0,.715.715,0,0,1,0,1.042l-4.73,4.526A.786.786,0,0,1,5.5,103.141Z" transform="translate(0 0)" fill="#0a0a0a"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{--<div class="section-event my-margin">
    <div class="container-small">
        <div class="swiper-container events-swiper-container d-flex justify-content-center">
            <div class="swiper-wrapper">
                <div class="swiper-slide events-swiper-slide-box">
                    <div class="row">
                        <div class="col-12 col-lg-6 event-picture">
                            <img class="w-100" src="{{ asset('images/santa.png')  }}" alt="" title="">
                        </div>

                        <div class="col-12 col-lg-6 d-flex flex-column event-details">

                            <span class="event-name">''Secret Santa'' campaign is officially launched!</span>

                            <span class="event-date">03.12.2020</span>

                            <span class="event-title">Give a gift. Make a change!</span>

                            <div class="event-description">
                                It is already the fourth year, World Vision Armenia has been organising Secret Santa charity campaign to raise funds from individuals and companies for Christmas presents for the most vulnerable children of Armenia.

                                With due consideration of the current situation in Armenia related to the Nagorno-Karabakh conflict and COVID-19 pandemic, this year we aim to not only reach children from needy families residing in Armenia...
                            </div>

                            <div class="progressbar-wrap">
                                @include('site.components.progressbar')
                            </div>

                            <a href="#" class="button-orange text-decoration-none">Give Now</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide events-swiper-slide-box">
                    <div class="row">
                        <div class="col-6 event-picture">
                            <img class="w-100" src="{{ asset('images/santa.png')  }}" alt="" title="">
                        </div>

                        <div class="col-6 d-flex flex-column event-details">
                            <span class="event-name">''Secret Santa'' campaign is officially launched!</span>

                            <span class="event-date">03.12.2020</span>

                            <span class="event-title">Give a gift. Make a change!</span>

                            <div class="event-description">
                                It is already the fourth year, World Vision Armenia has been organising Secret Santa charity campaign to raise funds from individuals and companies for Christmas presents for the most vulnerable children of Armenia.

                                With due consideration of the current situation in Armenia related to the Nagorno-Karabakh conflict and COVID-19 pandemic, this year we aim to not only reach children from needy families residing in Armenia...
                            </div>

                            <div class="progressbar-wrap">
                                @include('site.components.progressbar')
                            </div>

                            <a href="#" class="button-orange text-decoration-none">Give Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-swiper-buttons">
                <div class="swiper-button-prev events-swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11">
                        <g transform="translate(0 11) rotate(-90)">
                            <path d="M5.5,0a.786.786,0,0,0-.545.216L.226,4.742a.715.715,0,0,0,0,1.042.8.8,0,0,0,1.089,0l4.185-4,4.185,4a.8.8,0,0,0,1.089,0,.715.715,0,0,0,0-1.042L6.045.216A.786.786,0,0,0,5.5,0Z" transform="translate(0)" fill="#0a0a0a"/>
                        </g>
                    </svg>

                </div>

                <div class="swiper-button-next events-swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="11" viewBox="0 0 6 11">
                        <g transform="translate(-97.141 11.001) rotate(-90)">
                            <path d="M5.5,103.141a.786.786,0,0,1-.545-.216L.226,98.4a.715.715,0,0,1,0-1.042.8.8,0,0,1,1.089,0l4.185,4,4.185-4a.8.8,0,0,1,1.089,0,.715.715,0,0,1,0,1.042l-4.73,4.526A.786.786,0,0,1,5.5,103.141Z" transform="translate(0 0)" fill="#0a0a0a"/>
                        </g>
                    </svg>

                </div>
            </div>
        </div>
    </div>
</div>--}}
