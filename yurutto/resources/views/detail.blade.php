@extends('components.layout2')

@section('title', $recruitment->title)

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
@php
    $sportImage = match($recruitment->sport_type) {
        'サッカー' => 'assets/images/pictogram/football.png',
        'バスケットボール' => 'assets/images/pictogram/basket.png',
        'バドミントン' => 'assets/images/pictogram/bato.png',
        'ジム' => 'assets/images/pictogram/runnerMachine.png',
        'ボウリング' => 'assets/images/pictogram/bowling.png',
        '野球・キャッチボール' => 'assets/images/pictogram/glove.png',
        'ペットと運動' => 'assets/images/pictogram/dog.png',
        'その他' => 'assets/images/pictogram/run2.png',
        default => 'assets/images/pictogram/run2.png',
    };
@endphp

<div class="header">
    <h1 class="title">Yurutto</h1>
    <img src="{{ asset('storage/userProfileImages/search.png') }}" class="search-icon" alt="検索">
</div>

<div class="detail-card">
    <div class="detail-header">
        <img src="{{ asset($sportImage) }}" alt="{{ $recruitment->sport_type }}" class="main-icon">
        <h2 class="card-title">{{ $recruitment->title }}</h2>
        @if ($recruitment->user_id !== Auth::id())
            <a href="#" class="btn-participate" data-id="{{ $recruitment->id }}" data-user="{{ $recruitment->user_id }}">参加する</a>
        @endif
    </div>

    <div class="info-section">
        <div class="info-item">
            <img src="{{ asset('assets/images/logos2/Clock.jpg') }}" alt="">
            <p>{{ \Carbon\Carbon::parse($recruitment->scheduled_at)->format('n/j G:i') }}〜</p>
        </div>

        <div class="info-item">
            <img src="{{ asset('assets/images/logos2/Users.jpg') }}" alt="">
            <p>{{ $recruitment->recruit_number }}人</p>
        </div>

        <div class="info-item">
            <img src="{{ asset('assets/images/logos2/Map.jpg') }}" alt="">
            <p>{{ $recruitment->prefecture }}{{ $recruitment->city }} {{ $recruitment->place_name }}</p>
        </div>

        <div class="info-item">
            <img src="{{ asset('assets/images/logos2/Message.jpg') }}" alt="">
            <div>
                <p>ひとこと</p>
                <p>{{ $recruitment->comment }}</p>
            </div>
        </div>

        <div class="info-item">
            <img src="{{ asset('assets/images/logos2/User.jpg') }}" alt="">
            <p>{{ $recruitment->user->name ?? 'ユーザー名' }}</p>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/participate.js') }}"></script>
@endsection