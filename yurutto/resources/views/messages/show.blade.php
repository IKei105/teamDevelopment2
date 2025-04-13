@extends('components.layout2') {{-- フッター付きレイアウト --}}

@section('title', 'チャット - ' . $user->name)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/messages/show.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<h1 class="header">{{ $user->name }}</h1>
    <div class="room">
        <ul id="messages">
            @foreach($messages as $message)
                <li class="chat {{ $message->sender_id === auth()->id() ? 'me' : 'you' }}">
                    <p class="mes">{{ $message->message }}</p>
                    <div class="status">{{ $message->created_at->format('H:i') }}</div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="message-input">
        <input type="text" name="message" id="message-input" required>
        <button type="submit" id="send-button">送信</button>
    </div>
@endsection

@section('js')
    <script>
        const CHAT_CONFIG = {
            receiverId: @json($user->id),
            csrfToken: @json(csrf_token()),
            lastMessageId: @json($messages->last()?->id ?? 0)
        };
    </script>
    <script src="{{ asset('js/messages/show.js') }}"></script>
@endsection
