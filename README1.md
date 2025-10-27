## Удаляем функцию смены темы

Вот исправленный код **без функции смены темы**, но с рабочей навигацией:

```javascript
// ===== ОСНОВНЫЕ ПЕРЕМЕННЫЕ =====

let clickCount = 0;
const items = ['Элемент 1', 'Элемент 2', 'Элемент 3'];

// ===== ФУНКЦИИ =====

// Функция для обновления счетчика кликов
function updateClickCounter() {
    clickCount++;
    const counterElement = document.getElementById('click-counter');
    counterElement.textContent = `Количество нажатий: ${clickCount}`;
    
    // Меняем цвет текста при каждом клике
    const colors = ['#e74c3c', '#3498db', '#2ecc71', '#f39c12', '#9b59b6'];
    counterElement.style.color = colors[clickCount % colors.length];
}

// Функция для переключения между страницами
function showPage(pageId) {
    // Скрываем все секции
    const sections = document.querySelectorAll('.page-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Показываем выбранную секцию
    const targetSection = document.getElementById(`${pageId}-section`);
    if (targetSection) {
        targetSection.style.display = 'block';
    }
}

// Функция для обработки формы
function handleFormSubmit(event) {
    event.preventDefault(); // Предотвращаем перезагрузку страницы
    
    // Получаем значения из формы
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    
    // Валидация
    if (name && email && message) {
        const messageElement = document.getElementById('form-message');
        messageElement.innerHTML = `
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-top: 10px;">
                <strong>Спасибо, ${name}!</strong><br>
                Ваше сообщение отправлено. Мы ответим на: ${email}
            </div>
        `;
        
        // Очищаем форму
        document.getElementById('contact-form').reset();
        
        // Через 5 секунд убираем сообщение
        setTimeout(() => {
            messageElement.innerHTML = '';
        }, 5000);
    }
}

// Функция для добавления динамического элемента
function addDynamicItem() {
    const dynamicContent = document.getElementById('dynamic-content');
    const newItem = document.createElement('div');
    newItem.className = 'service';
    newItem.innerHTML = `
        <h3>Новый элемент ${dynamicContent.children.length + 1}</h3>
        <p>Добавлен в: ${new Date().toLocaleTimeString()}</p>
        <button class="remove-dynamic">Удалить</button>
    `;
    dynamicContent.appendChild(newItem);
    
    // Добавляем обработчик для кнопки удаления
    newItem.querySelector('.remove-dynamic').addEventListener('click', function() {
        dynamicContent.removeChild(newItem);
    });
}

// Функция для удаления последнего элемента
function removeLastItem() {
    const dynamicContent = document.getElementById('dynamic-content');
    if (dynamicContent.children.length > 0) {
        dynamicContent.removeChild(dynamicContent.lastChild);
    }
}

// Функция для обновления года в футере
function updateCurrentYear() {
    const yearElement = document.getElementById('current-year');
    yearElement.textContent = new Date().getFullYear();
}

// ===== ОБРАБОТЧИКИ СОБЫТИЙ =====

// Функция которая выполняется когда страница полностью загружена
document.addEventListener('DOMContentLoaded', function() {
    console.log('Страница загружена!');
    
    // Обновляем год в футере
    updateCurrentYear();
    
    // ===== НАЗНАЧАЕМ ОБРАБОТЧИКИ СОБЫТИЙ =====
    
    // Обработчик для кнопки "Нажми меня"
    document.getElementById('clickMe').addEventListener('click', updateClickCounter);
    
    // Обработчики для навигационного меню
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Отменяем стандартное поведение ссылки
            const page = this.getAttribute('data-page');
            showPage(page);
        });
    });
    
    // Обработчик для формы
    document.getElementById('contact-form').addEventListener('submit', handleFormSubmit);
    
    // Обработчики для динамического контента
    document.getElementById('add-item').addEventListener('click', addDynamicItem);
    document.getElementById('remove-item').addEventListener('click', removeLastItem);
    
    // Добавляем несколько начальных элементов
    items.forEach((item, index) => {
        setTimeout(() => {
            addDynamicItem();
        }, index * 500);
    });
});
```

## Что было удалено:
- Функция `toggleTheme()`
- Обработчик для кнопки `themeToggle`
- Все упоминания о смене темы

## Что осталось работоспособным:
- ✅ Навигация между страницами
- ✅ Счетчик кликов  
- ✅ Форма обратной связи
- ✅ Динамическое добавление/удаление элементов
- ✅ Обновление года в футере

Теперь навигация по ссылкам "Главная", "О нас", "Контакты" должна работать корректно!



> #### Я обновил код, но навигация между страницами (по ссылкам) - не работает



Проблема в том, что у секций нет класса `page-section`, который используется в JavaScript. Вот исправленный код:

## Исправленный HTML - добавьте классы секциям:

```html
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой сайт name</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Добро пожаловать на мой сайт</h1>
        <nav>
            <ul>
                <li><a href="#" data-page="home">Главная</a></li>
                <li><a href="#" data-page="about">О нас</a></li>
                <li><a href="#" data-page="contact">Контакты</a></li>
            </ul>
        </nav>
        <button id="themeToggle">Сменить тему</button>
    </header>

    <main>
        <!-- ДОБАВЬТЕ КЛАСС page-section К КАЖДОЙ СЕКЦИИ -->
        <section id="home-section" class="page-section">
            <h2>Главная</h2>
            <p id="welcome-text">Приветствую на нашем сайте!</p>
            <button id="clickMe" class="btn">Нажми меня!</button>
            <div id="click-counter" class="counter">Количество нажатий: 0</div>
        </section>

        <section id="about-section" class="page-section">
            <h2>О нас</h2>
            <p>Это простой параграф текста о нашей компании.</p>
            <div class="service">
                <h3>Веб-разработка</h3>
                <p>Создаем современные сайты</p>
            </div>
            <div class="service">
                <h3>Дизайн</h3>
                <p>Разрабатываем красивые интерфейсы</p>
            </div>
        </section>

        <section id="contact-section" class="page-section">
            <h2>Контакты</h2>
            <form id="contact-form">
                <div>
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Сообщение:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Отправить</button>
            </form>
            <div id="form-message"></div>
        </section>

        <section>
            <h2>Динамический контент</h2>
            <div id="dynamic-content">
                <!-- Сюда будем добавлять элементы через JavaScript -->
            </div>
            <button id="add-item">Добавить элемент</button>
            <button id="remove-item">Удалить элемент</button>
        </section>
    </main>

    <footer>
        <p>&copy; <span id="current-year">2024</span> Мой сайт. Все права защищены.</p>
    </footer>

    <script src="jscript.js"></script>
</body>
</html>
```

## Или измените JavaScript (альтернативное решение):

Если не хотите менять HTML, измените функцию `showPage()` в JavaScript:

```javascript
// Функция для переключения между страницами
function showPage(pageId) {
    // Скрываем все секции с ID, заканчивающимися на -section
    const sections = document.querySelectorAll('[id$="-section"]');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Показываем выбранную секцию
    const targetSection = document.getElementById(`${pageId}-section`);
    if (targetSection) {
        targetSection.style.display = 'block';
    }
}
```

## Также добавьте в CSS:

```css
/* Скрываем все секции кроме первой */
.page-section {
    display: none;
}

.page-section:first-child {
    display: block;
}
```

**Основная проблема**: в вашем HTML у секций нет класса `page-section`, который используется в JavaScript для поиска всех секций. Добавьте этот класс к каждой секции, и навигация заработает!