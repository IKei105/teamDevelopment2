@extends('components.layout2') {{-- フッター付きレイアウト想定 --}}

@section('title', '検索結果')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search/search_result.css') }}">
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

<div class="up">
    <h1>Yurutto</h1>
</div>

<div class="main-section">
    <h2>検索結果</h2>

    @if($results->isEmpty())
        <p>該当する募集はありませんでした。</p>
    @else
        <ul>
            @foreach($results as $item)
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
                            <a class="btn-participate" href="#">参加する</a>
                            <a href="{{ route('recruitments.show', ['id' => $item->id]) }}" class="btn-detail">詳細</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
@section('js')
    <script src="{{ asset('js/participate.js') }}"></script>
@endsection
