<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>

    <form method="POST" action="/login">
        @csrf

        <div>
            <label for="userid">ユーザーID:</label>
            <input type="text" id="userid" name="userid" required>
        </div>

        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">ログイン</button>
    </form>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">ログアウト</button>
    </form>

</body>
</html>
