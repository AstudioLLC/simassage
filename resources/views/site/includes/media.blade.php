<div class="media-filter">
    @if ($gallery->isNotEmpty() && $videoGallery->isNotEmpty())
        <button class="media-filter__item media-filter__item-active media_all" type="button"
                value="all">{{ t('Page home.All') }}</button>
    @endif
    @if (count($gallery))
        <button class="media-filter__item media_photo" type="button"
                value="media_photo">{{ t('Page home.Photo') }}</button>
    @endif
    @if (count($videoGallery))
        <button class="media-filter__item media_video" type="button"
                value="media_video">{{ t('Page home.Video') }}</button>
    @endif
</div>

<div class="gallery-row gallery-row-all">
    @foreach ($gallery->concat($videoGallery) as $item)
        @if (isset($item->link))
            @php
                // Extract video ID from the video link
                 $videoId = substr($item->link, strrpos($item->link, '/') + 1);

                 // Remove the query string and everything after it
                 $videoId = strtok($videoId, '?');

                 // Construct thumbnail URL
                 $imgLink = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
            @endphp
            <div class="gallery-row__item gallery-video ">
                <a data-fancybox="gallery" data-src="{{ $item->link }}">
                    <img class="img iframe-img" src="{{ $imgLink }}"  loading="lazy" alt="">
                    <iframe width="100%" height="100%" src="{{ $item->link }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#fff"
                         class="media-play bi bi-play-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z" />
                    </svg>
                </a>
            </div>
        @else
            <div class="gallery-row__item gallery-photo">
                <a data-fancybox="gallery" data-src="{{ $item->getImageUrl('thumbnail') }}">
                    <img class="img"  loading="lazy" src="{{ $item->getImageUrl('small') }}" alt="">
                </a>
            </div>
        @endif
    @endforeach
</div>
@push('css')
    <style>

        .media-filter {
            display: flex;
            margin-top: 47px;
        }

        .media-filter__item {
            border: none;
            outline: none !important;
            background: transparent;
            font-weight: normal;
            font-style: italic;
            font-size: 13px;
            text-align: left;
            color: #9D9D9D;
        }

        .media-filter__item:not(:last-child)::after {
            content: "/";
            padding: 0 8px;
        }

        .media-filter__item-active {
            color: var(--green);
        }

        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            margin: 17px -6px;
        }

        .gallery-row__item {
            cursor: pointer;
            padding: 6px;
            width: 25%;
        }

        .gallery-video>a {
            position: relative;
            overflow: hidden;
            width: 100%;
            display: block;
            padding-top: 74%;
        }

        .iframe-img {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .media-play {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 12;
            margin: auto auto;
        }

        .gallery-row__item iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

    </style>
@endpush
@push('js')
    <script>
        $('.media-filter__item').on('click', function() {
            var name = $(this).val();
            if (name == 'media_photo') {
                $('.gallery-row,.gallery-photo,.gallery-row-all').show();
                $('.gallery-video').hide(); // Hide all gallery items
                $('.media_photo').addClass('media-filter__item-active');
                $('.media_all').removeClass('media-filter__item-active');
                $('.media_video').removeClass('media-filter__item-active');
            } else if (name == 'media_video') {
                $('.gallery-row,.gallery-video,.gallery-row-all').show();
                $('.gallery-photo').hide();
                $('.media_video').addClass('media-filter__item-active');
                $('.media_all').removeClass('media-filter__item-active');
                $('.media_photo').removeClass('media-filter__item-active');

            } else if (name == 'all') {
                $('.gallery-row__item').show(); // Show all gallery items
                $('.media_all').addClass('media-filter__item-active');
                $('.media_video').removeClass('media-filter__item-active');
                $('.media_photo').removeClass('media-filter__item-active');
            }
        });
    </script>
@endpush
