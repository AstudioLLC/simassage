@if($items)
    <ul class="d-flex menu">
        @foreach($items as $item)
            <li>
                @if( isset($item->static) && $item->static == 'home')
                    <a @if(Request::getPathInfo() == '/') style="color: #ED3237;" @endif href="{{ route('page', ['url' => '/'] )}}" {{ !count($item->childrenForHeader) ? 'href='. route('page', ['url' => $item->url]) .'' : null }}>{{ $item->title }}
                    </a>
                @else
                    <a @if(Request::getPathInfo() == '/'.$item->url) style="color: #ED3237;" @endif href="{{ route('page', ['url' => $item->url] )}}" {{ !count($item->childrenForHeader) ? 'href='. route('page', ['url' => $item->url]) .'' : null }}>{{ $item->title }}</a>
                @endif
            </li>
        @endforeach
    </ul>
@endif
