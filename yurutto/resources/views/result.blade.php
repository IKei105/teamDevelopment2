@extends('components.layout2') {{-- フッターつきレイアウトを想定 --}}

@section('title', '募集投稿フォーム')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search/search_result.css') }}">
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
@endsection

@section('content')
<div class="main-section">
    <div class="up">
        <h1>Yurutto</h1>
    </div>

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

    {{-- 最新 --}}
    <div class="latest">
        @if($recommended->isEmpty())
            <p>該当する募集はありませんでした。</p>
        @else
        @foreach($latest as $item)
            <div class="latest-item">
                <a href="{{ route('recruitments.show', ['id' => $item->id]) }}" class="latest-link">
                    <div class="latest-icon">
                        <img src="{{ asset($iconMap[$item->sport_type] ?? 'assets/images/pictogram/run2.png') }}" alt="{{ $item->sport_type }}">
                    </div>
                    <div class="latest-title">
                        <p>{{ \Illuminate\Support\Str::limit($item->title, 34) }}</p>
                    </div>
                </a>
                <div class="latest-button">
                    @if ($item->user_id !== Auth::id())
                        <a href="#" class="btn-participate" data-id="{{ $item->id }}" data-user="{{ $item->user_id }}">参加する</a>
                    @endif
                </div>
            </div>
        @endforeach

        @endif
    </div>

    {{-- おすすめ --}}
    @if($recommended->isEmpty())
        <p>該当する募集はありませんでした。</p>
    @else
        <ul>
            @foreach($recommended as $item)
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
                            <a href="{{ route('recruitments.show', ['id' => $item->id]) }}" class="btn-detail">詳細</a>

                            @if ($item->user_id !== Auth::id())
                                <a href="#" class="btn-participate" data-id="{{ $item->id }}" data-user="{{ $item->user_id }}">参加する</a>
                            @endif
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
