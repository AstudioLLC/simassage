@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/my-donations.css') }}">
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])
    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>
            @if(count($donations))
                <div class="profile-content-right">
                    <div class="my-donations-page d-flex flex-column">
                        <div class="donations-page-top d-flex flex-column">
                            <span class="title-usual text-start">{{ __('frontend.cabinet.My donations') }}</span>
                            <div class="donation-history-block">
                                <span class="history-text">{{ __('frontend.cabinet.All donation history') }}</span>

                                <form class="datepickers-form">
                                    <div class="datepickers-group">
                                        <input class="date-input" type="date">
                                        <span>-</span>
                                        <input class="date-input date-input2" type="date">
                                    </div>

                                    <button class="button-orange calendar-orange-button" type="submit">
                                        <img class="img-fluid" src="{{ asset('images/loupe22.svg') }}" alt="" title="">
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="donation-table-wrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="th-names">{{ __('frontend.cabinet.table.Data') }}</th>
                                    <th scope="col" class="th-names">{{ __('frontend.cabinet.table.Designation') }}</th>
                                    <th scope="col" class="th-names">{{ __('frontend.cabinet.table.Amount') }}</th>
                                    <th scope="col" class="th-names">{{ __('frontend.cabinet.table.Frequency') }}</th>
                                    <th scope="col" class="th-names">{{ __('frontend.cabinet.table.Receipt') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($donations as $item)
                                    <tr>
                                        <th scope="row">{{ $item->created_at->format('d/m/Y') }}</th>
                                        <td>{{ $item->comment ?? null }}</td>
                                        <td>{{ number_format($item->amount) }} {{ __('frontend.Gifts.AMD') }}</td>
                                        <td>{{ $item->is_binding ? __('frontend.cabinet.table.Monthly') : __('frontend.cabinet.table.One Time') }}</td>
                                        <td>{{ __('frontend.cabinet.table.Download Receipt') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="donation-table-mobile">
                                @foreach($donations as $item)
                                    <div class="mobile-table-box">
                                        <div class="row">
                                            <div class="col-12 mobile-table-col">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="th-names">{{ __('frontend.cabinet.table.Data') }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="th-val">{{ $item->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mobile-table-col">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="th-names">{{ __('frontend.cabinet.table.Designation') }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="th-val">{{ $item->comment ?? null }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mobile-table-col">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="th-names">{{ __('frontend.cabinet.table.Amount') }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="th-val">{{ number_format($item->amount) }} {{ __('frontend.Gifts.AMD') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mobile-table-col">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="th-names">{{ __('frontend.cabinet.table.Frequency') }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="th-val">{{ $item->is_binding ? __('frontend.cabinet.table.Monthly') : __('frontend.cabinet.table.One Time') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mobile-table-col">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <span class="th-names">{{ __('frontend.cabinet.table.Receipt') }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <span class="th-val">{{ __('frontend.cabinet.table.Download Receipt') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('site.components.donate_now')
@endsection
