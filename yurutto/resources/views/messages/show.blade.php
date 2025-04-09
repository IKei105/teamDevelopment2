<!DOCTYPE html>
<html lang="ja">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <title>チャット - {{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/messages/show.css') }}">
</head>
<body>
    <div class="room">
        <ul id="messages">
            @foreach($messages as $message)
                <li class="chat {{$message->sender_id === auth()->id() ? 'me' : 'you'}}">
                    <p class="mes">{{ $message->message }}</p>
                    <div class="status">{{ $message->created_at->format('H:i') }}</div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $user->id }}"> -->

        <div>
            <input type="text" name="message" id="message-input" required>
            <button type="submit" id="send-button">送信</button>
        </div>
    <!-- </form> -->
</body>
<script>
    const CHAT_CONFIG = {
        receiverId: @json($user->id),
        csrfToken: @json(csrf_token()),
        lastMessageId: @json($messages->last()?->id ?? 0)
    };
</script>
<script src="{{ asset('js/messages/show.js') }}"></script>
</html>
