@extends('site.layouts.app')
@section('title')
    <meta name="description" content="{{ $seo['description'] }}">
    <meta property='fb:app_id' content='966242223397117'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $doctor->title }}">
    <meta property="og:description" content="{{ $doctor->title }}">
    <meta property="og:image" content="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ url()->current() }}"/>
    <meta name="twitter:creator" content="@simassage">
    <meta name="twitter:title" content="{{ $page->title }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}">
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
    <div class="stuff-ditail-page-info">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h1 class="section-title-text">{{ $doctor->title }} </h1>
            </div>
            <div>
                <p class="blog-date">{{ $doctor->position }}</p>
            </div>
            <div class="blog-ditail-info">
                <div class="blog-ditail-foto">
                    @if (!$doctor->imageBig)
                        <img class="img" src="{{ asset('image/doctor_not_found.png') }}" alt="">
                    @else
                        <img class="img" src="{{ $doctor->getImageUrl('thumbnail', $doctor->imageBig) }}"
                             alt="">
                    @endif
                </div>
                <p class="editor">
                    {!! $doctor->content !!}
                </p>
            </div>
            <div class="stuff-ditail-price-block">
                <div class="section-title">
                    <img src="{{asset('image/flower-2.png')}}" alt="">
                    <h2 class="section-title-text">{{__('app.price')}}</h2>
                </div>
                <div class="price-page-block">
                    <div class="massage-price-block">
                        @foreach($departments as $department)
                            <div class="massage-div">
                                <p class="massage-name">{{$department->title}}</p>
                                @foreach($allDepartmentsPrice as $price)
                                    @if($department->id==$price->department_id)
                                        <div class="massage-price-item">
                                            <p class="massage-title">{{$price->title}}</p>
                                            <p class="massage-title-price">{{ formatPrice($price->price)}}<span>֏</span>
                                            </p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="stuff-ditail-contact-block">
                <div class="contact-item-two">
                    <div class="section-title">
                        <img src="./Images/flower-2.png" alt="">
                        <h2 class="section-title-text">{{__('app.book')}}</h2>
                    </div>
                    <div class="contact-form-block">
                        <form action="{{ route('queuing.send_queuing') }}" method="post">
                            @csrf
                            <input type="hidden" name="doctor_name" value="{{ $doctor->title }}">
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
                            <br>
                            <div class="contact-form-item contact-textarea">
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
            @if(count($gallery) || count($videoGallery))
            <div class="stuff-ditail-gallery">
                <div class="section-title">
                    <img src="{{asset('image/flower-2.png')}}" alt="">
                    <h2 class="section-title-text">{{t('Page home.Media')}}</h2>
                </div>
                    @include('site.includes.media')
                </div>
            @endif

        </div>
    </div>
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
