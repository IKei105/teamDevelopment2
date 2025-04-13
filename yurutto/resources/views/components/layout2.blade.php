<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Yurutto')</title>
    <link rel="stylesheet" href="{{ asset('css/layout/layouts2.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    <!-- ヘッダー -->
    <!-- <header class="header">
        <h1 class="header-title">Yurutto</h1>
    </header> -->

    <!-- メインコンテンツは各ページで入れる -->
    @yield('content')

    <!-- フッター -->
    <footer class="footer">
        <a href="/index" class="footer-link">
            <img src="{{ asset('assets/images/footer/Home.svg') }}" alt="ホーム">
            <small>ホーム</small>
        </a>
        <a href="/messages" class="footer-link">
            <img src="{{ asset('assets/images/footer/Message circle.svg') }}" alt="チャット">
            <small>チャット</small>
        </a>
        <div class="footer-link-wrapper">
            <a href="/recruitments/create" class="footer-link create-post">
                <div class="plus-icon">＋</div>
            </a>    
            <small class="create-post-label">投稿</small>
        </div>
        <a href="/profile" class="footer-link">
            <img src="{{ asset('assets/images/footer/User.svg') }}" alt="マイページ">
            <small>マイページ</small>
        </a>
        <a href="/search" class="footer-link">
            <img src="{{ asset('assets/images/footer/Search.svg') }}" alt="検索">
            <small>検索</small>
        </a>
    </footer>
    @yield('js') 
</body>
</html>