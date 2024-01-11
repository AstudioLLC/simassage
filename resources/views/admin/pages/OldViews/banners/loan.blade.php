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
            @banner('content.title', t('Admin content.title'))
            @banner('content.content', t('Admin content.text'))
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>t('Admin content.image')])
            @banner('content.image', t('Admin content.image size') . ' (1440 x 292)')
            @endcard
            @if(isset($banners['content'][0]['data']['image']))
                @component('admin.components.imageDestroy', ['id' => $banners['content'][0]['id'], 'action' => route('admin.zayob.deleteImage')])@endcomponent
            @endif
        </div>
    </div>
    @endbannerBlock
@endsection
