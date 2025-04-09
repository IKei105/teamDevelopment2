<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>募集検索フォーム</title>
</head>
<body>
    <h1>募集検索</h1>

    <form action="{{ route('search.result') }}" method="GET">
        <!-- 種目 -->
        <!-- 種目（複数選択可） -->
        <label>種目</label><br>
        @php
            $sports = ['サッカー', 'バスケットボール', 'テニス', 'フットサル', '卓球', 'ランニング'];
        @endphp

        @foreach($sports as $sport)
            <label style="margin-right: 10px;">
                <input type="checkbox" name="sport_type[]" value="{{ $sport }}">
                {{ $sport }}
            </label>
        @endforeach


        <!-- 都道府県 -->
        <div>
            <label for="prefecture">都道府県</label>
            <select id="prefecture" name="prefecture" required>
                <option value="">選択してください</option>
                <!-- JSで追加 -->
            </select>
            <br><br>
        </div>
        

        <!-- 市区町村 -->
        <label for="city">市区町村</label>
        <select id="city" name="city" required>
            <option value="">先に都道府県を選択してください</option>
        </select>

        <!-- 日付（以降） -->
        <div>
            <label for="date">開催日（以降）</label>
            <input type="date" name="date" id="date">
            <br><br>
        </div>
        

        <button type="submit">検索</button>
    </form>
    <script src="{{ asset('js/search/pref_city.js') }}"></script>
</body>
</html>
