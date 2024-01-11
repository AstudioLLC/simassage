@if($items)
    @foreach($items as $item)
        @include('site.pages.blocks.card', ['item' => $item, 'index' => $loop->index])
    @endforeach
@endif
