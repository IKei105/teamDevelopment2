<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>

    <form method="POST" action="/register" enctype="multipart/form-data">
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

    <div>
        <label for="profile_image">プロフィール画像:</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*">
    </div>

    <div>
        <label for="residence">住んでいる地域:</label>
        <input type="text" id="residence" name="residence">
    </div>

    <div>
        <label for="favorite_sport">好きなスポーツ:</label>
        <input type="text" id="favorite_sport" name="favorite_sport">
    </div>

    <div>
        <label for="mood">温度感:</label>
        <select id="mood" name="mood">
            <option value="">選択してください</option>
            <option value="初心者歓迎">初心者歓迎</option>
            <option value="ゆるく">ゆるく</option>
            <option value="ガチ">ガチ</option>
        </select>
    </div>

    <div>
        <label for="introduction">自己紹介:</label>
        <textarea id="introduction" name="introduction" rows="3" cols="30"></textarea>
    </div>

    <button type="submit">登録</button>
</form>

</body>
</html>
