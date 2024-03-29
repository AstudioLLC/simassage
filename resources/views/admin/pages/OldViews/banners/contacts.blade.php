@extends('admin.pages.banners.layout')
@section('title', t('Admin content.main title') . " " . $banners['content'][0]['data']['title'][$lang])
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>t('Admin content.main title')])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок'])
                @banner('content.title', 'Название блока')
{{--                @banner('content.text', 'Текст после названии')--}}
{{--                @banner('content.contact_title', 'Название второго блока')--}}
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок для главной страницы '])
                @banner('content.first', 'Первый текст')
                @banner('content.second', 'Второй текст')
                @banner('content.third', 'Третий текст')
                @banner('content.button', 'Текст для кнопки')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
