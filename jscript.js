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

// Функция для смены темы
function toggleTheme() {
    const body = document.body;
    body.classList.toggle('dark-theme');
    
    const themeButton = document.getElementById('themeToggle');
    if (body.classList.contains('dark-theme')) {
        themeButton.textContent = 'Светлая тема';
    } else {
        themeButton.textContent = 'Темная тема';
    }
}

// Функция для переключения между страницами
function showPage(pageId) {
    // Скрываем все секции
    document.getElementById('home-section').style.display = 'none';
    document.getElementById('about-section').style.display = 'none';
    document.getElementById('contact-section').style.display = 'none';
    
    // Показываем выбранную секцию
    document.getElementById(`${pageId}-section`).style.display = 'block';
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
    
    // Обработчик для кнопки смены темы
    document.getElementById('themeToggle').addEventListener('click', toggleTheme);
    
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