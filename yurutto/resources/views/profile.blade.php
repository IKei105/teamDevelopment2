<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>プロフィール</title>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <h1>Yurutto</h1>
        <div class="profile-icon">
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="アイコン画像">
        </div>
    </div>

    <div class="profile-username">{{ $user->name }}</div>

    <div class="profile-info">
        <p>在住地域：{{ $user->residence }}</p>
        <p>好きなスポーツ：{{ $user->favorite_sport }}</p>
        <p>楽しみ方：{{ $user->mood }}</p>
        <p>自己紹介：{{ $user->introduction }}</p>
    </div>
</div>
</body>
</html>
