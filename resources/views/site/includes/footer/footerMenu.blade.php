@if($items)
        @foreach($items as $item)
                @if(isset($item->static) && $item->static == 'home')
                    <li class="footer-menu__item">
                        <a class="footer-menu__link" href="{{ route('page', ['url' => '/']) }}" >{{ $item->title }}</a> 
                    </li>
                @elseif($item->parent_id == 67)
               
                <li class="footer-menu__item"><a class="footer-menu__link @if($item->url == Request::segment(2) || $item->url == Request::segment(3)) footer-menu__link_active @endif" href="{{route('subpage', ['url' => $item->url])}}" >{{ $item->title }}</a> </li>
                @else
                    <li class="footer-menu__item"><a class="footer-menu__link @if('/'.$item->url == Request::getPathInfo() || '/ru/'.$item->url == Request::getPathInfo() || '/en/'.$item->url == Request::getPathInfo() ) footer-menu__link_active @endif" href="{{ route('page', ['url' => $item->url]) }}" >{{ $item->title }}</a> </li>
                @endif
        @endforeach
@endif
