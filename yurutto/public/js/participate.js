

console.log('jsを読み込みました');

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.btn-participate').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const recruitmentId = button.dataset.id;
            const partnerUserId = button.dataset.user;

            if (!confirm("この募集に参加しますか？")) return;

            try {
                const res = await fetch('/participate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ recruitment_id: recruitmentId })
                });

                const data = await res.json();

                if (data.success) {
                    // ボタンを削除
                    const parent = button.parentElement;
                    button.remove();

                    // 新しいメッセージボタンを作成
                    const messageBtn = document.createElement('a');
                    messageBtn.textContent = 'メッセージ';
                    messageBtn.href = `/messages/${partnerUserId}`;
                    messageBtn.classList.add('btn-message');

                    // ボタンの親要素に追加
                    parent.appendChild(messageBtn);

                    alert('参加が完了しました！');
                } else {
                    alert('参加できませんでした。');
                }
            } catch (err) {
                console.error('参加失敗', err);
                alert('エラーが発生しました。');
            }
        });
    });
});
