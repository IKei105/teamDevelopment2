console.log('こんばんは');

document.addEventListener('DOMContentLoaded', () => {
    const rateButtons = document.querySelectorAll('.btn-rate-toggle');
    const sections = document.querySelectorAll('.section');

    // 評価ボタンをクリックしたら評価フォームを表示
    rateButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();

            const section = button.closest('.section');
            const wrapper = section.querySelector('.rating-wrapper');

            if (wrapper) {
                wrapper.classList.add('active');
            }

            button.style.display = 'none';
        });
    });

    // 他の場所クリックで評価フォームを非表示
    document.addEventListener('click', (e) => {
        sections.forEach(section => {
            if (!section.contains(e.target)) {
                const wrapper = section.querySelector('.rating-wrapper');
                const button = section.querySelector('.btn-rate-toggle');

                if (wrapper && button) {
                    wrapper.classList.remove('active');
                    button.style.display = 'block';
                }
            }
        });
    });

    // 評価送信ボタン処理（API用）
    document.querySelectorAll('.rating-wrapper form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            if (!confirm('評価を送信しますか？')) return;

            const recruitmentId = form.querySelector('input[name="recruitment_id"]').value;
            const ratingValue = form.querySelector('input[name="rating"]:checked')?.value;

            console.log(recruitmentId);
            console.log(ratingValue);

            if (!ratingValue) {
                alert('評価の★を選択してください');
                return;
            }

            alert('評価が完了しました！');

            
        });
    });
});
