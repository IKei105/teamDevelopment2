document.addEventListener('DOMContentLoaded', () => {

    // スポーツオーバーレイを開く処理を追加
    const sportTypeSelector = document.getElementById('sport_type_selector');
    sportTypeSelector.addEventListener('click', () => {
        sportTypeOverlay.style.display = 'flex';
    });

    // スポーツオーバーレイを閉じる処理も追加しておくと良い（念のため）
    const closeSportTypeOverlay = document.getElementById('close_sport_type_overlay');
    closeSportTypeOverlay.addEventListener('click', () => {
        sportTypeOverlay.style.display = 'none';
    });



    /* =====================================================
       ※ 全体のバリデーション処理：最低1項目以上入力されているか
    ====================================================== */
    const searchForm = document.getElementById('search_form'); // Blade側でformのidを"search_form"などに変更しておく
    searchForm.addEventListener('submit', (e) => {
        // 各hiddenや入力値をチェック
        const sportTypes = document.getElementById('sport_types').value.trim();
        const prefecture = document.getElementById('prefecture').value.trim();
        const city = document.getElementById('city').value.trim();
        const minPeople = document.getElementById('min_people').value.trim();
        const maxPeople = document.getElementById('max_people').value.trim();
        const startDate = document.getElementById('start_date').value.trim();
        const endDate = document.getElementById('end_date').value.trim();

        if (!(sportTypes || (prefecture && city) || (minPeople || maxPeople) || (startDate || endDate))) {
            e.preventDefault();
            alert("検索条件を最低1つ以上入力してください。");
        }
    });


    /* =====================================================
       ① 種目：複数選択対応
       ・各.optionクリックで選択状態をトグル
       ・選択済み項目はhidden inputにカンマ区切りでセット
       ・「決定」ボタン押下でオーバーレイを閉じる
    ====================================================== */
    const sportTypeOverlay = document.getElementById('sport_type_overlay');
    const sportTypeOptions = document.querySelectorAll('.sport_option');
    const sportTypesInput = document.getElementById('sport_types');
    const selectedSportLabel = document.getElementById('selected_sport_label');
    const selectedSportImage = document.getElementById('selected_sport_image');
    const confirmSportBtn = document.getElementById('confirm_sport');

    // 各オプションクリックで選択状態トグル
    sportTypeOptions.forEach(option => {
        option.addEventListener('click', () => {
            // selectedクラスで選択状態を管理
            option.classList.toggle('selected');
        });
    });

    // 決定ボタン押下で選択項目を hidden に反映
    confirmSportBtn.addEventListener('click', () => {
        const selectedOptions = [];
        // 画像はひとまず最初に選んだものを表示例としてセット
        let displayImage = "";
        sportTypeOptions.forEach(option => {
            if (option.classList.contains('selected')) {
                selectedOptions.push(option.getAttribute('data-value'));
                // 初めての選択の場合は画像をセット
                if (!displayImage) {
                    displayImage = option.getAttribute('data-image');
                }
            }
        });
        sportTypesInput.value = selectedOptions.join(',');

        if (selectedOptions.length > 1) {
            selectedSportLabel.textContent = `${selectedOptions.length}個の種目を選択`;
        } else if (selectedOptions.length === 1) {
            selectedSportLabel.textContent = selectedOptions[0];
        } else {
            selectedSportLabel.textContent = '種目';
        }
    
        if(displayImage){
            selectedSportImage.src = displayImage;
        }
        sportTypeOverlay.style.display = 'none';
    });


    /* =====================================================
       ② 地域は基本従来と同様
       ※ Bladeでユーザーの都道府県が設定済みならhiddenに初期値セット済み
    ====================================================== */
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

    areaSelector.addEventListener('click', () => {
        areaOverlay.style.display = 'flex';
        // 都道府県リストを読み込む
        loadPrefectures();
    });

    closeAreaOverlay.addEventListener('click', () => {
        areaOverlay.style.display = 'none';
    });

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
    function loadCities() {
        areaOptionsContainer.innerHTML = '';
        areaOverlayTitle.textContent = `${selectedPrefecture} の市区町村を選択してください`;
        cities.forEach(city => {
            const option = document.createElement('div');
            option.classList.add('area_option');
            option.textContent = city.city;
            option.dataset.cityName = city.city;
            option.addEventListener('click', () => {
                prefectureInput.value = selectedPrefecture;
                cityInput.value = city.city;
                selectedAreaLabel.textContent = `${selectedPrefecture} ${city.city}`;
                areaOverlay.style.display = 'none';
            });
            areaOptionsContainer.appendChild(option);
        });
    }

// 楽しみ方
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


    /* =====================================================
       ③ 人数範囲指定
       ・オーバーレイ内に「最小人数」と「最大人数」入力欄を設置
       ・決定ボタン押下で各hidden（min_people, max_people）にセット
    ====================================================== */
    const numberSelector = document.getElementById('number_selector');
    const numberOverlay = document.getElementById('number_overlay');
    const closeNumberOverlay = document.getElementById('close_number_overlay');
    const minNumberInput = document.getElementById('min_number_input'); // HTML側に設置
    const maxNumberInput = document.getElementById('max_number_input'); // HTML側に設置
    const confirmNumberBtn = document.getElementById('confirm_number');
    const minPeopleInput = document.getElementById('min_people'); // hidden用
    const maxPeopleInput = document.getElementById('max_people'); // hidden用
    const selectedNumberLabel = document.getElementById('selected_number_label');

    numberSelector.addEventListener('click', () => {
        numberOverlay.style.display = 'flex';
    });
    closeNumberOverlay.addEventListener('click', () => {
        numberOverlay.style.display = 'none';
    });
    confirmNumberBtn.addEventListener('click', () => {
        const minVal = parseInt(minNumberInput.value, 10);
        const maxVal = parseInt(maxNumberInput.value, 10);
        if ((!isNaN(minVal) || !isNaN(maxVal)) && (!isNaN(minVal) && !isNaN(maxVal) ? minVal <= maxVal : true)) {
            // 任意項目なので、片方だけ入力もOK
            minPeopleInput.value = isNaN(minVal) ? "" : minVal;
            maxPeopleInput.value = isNaN(maxVal) ? "" : maxVal;
            let labelText = "";
            if(!isNaN(minVal)) labelText += minVal + "人～";
            if(!isNaN(maxVal)) labelText += maxVal + "人";
            selectedNumberLabel.textContent = labelText || "人数";
            numberOverlay.style.display = 'none';
        } else {
            alert('最小人数は最大人数以下に設定してください。');
        }
    });

    

    /* =====================================================
       ④ 日時範囲指定
       ・オーバーレイ内に「開始日時」と「終了日時」入力欄を設置
       ・決定ボタン押下で各hidden（start_date, end_date）にセット
       ・終了日時は開始日時より後であることのバリデーションも追加
    ====================================================== */
    const dateSelector = document.getElementById('date_selector');
    const dateOverlay = document.getElementById('date_overlay');
    const closeDateOverlay = document.getElementById('close_date_overlay');
    const startDateInput = document.getElementById('start_date_input'); // HTML側に設置
    const endDateInput = document.getElementById('end_date_input'); // HTML側に設置
    const confirmDateBtn = document.getElementById('confirm_date');
    const startDateHidden = document.getElementById('start_date'); // hidden用
    const endDateHidden = document.getElementById('end_date');   // hidden用
    const selectedDateLabel = document.getElementById('selected_date_label');

    dateSelector.addEventListener('click', () => {
        dateOverlay.style.display = 'flex';
    });
    closeDateOverlay.addEventListener('click', () => {
        dateOverlay.style.display = 'none';
    });
    confirmDateBtn.addEventListener('click', () => {
        const startVal = startDateInput.value;
        const endVal = endDateInput.value;
    
        // どちらも空ならリセット
        if (!startVal && !endVal) {
            startDateHidden.value = "";
            endDateHidden.value = "";
            selectedDateLabel.textContent = "日時";
            dateOverlay.style.display = 'none';
            return;
        }
    
        // どちらかだけの場合はそのまま使う
        if (startVal && endVal) {
            const start = new Date(startVal);
            const end = new Date(endVal);
            if (end < start) {
                alert("終了日は開始日以降に設定してください。");
                return;
            }
        }
    
        startDateHidden.value = startVal;
        endDateHidden.value = endVal;
    
        let labelText = "";
        if (startVal && endVal) {
            labelText = `${startVal} ～ ${endVal}`;
        } else if (startVal) {
            labelText = `${startVal} 以降`;
        } else if (endVal) {
            labelText = `${endVal} 以前`;
        }
    
        selectedDateLabel.textContent = labelText;
        dateOverlay.style.display = 'none';
    });
    
});


