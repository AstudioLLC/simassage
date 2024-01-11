@extends('site.layouts.app')

@section('content')
    @include('site.includes.breadcrumbs', ['page' => $page ?? null])
    <section>
        <div class="container">
            <div class="my-4 text-muted">
                {!! $page->content !!}
            </div>
            <div class="row justify-content-start mt-5 pt-5">
                @foreach($policy as $item)
                    <div class="policy-card col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="position-relative text-break text-center border p-5 rounded mb-5">
                            <h3 class="fw-bold fs-6 my-4">{{ $item->title }}</h3>
                            <div class="position-absolute top-100 start-50 translate-middle">
                                <div
                                    class="position-relative policy-card-circle d-flex justify-content-center align-items-center">
                                    <a href="{{ route('policy' , [$item->id]) }}">
                                        <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}" alt=""
                                             class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
