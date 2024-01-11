@extends('site.layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/frontend/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/profile-home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/step-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/messages.css') }}">
@endpush

@push('js')
    <script src="{{ asset('js/frontend/profile.js') }}"></script>
@endpush

@section('content')
    @include('site.components.breadcrumb', ['items' => $breadcrumbs ?? null])

    <div class="page-wrap">
        <div class="container-small profile-content">
            <div class="left-panel-wrap d-none d-lg-flex">
                @include('site.pages.cabinet.includes.left_panel', ['active' => $active])
            </div>

            <div class="profile-content-right fundraiser-page d-flex justify-content-start flex-column">
                <div class="messages-block-wrap d-flex flex-column">
                    <a class="messages-back d-flex align-items-center text-decoration-none" href="{{ $backUrl ?? null }}">
                        <img class="w-100 back-messages"
                             src="{{ asset('images/messages-back.svg') }}"
                             alt="{{ __('frontend.Back') }}"
                             title="{{ __('frontend.Back') }}">
                        <span>{{ __('frontend.Back') }}</span>
                    </a>
                    <span class="title-usual text-start">
                        {{ __('frontend.cabinet.Messages') }}
                    </span>
                    <div class="messages-block-main">
                        <div class="message-author-top">
                            <div class="message-author-photo">
                                @if($children->image)
                                    <img class="w-100"
                                         src="{{ $children->getImageUrl('thumbnail') }}"
                                         alt="{{ $children->title }}"
                                         title="{{ $children->title }}">
                                @endif
                            </div>
                            <span class="message-author-name">
                                {{ $children->title }}
                            </span>
                        </div>
                        <div class="chat-block">
                            @foreach($items as $item)
                                @include('site.pages.cabinet.components.chat_card', ['item' => $item])
                            @endforeach
                        </div>
                        <div class="chat-bottom">
                            <div class="chat-bottom-details">
                                <div class="chat-bottom-details-wrap">
                                    <img class="img-fluid attach attach-file" src="{{ asset('images/attach.svg') }}" alt="" title="">
                                </div>
                                <div class="chat-bottom-details-wrap">
                                    <img class="img-fluid smile" src="{{ asset('images/smile.svg') }}" alt="" title="">
                                </div>
                            </div>

                            <div class="message-form">
                                <form id="send-message-form"
                                      class="message-form-class"
                                      action="{{ route('cabinet.chat.store', ['childrenId' => $children->id, 'sponsorId' => $user->id]) }}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="children_id" value="{{ $children->id }}">
                                    <input type="hidden" name="sponsor_id" value="{{ $user->id }}">
                                    <input type="hidden" name="message_from" value="1">
                                    <input type="hidden" name="is_read" value="0">
                                    <input type="file" class="d-none" name="file">
                                    <input class="send-message-input"
                                           name="message"
                                           type="text"
                                           placeholder="{{ __('frontend.cabinet.Type your message here') }}">
                                    <button class="button-orange send-button-orange" type="submit" form="send-message-form">
                                        <img class="img-fluid attach" src="{{ asset('images/send.svg') }}" alt="" title="">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('site.components.donate_now')
@endsection
