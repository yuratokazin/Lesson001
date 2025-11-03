// Получаем элементы по их ID
const clickButton = document.getElementById('clickButton');
const counterDisplay = document.getElementById('counter');

// Изначальное значение счётчика
let counter = 0;

// Добавляем обработчик события на кнопку
clickButton.addEventListener('click', function() {
    counter++; // Увеличиваем счётчик на 1
    counterDisplay.textContent = counter; // Обновляем текст в элементе
});
