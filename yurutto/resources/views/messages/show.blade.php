<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャット - {{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/messages/show.css') }}">
</head>
<body>
    <div class="room">
        <ul>
            @foreach($messages as $message)
                <li class="chat {{$message->sender_id === auth()->id() ? 'me' : 'you'}}">
                    <p class="mes">{{ $message->message }}</p>
                    <div class="status">{{ $message->created_at->format('H:i') }}</div>
                </li>
            @endforeach
        </ul>
    </div>
    <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $user->id }}">

        <div>
            <input type="text" name="message" required style="width: 300px;">
            <button type="submit">送信</button>
        </div>
    </form>
</body>
</html>
