// Счетчик кликов
let clickCount = 0;
const clickMeButton = document.getElementById('clickMe');
const clickCounter = document.getElementById('click-counter');

// Обработчик клика для кнопки "Нажми меня!"
clickMeButton.addEventListener('click', function() {
    clickCount++; // Увеличиваем счетчик на 1
    clickCounter.textContent = `Количество нажатий: ${clickCount}`;
});
