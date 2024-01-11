@foreach($gallery->concat($videoGallery) as $item)
    @if(isset($item->link))
        @php
            // Extract video ID from the video link
            $videoId = substr($item->link, strrpos($item->link, '/') + 1);
            // Construct thumbnail URL
            $imgLink = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
        @endphp
        <div class="gallery-row__item gallery-video ">
            <a data-fancybox="gallery" data-src="{{ $item->link }}">
                <img class="img iframe-img" src="{{ $imgLink }}" alt="">
                <iframe width="100%" height="100%" src="{{ $item->link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#fff" class="media-play bi bi-play-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                </svg>
            </a>
        </div>
    @else
        <div class="gallery-row__item gallery-photo">
            <a data-fancybox="gallery" data-src="{{ $item->getImageUrl('thumbnail') }}">
                <img class="img" src="{{ $item->getImageUrl('small') }}" alt="">
            </a>
        </div>
    @endif
@endforeach
