@extends('admin.pages.banners.layout')
@php
    if(isset($banners['content'][0]['data']['title'][$lang])){
        $title = $banners['content'][0]['data']['title'][$lang];
    }else{
        $title = '';
    }
@endphp
@section('title', t('Admin content.main title') . " " . $title)
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-4">
            @card
                @banner('content.image', t('Admin pages form.image') . ' (1440 x 320)')
            @endcard
        </div>
        <div class="col-12 col-dxl-4">
            @card
                @banner('content.title', t('Admin pages form.title'))
            @endcard
        </div>
        <div class="col-12 col-dxl-4">
            @card
                @banner('content.url_text', t('Admin main slider form.button text'))
            @endcard
        </div>
        <div class="col-12 col-dxl-4">
            @card
                @banner('content.text', t('Admin pages form.content text'))
            @endcard
        </div>

        <div class="col-12 col-dxl-4">
            @card
                @banner('content.url', t('Admin pages form.url'))
            @endcard
        </div>
    @endbannerBlock
@endsection
