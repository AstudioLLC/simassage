@extends('admin.pages.banners.layout')
@section('title', 'Контент страницы Комнат |Нужно интегрировать переводы')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-4" style="height: 500px;background: white">
            @card(['title'=>'Изоброжение'])
                @banner('content.left', 'Изоброжение ( 580 x 260)')
            @endcard
        </div>
        <div class="col-12 col-dxl-4" style="height: 500px;background: white">
            @card(['title'=>'Изоброжение'])
                @banner('content.right', 'Изоброжение (830 x 260)')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
