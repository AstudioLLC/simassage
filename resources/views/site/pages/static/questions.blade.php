@extends('site.layouts.app')

@section('content')
{{--            @include('site.includes.breadcrumbs', ['page' => $page ?? null])--}}
    <div class="question-page">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h1 class="section-title-text">{{$page->title}}</h1>
            </div>
            <div class="qusetion-block">
                <div class="wrapper">
                    <div class="acordeon-core">
                        @foreach($question as $index => $item)
                        <div class="acordeon">
                            <input id="{{$item->id}}" type="checkbox" name="acordeons">
                            <label for="{{$item->id}}"><p>{{$item->title}}</p></label>
                            <div class="acordeon-content">
                                <p> {!! $item->content !!}--}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
@endsection
