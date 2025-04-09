<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャット一覧</title>
</head>
<body>
    <h1>チャット一覧</h1>

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

        <div style="margin-bottom: 16px;">
            <div><strong>{{ $otherUser->name }}</strong></div>
            <div>{{ $message->message }}</div>
            <div style="font-size: small; color: gray;">{{ $displayTime }}</div>
        </div>
    @endforeach
</body>
</html>
