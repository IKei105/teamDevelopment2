<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $recruitment->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>
<body>

    <div class="header">
        <h1 class="title">Yurutto</h1>
        <img src="{{ asset('storage/userProfileImages/search.png') }}" class="search-icon" alt="検索">
    </div>

    <div class="detail-card">
        <div class="detail-header">
            <img src="{{ asset('storage/userProfileImages/icon.png') }}" alt="種目アイコン" class="main-icon">

            <h2 class="card-title">{{ $recruitment->title }}</h2>

            <a href="#" class="btn-participate">参加する</a>
        </div>

        <div class="info-section">
            <div class="info-item">
                <img src="{{ asset('storage/userProfileImages/time.png') }}" alt="">
                <p>{{ \Carbon\Carbon::parse($recruitment->scheduled_at)->format('n/j G:i') }}〜</p>
            </div>

            <div class="info-item">
                <img src="{{ asset('storage/userProfileImages/people.png') }}" alt="">
                <p>{{ $recruitment->recruit_number }}人</p>
            </div>

            <div class="info-item">
                <img src="{{ asset('storage/userProfileImages/location.png') }}" alt="">
                <p>{{ $recruitment->prefecture }}{{ $recruitment->city }}　{{ $recruitment->place_name }}</p>
            </div>

            <div class="info-item">
                <img src="{{ asset('storage/userProfileImages/comment.png') }}" alt="">
                <div>
                    <p>ひとこと</p>
                    <p>{{ $recruitment->comment }}</p>
                </div>
            </div>

            <div class="info-item">
                <img src="{{ asset('storage/userProfileImages/user.png') }}" alt="">
                <p>{{ $recruitment->user->name ?? 'ユーザー名' }}</p>
            </div>
        </div>
    </div>

</body>
</html>
