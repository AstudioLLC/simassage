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
    @bannerBlock(['title'=>t('Admin content.main title')])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>t('Admin content.content')])
            @banner('main_banner.title', t('Admin content.title'))
            @banner('main_banner.content', t('Admin content.text'))
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
