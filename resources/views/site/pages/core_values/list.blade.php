@if($items)
    <div class="row mx-0 about-boxes">
        @foreach($items as $item)
            @include('site.pages.core_values.card', ['item' => $item])
        @endforeach
    </div>
@endif
