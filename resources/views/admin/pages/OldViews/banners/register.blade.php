@extends('admin.pages.banners.layout')
@section('title', 'Контент главной страницы |Нужно интегрировать переводы')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Первый банер'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Левый блок'])
            @banner('content.left', 'Левый блок')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Правый блок'])
            @banner('content.right', 'Правый блок')
            @endcard
        </div>

    </div>
    @endbannerBlock

@endsection
