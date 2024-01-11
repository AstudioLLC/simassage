@extends('site.mails.layout')
@section('content')
    <p>Новый пользователь на сайте {{ $_SERVER['SERVER_NAME'] }}.</p>
    <p>Адрес эл.почты: {{ $email }}</p>
@endsection
