@if($item)
    <div class="col-12 col-sm-6 col-lg-4 p-2 p-lg-3">
        <div class="about-box d-flex flex-column h-100">
            <div class="about-box-icon-wrap d-flex justify-content-center align-items-center">
                @if($item->image)
                    <img src="{{ $item->getImageUrl('thumbnail') }}"
                         alt="{{ $item->title }}"
                         title="{{ $item->title }}">
                @endif
            </div>
            <span class="about-box-title">
                {{ $item->title ?? null }}
            </span>
            <div class="about-box-description">
                {!! $item->content !!}
            </div>
        </div>
    </div>
@endif
