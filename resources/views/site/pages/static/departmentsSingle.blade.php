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
<section class="services-page-section">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h2 class="section-title-text">{{ $subPage->title }} </h2>
        </div>
        <div class="service-page">
            <div class="services-block-img">
                <img src="{{ $subPage->getImageUrl('thumbnail', $subPage->image) }}" alt="" class="img">
            </div>
            <div class="service-ditail-form">
                <div class="contact-item-two">
                    <div class="section-title">
                        <img src="./Images/flower-2.png" alt="">
                        <h2 class="section-title-text">{{__('app.help')}}</h2>
                    </div>
                    <div class="contact-form-block">
                        <form action="{{ route('queuing.send_queuing') }}" method="post">
                            <input type="hidden" name="service" value="{{$subPage->title}}" maxlength="250">
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
        <div class="service-ditail-text">
            @if($subPage->phone)
                <h2 class="service-ditail-title">{{__('app.procedurePrice')}} {{$subPage->phone}}<span>֏</span></h2>
            @endif
            <div class="editor">{!! $subPage->content !!}</div>
        </div>
        @if($doctors->count())
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{__('app.masseuses')}}</h2>
            </div>
        @endif
        <div class="staff-block">
            <div class="product-card-slider">
                <div class="product-card">
                    @foreach($doctors as $doctor)
                    <div class="product-card-item">
                        <a href="{{ route('doctors.detail', ['url' => $doctor->url ?? null]) }}">
                            @if (!$doctor->imageBig)
                                <img class="img" src="{{ asset('image/doctor_not_found.png') }}" alt="">
                            @else
                                <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}"
                                     alt="">
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
        @if(count($gallery) || count($videoGallery))
            @include('site.includes.media')
        @endif
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
