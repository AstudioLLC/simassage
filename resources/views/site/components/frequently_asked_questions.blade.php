<div class="frequently-asked-questions-component my-margin d-flex justify-content-center align-items-end">
    <img class="img-fluid d-none d-sm-block" src="{{ asset('images/questions-background.png') }}" alt="" title="">
    <img class="w-100 d-sm-none" src="{{ asset('images/questions-image-2.png') }}" alt="" title="">
    <div class="frequently-asked-question-content position-absolute d-flex flex-column">
        <span class="title-usual">{{ __('frontend.FAQ.Get to know the frequently asked questions') }}</span>
        <a href="{{ route('page', ['url' => $faq->url]) }}" class="button-orange text-decoration-none">
            {{ __('frontend.FAQ.Get acquainted') }}
        </a>
    </div>
</div>
