document.addEventListener('DOMContentLoaded', () => {
    const timeInput = document.getElementById('scheduled_at');

    timeInput.addEventListener('change', () => {
        const value = timeInput.value;
        if (value) {
            // 入力された値の「分」を 00 に変換
            const [date, time] = value.split('T');
            const [hour] = time.split(':');
            timeInput.value = `${date}T${hour.padStart(2, '0')}:00`;
        }
    });
});