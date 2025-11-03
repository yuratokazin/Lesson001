Вот простой пример веб‑страницы с использованием HTML, CSS и  JavaScript. Проект показывает счётчик кликов: при нажатии на кнопку  число увеличивается.

Структура проекта:

```
Проект «Счётчик кликов»
│
├── index.html             # Основной HTML‑файл (структура страницы)
├── styles.css             # Файл стилей CSS (оформление элементов)
└── script.js              # JavaScript‑файл (интерактивность)
```

**Подробное описание файлов:**

1. **`index.html`**
   - Доктайп и метаданные (кодировка, адаптивность).
   - Подключение CSS (`<link>`).
   - Базовая структура: контейнер с заголовком, счётчиком и кнопкой.
   - Подключение JS‑скрипта (`<script>`).
2. **`styles.css`**
   - Стили для `body` (центрирование, фон).
   - Стили контейнера (отступы, тень, скругление).
   - Оформление заголовка, текста, счётчика.
   - Стили кнопки (цвет, эффекты при наведении).
3. **`script.js`**
   - Получение DOM‑элементов по ID.
   - Инициализация счётчика (`let counter = 0`).
   - Обработчик клика для кнопки (увеличение счётчика и обновление интерфейса).

## Как запустить

1. Создайте три файла в одной папке: `index.html`, `styles.css`, `script.js`.
2. Скопируйте соответствующий код в каждый файл.
3. Откройте `index.html` в браузере.

Вы увидите страницу со счётчиком, который увеличивается при нажатии на кнопку.

### 1. HTML‑файл (`index.html`)

html

```html
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Счётчик кликов</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Счётчик кликов</h1>
        <p>Количество кликов: <span id="counter">0</span></p>
        <button id="clickButton">Нажми на меня!</button>
    </div>
    <script src="script.js"></script>
</body>
</html>
```

### 2. CSS‑файл (`styles.css`)

css

```css
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}

.container {
    text-align: center;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    color: #555;
    margin-bottom: 20px;
}

#counter {
    font-weight: bold;
    color: #007BFF;
}

#clickButton {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#clickButton:hover {
    background-color: #0056b3;
}
```

### 3. JavaScript‑файл (`script.js`)

javascript

```javascript
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
```

## Как это работает

1. **HTML** задаёт структуру страницы: заголовок, параграф со счётчиком и кнопку.
2. **CSS** стилизует элементы: центрирует контейнер, задаёт цвета, отступы, скругления и эффекты при наведении.
3. **JavaScript** добавляет интерактивность:
   - находит кнопку и элемент со счётчиком по ID;
   - при клике на кнопку увеличивает значение счётчика и обновляет текст на странице.

Links used:

https://purpleschool.ru/blog/HTML_CSS_JS

https://habr.com/ru/companies/ruvds/articles/909390/

https://itchief.ru/javascript/hello-world