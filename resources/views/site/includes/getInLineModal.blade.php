<div class="price-list-modal-bg">
    <div class="price-list-modal">
        <div class="title-block">
            <h2 class="title-block__title">{{t('Page home.Enrol')}} </h2>
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
        <div class="test">
        </div>

        @if(($cart_data))
                <?php $price = 0 ?>
            @foreach($cart_data as $data)
                    <?php $price += $data['item_price'] ?>
                <p class="queued-text queued" data-id="{{$data['item_id']}}"
                   data-price="{{$data['item_price']}}">
                   @if($data['item_price_code'])
                        {{$data['item_price_code']}} -
                    @endif
                    {{$data['item_name']}} - {{formatPrice($data['item_price'])}} &#x58F;
                </p>
            @endforeach
            <p class="queued-text-total">{{t('Page home.Total')}} <span
                    class="price">{{formatPrice($price)}} &#x58F;</span></p>
            @endif
        <form action="{{route('queuing.send_queuing_with_items')}}" method="post" class="queuing-form">
            @csrf
            <div class="queuing-form__item">
                <label for="name" class="required">{{t('Page home.Name surname')}}</label>
                <input type="text" id="name" name="name" maxlength="250" class="queuing-form-input" required>
                @if ($errors->has('name'))
                    <span class="text-danger">
                       <strong>{{ $errors->first('name') }}</strong>
                   </span>
                @endif
            </div>
            <div class="queuing-form__item">
                <label for="tel" class="required">{{t('Page home.Phone')}}</label>
                <input type="number" id="tel" name="phone" maxlength="250" class="queuing-form-input" required>
                @if ($errors->has('phone'))
                    <span class="text-danger">
                       <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
            <div class="queuing-form__item">
                <label for="mail" class="required">{{t('Page home.Email address')}}</label>
                <input type="email" id="mail" name="email" maxlength="250" class="queuing-form-input" required>
                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="queuing-form__item">
                <label for="services" class="required">{{t('Page home.Departments')}} </label>
                <select id="services" name="service">
                    <option value="0" selected disabled>{{t('Page home.Select department')}}</option>
                    @foreach($departments as $department)
                        <option
                            value="{{$department->title}}">{{ \Illuminate\Support\Str::limit($department->title, 25) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('service'))
                    <span class="text-danger">
                      <strong>{{ $errors->first('service') }}</strong>
                    </span>
                @endif
            </div>
            <div class="queuing-form__item">
                <label for="date" class="required">{{t('Page home.Desired day of visit')}} </label>
                <input id="date" name="date" class="form-control setTodaysDate " type="date" maxlength="250"
                       class="queuing-form-input" required>
                @if ($errors->has('date'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="queuing-form__item">
                <label for="time">{{t('Page home.Preferred time')}}     </label>
                <select id="time" name="time">
                    <option value="0" selected disabled>{{t('Page home.Select desired time')}}</option>
                    @foreach($time as $item)
                        <option value="{{$item->hour}} : {{$item->minute}}">{{$item->hour}}
                            : {{$item->minute}} </option>
                    @endforeach
                </select>
            </div>
            <div class="queuing-form__item wth">
                <label for="text">{{t('Page static contacts.message')}}  </label>
                <textarea name="message" id="text" maxlength="250"></textarea>
            </div>
            <div class="queuing-form__item">
                <div class="g-recaptcha" data-sitekey="6LejQG4mAAAAAFkreiVL2jBAT17M-UslLQgkrU8E"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger">
                                <strong>{{ $errors->first('g-recaptcha-response') }} recaptcha</strong>
                        </span>
                @endif
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
</div>
