@if($items)
        <div class="position-relative">
            @if(count($items)>1)
            <button class="language-btn @foreach($items as $item) @if(app()->getLocale() == $item->iso) active ">{{ $item->title }} @endif @endforeach</button>
            @endif
            <div class="switcher d-none">
                @foreach($items as $item)
                    <a href="{{url(\LanguageManager::getUrlWithLocale($item->iso)) }}" class="language-link text-decoration-none @if(app()->getLocale() == $item->iso) active @endif">
                        @if($item->iso == 'hy' && app()->getLocale() !== $item->iso)
                            <div class="dashed-border d-flex justify-content-end align-items-center">
                                <img src="{{ asset('images/Flag_of_Armenia.svg.svg') }}" alt="flag" class="w-100">
                            </div>
                        @elseif($item->iso == 'ru' && app()->getLocale() !== $item->iso)
                            <div class="dashed-border  d-flex justify-content-end align-items-center">
                                <img src="{{ asset('images/russianflag.svg') }}" alt="flag" class="w-100">
                            </div>
                        @elseif($item->iso == 'en' && app()->getLocale() !== $item->iso)
                            <div class="d-flex justify-content-end align-items-center">
                                <img src="{{ asset('images/usa.svg') }}" alt="flag" class="w-100">
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
@endif
