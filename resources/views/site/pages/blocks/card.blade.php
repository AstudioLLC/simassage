@if($item)
    @if($index %2 == 0)
        <div class="container-small about-top">
            <div class="row">
                <div class="col-12 col-lg-6 p-lg-4">
                    <div class="about-text-content">
                        <div class="text-orange">
                            {{ $item->title }}
                        </div>
                        <div class="donate-pic-group">
                            @if($item->icon)
                                <div class="donate-pic">
                                    <img class="img-fluid"
                                         src="{{ $item->getImageUrl('thumbnail', $item->icon) }}"
                                         alt="{{ $item->title }}"
                                         title="{{ $item->title }}">
                                </div>
                            @endif
                            @if($item->count)
                                <div class="about-number">
                                    {{ $item->count }}
                                </div>
                            @endif
                        </div>
                        @if($item->small_title)
                            <div class="about-number-text-orange">
                                {{ $item->small_title }}
                            </div>
                        @endif
                        <div class="editor">
                            {!! $item->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-lg-4 about-picture-right">
                    @if($item->image)
                        <img class="w-100"
                             src="{{ $item->getImageUrl('thumbnail') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="container-small my-margin about2">
            <div class="row">
                <div class="col-12 col-lg-6 p-lg-3 about-picture-right">
                    @if($item->image)
                        <img class="w-100"
                             src="{{ $item->getImageUrl('thumbnail') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                    @endif
                </div>
                <div class="col-12 col-lg-6 p-lg-3">
                    <div class="about-details d-flex flex-column">
                        <div class="text-orange">
                            {{ $item->title }}
                        </div>
                        <div class="donate-pic-group">
                            @if($item->icon)
                                <div class="donate-pic">
                                    <img class="img-fluid"
                                         src="{{ $item->getImageUrl('thumbnail', $item->icon) }}"
                                         alt="{{ $item->title }}"
                                         title="{{ $item->title }}">
                                </div>
                            @endif
                            @if($item->count)
                                <div class="about-number">
                                    {{ $item->count }}
                                </div>
                            @endif
                        </div>
                        @if($item->small_title)
                            <div class="about-number-text-orange">
                                {{ $item->small_title }}
                            </div>
                        @endif
                        <div class="editor">
                            {!! $item->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
