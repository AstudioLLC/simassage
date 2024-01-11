@extends('site.layouts.app')

@section('content')
    @include('site.includes.breadcrumbs', ['page' => $page ?? null])
    <section class="works">
        <div class="container">
            <div class="my-4 text-muted px-2">
                {!! $page->content !!}
            </div>
            <div class="row my-5">
                @foreach($activity as $item)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <a class="text-black text-decoration-none" href="{{ route('activity.detail', ['url' => $item->url ?? null]) }}">
                            <div class="card p-4 text-center border-1 border-white shadow-sm mb-4">
                                <div class="crad-body">
                                    <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}" alt=""
                                         class="img-fluid">
                                    <h3 class="card-title h4 my-4">{{ $item->title }}</h3>
                                    <p class="card-text text-muted">
                                        {!! Str::limit(strip_tags($item->short),110) !!}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
