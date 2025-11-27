document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.button');
    const colorBox = document.querySelector('.color-box');

    button.addEventListener('click', () => {
        // alert('Привет от DevTools!');

        // Переключаем класс для изменения цвета
        colorBox.classList.toggle('changed');

        // Также меняем текст внутри блока
        const paragraph = colorBox.querySelector('p');
        if (colorBox.classList.contains('changed')) {
            paragraph.textContent = 'Цвет изменен!';
        } else {
            paragraph.textContent = 'Измени мой цвет!';
        }
    });
});
