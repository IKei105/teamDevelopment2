<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>募集投稿フォーム</title>
</head>
<body>
    <h1>募集投稿フォーム</h1>

    <form action="{{ route('recruitments.store') }}" method="POST">
        @csrf

        <!-- 種目 -->
        <label for="sport_type">種目</label>
        <select name="sport_type" id="sport_type" required>
            <option value="">選択してください</option>
            <option value="サッカー">サッカー</option>
            <option value="バスケットボール">バスケットボール</option>
            <option value="テニス">テニス</option>
            <option value="フットサル">フットサル</option>
            <option value="卓球">卓球</option>
            <option value="ランニング">ランニング</option>
        </select>
        <br><br>

        <!-- 都道府県 -->
        <label for="prefecture">都道府県</label>
        <select id="prefecture" name="prefecture" required>
            <option value="">選択してください</option>
            <!-- JSで追加 -->
        </select>
        <br><br>

        <!-- 市区町村 -->
        <label for="city">市区町村</label>
        <select id="city" name="city" required>
            <option value="">先に都道府県を選択してください</option>
        </select>
        <br><br>

        <!-- 場所の名前 -->
        <label for="place_name">場所の名称</label>
        <input type="text" name="place_name" id="place_name" required>
        <br><br>

        <!-- 日時 -->
        <label for="scheduled_at">日時</label>
        <input type="datetime-local" name="scheduled_at" id="scheduled_at" required>
        <br><br>

        <!-- 募集人数 -->
        <label for="recruit_number">募集人数</label>
        <input type="number" name="recruit_number" id="recruit_number" min="1" required>
        <br><br>

        <!-- 温度感 -->
        <label for="mood">温度感</label>
        <select name="mood" id="mood" required>
            <option value="">選択してください</option>
            <option value="初心者歓迎">初心者歓迎</option>
            <option value="ゆるく">ゆるく</option>
            <option value="ガチ">ガチ</option>
        </select>
        <br><br>

        <!-- 最後の一言 -->
        <label for="comment">最後の一言</label>
        <textarea name="comment" id="comment" rows="3" cols="30"></textarea>
        <br><br>

        <button type="submit">投稿する</button>
    </form>

    <!-- 都道府県→市区町村 連動JS -->
    <script src="{{ asset('js/search/pref_city.js') }}"></script>
    <script src="{{ asset('js/recruitments/create.js') }}"></script>
</body>

</html>
