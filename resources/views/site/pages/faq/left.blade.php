@if($items)
    <div class="left-panel-faq d-flex flex-column">
        @if($active)
            <a href="{{ route('faq.detail', ['url' => $active->url ?? null]) }}"
               class="faq-link text-decoration-none active">
                {{ $active->title ?? null }}
            </a>
            @foreach($items as $item)
                @if($item->id != $active->id)
                    <a href="{{ route('faq.detail', ['url' => $item->url ?? null]) }}"
                       class="faq-link text-decoration-none">
                        {{ $item->title ?? null }}
                    </a>
                @endif
            @endforeach
        @endif
    </div>
@endif
