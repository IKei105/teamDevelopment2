document.addEventListener('DOMContentLoaded', () => {
    const prefectureSelect = document.getElementById('prefecture');
    const citySelect = document.getElementById('city');

    fetch('/js/search/prefectures.json')
        .then(response => response.json())
        .then(jsonData => {
            const data = jsonData[0]; // ← ここが重要
            Object.keys(data).forEach(key => {
                const prefData = data[key];
                const option = document.createElement('option');
                option.value = prefData.name;
                option.textContent = prefData.name;
                option.dataset.city = JSON.stringify(prefData.city); // 市をdata属性に保存
                prefectureSelect.appendChild(option);
            });
        });

    prefectureSelect.addEventListener('change', () => {
        const selectedOption = prefectureSelect.selectedOptions[0];
        const cities = JSON.parse(selectedOption.dataset.city || '[]');

        citySelect.innerHTML = '<option value="">市区町村を選択してください</option>';
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.city;
            option.textContent = city.city;
            citySelect.appendChild(option);
        });
    });
});
