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
