@if(isset($items))
    <div class="container-small breadcrumb-wrap">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @if($homepage)
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">
                            {!! $homepage->title !!}
                        </a>
                    </li>
                @endif
                @foreach($items as $item)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">
                            {!! $item['title'] !!}
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ !empty($item['url']) ? $item['url'] : 'javascript:void(0)' }}" class="text-decoration-none">
                                {!! $item['title'] !!}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endif
