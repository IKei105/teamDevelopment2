<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/messages/list.css') }}">
    <title>チャット一覧</title>
</head>
<body>
    @foreach($latestMessages as $message)
        @php
            $isSender = $message->sender_id === $userId;
            $otherUser = $isSender ? $message->receiver : $message->sender;
            $timestamp = $message->created_at;
            $now = \Illuminate\Support\Carbon::now();

            if ($timestamp->isToday()) {
                $displayTime = $timestamp->format('H:i');
            } else {
                $displayTime = $timestamp->format('Y/m/d');
            }
        @endphp

        <div style="">
            <div><strong>{{ $otherUser->name }}</strong></div>
            <div>{{ $message->message }}</div>
            <div>{{ $displayTime }}</div>
        </div>
        <div class="message-section">
            <div class="user-profile-image">
                <img src="{{ asset('storage/userProfileImages/neko.jpeg') }}" alt="">
            </div>
            <div class="message-info">
                <div class="user-latest-message">
                    <p class="username">ユーザー名</p>
                    <p class="latest-message">お前を倒してやる！！！</p>
                </div>
                <div class="message-latest-time">
                    <p>17:05</p>
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>
