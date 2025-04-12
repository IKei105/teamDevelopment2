<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規募集</title>
    <link rel="stylesheet" href="{{ asset('css/recruitements/recruitements_create.css') }}">
</head>
<body>
    <div class="recruitement_container">
        <h1>募集する</h1>
        <form action="{{ route('recruitments.store') }}" method="POST">
        @csrf
            <!-- 種目 -->
            <div class="selector sport_type" id="sport_type_selector">
                <div class="image_container">
                    <img id="selected_sport_image" class="sport_type_logo"src="{{ asset('assets/images/pictogram/run.png') }}" alt="種目">
                </div>
                <input type="hidden" name="sport_type" id="sport_type" value="">
                <label for="sport_type" id="selected_sport_label">種目</label>
            </div>

            <!-- オーバーレイ -->
            <div class="overlay" id="sport_type_overlay">
                <div class="overlay_content">
                    <button class="close_button" id="close_sport_type_overlay">×</button>
                    <h2>種目を選択してください</h2>
                    <div class="sport_options">
                        <div class="sport_option" data-value="サッカー" data-image="{{ asset('assets/images/pictogram/football.png') }}">
                            <img src="{{ asset('assets/images/pictogram/football.png') }}" alt="サッカー">
                            <span>サッカー</span>
                        </div>
                        <div class="sport_option" data-value="バスケットボール" data-image="{{ asset('assets/images/pictogram/basket.png') }}">
                            <img src="{{ asset('assets/images/pictogram/basket.png') }}" alt="バスケットボール">
                            <span>バスケットボール</span>
                        </div>
                        <div class="sport_option" data-value="バドミントン" data-image="{{ asset('assets/images/pictogram/bato.png') }}">
                            <img src="{{ asset('assets/images/pictogram/bato.png') }}" alt="バドミントン">
                            <span>テニス</span>
                        </div>
                        <div class="sport_option" data-value="ジム" data-image="{{ asset('assets/images/pictogram/runnerMachine.png') }}">
                            <img src="{{ asset('assets/images/pictogram/runnerMachine.png') }}" alt="ジム">
                            <span>ジム</span>
                        </div>
                        <div class="sport_option" data-value="ボウリング" data-image="{{ asset('assets/images/pictogram/bowling.png') }}">
                            <img src="{{ asset('assets/images/pictogram/bowling.png') }}" alt="ボウリング">
                            <span>ボウリング</span>
                        </div>
                        <div class="sport_option" data-value="野球・キャッチボール" data-image="{{ asset('assets/images/pictogram/glove.png') }}">
                            <img src="{{ asset('assets/images/pictogram/glove.png') }}" alt="野球">
                            <span>野球・キャッチボール</span>
                        </div>
                        <div class="sport_option" data-value="ペットと運動" data-image="{{ asset('assets/images/pictogram/dog.png') }}">
                            <img src="{{ asset('assets/images/pictogram/dog.png') }}" alt="ペットと運動">
                            <span>ペットと運動</span>
                        </div>
                        <div class="sport_option" data-value="その他" data-image="{{ asset('assets/images/pictogram/run2.png') }}">
                            <img src="{{ asset('assets/images/pictogram/run2.png') }}" alt="その他">
                            <span>その他運動</span>
                        </div>

                        <!-- 必要に応じて追加 -->
                    </div>
                </div>
            </div>

            <!-- 地域選択 -->
            <div class="selector area_container">
                <div class="image_container">
                    <img class="area_logo"src="{{ asset('assets/images/logos/mapPin_logo.svg') }}" alt="地域">
                </div>
                <!-- 都道府県 -->
                <label for="prefecture">地域</label>
                <select id="prefecture" name="prefecture" required>
                    <option value="">選択してください</option>
                    <!-- JSで追加 -->
                </select>

                <!-- 市区町村 -->
                <label for="city"></label>
                <select id="city" name="city" required>
                    <option value="">先に都道府県を選択してください</option>
                </select>
            </div>

            <!-- 温度感 -->
            <div class="selector mood">
                <div class="image_container">
                    <img class="mood_logo"src="{{ asset('assets/images/logos/smileIcon_logo.svg') }}" alt="楽しみ方">
                </div>
                <label for="mood">楽しみ方</label>
                <select name="mood" id="mood" required>
                    <option value="">選択してください</option>
                    <option value="初心者歓迎">初心者歓迎</option>
                    <option value="ゆるく">ゆるく</option>
                    <option value="ガチ">ガチ</option>
                </select>
            </div>

            <!-- 募集人数 -->
            <div class="selector people_number">
                <div class="image_container">
                    <img class="people_number_logo"src="{{ asset('assets/images/logos/humans_logo.svg') }}" alt="人数">
                </div>
                <label for="recruit_number">募集人数</label>
                <input type="number" name="recruit_number" id="recruit_number" min="1" required>
            </div>

            <!-- 日時 -->
            <div class="selector recruitment_date">
                <div class="image_container">
                    <img class="recruitment_date_logo"src="{{ asset('assets/images/logos/clockIcon_logo.svg') }}" alt="日時">
                </div>
                <label for="scheduled_at">日時</label>
                <input type="datetime-local" name="scheduled_at" id="scheduled_at" required>
            </div>

            <!-- 募集タイトル -->
            <div class="section">
                <label for="title"></label>
                <input class="form_section title_box" type="text" name="title" id="title" required placeholder="募集タイトル">
            </div>

            <!-- 場所の名前 -->
            <div class="place_name">
                <label for="place_name"></label>
                <input class="form_section place_name_box" type="text" name="place_name" id="place_name" required placeholder="場所を入力(例)公園、広場など">
            </div>

            <!-- コメント -->
            <div class="comment">
                <label for="comment"></label>
                <textarea class="form_section comment_box" name="comment" id="comment" rows="3" cols="30" placeholder="コメントを入力"></textarea>
            </div>

            <button class="submit" type="submit">募集する！</button>
        </form>
    </div>

    <!-- 都道府県→市区町村 連動JS -->
    <script src="{{ asset('js/search/pref_city.js') }}"></script>
    <script src="{{ asset('js/recruitments/create.js') }}"></script>

    <!-- オーバーレイJS -->
    <script src="{{ asset('js/recruitments/selector.js') }}"></script>
</body>

</html>
