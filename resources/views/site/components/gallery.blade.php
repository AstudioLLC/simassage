@if($items)
    @push('css')
{{--        <link rel="stylesheet" href="{{ asset('css/frontend/fancyapps.css') }}">--}}
        <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('js/slider.js') }}"></script>
    @endpush

    <div class="carousel">
        <div>
            <div class="d-flex flex-wrap align-items-center">
                @foreach($items as $item)
                <div class="slide" data-hash="{{ $item->id }}">
                    <img src="{{ $item->getImageUrl('small', $item->image) }}" alt="{{ $item->title }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
