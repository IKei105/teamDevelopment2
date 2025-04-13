console.log("こん");

document.addEventListener('DOMContentLoaded', () => {
    const sendButton = document.getElementById('send-button');
    const input = document.getElementById('message-input');
    const ul = document.getElementById('messages');

    console.log('トークン');
    console.log(CHAT_CONFIG.csrfToken);

    console.log('受信者');
    console.log(CHAT_CONFIG.receiverId);

    if (!sendButton || !input || !ul) return;

    sendButton.addEventListener('click', async () => {
        const message = input.value.trim();
        if (!message) return;

        // ボタンを押した瞬間に画面に追加（APIレスポンス待たず）
        const li = document.createElement('li');
        li.classList.add('chat', 'me');

        const p = document.createElement('p');
        p.className = 'mes';
        p.textContent = message;

        const time = document.createElement('div');
        time.className = 'status';
        const now = new Date();
        time.textContent = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        li.appendChild(p);
        li.appendChild(time);
        ul.appendChild(li);

        input.value = ''; // 入力欄クリア

        // APIに送信
        try {
            await fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CHAT_CONFIG.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    receiver_id: CHAT_CONFIG.receiverId,
                    message: message
                })
            });
        } catch (err) {
            console.error('送信失敗（でも表示はされた）:', err);
        }
    });


    // メッセージを取得するAPIです
    function fetchNewMessages() {
        fetch(`/fetch-messages/${CHAT_CONFIG.receiverId}?last_id=${CHAT_CONFIG.lastMessageId}`)
            .then(res => res.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        const li = document.createElement('li');
                        li.classList.add('chat', 'you');
    
                        const p = document.createElement('p');
                        p.className = 'mes';
                        p.textContent = msg.message;
    
                        const time = document.createElement('div');
                        time.className = 'status';
                        const createdAt = new Date(msg.created_at);
                        time.textContent = createdAt.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
                        li.appendChild(p);
                        li.appendChild(time);
                        document.getElementById('messages').appendChild(li);
    
                        CHAT_CONFIG.lastMessageId = msg.id;
                    });
                }
            })
            .catch(err => {
                console.error('新着取得エラー:', err);
            })
            .finally(() => {
                // 1秒待ってから次のリクエストへ
                setTimeout(fetchNewMessages, 1000);
            });
    }
    
    // 最初の呼び出し
    fetchNewMessages();
    

});
