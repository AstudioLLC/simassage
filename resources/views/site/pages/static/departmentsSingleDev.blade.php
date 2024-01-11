@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current()}}">
    <meta property="og:title" content="{{$subPage->title }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:image" content="{{ $subPage->getImageUrl('thumbnail', $subPage->image) }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current()}}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{$subPage->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{$subPage->getImageUrl('thumbnail', $subPage->image)}}">
@endsection

@section('content')
    <section class="department-page-section">
        <div class="container">
            @include('site.includes.breadcrumbs', ['page' => $page ?? null])
            <div class="title-block">
                <h1 class="title-block__title">{{$subPage->title}} </h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                    <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                        <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2"
                              transform="translate(925 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2"
                              transform="translate(1001 3479)" fill="#ef344e"></rect>
                        <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2"
                              transform="translate(915 3479)" fill="#ef344e"></rect>
                    </g>
                </svg>
            </div>
            <div class="department-page__img">
                <img class="img" src="{{ $subPage->getImageUrl('thumbnail', $subPage->image) }}" alt="">
                <img class="department-img-icon" src="{{ $subPage->getImageUrl('thumbnail', $subPage->icon) }}" alt="">
            </div>

            <div class="department-page-info">
                <div class="department-page-filter">
                    <svg class="horizontal-scroll" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" width="38" height="38" viewBox="0 0 84 84">
                        <image id="hand-cursor" width="84" height="84"
                               xlink:href="data:image/png;base64,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"/>
                    </svg>
                    @foreach($departmentServices as $value)
                        @if(count($prices) && $value->static=='price')
                            <button class="department-page-filter__item @if($loop->index==0) department-page-filter__item_active @endif  department-filter"
                                    value="{{$value->static ?? $value->id}}" type="button">{{$value->title}}</button>
                        @elseif(count($doctors) && $value->static=='personnel')
                            <button class="department-page-filter__item @if($loop->index==0) department-page-filter__item_active @endif  department-filter"
                                    value="{{$value->static ?? $value->id}}" type="button">{{$value->title}}</button>
                        @elseif(count($services) && $value->static=='services')
                            <button class="department-page-filter__item @if($loop->index==0) department-page-filter__item_active @endif  department-filter"
                                    value="{{$value->static ?? $value->id}}" type="button">{{$value->title}}</button>
                        @elseif(!empty($generalInfo->content) && $value->static=='general-information')
                            <button class="department-page-filter__item @if($loop->index==0) department-page-filter__item_active @endif  department-filter"
                                    value="{{$value->static ?? $value->id}}" type="button">{{$value->title}}</button>
                        @elseif(count($dinamicContent) && $value->static==null)
                            <button class="department-page-filter__item @if($loop->index==0) department-page-filter__item_active @endif  department-filter"
                                    value="{{$value->static ?? $value->id}}" type="button">{{$value->title}}</button>
                        @endif
                    @endforeach
                    @if(count($gallery) || count($videoGallery))
                        <button class="department-page-filter__item department-filter" value="media"
                                type="button">{{t('Page home.Media')}}</button>
                    @endif
                </div>
                <div class="department-page-content">
                    <div class="editor department-content" style="display: none">
                        {!! $generalInfo->content ?? null !!}
                    </div>
                    <div class="department-services" style="display: none">
                        @foreach($services as $service)
                            <div class="department-services__item">
                                <a href="{{ route('services.detail',['department'=> $subPage->url, 'url' => $service->url ?? null]) }}"
                                   class="department-services-block">
                                    <img class="img"
                                         src="{{ $service->getImageUrl('thumbnail', $service->imageSmall) }}" alt="">
                                    <div class="department-services-info">
                                        <h3 class="department-services-title">{{$service->title}}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="price-list" style="display: none">
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
                                    <div class="price-list-name">
                                        <p class="price-list-name__title"
                                           data-id="{{$price->id}}">{{$price->price_code}}@if($price->price_code)
                                                &nbsp;
                                            @endif{{$price->title}}</p>
                                        <p class="price-list-name__price"
                                           data-pricelist="{{$price->price}}">{{ formatPrice($price->price)}}</p>
                                    </div>
                                    <button type="button" class="price-list-names-plus"
                                            style="{{ isset($active) && $active == 'true' ?'display:none': '' }}"
                                            data-item-id="{{ $price->id }}"
                                            data-isset="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#57556A"
                                             class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="price-list-names-checked"
                                            style="{{ isset($active) && $active == 'true' ?'display:block': '' }}"
                                            data-item-id="{{ $price->id }}"
                                            data-isset="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#149E00"
                                             class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="doctors-row" style="display: none">
                        @foreach($doctors as $doctor)
                            <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}"
                               class="doctors-row__item">
                                @if (!$doctor->imageBig)
                                    <img class="img" src="{{ asset('image/doctor_not_found.png') }}" alt="">
                                @else
                                    <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}"
                                         alt="">
                                @endif
                                <h3 class="doctors-block__title">{{$doctor->title}}</h3>
                                <p class="doctors-block__position">{{$doctor->position}}</p>

                            </a>
                        @endforeach
                    </div>

                    <div class="media" style="display: none">
                        @include('site.includes.media', [
                            'loadMediaItems' => false
                        ])
                    </div>

                    @foreach($dinamicContent as $content)
                        <div class="editor department-dinamic-content" style="display: none" data-id="{{$content->id}}">
                            {!! $content->content ?? null !!}
                        </div>
                    @endforeach
                </div>
            </div>
            @if($subPage->active_form === 1)
                <div class="title-block">
                    <h2 class="title-block__title">{{t('Page home.Enrol')}}</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="2" viewBox="0 0 90 2">
                        <g id="Group_9865" data-name="Group 9865" transform="translate(-915 -3479)">
                            <rect id="Rectangle_18820" data-name="Rectangle 18820" width="70" height="2"
                                  transform="translate(925 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18835" data-name="Rectangle 18835" width="4" height="2"
                                  transform="translate(1001 3479)" fill="#ef344e"></rect>
                            <rect id="Rectangle_18834" data-name="Rectangle 18834" width="4" height="2"
                                  transform="translate(915 3479)" fill="#ef344e"></rect>
                        </g>
                    </svg>
                </div>
                @if(session()->has('message_sent'))
                    <p class="text-success">{{ t('Page static contacts.Thank you. Your email has been sent successfully') }}</p>
                @endif
                <div class="queuing-form-block">
                    <form action="{{ route('queuing.send_queuing') }}" method="post" class="queuing-form">
                        @csrf
                        <div class="queuing-form__item">
                            <label for="name" class="required">{{t('Page home.Name surname')}} </label>
                            <input type="text" name="name" id="name" maxlength="250" class="queuing-form-input"
                                   required>
                            @if ($errors->has('name'))
                                <span class="text-danger">
                       <strong>{{ $errors->first('name') }}</strong>
                   </span>
                            @endif
                        </div>
                        <div class="queuing-form__item">
                            <label for="tel" class="required">{{t('Page home.Phone')}} </label>
                            <input type="number" name="phone" id="tel" maxlength="250" class="queuing-form-input"
                                   required>
                            @if ($errors->has('phone'))
                                <span class="text-danger">
                       <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="queuing-form__item">
                            <label for="mail" class="required">{{t('Page home.Email address')}}</label>
                            <input type="email" name="email" id="mail" maxlength="250" class="queuing-form-input"
                                   required>
                            @if ($errors->has('email'))
                                <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="queuing-form__item">
                            <label for="services" class="required">{{t('Page home.Departments')}} </label>
                            <input type="text" disabled value="{{$subPage->title}}" maxlength="250"
                                   class="queuing-form-input" required>
                            <input type="hidden" name="service" value="{{$subPage->title}}" maxlength="250"
                                   class="queuing-form-input">
                            @if ($errors->has('service'))
                                <span class="text-danger">
                      <strong>{{ $errors->first('service') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="queuing-form__item">
                            <label for="date" class="required">{{t('Page home.Desired day of visit')}} </label>
                            <input id="date" name="date" class="form-control setTodaysDate" type="date" maxlength="250"
                                   class="queuing-form-input" required>
                            @if ($errors->has('date'))
                                <span class="text-danger">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="queuing-form__item">
                            <label for="time">{{t('Page home.Preferred time')}}    </label>
                            <select id="time" name="time">
                                <option value="0" selected disabled>{{t('Page home.Select desired time')}} </option>
                                @foreach($time as $item)
                                    <option value='{{$item->hour}} : {{$item->minute}}' name='time'>{{$item->hour}}
                                        : {{$item->minute}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="queuing-form__item wth">
                            <label for="text">{{t('Page static contacts.message')}}</label>
                            <textarea name="message" id="text" maxlength="250"></textarea>
                        </div>
                        <div class="queuing-form__item">
                            <div class="g-recaptcha" data-sitekey="6LejQG4mAAAAAFkreiVL2jBAT17M-UslLQgkrU8E"></div>
                        </div>
                        <div class="queuing-form__item">
                            <button type="submit" class="queuing-form__btn button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20">
                                    <path id="Union_35" data-name="Union 35"
                                          d="M6.186,20V13.913h6.186V20Zm6.628-6.956V6.957H19v6.087ZM0,13.044V6.957H6.186v6.087ZM6.186,6.087V0h6.186V6.087Z"
                                          fill="#fff"></path>
                                </svg>
                                {{t('Page home.Submit application')}}
                            </button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="shares-block">
                <div class=" text-center">
                    <p class="share_title">{{t('Page home.Share')}}</p>
                    <div class="share text-center mb15 pt-0">
                        <div class="colblack fs-13 text-center mb5"></div>
                        <span title="Whatsapp" class="hidden_desk"
                              onclick="shareToWhatsApp('{{ url()->current() }}', '{{$subPage->title}}', '{{ asset('image/'.$subPage->image) }}', '{{ $subPage->seo_description }}')">
                        <button type="button" class="share-button wa-button">
                            <span class="sr-only">Whatsapp</span>
                            <i class="fa-brands fa-whatsapp"></i>
                        </button>
                    </span>

                        <span title="Facebook"
                              onclick="Share.facebook('{{ url()->current() }}','{{$subPage->title}}','{{ $subPage->getImageUrl('thumbnail', $subPage->image) }}','{{$subPage->title }}')">
                        <button type="button" class="share-button fb-button">
                            <span class="sr-only">Facebook</span>
                            <i class="fa-brands fa-facebook-f"></i>
                        </button>
                    </span>
                        <span title="Linkedin"
                              onclick="Share.linkedin('{{ url()->current() }}','{{$subPage->title}}','{{$subPage->image}}','{{ $subPage->title }}')">
                        <button type="button" class="share-button in-button">
                            <span class="sr-only">Linkedin</span>
                            <i class="fa-brands fa-linkedin"></i>
                        </button>
                    </span>
                        <span title="Vkontakte"
                              onclick="Share.vkontakte('{{ url()->current() }}','{{$subPage->title}}','{{asset('image/'.$subPage->image)}}','')">
                        <button type="button" class="share-button vk-button">
                            <span class="sr-only">Vkontakte</span>
                            <i class="fa-brands fa-vk"></i>
                        </button>
                    </span>
                        <span title="Twitter" onclick="Share.twitter('{{ url()->current() }}','{{$subPage->title}}')">
                        <button type="button" class="share-button tw-button">
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

@push('js')
    <script>
        const subPageAlias = '{{ $subPage->url }}';
        const mediaItemsUrl = '{{ route('getMediaItemsView', ['url' => ':subPageAlias']) }}';

        window.onload = function () {
            document.querySelector('.department-filter').click();
        }
        $('.department-filter').on('click', function () {
            var name = $(this).val();
            var data_id = $('.department-dinamic-content').data('id');

            if (name == 'services') {
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.department-services').show()
                $('.department-content, .media').hide()
                $('.doctors-row').hide()
                $('.price-list').hide()
                $('.department-dinamic-content').hide()
            } else if (name == 'price') {
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.price-list').show()
                $('.department-content, .media').hide()
                $('.doctors-row').hide()
                $('.department-services').hide()
                $('.department-dinamic-content').hide()
            } else if (name == 'general-information') {
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.department-content').show()
                $('.price-list, .media').hide()
                $('.doctors-row').hide()
                $('.department-services').hide()
                $('.department-dinamic-content').hide()
            } else if (name == 'personnel') {
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.doctors-row').show()
                $('.price-list, .media').hide()
                $('.department-content').hide()
                $('.department-services').hide()
                $('.department-dinamic-content').hide()
            } else if (name == 'media') {
                $('.department-filter').removeClass('department-page-filter__item_active');
                $(this).addClass('department-page-filter__item_active');
                $('.media').show();
                $('.price-list').hide();
                $('.department-content').hide();
                $('.doctors-row').hide();
                $('.department-services').hide();
                $('.department-dinamic-content').hide();

                if ($('.section-loading').length) {
                    loadMediaItems().then((html) => {
                        $('.gallery-row.gallery-row-all').html(html);
                    })
                }
            } else if (name) {
                $('.department-filter').removeClass('department-page-filter__item_active')
                $(this).addClass('department-page-filter__item_active')
                $('.doctors-row').hide()
                $('.price-list, .media').hide()
                $('.department-content').hide()
                $('.department-services').hide()
                let all = document.querySelectorAll('.department-dinamic-content');
                all.forEach((item) => {
                    if (item.getAttribute('data-id') == name) {
                        item.style.display = 'block'
                    } else {
                        item.style.display = 'none'
                    }
                })
            }
        });


        async function loadMediaItems() {
            const response = await fetch(mediaItemsUrl.replace(':subPageAlias', subPageAlias));

            return await response.text();
        }
    </script>
@endpush
