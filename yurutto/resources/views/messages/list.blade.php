<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/messages/list.css') }}">
    <title>チャット一覧</title>
</head>
<body>
    <div class="main-section">
        <div class="header">
            <h1>Yurutto</h1>
        </div>
        @foreach($latestMessages as $message)
            @php
                $isSender = $message->sender_id === $userId;
                $otherUser = $isSender ? $message->receiver : $message->sender;
                $timestamp = $message->created_at;
                $now = \Illuminate\Support\Carbon::now();

                if ($timestamp->isToday()) {
                    $displayTime = $timestamp->format('H:i');
                } else {
                    $displayTime = $timestamp->format('m/d');
                }
            @endphp
            <div class="message-section">
                <a href="{{ route('messages.show', ['user' => $otherUser->id]) }}">
                    <div class="user-profile-image">
                        <img src="{{ asset('storage/userProfileImages/neko.jpeg') }}" alt="">
                    </div>
                    <div class="message-info">
                        <div class="user-latest-message">
                            <p class="username">{{ $otherUser->name }}</p>
                            <p class="latest-message">{{ $message->message }}</p>
                        </div>
                        <div class="message-latest-time">
                            <p>{{ $displayTime }}</p>
                        </div>
                    </div>
                </a>    
            </div>
        @endforeach
    </div>
</body>
</html>
