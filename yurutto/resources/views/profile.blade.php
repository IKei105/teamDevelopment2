@extends('components.layout2')

@section('title', 'プロフィール')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
@php
    $iconMap = [
        'サッカー' => 'assets/images/pictogram/football.png',
        'バスケットボール' => 'assets/images/pictogram/basket.png',
        'バドミントン' => 'assets/images/pictogram/bato.png',
        'ジム' => 'assets/images/pictogram/runnerMachine.png',
        'ボウリング' => 'assets/images/pictogram/bowling.png',
        '野球・キャッチボール' => 'assets/images/pictogram/glove.png',
        'ペットと運動' => 'assets/images/pictogram/dog.png',
        'その他' => 'assets/images/pictogram/run2.png',
    ];
@endphp

<div class="profile-container">
    <div class="profile-header">
        <h1>Yurutto</h1>
        <div class="profile-icon">
            <img src="{{ asset($user->profile_image) }}" alt="アイコン画像">
        </div>
    </div>

    <div class="profile-username">{{ $user->name }}</div>

    <div class="profile-info">
        <p>在住地域：{{ $user->residence }}</p>
        <p>好きなスポーツ：{{ $user->favorite_sport }}</p>
        <p>楽しみ方：{{ $user->mood }}</p>
        <p>自己紹介：{{ $user->introduction }}</p>
    </div>

    <div class="main-section">
        <h2>現在参加中の募集</h2>
        @if($ongoing->isEmpty())
            <p>現在参加中の募集はありません。</p>
        @else
            <ul>
                @foreach($ongoing as $item)
                    <li>
                        <div class="section">
                            <div class="icon-section">
                                <img class="icon" src="{{ asset($iconMap[$item->sport_type] ?? 'assets/images/pictogram/run2.png') }}" alt="{{ $item->sport_type }}">
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
                                <a class="btn-message" href="/messages/{{ $item->user->id }}">メッセージ</a>
                                <a href="/detail/{{ $item->id }}" class="btn-detail">詳細</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2>過去に参加した募集</h2>
        @if($past->isEmpty())
            <p>過去に参加した募集はありません。</p>
        @else
            <ul>
                @foreach($past as $item)
                    <li>
                        <div class="section" data-id="{{ $item->id }}">
                            <div class="icon-section">
                                <img class="icon" src="{{ asset($iconMap[$item->sport_type] ?? 'assets/images/pictogram/run2.png') }}" alt="{{ $item->sport_type }}">
                            </div>
                            <div class="info-section">
                                <p class="title">{{ $item->title }}</p>
                                <div class="date-area">
                                    <p class="date">{{ \Carbon\Carbon::parse($item->scheduled_at)->format('n月j日') }}</p>
                                </div>
                            </div>

                            <div class="button-section">
                                <div class="rating-wrapper">
                                    <form method="POST" action="/rate">
                                        @csrf
                                        <input type="hidden" name="recruitment_id" value="{{ $item->id }}">
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="star{{ $i }}-{{ $item->id }}" name="rating" value="{{ $i }}">
                                                <label for="star{{ $i }}-{{ $item->id }}">★</label>
                                            @endfor
                                        </div>
                                        <button class="btn-participate" type="submit">評価を送信する</button>
                                    </form>
                                </div>
                                <button class="btn-detail btn-rate-toggle">評価する</button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
@section('js')
    <script>
        const CHAT_CONFIG = {
            csrfToken: @json(csrf_token()),
        };
    </script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection