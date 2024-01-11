@if($item)
    <div class="col-6 col-lg-4 p-2 p-md-3">
        <a href="{{ route('page', ['url' => $item->url ?? null] )}}"
           class="d-flex justify-content-center flex-column align-items-center help-link text-decoration-none">
            <span class="d-block help-picture">
                @if($item->icon)
                    <img class="img-fluid"
                         src="{{ $item->getImageUrl('thumbnail', $item->icon) }}"
                         alt="{{ $item->title }}"
                         title="{{ $item->title }}">
                @endif
            </span>
            <span class="help-box-name">{{ $item->title }}</span>
        </a>
    </div>
@endif
