@if($item)
    <div class="col-12 col-sm-6 col-lg-4 p-3 d-flex flex-column care-center-card">
        <div class="care-center-image-wrap">
            @if($item->imageSmall)
                <a href="{{ route('fundraisers.detail', ['url' => $item->url ?? null]) }}" class="text-decoration-none">
                    <img class="w-100"
                         src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"
                         alt="{{ $item->title }}"
                         title="{{ $item->title }}">
                </a>
            @endif
        </div>
        <div class="care-center-card-wrap">
            <a href="{{ route('fundraisers.detail', ['url' => $item->url ?? null]) }}" class="text-decoration-none">
                <span class="care-center-card-name">{{ $item->title ?? null }}</span>
            </a>
            @include('.site.components.progressbar', ['item' => $item])
        </div>
    </div>
@endif
