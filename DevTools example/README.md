# Инструкция по созданию мини-сайта на базе HTML кода

## 1. Создание структуры файлов

Создайте папку для вашего проекта и разместите в ней следующие файлы:

```
my-website/
├── index.html
├── style.css
└── script.js
```

## 2. Содержимое файлов

### index.html
```html
<!DOCTYPE html>
<html>
<head>
    <title>DevTools Demo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <button class="button">Нажми меня!</button>
        <div class="color-box">
            <p>Измени цвет!</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
```

### style.css
```css
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f0f0;
}

.container {
    text-align: center;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #45a049;
}

.color-box {
    margin-top: 20px;
    padding: 30px;
    border: 2px dashed #ccc;
    border-radius: 5px;
    transition: background-color 0.5s;
}

.color-box p {
    margin: 0;
    font-weight: bold;
}
```

### script.js
```javascript
// Получаем элементы DOM
const button = document.querySelector('.button');
const colorBox = document.querySelector('.color-box');

// Функция для генерации случайного цвета
function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Добавляем обработчик события на кнопку
button.addEventListener('click', function() {
    // Изменяем цвет фона color-box
    colorBox.style.backgroundColor = getRandomColor();
    
    // Меняем текст кнопки на короткое время
    const originalText = button.textContent;
    button.textContent = 'Цвет изменен!';
    
    setTimeout(() => {
        button.textContent = originalText;
    }, 1000);
});
```

## 3. Запуск сайта

1. Сохраните все три файла в одной папке
2. Откройте файл `index.html` в любом браузере:
   - Дважды кликните по файлу
   - Или откройте браузер и перетащите файл в окно браузера
   - Или используйте сочетание Ctrl+O (Cmd+O на Mac) и выберите файл

## 4. Тестирование функциональности

- Нажмите кнопку "Нажми меня!" - цвет блока изменится на случайный
- Текст кнопки временно изменится на "Цвет изменен!"
- Через секунду текст кнопки вернется к исходному

## 5. Дополнительные возможности для развития

### Добавьте больше интерактивных элементов в script.js:
```javascript
// Добавьте этот код в существующий script.js

// Изменение текста при наведении на цветной блок
colorBox.addEventListener('mouseover', function() {
    this.querySelector('p').textContent = 'Наведи курсор!';
});

colorBox.addEventListener('mouseout', function() {
    this.querySelector('p').textContent = 'Измени цвет!';
});

// Добавление счетчика кликов
let clickCount = 0;
const clickCounter = document.createElement('p');
clickCounter.textContent = `Кликов: ${clickCount}`;
document.querySelector('.container').appendChild(clickCounter);

button.addEventListener('click', function() {
    clickCount++;
    clickCounter.textContent = `Кликов: ${clickCount}`;
    // остальной код обработчика...
});
```

### Улучшите стили в style.css:
```css
/* Добавьте эти стили к существующим */

.click-counter {
    margin-top: 15px;
    font-size: 14px;
    color: #666;
}

/* Анимация для кнопки */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.button:active {
    animation: pulse 0.3s;
}
```

## 6. Публикация сайта (опционально)

Чтобы сделать сайт доступным в интернете, вы можете:
- Использовать GitHub Pages
- Загрузить на хостинг-провайдера
- Использовать сервисы вроде Netlify или Vercel

Теперь у вас есть полностью функциональный мини-сайт с интерактивными элементами!

Links used:

https://purpleschool.ru/blog/HTML_CSS_JS

https://habr.com/ru/companies/ruvds/articles/909390/

https://itchief.ru/javascript/hello-world
