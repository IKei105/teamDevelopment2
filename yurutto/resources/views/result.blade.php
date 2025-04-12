
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/search/search_result.css') }}">
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
    <title>募集投稿フォーム</title>
</head>
<body>
<div class="up">
    <h1>Yurutto</h1>
</div>
<div class="main-section">
    <div class="latest">
        @if($recommended->isEmpty())
            <p>該当する募集はありませんでした。</p>
        @else
            @foreach($latest as $item)
                <div class="latest-item">
                    <div class="latest-icon">
                        <img src="{{ asset('storage/userProfileImages/neko.jpeg') }}" alt="">
                    </div>
                    <div class="latest-title">
                        <p>タイトルです（ ＾ω＾）</p>
                    </div>
                    <div class="latest-button">
                        <a href="">参加する</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if($recommended->isEmpty())
        <p>該当する募集はありませんでした。</p>
    @else
        <ul>
            @foreach($recommended as $item)
                <li>
                    <div class="section">
                        <div class="icon-section">
                            <img class="icon" src="{{ asset('storage/userProfileImages/neko.jpeg') }}" alt="">
                        </div>
                        <div class="info-section">
                            <p class="title">{{ $item->title }}</p>
                            <div class="date-area">
                                <p class="date">{{ \Carbon\Carbon::parse($item->scheduled_at)->format('n月j日 G時〜') }}</p>
                                <p class="area">{{ $item->place_name }}</p>
                            </div>
                            <div>
                                <p class="num">{{ $item->recruit_number }}人</p>
                                <p class="mood">{{ $item->mood }}</p>
                            </div> 
                        </div>
                        <div class="button-section">
                            <a class="btn-participate" href="">参加する</a>
                            <a href="#" class="btn-detail">詳細</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
