@extends('components.layout')

@section('title', '検索')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search/search_index.css') }}">
@endsection
@section('content')
    <div class="recruitement_container">
        <h1>投稿を検索</h1>
        <form id="search_form" action="{{ route('recruitments.store') }}" method="POST">
        @csrf
            <!-- 種目 -->
            <div class="selector sport_type" id="sport_type_selector">
                <div class="image_container">
                    <img id="selected_sport_image" class="sport_type_logo"src="{{ asset('assets/images/pictogram/run.png') }}" alt="種目">
                </div>
                <input type="hidden" name="sport_types" id="sport_types" value="">
                <label for="sport_type" id="selected_sport_label">種目</label>
            </div>

            <!-- オーバーレイ -->
            <div class="overlay" id="sport_type_overlay">
                <div class="overlay_content">
                    <button type="button" class="close_button" id="close_sport_type_overlay">×</button>
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
                            <span>バドミントン</span>
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
                    <button type="button" id="confirm_sport">決定</button>
                </div>
            </div>

            <!-- 地域選択 -->
            <div class="selector area_container" id="area_selector">
                <div class="image_container">
                    <img id="selected_area_image" class="area_logo"src="{{ asset('assets/images/logos/mapPin_logo.svg') }}" alt="地域">
                </div>
                <input type="hidden" name="prefecture" id="prefecture" value="">
                <input type="hidden" name="city" id="city" value="">
                <label id="selected_area_label">地域</label>
            </div>

            <!-- 地域オーバーレイ -->
            <div class="overlay" id="area_overlay">
                <div class="overlay_content">
                    <button class="close_button" id="close_area_overlay">×</button>
                    <h2 id="area_overlay_title">都道府県を選択してください</h2>
                    <div class="area_options" id="area_options_container">
                        <!-- 都道府県リスト / 市区町村リストをここに動的生成 -->
                    </div>
                </div>
            </div>

            <!-- 温度感 -->
            <div class="selector mood" id="mood_selector">
                <div class="image_container">
                    <img id="selected_mood_image" class="mood_logo"src="{{ asset('assets/images/logos/smileIcon_logo.svg') }}" alt="楽しみ方">
                </div>
                <input type="hidden" name="mood" id="mood" value="">
                <label id="selected_mood_label">楽しみ方</label>
            </div>
            <!-- 楽しみ方オーバーレイ -->
            <div class="overlay" id="mood_overlay">
                <div class="overlay_content">
                    <button type="button" class="close_button" id="close_mood_overlay">×</button>
                    <h2>楽しみ方を選択してください</h2>
                    <div class="mood_options">
                        <div class="mood_option" data-value="初心者歓迎" data-image="{{ asset('assets/images/logos/biginner.png') }}">
                            <img src="{{ asset('assets/images/logos/biginner.png') }}" alt="初心者歓迎">
                            <span>初心者歓迎</span>
                        </div>
                        <div class="mood_option" data-value="ゆる～く運動" data-image="{{ asset('assets/images/logos/nonbiri.png') }}">
                            <img src="{{ asset('assets/images/logos/nonbiri.png') }}" alt="ゆる～く運動">
                            <span>ゆる～く運動</span>
                        </div>
                        <div class="mood_option" data-value="ダイエット" data-image="{{ asset('assets/images/logos/diet.png') }}">
                            <img src="{{ asset('assets/images/logos/diet.png') }}" alt="ダイエット">
                            <span>ダイエット</span>
                        </div>
                        <div class="mood_option" data-value="経験者歓迎" data-image="{{ asset('assets/images/logos/fire.png') }}">
                            <img src="{{ asset('assets/images/logos/fire.png') }}" alt="経験者歓迎">
                            <span>経験者歓迎</span>
                        </div>
                        <div class="mood_option" data-value="試合がしたい" data-image="{{ asset('assets/images/logos/battle.png') }}">
                            <img src="{{ asset('assets/images/logos/battle.png') }}" alt="試合がしたい">
                            <span>試合がしたい</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 募集人数 -->
            <div class="selector people_number" id="number_selector">
                <div class="image_container">
                    <img id="selected_number_image" class="people_number_logo" src="{{ asset('assets/images/logos/humans_logo.svg') }}" alt="人数">
                </div>
                <input type="hidden" name="recruit_number" id="recruit_number" value="">
                <label id="selected_number_label">募集人数</label>
            </div>

            <!-- 募集人数オーバーレイ -->
            <div class="overlay" id="number_overlay">
                <div class="overlay_content">
                    <button type="button" class="close_button" id="close_number_overlay">×</button>
                    <h2>募集人数を入力してください</h2>
                    <input type="number" id="min_number_input" min="1" placeholder="最小人数を入力" style="width: 100%; padding: 8px; font-size: 16px; margin-top: 12px;">
                    <input type="number" id="max_number_input" min="1" placeholder="最大人数を入力" style="width: 100%; padding: 8px; font-size: 16px; margin-top: 12px;">
                    <button type="button" id="confirm_number" class="submit" style="margin-top: 12px;">決定</button>
                </div>
            </div>
            <!-- hidden input 用意 -->
            <input type="hidden" name="min_people" id="min_people" value="">
            <input type="hidden" name="max_people" id="max_people" value="">

            <!-- 日時 -->
            <div class="selector recruitment_date" id="date_selector">
                <div class="image_container">
                    <img id="selected_date_image" class="recruitment_date_logo" src="{{ asset('assets/images/logos/clockIcon_logo.svg') }}" alt="日時">
                </div>
                <label id="selected_date_label">日時</label>
            </div>

            <!-- 日時オーバーレイ -->
            <div class="overlay" id="date_overlay">
                <div class="overlay_content">
                    <button type="button" class="close_button" id="close_date_overlay">×</button>
                    <h2>日時を選択してください</h2>
                    <input type="date" id="start_date_input" style="width: 100%; padding: 8px; font-size: 16px; margin-top: 12px;" placeholder="開始日">
                    <input type="date" id="end_date_input" style="width: 100%; padding: 8px; font-size: 16px; margin-top: 12px;" placeholder="終了日">
                    <button type="button" id="confirm_date" class="submit" style="margin-top: 12px;">決定</button>
                </div>
            </div>

            <!-- hidden input -->
            <input type="hidden" name="start_date" id="start_date" value="">
            <input type="hidden" name="end_date" id="end_date" value="">

            <button class="submit" type="submit">募集する！</button>
        </form>
    </div>

    <!-- 都道府県→市区町村 連動JS -->
    <script src="{{ asset('js/search/pref_city.js') }}"></script>

    <!-- オーバーレイJS -->
    <script src="{{ asset('js/search/search.js') }}"></script>
@endsection
