@if($item)
    @if($item->message_from == 0)
        <div class="chat-user chat-user-1 d-flex">
            <div class="user1-photo">
                @if($children->image)
                    <img class="w-100"
                         src="{{ $children->getImageUrl('thumbnail') }}"
                         alt="{{ $children->title }}"
                         title="{{ $children->title }}">
                @endif
            </div>
            <div class="user-1-chats d-flex flex-column">
                <div class="message user1-message d-flex flex-column">
                    <div class="message-details d-flex justify-content-between align-items-start">
                        <div class="message-text-wrap">
                            @if($item->message)
                                {!! $item->message !!}
                            @endif
                        </div>

                        <div class="message-file">
                            @if($item->file)
                                <a href="{{ $item->getImageUrl('thumbnail', $item->file) }}" target="_blank">
                                    <img class="w-100"
                                         src="{{ asset('images/pdf.png') }}"
                                         alt="{{ $item->file }}"
                                         title="{{ $item->file }}">
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="message-date text-end">{{ $item->created_at }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="chat-user chat-user-2 d-flex">
            <div class="user-2-chats d-flex flex-column">
                <div class="message user2-message d-flex flex-column">
                    <div class="message-details d-flex justify-content-between align-items-start">
                        <div class="message-file">
                            @if($item->file)
                                <a href="{{ $item->getImageUrl('thumbnail', $item->file) }}" target="_blank">
                                    <img class="w-100"
                                         src="{{ asset('images/pdf.png') }}"
                                         alt="{{ $item->file }}"
                                         title="{{ $item->file }}">
                                </a>
                            @endif
                        </div>
                        <div class="message-text-wrap">
                            @if($item->message)
                                {!! $item->message !!}
                            @endif
                        </div>
                    </div>

                    <div class="message-date text-end">{{ $item->created_at }}</div>
                </div>
            </div>
            <div class="user1-photo user2-photo">
                <img class="w-100"
                     src="{{ asset('images/user25.svg') }}"
                     alt="{{ $user->name }}"
                     title="{{ $user->name }}">
            </div>
        </div>
    @endif
@endif
