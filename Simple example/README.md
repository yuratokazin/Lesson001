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



Ниже — объединённый код с **подробными комментариями** к каждому блоку согласно нашей задачи. 

Комментарии поясняют назначение элементов и логику стилей.

------

### Полный код страницы (`index.html`) с комментариями

html

```html
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Метаданные документа -->
    <meta charset="UTF-8"> <!-- Кодировка UTF-8 для поддержки кириллицы и спецсимволов -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Адаптивность под мобильные устройства -->
    <title>Счётчик кликов</title> <!-- Заголовок вкладки в браузере -->

    <!-- Подключение внешнего CSS-файла со стилями -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Основной контейнер страницы -->
    <div class="container">
        <!-- Заголовок верхнего уровня -->
        <h1>Счётчик кликов</h1>

        <!-- Параграф с текстом и счётчиком -->
        <!-- <span id="counter"> содержит текущее значение счётчика (изначально 0) -->
        <p>Количество кликов: <span id="counter">0</span></p>

        <!-- Кнопка, при клике на которую увеличивается счётчик -->
        <button id="clickButton">Нажми на меня!</button>
    </div>

    <!-- Подключение внешнего JavaScript-файла -->
    <script src="script.js"></script>
</body>
</html>
```

------

### Файл стилей (`styles.css`) с комментариями

css

```css
/* Общие стили для тела страницы */
body {
    font-family: Arial, sans-serif; /* Шрифт без засечек */
    margin: 0; /* Убираем внешние отступы */
    padding: 0; /* Убираем внутренние отступы */
    display: flex; /* Включаем flexbox для центрирования */
    justify-content: center; /* Центрируем по горизонтали */
    align-items: center; /* Центрируем по вертикали */
    height: 100vh; /* Высота — 100% от высоты экрана */
    background-color: #f0f0f0; /* Светло-серый фон страницы */
}

/* Стили для основного контейнера */
.container {
    text-align: center; /* Выравнивание текста по центру */
    background-color: white; /* Белый фон контейнера */
    padding: 30px; /* Отступы внутри контейнера */
    border-radius: 10px; /* Скругление углов */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Тень для объёма */
}

/* Стили заголовка */
h1 {
    color: #333; /* Тёмно-серый цвет текста */
    margin-bottom: 20px; /* Отступ снизу */
}

/* Стили абзаца */
p {
    font-size: 18px; /* Размер шрифта */
    color: #555; /* Серый цвет текста */
    margin-bottom: 20px; /* Отступ снизу */
}

/* Стили для счётчика (цифра внутри <span>) */
#counter {
    font-weight: bold; /* Жирный шрифт */
    color: #007BFF; /* Синий цвет для акцента */
}

/* Стили кнопки */
#clickButton {
    background-color: #007BFF; /* Синий фон */
    color: white; /* Белый текст */
    border: none; /* Убираем рамку */
    padding: 12px 24px; /* Внутренние отступы */
    font-size: 16px; /* Размер шрифта */
    border-radius: 5px; /* Скругление углов */
    cursor: pointer; /* Курсор-указатель при наведении */
    transition: background-color 0.3s; /* Плавная смена цвета фона */
}

/* Эффект при наведении на кнопку */
#clickButton:hover {
    background-color: #0056b3; /* Более тёмный синий при наведении */
}
```

------

### Пояснения

1. **HTML**
   - Структура проста и семантична: заголовок, текст со счётчиком, кнопка.
   - `id` у элементов (`counter`, `clickButton`) нужны для доступа из JavaScript.
   - Подключение CSS и JS через `<link>` и `<script>`.
2. **CSS**
   - `body` центрирует контент с помощью flexbox.
   - `.container` создаёт «карточку» с тенью и скруглёнными углами.
   - `#counter` выделяет число синим и делает его жирным.
   - `#clickButton` стилизует кнопку и добавляет плавный переход цвета при наведении.
3. **JavaScript** (не приведён, но подразумевается)
   - Будет отслеживать клик по `#clickButton`.
   - Увеличивать значение `#counter` на 1 при каждом клике.



Links used:

https://purpleschool.ru/blog/HTML_CSS_JS

https://habr.com/ru/companies/ruvds/articles/909390/

https://itchief.ru/javascript/hello-world