<!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
        <title>ユーザー登録</title>
    </head>
    <body>
        <div class="main-section">
        <h1>yurutto</h1>
        <form method="POST" action="/register" enctype="multipart/form-data">
            @csrf

            <div class="section profile-image">
                <label for="profile_image">プロフィール画像:</label>
                <input class="input" type="file" id="profile_image" name="profile_image" accept="image/*">
            </div>
        
            <div class="section userid">
                <input class="userid-input" type="text" id="userid" name="userid" placeholder="ユーザーID" required>
            </div>

            <div class="section username">
                <input class="username-input" type="text" id="name" name="name" placeholder="ユーザー名" required>
            </div>

            <div class="section password">
                <input class="password-input" type="password" id="password" name="password" placeholder="パスワード"  required>
            </div>

            <div class="section password">
                <input class="password-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="もう一度入力" required>
            </div>

            <div class="section residence">
                <select class="residence-select" id="residence" name="residence">
                    <option value="">住んでいる地域を選択</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
            </div>

            <div class="section favorite_sport">
                <input class="favorite-input" type="text" id="favorite_sport" placeholder="好きなスポーツ" name="favorite_sport">
            </div>

            <div class="section mood">
                <select class="mood-input" id="mood" name="mood">
                    <option value="">温度感を選択</option>
                    <option value="初心者歓迎">初心者歓迎</option>
                    <option value="ゆるく">ゆるく</option>
                    <option value="ガチ">ガチ</option>
                </select>
            </div>

            <div class="section introduction">
                <textarea class="introduction-input" id="introduction" name="introduction" rows="3" cols="30" placeholder="自己紹介を入力"></textarea>
            </div>

            <button class="submit-btn" type="submit">登録</button>
        </form>
        </div>

    </body>
</html>
