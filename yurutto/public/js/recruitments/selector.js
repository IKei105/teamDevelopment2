// オーバーレイ開く
document.getElementById('sport_type_selector').addEventListener('click', () => {
    document.getElementById('sport_type_overlay').style.display = 'flex';
});

// オーバーレイ閉じる
document.getElementById('close_sport_type_overlay').addEventListener('click', () => {
    document.getElementById('sport_type_overlay').style.display = 'none';
});

// 選択肢クリックで選択処理
document.querySelectorAll('.sport_option').forEach(option => {
    option.addEventListener('click', () => {
        const selectedValue = option.getAttribute('data-value');
        const selectedImage = option.getAttribute('data-image');

        // hidden input にセット
        document.getElementById('sport_type').value = selectedValue;

        // 表示中の画像差し替え
        document.getElementById('selected_sport_image').src = selectedImage;

        // 表示中のテキスト差し替え
        document.getElementById('selected_sport_label').textContent = selectedValue;

        // オーバーレイを閉じる
        document.getElementById('sport_type_overlay').style.display = 'none';
    });
});


// 地域選択
document.addEventListener('DOMContentLoaded', () => {
    const areaSelector = document.getElementById('area_selector');
    const areaOverlay = document.getElementById('area_overlay');
    const closeAreaOverlay = document.getElementById('close_area_overlay');
    const areaOptionsContainer = document.getElementById('area_options_container');
    const areaOverlayTitle = document.getElementById('area_overlay_title');

    const prefectureInput = document.getElementById('prefecture');
    const cityInput = document.getElementById('city');
    const selectedAreaLabel = document.getElementById('selected_area_label');

    let selectedPrefecture = '';
    let cities = [];

    // オーバーレイ開く
    areaSelector.addEventListener('click', () => {
        areaOverlay.style.display = 'flex';
        areaOverlayTitle.textContent = '都道府県を選択してください';
        loadPrefectures();
    });

    // オーバーレイ閉じる
    closeAreaOverlay.addEventListener('click', () => {
        areaOverlay.style.display = 'none';
    });

    // 都道府県リストを読み込む
    function loadPrefectures() {
        areaOptionsContainer.innerHTML = '';

        fetch('/js/search/prefectures.json')
            .then(response => response.json())
            .then(jsonData => {
                const data = jsonData[0];
                Object.keys(data).forEach(key => {
                    const prefData = data[key];
                    const option = document.createElement('div');
                    option.classList.add('area_option');
                    option.textContent = prefData.name;
                    option.dataset.prefName = prefData.name;
                    option.dataset.cities = JSON.stringify(prefData.city);

                    option.addEventListener('click', () => {
                        selectedPrefecture = prefData.name;
                        cities = prefData.city;
                        loadCities();
                    });

                    areaOptionsContainer.appendChild(option);
                });
            });
    }

    // 市区町村リストを読み込む
    function loadCities() {
        areaOptionsContainer.innerHTML = '';
        areaOverlayTitle.textContent = `${selectedPrefecture} の市区町村を選択してください`;

        cities.forEach(city => {
            const option = document.createElement('div');
            option.classList.add('area_option');
            option.textContent = city.city;
            option.dataset.cityName = city.city;

            option.addEventListener('click', () => {
                // 選択後の処理
                prefectureInput.value = selectedPrefecture;
                cityInput.value = city.city;
                selectedAreaLabel.textContent = `${selectedPrefecture} ${city.city}`;
                areaOverlay.style.display = 'none';
            });

            areaOptionsContainer.appendChild(option);
        });
    }
});

// 楽しみ方
document.addEventListener('DOMContentLoaded', () => {
    const moodSelector = document.getElementById('mood_selector');
    const moodOverlay = document.getElementById('mood_overlay');
    const closeMoodOverlay = document.getElementById('close_mood_overlay');
    const moodOptions = document.querySelectorAll('.mood_option');
    const moodInput = document.getElementById('mood');
    const selectedMoodImage = document.getElementById('selected_mood_image');
    const selectedMoodLabel = document.getElementById('selected_mood_label');

    // オーバーレイ開く
    moodSelector.addEventListener('click', () => {
        moodOverlay.style.display = 'flex';
    });

    // オーバーレイ閉じる
    closeMoodOverlay.addEventListener('click', () => {
        moodOverlay.style.display = 'none';
    });

    // 選択肢クリックで選択処理
    moodOptions.forEach(option => {
        option.addEventListener('click', () => {
            const selectedValue = option.getAttribute('data-value');
            const selectedImage = option.getAttribute('data-image');

            // hidden input にセット
            moodInput.value = selectedValue;

            // 表示中の画像差し替え
            selectedMoodImage.src = selectedImage;

            // 表示中のテキスト差し替え
            selectedMoodLabel.textContent = selectedValue;

            // オーバーレイを閉じる
            moodOverlay.style.display = 'none';
        });
    });
});


// 人数

document.addEventListener('DOMContentLoaded', () => {
    const numberSelector = document.getElementById('number_selector');
    const numberOverlay = document.getElementById('number_overlay');
    const closeNumberOverlay = document.getElementById('close_number_overlay');
    const numberInput = document.getElementById('number_input');
    const confirmNumber = document.getElementById('confirm_number');
    const recruitNumberInput = document.getElementById('recruit_number');
    const selectedNumberLabel = document.getElementById('selected_number_label');

    numberSelector.addEventListener('click', () => {
        numberOverlay.style.display = 'flex';
    });

    closeNumberOverlay.addEventListener('click', () => {
        numberOverlay.style.display = 'none';
    });

    confirmNumber.addEventListener('click', () => {
        const value = numberInput.value;
        if (value && value > 0) {
            recruitNumberInput.value = value;
            selectedNumberLabel.textContent = `${value}人`;
            numberOverlay.style.display = 'none';
        } else {
            alert('1以上の人数を入力してください');
        }
    });
});
// 日時
document.addEventListener('DOMContentLoaded', () => {
    const dateSelector = document.getElementById('date_selector');
    const dateOverlay = document.getElementById('date_overlay');
    const closeDateOverlay = document.getElementById('close_date_overlay');
    const dateInput = document.getElementById('date_input');
    const confirmDate = document.getElementById('confirm_date');
    const scheduledAtInput = document.getElementById('scheduled_at');
    const selectedDateLabel = document.getElementById('selected_date_label');

    dateSelector.addEventListener('click', () => {
        dateOverlay.style.display = 'flex';
    });

    closeDateOverlay.addEventListener('click', () => {
        dateOverlay.style.display = 'none';
    });

    confirmDate.addEventListener('click', () => {
        const value = dateInput.value;
        if (value) {
            scheduledAtInput.value = value;
            const date = new Date(value);
            const formatted = `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日 ${date.getHours()}時`;
            selectedDateLabel.textContent = formatted;
            dateOverlay.style.display = 'none';
        } else {
            alert('日時を選択してください');
        }
    });
});
