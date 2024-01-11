@if($items)
    <div class="d-flex social-media">
        @foreach($items as $item)
            <a {{ $item->url ? 'target=_blank' : '' }} href="{{ $item->url ?? 'javascript:void(0)' }}">
                <img class="img-fluid" src="{{ $item->getImageUrl('thumbnail') }}" alt="{{ $item->title ?? null }}" title="">
            </a>
        @endforeach
    </div>
@endif
