@if($items)
    @foreach($items->faq as $item)
        <div class="text-default">
            <p class="mb-2">{{ $item->title ?? null }}</p>
            <div class="editor">
                {!! $item->content ?? null !!}
            </div>
        </div>
    @endforeach
@endif
