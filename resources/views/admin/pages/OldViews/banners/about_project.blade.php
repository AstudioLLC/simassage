@extends('admin.pages.banners.layout')
@section('title', t('Admin content.main title') . " " . $banners['content'][0]['data']['title'][$lang])
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>t('Admin content.main title')])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>t('Admin content.content')])
                @banner('content.top_text', t('Admin content.text top'))
                @banner('content.bottom_text', t('Admin content.text bottom'))
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
