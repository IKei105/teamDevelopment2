<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>

    <form method="POST" action="/register">
        @csrf

        <div>
            <label for="userid">ユーザーID:</label>
            <input type="text" id="userid" name="userid" required>
        </div>

        <div>
            <label for="name">ユーザー名:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">パスワード（確認）:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">登録</button>
    </form>
</body>
</html>
