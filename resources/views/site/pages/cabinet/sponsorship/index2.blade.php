@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/home-sponsor-a-child.css') }}">
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])

    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>

            <div class="profile-content-right">
                <div class="step-pages-construction d-flex flex-column">
                    <span class="title-usual text-start">Sponsor a child</span>
                    <div class="steps-breadcrumb-wrap d-flex justify-content-start align-items-center">
                        <div class="steps-breadcrumb d-flex align-items-center">
                            <div class="circle-wrap active-step d-flex flex-column align-items-center">
                                <div class="circle">
                                    <span class="circle-number">1</span>
                                </div>

                                <span class="circle-bottom-text d-none d-sm-block">General info</span>
                            </div>
                            <div class="steps-band"></div>
                            <div class="circle-wrap d-flex flex-column align-items-center">
                                <div class="circle circle-two">
                                    <span class="circle-number">2</span>
                                </div>

                                <span class="circle-bottom-text d-none d-sm-block">Terms &amp; Co.</span>
                                <span class="circle-bottom-text active-step-name d-sm-none">General info</span>
                            </div>
                            <div class="steps-band"></div>
                            <div class="circle-wrap d-flex flex-column align-items-center">
                                <div class="circle circle-two">
                                    <span class="circle-number">3</span>
                                </div>

                                <span class="circle-bottom-text d-none d-sm-block">Billing Info</span>
                            </div>
                        </div>
                    </div>

                    <div class="step-white-block-wrap w-100 d-flex justify-content-center align-items-center">
                        <div class="step-white-block">
                            <form class="row w-100" id="sponsored-child-general-info-form-page-1" action="/" method="POST">
                                <div class="col-12 col-md-6 col-left">
                                    <div class="white-group-main w-100 d-flex flex-column">
                                        <span class="step-group-names">Whom do you want to sponsor?</span>
                                        <div class="select-group">
                                            <select class="select" name="approach-type">
                                                <option disabled>Select approach type</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="select-group">
                                                    <select class="select" name="language">
                                                        <option disabled>Age</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="select-group">
                                                    <select class="select" name="language">
                                                        <option disabled>Area</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="white-group-main w-100 d-flex flex-column">
                                        <span class="step-group-names">Monthly Donation Amount</span>
                                        <div class="step-button">8000 AMD</div>
                                    </div>

                                    <div class="white-group-main w-100 d-flex flex-column">
                                        <span class="step-group-names">Frequency</span>
                                        <div class="step-group">
                                            <label class="text-default custom-radio mb-2"><input name="frequency" type="radio" value=">automatic"><span>1 month  8000AMD</span></label>
                                            <label class="text-default custom-radio"><input name="frequency" type="radio" value="manually"><span>1 year  96000AMD</span></label>
                                            <label class="text-default custom-radio"><input name="frequency" type="radio" value="manually"><span>3 months  24000AMD</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-right">
                                    <div class="white-group-main">
                                    <span class="step-group-names d-flex align-items-center">
                                        Recurring payment
                                        <img class="img-fluid information" src="http://admin.astudio.laravel/images/information.svg" alt="" title="">
                                    </span>

                                        <div class="step-group step-group-right">
                                            <label class="text-default custom-radio"><input name="recurring-payment" type="radio" value=">automatic"><span>Automatic</span></label>
                                            <label class="text-default custom-radio"><input name="recurring-payment" type="radio" value="manually"><span>Manually</span></label>
                                        </div>
                                    </div>

                                    <div class="white-group-main">
                                    <span class="step-group-names d-flex align-items-center">
                                        Do you want to receive letters from sponsored child?
                                    </span>

                                        <div class="step-group step-group-right">
                                            <label class="text-default custom-radio"><input name="do-you-want-to-receive-letters-from-sponsored-child" type="radio" value=">automatic"><span>Yes</span></label>
                                            <label class="text-default custom-radio"><input name="do-you-want-to-receive-letters-from-sponsored-child" type="radio" value="manually"><span>No</span></label>
                                        </div>
                                    </div>



                                    <div class="white-group-main">
                                        <textarea name="sponsor-a-child-comment" placeholder="Comment" class="input-default textarea-default"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-center align-items-center mt-4">
                                    <button class="button-orange" style="margin-right: auto">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site.components.donate_now')
@endsection
