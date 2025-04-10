<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール</title>
</head>
<body>
    <h1>{{ $user->name }} さんのプロフィール</h1>

    <p><strong>ユーザーID:</strong> {{ $user->userid }}</p>
    <p><strong>住んでいる地域:</strong> {{ $user->residence }}</p>
    <p><strong>好きなスポーツ:</strong> {{ $user->favorite_sport }}</p>
    <p><strong>温度感:</strong> {{ $user->mood }}</p>
    <p><strong>自己紹介:</strong> {{ $user->introduction }}</p>
    <p><strong>評価:</strong> {{ $user->rating }}</p>

    @if ($user->profile_image)
        <p><strong>プロフィール画像:</strong></p>
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" width="150">
    @else
        <p>プロフィール画像は設定されていません。</p>
    @endif
</body>
</html>
