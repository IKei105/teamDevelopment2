<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Yurutto</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="main-section">
        <h1 class="title">Yurutto</h1>

        <div class="button-wrapper">
            <a href="{{ route('register') }}" class="btn register">新規登録の方はこちら</a>
            <a href="{{ route('login') }}" class="btn login">ログイン</a>
        </div>
    </div>
</body>
</html>
