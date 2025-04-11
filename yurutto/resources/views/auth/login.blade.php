<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <title>ログイン</title>
</head>
<body>
    <div class="main-section">
    <h1 class="title">yurutto</h1>
        <form method="POST" action="/login">
            @csrf

            <div class="section">
                <input class="userid-input" type="text" id="userid" name="userid" placeholder="ユーザーID" required>
            </div>

            <div class="section">
                <input class="password-input" type="password" id="password" name="password" placeholder="パスワード" required>
            </div>

            <button class="submit-btn" type="submit">ログイン</button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button class="submit-btn logout" type="submit">ログアウト</button>
        </form>
    </div>
</body>
</html>
