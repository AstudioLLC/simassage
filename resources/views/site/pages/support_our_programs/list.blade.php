@if($items)
    <div class="how-to-help-links">
        <div class="row">
            @foreach($items as $item)
                @if($item->active)
                    @include('site.pages.support_our_programs.card', ['item' => $item])
                @endif
            @endforeach
        </div>
    </div>
@endif
