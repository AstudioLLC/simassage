@if($item)
    <div class="sponsor-card">
        <div class="children-photo d-flex align-items-sm-start">
            @if($item->image)
                <div class="children-photo-wrap">
                    <img class="img-fluid"
                         src="{{ $item->getImageUrl('thumbnail') }}"
                         alt="{{ $item->title }}"
                         title="{{ $item->title }}">
                </div>
            @endif
            <div class="children-info d-flex flex-column d-md-none">
                <span class="text-default children-name">
                    {{ $item->title ?? null }}
                </span>
                <span class="text-default children-age">
                    {{ $item->child_id ?? null }}
                </span>
                <span class="text-default children-age">
                    {{ __('frontend.cabinet.Age') }} {{ $item->calculateAge() }}
                </span>
            </div>
        </div>
        <div class="card-details d-flex flex-column w-100">
            <div class="children-info-web d-none d-md-flex flex-column">
                <span class="text-default children-name">
                    {{ $item->title ?? null }}
                </span>
                <span class="text-default children-age">
                    {{ $item->child_id ?? null }}
                </span>
                <span class="text-default children-age">
                    {{ __('frontend.cabinet.Age') }} {{ $item->calculateAge() }}
                </span>
            </div>
            <div class="row w-100 m-0 sponsor-card-links-group">
                <div class="col-6 col-md-3 p-3 ps-0 p-md-0">
                    <a class="d-flex align-items-center sponsor-card-link text-decoration-none">
                        <img class="img-fluid"
                             src="{{ asset('images/play.svg') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                        <span class="sponsor-card-link-span text-decoration-none text-default">
                            {{ __('frontend.cabinet.Videos') }}
                        </span>
                    </a>
                </div>

                <div class="col-6 col-md-3 p-3 ps-0 p-md-0">
                    <a class="d-flex align-items-center sponsor-card-link text-decoration-none">
                        <img class="img-fluid"
                             src="{{ asset('images/photos.svg') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                        <span class="sponsor-card-link-span text-decoration-none text-default">
                            {{ __('frontend.cabinet.Photos') }}
                        </span>
                    </a>
                </div>
                <div class="col-6 col-md-3 p-3 ps-0 p-md-0">
                    <a class="d-flex align-items-center sponsor-card-link text-decoration-none"
                       href="{{ route('cabinet.chat.index', ['childrenId' => $item->id, 'sponsorId' => $user->id]) }}">
                        <img class="img-fluid"
                             src="{{ asset('images/letters.svg') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                        <span class="sponsor-card-link-span text-decoration-none text-default">
                            {{ __('frontend.cabinet.Letters') }}
                        </span>
                    </a>
                </div>
                <div class="col-6 col-md-3 p-3 ps-0 p-md-0">
                    <a class="d-flex align-items-center sponsor-card-link text-decoration-none">
                        <img class="img-fluid"
                             src="{{ asset('images/reports.svg') }}"
                             alt="{{ $item->title }}"
                             title="{{ $item->title }}">
                        <span class="sponsor-card-link-span text-decoration-none text-default">
                            {{ __('frontend.cabinet.Reports') }}
                        </span>
                    </a>
                </div>
            </div>
            <div class="row w-100 m-0 sponsor-card-buttons-group">
                <div class="col-12 col-sm-3 p-2 ps-0">
                    <a type="button" class="button-orange text-decoration-none">
                        {{ __('frontend.cabinet.Donate') }}
                    </a>
                </div>
                <div class="col-12 col-sm-3 ps-0 ps-sm-2 p-2 ">
                    <a type="button" class="button-orange button-orange-white text-decoration-none">
                        {{ __('frontend.cabinet.Details') }}
                    </a>
                </div>
                <div class="col-12 col-sm-3 ps-0 ps-sm-2 p-2">
                    <a type="button" class="button-orange button-orange-gift text-decoration-none">
                        {{ __('frontend.cabinet.Give a gift') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
