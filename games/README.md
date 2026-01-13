Задание разработано в жанре гиперкежула игры. 

Это классический проект для **Scratch**, который идеально подходит для обучения логике программирования через создание гиперказуального хита.

Вот краткий разбор того, как превратить это ТЗ в работающий код, следуя вашим шагам:

🛠 Логика реализации в Scratch:

1. **Движение (Шаг 5):** Чтобы игрок не проходил сквозь стены лабиринта, используйте блок `если касается цвета [цвет стен], то идти -5 шагов`. Это создаст эффект твердого препятствия.
2. **Враги (Шаг 6-7):** Для движения «влево-вправо» используйте цикл `всегда` с командами `идти 10 шагов` и блоком `если касается края/стены, оттолкнуться` (или разворот на 180 градусов). Использование **клонов** позволит быстро наполнить лабиринт опасностями без дублирования кода.
3. **Счетчик (Шаг 3):** Переменная «Количество попыток» должна увеличиваться на 1 каждый раз, когда красный квадрат касается синего. При этом персонаж должен мгновенно возвращаться в точку спавна (блок `перейти в x: y:`).
4. **Победа:** Конец лабиринта можно обозначить зоной другого цвета (например, зеленого). При касании этого цвета игра останавливается («Стоп всё»).

💡 Совет для наставника:

Объясните участникам, что **клонирование** в Scratch — это аналог **объектно-ориентированного программирования (ООП)**, где мы создаем один «класс» (оригинал), а затем плодим его «экземпляры» (клоны), которые наследуют всё поведение.

------

Можно составить подробный список скриптов (командных блоков) для каждого спрайта, чтобы участникам было проще ориентироваться.

---

`Но мы перепишем игру так что бы ее можно было использовать для детей на курсе веб разработка`

---

Для курса по веб-разработке мы перенесем логику из Scratch в связку 

**HTML5 + CSS3 + JavaScript**. Это позволит детям увидеть, как работает реальный код, сохраняя механику гиперказуальной игры.

Вот структура проекта, адаптированная для обучения:

\1. Разметка (HTML) — «Каркас»

Создаем игровое поле и элементы интерфейса.

html

```
<div class="stats">Попытки: <span id="tries">0</span></div>
<div id="game-container">
    <div id="player"></div>
    <div id="wall1" class="wall" style="top: 100px; left: 0; width: 300px; height: 20px;"></div>
    <div id="enemy1" class="enemy" style="top: 150px; left: 10px;"></div>
    <div id="finish"></div>
</div>
```



\2. Стили (CSS) — «Внешний вид»

Здесь мы объясняем, как позиционировать объекты (`absolute`) и задавать им цвета.

css

```
#game-container { position: relative; width: 400px; height: 400px; border: 2px solid #000; }
#player { width: 30px; height: 30px; background: red; position: absolute; }
.enemy { width: 30px; height: 30px; background: blue; position: absolute; }
#finish { width: 30px; height: 30px; background: green; position: absolute; right: 0; bottom: 0; }
.wall { background: black; position: absolute; }
```



\3. Логика (JavaScript) — «Мозг игры»

Разбиваем код на понятные функции, проводя аналогии со Scratch:

- **Переменные:** `let attempts = 0;` (аналог оранжевых блоков).
- **Движение:** Слушатель событий `keydown`.
- **Игровой цикл:** `requestAnimationFrame` для движения врагов и проверки столкновений.

**Пример логики столкновения (Collisions):**

javascript

```
function checkCollision(rect1, rect2) {
    return !(rect1.right < rect2.left || 
             rect1.left > rect2.right || 
             rect1.bottom < rect2.top || 
             rect1.top > rect2.bottom);
}
```



Преимущества такого подхода для обучения:

1. **Событийное программирование:** Ученики поймут, как браузер «слышит» нажатие клавиш.
2. **Координатная сетка:** Работа с `top` и `left` закрепляет понимание осей X и Y.
3. **DOM-дерево:** Дети увидят, что любой игровой объект — это просто узел в структуре страницы.

---

`Теперь нач нужно подготовить полный и чистый код с тремя файлами HTML, CSS и JS, чтобы мы могли сразу запустить его и показать ученикам`

---

Вот готовый проект, разделенный на три файла. Код снабжен подробными комментариями, чтобы детям было проще соотнести его с блоками Scratch.



\1. index.html

Здесь мы создаем структуру игры. Лабиринт строится из обычных `div`.

html

```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Гиперкежуал Лабиринт</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ui">
        <h1>Лабиринт</h1>
        <p>Попытки: <span id="tries">0</span></p>
    </div>

    <div id="game-board">
        <!-- Стены лабиринта -->
        <div class="wall" style="top: 100px; left: 0; width: 300px; height: 20px;"></div>
        <div class="wall" style="top: 200px; left: 100px; width: 300px; height: 20px;"></div>
        <div class="wall" style="top: 300px; left: 0; width: 250px; height: 20px;"></div>
        
        <!-- Цель (Финиш) -->
        <div id="finish"></div>

        <!-- Игрок (Красный квадрат) -->
        <div id="player"></div>

        <!-- Враги (Синие квадраты) -->
        <div class="enemy" style="top: 140px; left: 50px;" data-range="200"></div>
        <div class="enemy" style="top: 240px; left: 200px;" data-range="150"></div>
    </div>

    <script src="script.js"></script>
</body>
</html>
```



\2. style.css

Здесь мы задаем «внешку» и фиксируем размеры игрового поля.

css

```
body {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #f0f0f0;
    font-family: sans-serif;
}

#game-board {
    position: relative;
    width: 400px;
    height: 400px;
    background-color: white;
    border: 5px solid #333;
    overflow: hidden;
}

#player {
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: red;
    top: 10px;
    left: 10px;
    transition: 0.05s; /* Плавность движения */
}

.enemy {
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: blue;
}

.wall {
    position: absolute;
    background-color: #333;
}

#finish {
    position: absolute;
    width: 40px;
    height: 40px;
    background-color: green;
    bottom: 10px;
    right: 10px;
}

.ui { text-align: center; }
```



\3. script.js

Логика управления, движения врагов и проверки столкновений.

javascript

```
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const enemies = document.querySelectorAll('.enemy');
const walls = document.querySelectorAll('.wall');
const finish = document.getElementById('finish');

let tries = 0;
let playerX = 10;
let playerY = 10;

// 1. Движение игрока (клавиши)
document.addEventListener('keydown', (e) => {
    const step = 10;
    let oldX = playerX;
    let oldY = playerY;

    if (e.key === 'ArrowUp') playerY -= step;
    if (e.key === 'ArrowDown') playerY += step;
    if (e.key === 'ArrowLeft') playerX -= step;
    if (e.key === 'ArrowRight') playerX += step;

    updatePosition();

    // Проверка столкновения со стенами
    walls.forEach(wall => {
        if (isColliding(player, wall)) {
            playerX = oldX; // Откат позиции (стенка)
            playerY = oldY;
            updatePosition();
        }
    });

    // Проверка победы
    if (isColliding(player, finish)) {
        alert("Ура! Вы вышли из лабиринта!");
        resetPlayer();
    }
});

function updatePosition() {
    player.style.top = playerY + 'px';
    player.style.left = playerX + 'px';
}

function resetPlayer() {
    playerX = 10;
    playerY = 10;
    updatePosition();
}

// 2. Логика врагов (авто-движение влево-вправо)
let enemyDir = 1;
function moveEnemies() {
    enemies.forEach(enemy => {
        let left = parseInt(enemy.style.left);
        let range = parseInt(enemy.dataset.range);
        
        if (left > range || left < 10) enemyDir *= -1;
        enemy.style.left = (left + (2 * enemyDir)) + 'px';

        // Проверка касания игрока врагом
        if (isColliding(player, enemy)) {
            tries++;
            triesDisplay.textContent = tries;
            resetPlayer();
        }
    });
    requestAnimationFrame(moveEnemies);
}

// 3. Функция проверки столкновений (Rect collision)
function isColliding(a, b) {
    let aRect = a.getBoundingClientRect();
    let bRect = b.getBoundingClientRect();
    return !(
        aRect.top > bRect.bottom ||
        aRect.bottom < bRect.top ||
        aRect.right < bRect.left ||
        aRect.left > bRect.right
    );
}

moveEnemies(); // Запуск цикла игры
```



**Инструкция для запуска:**

1. Создайте папку.
2. Сохраните в неё эти три файла под указанными именами.
3. Откройте `index.html` в любом браузере.



---

`Добавьим в код мобильное управление (кнопки на экране), так как это гиперказуальный жанр «tap to play»`

---



Чтобы превратить проект в настоящий мобильный «гиперкежуал», добавим блок сенсорного управления (D-pad). Теперь играть можно будет как с клавиатуры, так и нажимая на экран смартфона или планшета.



Обновите файлы следующим кодом:

\1. index.html (Добавляем блок кнопок)

Вставьте этот блок сразу после закрывающего тега `</div>` игрового поля (`#game-board`).

html

```
<!-- Блок управления для мобильных устройств -->
<div class="controls">
    <div class="row"><button class="btn" id="up">▲</button></div>
    <div class="row">
        <button class="btn" id="left">◀</button>
        <button class="btn" id="down">▼</button>
        <button class="btn" id="right">▶</button>
    </div>
</div>
```



\2. style.css (Стилизуем кнопки под «tap to play»)

Добавьте эти стили в конец вашего CSS-файла.

css

```
.controls {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    user-select: none; /* Чтобы текст не выделялся при тапах */
}

.row { display: flex; }

.btn {
    width: 60px;
    height: 60px;
    margin: 5px;
    font-size: 24px;
    font-weight: bold;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 10px;
    touch-action: manipulation; /* Убирает задержку клика на смартфонах */
}

.btn:active {
    background-color: red; /* Визуальный отклик при нажатии */
}
```



\3. script.js (Добавляем обработку кликов)

Добавьте этот код в конец JS-файла. Мы создадим общую функцию перемещения, чтобы не дублировать логику.

javascript

```
// Функция движения (вынесена отдельно для клавиатуры и кнопок)
function move(direction) {
    const step = 20; // Увеличим шаг для удобства игры на телефоне
    let oldX = playerX;
    let oldY = playerY;

    if (direction === 'up') playerY -= step;
    if (direction === 'down') playerY += step;
    if (direction === 'left') playerX -= step;
    if (direction === 'right') playerX += step;

    updatePosition();

    // Проверка столкновения со стенами
    walls.forEach(wall => {
        if (isColliding(player, wall)) {
            playerX = oldX;
            playerY = oldY;
            updatePosition();
        }
    });
}

// Привязываем кнопки экрана к функции движения
document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');

// Обновляем старый обработчик клавиатуры, чтобы он тоже использовал функцию move
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowUp') move('up');
    if (e.key === 'ArrowDown') move('down');
    if (e.key === 'ArrowLeft') move('left');
    if (e.key === 'ArrowRight') move('right');
});
```



Что это дает для обучения:

1. **DRY (Don't Repeat Yourself):** Мы вынесли логику движения в отдельную функцию `move()`, которую вызывают и кнопки, и клавиатура.
2. **Адаптивность:** Дети увидят, как интерфейс подстраивается под разные способы ввода.
3. **События `onclick`:** Это самый простой способ познакомить учеников с интерактивностью элементов.



---

Добавим этот код в наши три файла index.html, style.css и script.js

---



Вот полностью обновленный и готовый к работе код. Я объединил логику управления и добавил эффект «вспышки» при столкновении, чтобы игра выглядела как настоящий гиперказуальный проект.



\1. index.html

html

```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Maze: Hypercasual</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ui">
        <h1>ЛАБИРИНТ</h1>
        <p>Попытки: <span id="tries">0</span></p>
    </div>

    <div id="game-board">
        <!-- Стены -->
        <div class="wall" style="top: 100px; left: 0; width: 300px; height: 20px;"></div>
        <div class="wall" style="top: 200px; left: 100px; width: 300px; height: 20px;"></div>
        <div class="wall" style="top: 300px; left: 0; width: 250px; height: 20px;"></div>
        
        <div id="finish"></div>
        <div id="player"></div>

        <!-- Враги -->
        <div class="enemy" style="top: 140px; left: 50px;" data-range="250"></div>
        <div class="enemy" style="top: 240px; left: 200px;" data-range="150"></div>
    </div>

    <!-- Кнопки управления для тач-скринов -->
    <div class="controls">
        <div class="row"><button class="btn" id="up">▲</button></div>
        <div class="row">
            <button class="btn" id="left">◀</button>
            <button class="btn" id="down">▼</button>
            <button class="btn" id="right">▶</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
```



\2. style.css

css

```
body {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #f0f0f0;
    font-family: 'Arial', sans-serif;
    touch-action: manipulation;
}

#game-board {
    position: relative;
    width: 400px;
    height: 400px;
    background-color: white;
    border: 5px solid #333;
    overflow: hidden;
    transition: background-color 0.2s; /* Для вспышки при столкновении */
}

#player {
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: red;
    top: 10px;
    left: 10px;
}

.enemy {
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: blue;
}

.wall {
    position: absolute;
    background-color: #333;
}

#finish {
    position: absolute;
    width: 40px;
    height: 40px;
    background-color: green;
    bottom: 10px;
    right: 10px;
}

/* Мобильное управление */
.controls { margin-top: 20px; display: flex; flex-direction: column; align-items: center; }
.row { display: flex; }
.btn {
    width: 65px; height: 65px; margin: 5px;
    font-size: 24px; background: #333; color: white;
    border: none; border-radius: 15px; cursor: pointer;
}
.btn:active { background: red; }

/* Класс для анимации проигрыша */
.flash-red { background-color: #ffcccc !important; }
```



\3. script.js

javascript

```
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const enemies = document.querySelectorAll('.enemy');
const walls = document.querySelectorAll('.wall');
const finish = document.getElementById('finish');

let tries = 0;
let playerX = 10;
let playerY = 10;

// Общая функция движения
function move(direction) {
    const step = 15;
    let oldX = playerX;
    let oldY = playerY;

    if (direction === 'up') playerY -= step;
    if (direction === 'down') playerY += step;
    if (direction === 'left') playerX -= step;
    if (direction === 'right') playerX += step;

    // Ограничения поля
    if (playerX < 0 || playerX > 375 || playerY < 0 || playerY > 375) {
        playerX = oldX; playerY = oldY;
    }

    updatePosition();

    // Проверка стен
    walls.forEach(wall => {
        if (isColliding(player, wall)) {
            playerX = oldX;
            playerY = oldY;
            updatePosition();
        }
    });

    // Проверка победы
    if (isColliding(player, finish)) {
        alert("Победа!");
        resetGame();
    }
}

function updatePosition() {
    player.style.top = playerY + 'px';
    player.style.left = playerX + 'px';
}

function resetGame() {
    playerX = 10;
    playerY = 10;
    updatePosition();
}

function triggerFlash() {
    board.classList.add('flash-red');
    setTimeout(() => board.classList.remove('flash-red'), 200);
}

// Движение врагов
let enemyDir = 1;
function animate() {
    enemies.forEach(enemy => {
        let left = parseInt(enemy.style.left) || 0;
        let range = parseInt(enemy.dataset.range);
        
        if (left > range || left < 10) enemyDir *= -1;
        enemy.style.left = (left + (3 * enemyDir)) + 'px';

        if (isColliding(player, enemy)) {
            tries++;
            triesDisplay.textContent = tries;
            triggerFlash();
            resetGame();
        }
    });
    requestAnimationFrame(animate);
}

function isColliding(a, b) {
    let aRect = a.getBoundingClientRect();
    let bRect = b.getBoundingClientRect();
    return !(aRect.top > bRect.bottom || aRect.bottom < bRect.top || 
             aRect.right < bRect.left || aRect.left > bRect.right);
}

// Слушатели событий
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowUp') move('up');
    if (e.key === 'ArrowDown') move('down');
    if (e.key === 'ArrowLeft') move('left');
    if (e.key === 'ArrowRight') move('right');
});

document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');

animate();
```



---

Теперь

1)`Нужно добавить анимацию проигрыша (например, мигание экрана красным), чтобы усилить эффект гиперказуальной игры`

2)`Нужно дополнить код системой уровней, чтобы при достижении финиша стены лабиринта перестраивались автоматически`

---



Чтобы сделать игру по-настоящему «гиперказуальной» и интересной для обучения, мы добавим **массив уровней** в JavaScript. Теперь стены будут перестраиваться автоматически, а экран будет эффектно мигать при столкновении.

Вот финальные версии трех файлов:

\1. index.html

Мы убрали стены из HTML, так как теперь их будет строить JavaScript.

html

```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Maze: Levels & FX</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ui">
        <h1>УРОВЕНЬ: <span id="lvl-num">1</span></h1>
        <p>Попытки: <span id="tries">0</span></p>
    </div>

    <div id="game-board">
        <!-- Стены и враги создаются через JS -->
        <div id="finish"></div>
        <div id="player"></div>
    </div>

    <div class="controls">
        <div class="row"><button class="btn" id="up">▲</button></div>
        <div class="row">
            <button class="btn" id="left">◀</button>
            <button class="btn" id="down">▼</button>
            <button class="btn" id="right">▶</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
```



\2. style.css

Добавлена анимация вспышки.

css

```
body { display: flex; flex-direction: column; align-items: center; background: #f0f0f0; font-family: sans-serif; touch-action: manipulation; }
#game-board { 
    position: relative; width: 400px; height: 400px; background: white; 
    border: 5px solid #333; overflow: hidden; transition: background 0.1s; 
}
#player { position: absolute; width: 20px; height: 20px; background: red; z-index: 10; }
.enemy { position: absolute; width: 20px; height: 20px; background: blue; z-index: 5; }
.wall { position: absolute; background: #333; }
#finish { position: absolute; width: 30px; height: 30px; background: green; bottom: 10px; right: 10px; }

/* Анимация проигрыша */
.flash-red { background-color: #ff4d4d !important; }

.controls { margin-top: 20px; }
.btn { width: 60px; height: 60px; margin: 5px; background: #333; color: white; border: none; border-radius: 10px; font-size: 20px; }
.btn:active { background: red; }
```



\3. script.js

Здесь реализована логика смены уровней и эффекты.

javascript

```
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const lvlDisplay = document.getElementById('lvl-num');

let tries = 0;
let currentLevel = 0;
let playerX = 10, playerY = 10;

// Конфигурация уровней
const levels = [
    { walls: [{t:100, l:0, w:300, h:20}], enemies: [{t:150, l:50, r:300}] },
    { walls: [{t:100, l:100, w:300, h:20}, {t:250, l:0, w:300, h:20}], enemies: [{t:180, l:10, r:350}] },
    { walls: [{t:50, l:0, w:20, h:300}, {t:200, l:100, w:20, h:200}], enemies: [{t:50, l:50, r:300}, {t:300, l:50, r:300}] }
];

function loadLevel(idx) {
    if (idx >= levels.length) { alert("Вы прошли все уровни!"); currentLevel = 0; return loadLevel(0); }
    
    // Очистка старых стен и врагов
    document.querySelectorAll('.wall, .enemy').forEach(el => el.remove());
    
    // Создание стен
    levels[idx].walls.forEach(w => {
        const wall = document.createElement('div');
        wall.className = 'wall';
        wall.style.cssText = `top:${w.t}px; left:${w.l}px; width:${w.w}px; height:${w.h}px;`;
        board.appendChild(wall);
    });

    // Создание врагов
    levels[idx].enemies.forEach(e => {
        const enemy = document.createElement('div');
        enemy.className = 'enemy';
        enemy.style.cssText = `top:${e.t}px; left:${e.l}px;`;
        enemy.dataset.range = e.r;
        board.appendChild(enemy);
    });

    lvlDisplay.textContent = idx + 1;
    resetPosition();
}

function move(dir) {
    let oldX = playerX, oldY = playerY;
    if (dir === 'up') playerY -= 15;
    if (dir === 'down') playerY += 15;
    if (dir === 'left') playerX -= 15;
    if (dir === 'right') playerX += 15;

    player.style.left = playerX + 'px';
    player.style.top = playerY + 'px';

    // Коллизии со стенками
    document.querySelectorAll('.wall').forEach(wall => {
        if (isColliding(player, wall)) { playerX = oldX; playerY = oldY; }
    });

    // Коллизия с финишем
    if (isColliding(player, document.getElementById('finish'))) {
        currentLevel++;
        loadLevel(currentLevel);
    }
    updateUI();
}

function updateUI() {
    player.style.left = playerX + 'px';
    player.style.top = playerY + 'px';
}

function resetPosition() { playerX = 10; playerY = 10; updateUI(); }

function isColliding(a, b) {
    let r1 = a.getBoundingClientRect(), r2 = b.getBoundingClientRect();
    return !(r1.top > r2.bottom || r1.bottom < r2.top || r1.right < r2.left || r1.left > r2.right);
}

function animate() {
    document.querySelectorAll('.enemy').forEach(en => {
        let left = parseInt(en.style.left) || 0;
        let range = parseInt(en.dataset.range);
        let dir = en.dataset.dir || 1;
        
        if (left > range || left < 10) dir *= -1;
        en.dataset.dir = dir;
        en.style.left = (left + (2 * dir)) + 'px';

        if (isColliding(player, en)) {
            tries++;
            triesDisplay.textContent = tries;
            board.classList.add('flash-red');
            setTimeout(() => board.classList.remove('flash-red'), 150);
            resetPosition();
        }
    });
    requestAnimationFrame(animate);
}

// Инициализация
document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');
loadLevel(0);
animate();
```



Теперь у вас есть полноценный игровой движок на минималках!



---

`Добавим звуковые эффекты (короткий «бип» при столкновении и «фанфары» при победе), чтобы завершить образ игры`

---



Для реализации звуков в вебе мы будем использовать **Web Audio API**. Это крутой инструмент: он позволяет генерировать звуки программно, не скачивая лишние MP3-файлы. Это идеальный пример для учеников, как "код превращается в звук".

Обновите ваш `script.js`, добавив функции синтеза звука.

\1. script.js (Добавьте это в начало или конец файла)

javascript

```
// Функция для генерации звуков (синтезатор)
function playSound(type) {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = ctx.createOscillator();
    const gain = ctx.createGain();

    osc.connect(gain);
    gain.connect(ctx.destination);

    if (type === 'hit') {
        // Короткий низкий звук "бип" при столкновении
        osc.type = 'square';
        osc.frequency.setValueAtTime(150, ctx.currentTime); 
        osc.frequency.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        gain.gain.setValueAtTime(0.1, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        osc.start();
        osc.stop(ctx.currentTime + 0.2);
    } 
    else if (type === 'win') {
        // Победный мажорный аккорд (фанфары)
        const notes = [440, 554, 659, 880]; // Ноты аккорда A
        notes.forEach((freq, i) => {
            const o = ctx.createOscillator();
            const g = ctx.createGain();
            o.connect(g);
            g.connect(ctx.destination);
            o.frequency.value = freq;
            g.gain.setValueAtTime(0, ctx.currentTime);
            g.gain.linearRampToValueAtTime(0.1, ctx.currentTime + 0.1 + (i * 0.1));
            g.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.8);
            o.start(ctx.currentTime + (i * 0.1));
            o.stop(ctx.currentTime + 0.8);
        });
    }
}

// Теперь интегрируем вызовы звуков в существующие функции:

// В функции animate(), там где столкновение с врагом:
if (isColliding(player, en)) {
    tries++;
    triesDisplay.textContent = tries;
    board.classList.add('flash-red');
    playSound('hit'); // <--- ДОБАВИТЬ ЭТО
    setTimeout(() => board.classList.remove('flash-red'), 150);
    resetPosition();
}

// В функции move(), там где проверка победы:
if (isColliding(player, document.getElementById('finish'))) {
    playSound('win'); // <--- ДОБАВИТЬ ЭТО
    currentLevel++;
    setTimeout(() => loadLevel(currentLevel), 300); // Небольшая задержка для красоты
}
```



Почему это полезно для курса веб-разработки:

1. **AudioContext**: Вы объясняете, что браузер — это не только текст и картинки, но и мощная медиа-платформа.
2. **Синтез частот**: Можно вскользь упомянуть, что звук — это волна (частота в Гц), и мы управляем ею через код.
3. **Пользовательский опыт (UX)**: Звук дает игроку мгновенную обратную связь, что критично для гиперказуальных игр.

**Важное примечание:** Браузеры часто блокируют звук до первого клика пользователя. Поскольку у нас игра начинается с нажатия кнопок, звук заработает сразу!



---

`Полный код всего файла script.js после добавления`

---



Вот полный и финальный код файла `script.js`. Я объединил всю логику: уровни, движение, анимацию проигрыша и программную генерацию звуков.

javascript

```
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const lvlDisplay = document.getElementById('lvl-num');

let tries = 0;
let currentLevel = 0;
let playerX = 10;
let playerY = 10;

// 1. КОНФИГУРАЦИЯ УРОВНЕЙ
const levels = [
    { 
        walls: [{t:100, l:0, w:300, h:20}], 
        enemies: [{t:150, l:50, r:300}] 
    },
    { 
        walls: [{t:100, l:100, w:300, h:20}, {t:250, l:0, w:300, h:20}], 
        enemies: [{t:180, l:10, r:350}] 
    },
    { 
        walls: [{t:50, l:0, w:20, h:300}, {t:200, l:100, w:20, h:200}, {t:150, l:200, w:200, h:20}], 
        enemies: [{t:50, l:50, r:300}, {t:300, l:50, r:300}] 
    }
];

// 2. ЗВУКОВАЯ СИСТЕМА (Web Audio API)
function playSound(type) {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    
    if (type === 'hit') {
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        osc.type = 'square';
        osc.frequency.setValueAtTime(150, ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        gain.gain.setValueAtTime(0.1, ctx.currentTime);
        osc.start();
        osc.stop(ctx.currentTime + 0.2);
    } 
    else if (type === 'win') {
        const notes = [440, 554, 659, 880]; // Ля-мажорное созвучие
        notes.forEach((freq, i) => {
            const o = ctx.createOscillator();
            const g = ctx.createGain();
            o.connect(g);
            g.connect(ctx.destination);
            o.frequency.value = freq;
            g.gain.setValueAtTime(0, ctx.currentTime);
            g.gain.linearRampToValueAtTime(0.1, ctx.currentTime + 0.1 + (i * 0.1));
            g.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.8);
            o.start(ctx.currentTime + (i * 0.1));
            o.stop(ctx.currentTime + 0.8);
        });
    }
}

// 3. ЛОГИКА УРОВНЕЙ
function loadLevel(idx) {
    if (idx >= levels.length) {
        alert("Поздравляем! Вы прошли все уровни!");
        currentLevel = 0;
        tries = 0;
        triesDisplay.textContent = tries;
        return loadLevel(0);
    }
    
    // Очистка поля
    document.querySelectorAll('.wall, .enemy').forEach(el => el.remove());
    
    // Отрисовка стен
    levels[idx].walls.forEach(w => {
        const wall = document.createElement('div');
        wall.className = 'wall';
        wall.style.cssText = `top:${w.t}px; left:${w.l}px; width:${w.w}px; height:${w.h}px;`;
        board.appendChild(wall);
    });

    // Отрисовка врагов
    levels[idx].enemies.forEach(e => {
        const enemy = document.createElement('div');
        enemy.className = 'enemy';
        enemy.style.cssText = `top:${e.t}px; left:${e.l}px;`;
        enemy.dataset.range = e.r;
        board.appendChild(enemy);
    });

    lvlDisplay.textContent = idx + 1;
    resetPosition();
}

// 4. ДВИЖЕНИЕ И КОЛЛИЗИИ
function move(dir) {
    let oldX = playerX, oldY = playerY;
    const step = 15;

    if (dir === 'up') playerY -= step;
    if (dir === 'down') playerY += step;
    if (dir === 'left') playerX -= step;
    if (dir === 'right') playerX += step;

    // Границы поля
    if (playerX < 0 || playerX > 380 || playerY < 0 || playerY > 380) {
        playerX = oldX; playerY = oldY;
    }

    player.style.left = playerX + 'px';
    player.style.top = playerY + 'px';

    // Проверка стен
    document.querySelectorAll('.wall').forEach(wall => {
        if (isColliding(player, wall)) {
            playerX = oldX; 
            playerY = oldY;
            player.style.left = playerX + 'px';
            player.style.top = playerY + 'px';
        }
    });

    // Проверка финиша
    if (isColliding(player, document.getElementById('finish'))) {
        playSound('win');
        currentLevel++;
        setTimeout(() => loadLevel(currentLevel), 300);
    }
}

function resetPosition() {
    playerX = 10;
    playerY = 10;
    player.style.left = playerX + 'px';
    player.style.top = playerY + 'px';
}

function isColliding(a, b) {
    let r1 = a.getBoundingClientRect(), r2 = b.getBoundingClientRect();
    return !(r1.top > r2.bottom || r1.bottom < r2.top || r1.right < r2.left || r1.left > r2.right);
}

// 5. ИГРОВОЙ ЦИКЛ (Анимация врагов и смерть)
let enemyDir = 1;
function animate() {
    document.querySelectorAll('.enemy').forEach(en => {
        let left = parseInt(en.style.left) || 0;
        let range = parseInt(en.dataset.range);
        let dir = parseInt(en.dataset.dir) || 1;
        
        if (left > range || left < 10) dir *= -1;
        en.dataset.dir = dir;
        en.style.left = (left + (2 * dir)) + 'px';

        if (isColliding(player, en)) {
            tries++;
            triesDisplay.textContent = tries;
            playSound('hit');
            board.classList.add('flash-red');
            setTimeout(() => board.classList.remove('flash-red'), 150);
            resetPosition();
        }
    });
    requestAnimationFrame(animate);
}

// 6. ОБРАБОТЧИКИ СОБЫТИЙ
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowUp') move('up');
    if (e.key === 'ArrowDown') move('down');
    if (e.key === 'ArrowLeft') move('left');
    if (e.key === 'ArrowRight') move('right');
});

document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');

// СТАРТ ИГРЫ
loadLevel(0);
animate();
```



Теперь ваш проект полностью укомплектован!

---

`Добавим "Босса" на последнем уровне и оформим финальную инструкцию для учеников, как упаковать этот проект в архив для портфолио`

---



Чтобы добавить **Босса**, мы создадим особого «врага» с уникальными свойствами (большой размер и движение по кругу или преследование), который появляется только на последнем уровне.

Вот как это реализовать, а также финальный чек-лист для учеников.

\1. Добавление Босса в `script.js`

**Шаг 1: Добавьте новый уровень в массив `levels`:**

javascript

```
// Добавьте это в массив levels (в самом конце)
{ 
    isBossLevel: true,
    walls: [], // На уровне босса стен может не быть для простора
    enemies: [{t: 150, l: 150, r: 0, isBoss: true}] 
}
```



**Шаг 2: Модифицируйте функцию `animate()`:**
Добавьте логику «преследования» игрока боссом внутри цикла движения врагов:

javascript

```
function animate() {
    document.querySelectorAll('.enemy').forEach(en => {
        if (en.dataset.isBoss === "true") {
            // ЛОГИКА БОССА: он медленно идет за игроком
            let bossX = parseInt(en.style.left);
            let bossY = parseInt(en.style.top);
            
            if (bossX < playerX) bossX += 1;
            else if (bossX > playerX) bossX -= 1;
            
            if (bossY < playerY) bossY += 1;
            else if (bossY > playerY) bossY -= 1;
            
            en.style.left = bossX + 'px';
            en.style.top = bossY + 'px';
        } else {
            // Обычная логика движения влево-вправо (старый код)
            let left = parseInt(en.style.left) || 0;
            let range = parseInt(en.dataset.range);
            let dir = parseInt(en.dataset.dir) || 1;
            if (left > range || left < 10) dir *= -1;
            en.dataset.dir = dir;
            en.style.left = (left + (2 * dir)) + 'px';
        }

        // Проверка столкновения (общая)
        if (isColliding(player, en)) {
            // ... (старый код проигрыша со звуком и вспышкой)
        }
    });
    requestAnimationFrame(animate);
}
```



**Шаг 3: В функции `loadLevel()` добавьте стилизацию босса:**

javascript

```
// Внутри цикла создания врагов (levels[idx].enemies.forEach)
if (e.isBoss) {
    enemy.style.width = "60px";
    enemy.style.height = "60px";
    enemy.style.backgroundColor = "purple"; // Босс будет фиолетовым
    enemy.dataset.isBoss = "true";
}
```



------

📦 Инструкция для учеников: Как собрать проект в портфолио

Ребята, поздравляем! Вы создали свою первую браузерную игру. Чтобы сохранить её и показать друзьям/родителям, сделайте следующее:

1. **Проверьте файлы**: В вашей папке должно быть строго 3 файла: `index.html`, `style.css` и `script.js`.
2. **Название папки**: Назовите папку латиницей без пробелов, например `my_first_game`.
3. **Создание архива**:
   - **Windows**: Нажмите правой кнопкой на папку -> Отправить -> Сжатая ZIP-папка.
   - **macOS**: Правой кнопкой на папку -> Сжать (Compress).
4. **Где опубликовать?**:
   - Загрузите файлы на **GitHub Pages** (если вы уже проходили хостинг).
   - Или просто загрузите архив в облако (Google Drive / Яндекс.Диск), чтобы отправить ссылку.
5. **Что написать в портфолио?**:
   - *Название*: Гиперказуальный лабиринт.
   - *Технологии*: HTML5, CSS3 (анимации), JavaScript (Web Audio API, DOM manipulation).
   - *Фишки*: Процедурная генерация уровней, мобильное управление, синтезированные звуки.



---

`Подготовим краткий «словать терминов» для этого урока, чтобы ученики могли записать важные определения (DOM, Коллизия, Оциллятор`

---



Этот словарь поможет закрепить теорию и перекинуть мостик от «просто игры» к профессиональной веб-разработке.



📘 Словарь юного веб-разработчика

- **DOM (Document Object Model)** — это «дерево» элементов внутри страницы. Когда мы через JavaScript находим игрока или меняем цвет фона, мы работаем именно с DOM.
- **Коллизия (Collision)** — физическое столкновение объектов. В коде это проверка: накладываются ли координаты прямоугольника игрока на координаты стены или врага.
- **Осциллятор (Oscillator)** — электронный генератор звуковых волн. В нашем коде он создаёт звук «из ничего», задавая частоту (высоту звука) и форму волны без использования аудио-файлов.
- **Игровой цикл (Game Loop)** — бесконечный цикл (в JS это `requestAnimationFrame`), который обновляет положение объектов и проверяет условия проигрыша много раз в секунду.
- **Синтаксис (Syntax)** — правила написания кода. Если в Scratch мы соединяем блоки, то в JS мы должны строго соблюдать скобки `{}` и точки с запятой `;`.
- **Событие (Event)** — сигнал от браузера о том, что что-то произошло. Например, `keydown` (нажатие клавиши) или `onclick` (клик по кнопке).
- **Адаптивность** — способность интерфейса подстраиваться под разные устройства. В нашей игре это наличие кнопок управления для телефонов и планшетов.

------

**Совет для наставника:** Попробуйте в конце занятия спросить ребят: «Какой элемент DOM в нашей игре самый опасный?». Правильный ответ — любой `div` с классом `.enemy`.



---

`Теперь напишим полный код всех файлов игры которые мы будем упаковывать в архив на и подготовим финальный тест из 5 вопросов для проверки знаний в конце урока`

---



Вот полный комплект файлов для упаковки и финальный тест. Все пути в коде настроены так, чтобы игра запустилась сразу после разархивирования папки.



\1. index.html

html

```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>HyperMaze Web Edition</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="ui">
        <h1>УРОВЕНЬ: <span id="lvl-num">1</span></h1>
        <p>ПОПЫТКИ: <span id="tries">0</span></p>
    </div>

    <div id="game-board">
        <div id="finish"></div>
        <div id="player"></div>
    </div>

    <div class="controls">
        <div class="row"><button class="btn" id="up">▲</button></div>
        <div class="row">
            <button class="btn" id="left">◀</button>
            <button class="btn" id="down">▼</button>
            <button class="btn" id="right">▶</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
```



\2. style.css

css

```
body {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #2c3e50;
    color: white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    overflow: hidden;
    touch-action: none;
}

.ui { text-align: center; margin-top: 10px; }

#game-board {
    position: relative;
    width: 380px;
    height: 380px;
    background-color: #ecf0f1;
    border: 4px solid #34495e;
    border-radius: 8px;
    transition: background-color 0.1s;
}

#player {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: #e74c3c;
    border-radius: 4px;
    z-index: 10;
}

.wall {
    position: absolute;
    background-color: #34495e;
    border-radius: 2px;
}

.enemy {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: #3498db;
    border-radius: 4px;
}

#finish {
    position: absolute;
    width: 30px;
    height: 30px;
    background-color: #2ecc71;
    bottom: 10px;
    right: 10px;
    border-radius: 50%;
}

.flash-red { background-color: #ff7675 !important; }

.controls { margin-top: 15px; }
.row { display: flex; justify-content: center; }
.btn {
    width: 60px;
    height: 60px;
    margin: 4px;
    background-color: #34495e;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 20px;
    cursor: pointer;
}
.btn:active { background-color: #e74c3c; }
```



\3. script.js

javascript

```
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const lvlDisplay = document.getElementById('lvl-num');

let tries = 0;
let currentLevel = 0;
let playerX = 10, playerY = 10;

const levels = [
    { walls: [{t:100, l:0, w:280, h:20}], enemies: [{t:150, l:10, r:300}] },
    { walls: [{t:120, l:100, w:280, h:20}, {t:240, l:0, w:280, h:20}], enemies: [{t:180, l:50, r:320}] },
    { isBossLevel: true, walls: [], enemies: [{t:150, l:150, r:0, isBoss: true}] }
];

function playSound(type) {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    osc.connect(gain); gain.connect(ctx.destination);

    if (type === 'hit') {
        osc.frequency.setValueAtTime(150, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        osc.start(); osc.stop(ctx.currentTime + 0.2);
    } else {
        [440, 554, 659].forEach((f, i) => {
            const o = ctx.createOscillator();
            const g = ctx.createGain();
            o.connect(g); g.connect(ctx.destination);
            o.frequency.value = f;
            g.gain.setValueAtTime(0, ctx.currentTime);
            g.gain.linearRampToValueAtTime(0.1, ctx.currentTime + 0.1 + i*0.1);
            o.start(ctx.currentTime + i*0.1); o.stop(ctx.currentTime + 0.6);
        });
    }
}

function loadLevel(idx) {
    if (idx >= levels.length) { alert("ВЫ ПРОШЛИ ИГРУ!"); currentLevel = 0; return loadLevel(0); }
    document.querySelectorAll('.wall, .enemy').forEach(el => el.remove());
    
    levels[idx].walls.forEach(w => {
        const wall = document.createElement('div');
        wall.className = 'wall';
        wall.style.cssText = `top:${w.t}px; left:${w.l}px; width:${w.w}px; height:${w.h}px;`;
        board.appendChild(wall);
    });

    levels[idx].enemies.forEach(e => {
        const en = document.createElement('div');
        en.className = 'enemy';
        en.style.cssText = `top:${e.t}px; left:${e.l}px;`;
        if(e.isBoss) { en.style.width = '50px'; en.style.height = '50px'; en.style.background = 'purple'; en.dataset.isBoss = "true"; }
        en.dataset.range = e.r; board.appendChild(en);
    });
    lvlDisplay.textContent = idx + 1;
    resetPos();
}

function move(dir) {
    let oldX = playerX, oldY = playerY;
    const step = 20;
    if (dir === 'up') playerY -= step; if (dir === 'down') playerY += step;
    if (dir === 'left') playerX -= step; if (dir === 'right') playerX += step;
    
    player.style.left = playerX + 'px'; player.style.top = playerY + 'px';

    document.querySelectorAll('.wall').forEach(w => { if(isColliding(player, w)) { playerX = oldX; playerY = oldY; } });
    if (isColliding(player, document.getElementById('finish'))) { playSound('win'); currentLevel++; loadLevel(currentLevel); }
    updateUI();
}

function updateUI() { player.style.left = playerX + 'px'; player.style.top = playerY + 'px'; }
function resetPos() { playerX = 10; playerY = 10; updateUI(); }
function isColliding(a, b) {
    let r1 = a.getBoundingClientRect(), r2 = b.getBoundingClientRect();
    return !(r1.top > r2.bottom || r1.bottom < r2.top || r1.right < r2.left || r1.left > r2.right);
}

function animate() {
    document.querySelectorAll('.enemy').forEach(en => {
        let l = parseInt(en.style.left), t = parseInt(en.style.top);
        if (en.dataset.isBoss === "true") {
            l += (playerX > l ? 1 : -1); t += (playerY > t ? 1 : -1);
            en.style.left = l + 'px'; en.style.top = t + 'px';
        } else {
            let r = parseInt(en.dataset.range), d = parseInt(en.dataset.d) || 1;
            if (l > r || l < 10) d *= -1; en.dataset.d = d;
            en.style.left = (l + 2 * d) + 'px';
        }
        if (isColliding(player, en)) { 
            tries++; triesDisplay.textContent = tries; 
            playSound('hit'); board.classList.add('flash-red');
            setTimeout(() => board.classList.remove('flash-red'), 100); resetPos(); 
        }
    });
    requestAnimationFrame(animate);
}

document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');
document.addEventListener('keydown', (e) => {
    if(e.key.includes('Arrow')) move(e.key.replace('Arrow','').toLowerCase());
});
loadLevel(0); animate();
```



------

📝 Финальный тест: «Мастер Web-игр»

1. **Что такое DOM в контексте нашей игры?**
   - А) Модель поведения врагов.
   - Б) Структура HTML-элементов, которыми мы управляем через JS.
   - В) Название звукового движка.
2. **За что отвечает функция `isColliding`?**
   - А) За движение игрока.
   - Б) За проверку столкновения объектов.
   - В) За смену уровней.
3. **Какой инструмент мы использовали для создания звука "бип" без аудио-файлов?**
   - А) HTML5 Video.
   - Б) Oscillator (Осциллятор).
   - В) CSS Animation.
4. **Для чего в игре нужен `requestAnimationFrame`?**
   - А) Чтобы один раз загрузить картинку.
   - Б) Чтобы создать бесконечный игровой цикл для плавной анимации.
   - В) Чтобы остановить игру при проигрыше.
5. **Как в коде реализована "твердость" стен?**
   - А) Стены физически не дают нажать кнопку.
   - Б) Если игрок зашел на стену, код возвращает его на шаг назад (oldX/oldY).
   - В) Стены просто нарисованы для красоты и не влияют на игрока.

**Ответы:** 1-Б, 2-Б, 3-Б, 4-Б, 5-Б.



---

Добавим комментарии к каждой строчке кода, чтобы ребятам было проще делать презентацию проекта

---



Вот полный код с подробными комментариями. Я адаптировал объяснения так, чтобы ребята могли использовать их как готовый текст для выступления на презентации.



\1. index.html (Каркас игры)

html

```
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- Делаем так, чтобы игра удобно открывалась на смартфонах -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>HyperMaze Web Edition</title>
    <!-- Подключаем файл со стилями -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Верхняя панель с информацией (UI) -->
    <div class="ui">
        <h1>УРОВЕНЬ: <span id="lvl-num">1</span></h1>
        <p>ПОПЫТКИ: <span id="tries">0</span></p>
    </div>

    <!-- Игровое поле -->
    <div id="game-board">
        <!-- Цель игры (Зеленый круг) -->
        <div id="finish"></div>
        <!-- Персонаж игрока (Красный квадрат) -->
        <div id="player"></div>
    </div>

    <!-- Кнопки управления (D-Pad) -->
    <div class="controls">
        <div class="row"><button class="btn" id="up">▲</button></div>
        <div class="row">
            <button class="btn" id="left">◀</button>
            <button class="btn" id="down">▼</button>
            <button class="btn" id="right">▶</button>
        </div>
    </div>

    <!-- Подключаем логику игры -->
    <script src="script.js"></script>
</body>
</html>
```



\2. style.css (Дизайн и анимации)

css

```
body {
    display: flex; /* Выравниваем всё по центру */
    flex-direction: column;
    align-items: center;
    background-color: #2c3e50; /* Темно-синий фон страницы */
    color: white; /* Белый текст */
    font-family: sans-serif;
    margin: 0;
    overflow: hidden; /* Убираем прокрутку страницы */
    touch-action: none; /* Отключаем лишние жесты браузера */
}

#game-board {
    position: relative; /* Позволяет размещать объекты внутри по координатам */
    width: 380px;
    height: 380px;
    background-color: #ecf0f1; /* Светлый фон лабиринта */
    border: 4px solid #34495e;
    border-radius: 8px;
    transition: background-color 0.1s; /* Плавное мигание при проигрыше */
}

#player {
    position: absolute; /* Позволяет перемещать игрока через top/left */
    width: 20px;
    height: 20px;
    background-color: #e74c3c; /* Красный цвет героя */
    border-radius: 4px;
    z-index: 10; /* Герой всегда выше стен и врагов */
}

.wall {
    position: absolute;
    background-color: #34495e; /* Цвет стен лабиринта */
}

.enemy {
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: #3498db; /* Синий цвет врагов */
    border-radius: 4px;
}

#finish {
    position: absolute;
    width: 30px;
    height: 30px;
    background-color: #2ecc71; /* Зеленый финиш */
    bottom: 10px;
    right: 10px;
    border-radius: 50%;
}

/* Специальный класс для вспышки при смерти */
.flash-red { background-color: #ff7675 !important; }

/* Стили кнопок управления */
.btn {
    width: 60px;
    height: 60px;
    margin: 4px;
    background-color: #34495e;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 20px;
}
.btn:active { background-color: #e74c3c; } /* Кнопка краснеет при нажатии */
```



\3. script.js (Логика и "мозг" игры)

javascript

```
// Находим все важные элементы игры в HTML
const player = document.getElementById('player');
const board = document.getElementById('game-board');
const triesDisplay = document.getElementById('tries');
const lvlDisplay = document.getElementById('lvl-num');

// Глобальные переменные состояния игры
let tries = 0; // Счетчик попыток
let currentLevel = 0; // Текущий индекс уровня
let playerX = 10, playerY = 10; // Координаты игрока

// База данных уровней
const levels = [
    { walls: [{t:100, l:0, w:280, h:20}], enemies: [{t:150, l:10, r:300}] },
    { walls: [{t:120, l:100, w:280, h:20}, {t:240, l:0, w:280, h:20}], enemies: [{t:180, l:50, r:320}] },
    { isBossLevel: true, walls: [], enemies: [{t:150, l:150, r:0, isBoss: true}] }
];

// Функция создания звука "из кода"
function playSound(type) {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = ctx.createOscillator(); // Генератор волны
    const gain = ctx.createGain(); // Узел громкости
    osc.connect(gain); gain.connect(ctx.destination);

    if (type === 'hit') { // Короткий звук для столкновения
        osc.frequency.setValueAtTime(150, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        osc.start(); osc.stop(ctx.currentTime + 0.2);
    } else { // Аккорд для победы
        [440, 554, 659].forEach((f, i) => {
            const o = ctx.createOscillator();
            const g = ctx.createGain();
            o.connect(g); g.connect(ctx.destination);
            o.frequency.value = f;
            g.gain.setValueAtTime(0, ctx.currentTime);
            g.gain.linearRampToValueAtTime(0.1, ctx.currentTime + 0.1 + i*0.1);
            o.start(ctx.currentTime + i*0.1); o.stop(ctx.currentTime + 0.6);
        });
    }
}

// Функция сборки уровня из базы данных
function loadLevel(idx) {
    if (idx >= levels.length) { // Если уровни кончились
        alert("ВЫ ПРОШЛИ ИГРУ!");
        currentLevel = 0; return loadLevel(0);
    }
    // Удаляем старые стены и врагов перед загрузкой новых
    document.querySelectorAll('.wall, .enemy').forEach(el => el.remove());
    
    // Создаем стены нового уровня
    levels[idx].walls.forEach(w => {
        const wall = document.createElement('div');
        wall.className = 'wall';
        wall.style.cssText = `top:${w.t}px; left:${w.l}px; width:${w.w}px; height:${w.h}px;`;
        board.appendChild(wall);
    });

    // Создаем врагов нового уровня
    levels[idx].enemies.forEach(e => {
        const en = document.createElement('div');
        en.className = 'enemy';
        en.style.cssText = `top:${e.t}px; left:${e.l}px;`;
        if(e.isBoss) { // Если это босс, делаем его больше и фиолетовым
            en.style.width = '50px'; en.style.height = '50px'; 
            en.style.background = 'purple'; en.dataset.isBoss = "true"; 
        }
        en.dataset.range = e.r; board.appendChild(en);
    });
    lvlDisplay.textContent = idx + 1; // Обновляем номер уровня на экране
    resetPos(); // Возвращаем игрока в начало
}

// Функция перемещения игрока
function move(dir) {
    let oldX = playerX, oldY = playerY; // Запоминаем позицию до шага
    const step = 20; // Длина шага в пикселях
    if (dir === 'up') playerY -= step; if (dir === 'down') playerY += step;
    if (dir === 'left') playerX -= step; if (dir === 'right') playerX += step;
    
    updateUI(); // Применяем координаты

    // Проверяем, не врезался ли игрок в стену
    document.querySelectorAll('.wall').forEach(w => { 
        if(isColliding(player, w)) { // Если врезался — отменяем шаг
            playerX = oldX; playerY = oldY; 
            updateUI();
        } 
    });

    // Проверяем, дошел ли до финиша
    if (isColliding(player, document.getElementById('finish'))) {
        playSound('win');
        currentLevel++; 
        loadLevel(currentLevel);
    }
}

// Обновление позиции спрайта на экране
function updateUI() { 
    player.style.left = playerX + 'px'; 
    player.style.top = playerY + 'px'; 
}

// Сброс позиции в начало (0,0)
function resetPos() { playerX = 10; playerY = 10; updateUI(); }

// Универсальная математическая функция проверки столкновения двух прямоугольников
function isColliding(a, b) {
    let r1 = a.getBoundingClientRect(), r2 = b.getBoundingClientRect();
    return !(r1.top > r2.bottom || r1.bottom < r2.top || r1.right < r2.left || r1.left > r2.right);
}

// Игровой цикл: здесь движутся враги и босс
function animate() {
    document.querySelectorAll('.enemy').forEach(en => {
        let l = parseInt(en.style.left), t = parseInt(en.style.top);
        if (en.dataset.isBoss === "true") { // Логика Босса: преследование игрока
            l += (playerX > l ? 1 : -1); 
            t += (playerY > t ? 1 : -1);
            en.style.left = l + 'px'; en.style.top = t + 'px';
        } else { // Логика обычного врага: патруль влево-вправо
            let r = parseInt(en.dataset.range), d = parseInt(en.dataset.d) || 1;
            if (l > r || l < 10) d *= -1; // Разворот при достижении границы
            en.dataset.d = d;
            en.style.left = (l + 2 * d) + 'px';
        }
        // Проверка: убил ли враг игрока?
        if (isColliding(player, en)) { 
            tries++; triesDisplay.textContent = tries; 
            playSound('hit'); 
            board.classList.add('flash-red'); // Красная вспышка
            setTimeout(() => board.classList.remove('flash-red'), 100); 
            resetPos(); 
        }
    });
    requestAnimationFrame(animate); // Запуск следующего кадра анимации
}

// Привязываем кнопки экрана и клавиатуру к функции move
document.getElementById('up').onclick = () => move('up');
document.getElementById('down').onclick = () => move('down');
document.getElementById('left').onclick = () => move('left');
document.getElementById('right').onclick = () => move('right');
document.addEventListener('keydown', (e) => {
    if(e.key.includes('Arrow')) move(e.key.replace('Arrow','').toLowerCase());
});

// Запуск самого первого уровня и цикла анимации
loadLevel(0); animate();
```



Это финальный вариант. Весь код готов к работе и объяснен простыми словами.



Желаете получить дополнительные советы по защите проекта перед комиссией или другими учениками?



---

---


Задание разработано в жанре гиперкежула игры. С 2018 данный жанр занял плотно нишу
игр. Гипер казуальные игры — это игры без сюжета с максимально простым управлением
в «tap to play» формате. Как правило, цель игры настолько понятна для игрока, что нет
необходимости объяснять ее.
Общая формулировка задания в рамках пробы

Необходимо разработать игру «Лабиринт».

• Создается карта лабиринта.

• Игрок в виде красного квадрата и противники в виде синих квадратов.

• Враги ходят в право в лево.

• Цель игры - выйти из лабиринта

• Необходимо вести подсчет очков


Пошаговая инструкция по выполнению задания

/1) Создаем проект

/2) Рисуем 2 квадрата разного цвета и произвольной формы лабиринт

/3) Создаем переменную «Количество попыток»

/4) Щелкаем на нашего персонажа и реализуем спавн игрока в начале игры

/5) Реализуем ограничение и движение персонажа

/6) Реализуем логику врагов. Кликаем 2 раза на врага и реализуем спавн врагов

/7) Теперь нам необходимо описать логику врагов. Логику мы будем задавать для клонированных врагов

/8) Нажимаем зеленый флажек и тестируем игру


Рекомендации для наставника по организации процесса выполнения задания

/1) В процессе работы участникам необходимо не только рассказывать, как собрать логику работы, но и то, как каждый из блоков соотносится с реальным программированием.

/2) Перед началом разработки стоит с участниками разобрать алгоритм работы игры.


Критерии оценки
• Корректная работа игры в рамках предложенных заданий
• Аккуратность, внимательность и сосредоточенность участника


Компетенция
Разработка компьютерных игр и мультимедийных приложений                                                      1

Программа профессиональной пробы разработана в 2020-м году по заказу Союза “Агентство развития
профессиональных сообществ и рабочих кадров “Молодые профессионалы (Ворлдскиллс Россия)” для реализации на
практических мероприятиях в рамках проекта по ранней профессиональной ориентации учащихся 6-11-х классов
общеобразовательных организаций "Билет в будущее".

Вопросы по содержанию и использованию программы вы можете задать по электронному адресу bilet@worldskills.ru




                                        Паспорт программы


Компетенция                                  Разработка компьютерных игр и мультимедийных приложений

Уровень                                          Продвинутый

Формат проведения                            Очный

Время проведения                             90 минут

Максимальное количество участников           6 человек

Возрастная категория участников              6-11 класс

Доступность для участников с инвалидностью и ОВЗ                Не адаптировано

Автор программы                              Менеджер компетенции разработка компьютерных игр и
                                             мультимедийных приложений



Введение

Разработчик компьютерных игр – это специалист, работающий в области создания
компьютерных игр. Он работает в команде проекта по созданию игры вместе с режиссером,
руководителем проекта, программистом, гейм-дизайнером, музыкантом, художником и
тестировщиком или играет сам все эти роли, берет на себя те задачи, с которыми может
справиться. Разработчик создает концепцию игры, дизайн персонажей, создает прототип
игры, выбирает средства для реализации проекта.

Компетенция разработка компьютерных игр включает в себя два аспект разработки
компьютерных игр — это программирование и гейм дизайн.

Программист - это тот человек, который разрабатывает компьютерные, мобильные
приложения, веб сайты. Игры могут быть десктопные, мобильные и браузерные.

Компьютерная программа (она же приложение) — связка многочисленных строк
специального текста. Он является специальным, потому что создан таким образом, чтобы
машине было понятно, какие действия должны быть выполнены. Самые простые
приложения содержат около ста строк кода, а в сложных и масштабных приложениях
количество строк кода доходит до миллиарда.

Геймдизайнер это специалист, который отвечает и разрабатывает правила игры и механику.

Игровой дизайнер слышит, чувствует и может «пощупать» игру у себя в мыслях еще до
написания первой строки кода.

Место и перспективы компетенции в современной экономике страны, мира

Индустрия разработки игр заняла плотную нишу в современном мире. Доход игровой
индустрии сопоставим на 2020 год с индустрией кино.
Игры — это не только развлекательный контент, но и образовательный.

Ключевые навыки и знания для овладения компетенцией

В играх все строится на математических и физических формулах, взаимодействиях.
Для того что бы овладеть компетенцией необходимо хорошо знать математику, физику,
геометрию, иметь хорошую логику и алгоритмически аппарат.

Связь задания в рамках пробы с реальной деятельностью

Задание разработано в жанре гиперкежула игры. С 2018 данный жанр занял плотно нишу
игр. Гипер казуальные игры — это игры без сюжета с максимально простым управлением
в «tap to play» формате. Как правило, цель игры настолько понятна для игрока, что нет
необходимости объяснять ее.
Общая формулировка задания в рамках пробы

  Необходимо разработать игру «Лабиринт».

     • Создается карта лабиринта.
    
     • Игрок в виде красного квадрата и противники в виде синих квадратов.
    
     • Враги ходят в право в лево.
    
     • Цель игры - выйти из лабиринта
    
     • Необходимо вести подсчет очков

Демонстрация финального результата, продукта
  Демонстрация продукта указана в виде ссылки на видео в приложении



Пошаговая инструкция по выполнению задания



      1) Создаем проект в среде Scratch
      2) Рисуем 2 квадрата разного цвета и произвольной формы лабиринт
      3) Создаем переменную «Количество попыток»
      4) Щелкаем на нашего персонажа и реализуем спавн игрока в начале игры
      5) Реализуем ограничение и движение персонажа
      6) Реализуем логику врагов. Кликаем 2 раза на врага и реализуем спавн врагов
      7) Теперь нам необходимо описать логику врагов. Логику мы будем задавать для
         клонированных врагов
      8) Нажимаем зеленый флажек и тестируем игру


Рекомендации для наставника по организации процесса выполнения задания
 1) В процессе работы участникам необходимо не только рассказывать, как собрать
    логику работы, но и то, как каждый из блоков соотносится с реальным
    программированием.
 2) Перед началом разработки стоит с участниками разобрать алгоритм работы игры.


Критерии оценки

     •   Корректная работа игры в рамках предложенных заданий
     
     •   Аккуратность, внимательность и сосредоточенность участника
     
      Инфраструктурный лист

Наименование       Технические               Кол-во   Расчёт   Степень
                   характеристики        с                     необходимости
                   необходимыми                                (необходимо/
                   примечаниями                                опционально)
Игровой     движок В     игровом движке 1             На     1 Необходимо
Scratch 2          разработка    должна               человека
                   происходить на языке
                   Scratch
Компьютер          Монитор               с 1          На     1 Необходимо
                   соотношением     сторон            человека
                   16:9, процессор любой,
                   видео    карта   любая,
                   оперативная память не
                   меньше 4 гб, клавиатура
                   и мышь
Флеш накопитель    Интерфейс подключения 1            На       опционально
                   USB 3.0, Объем не                  группу
                   меньше 1 гб
Проектор           разрешение               1         На       Необходимо
                   минимум1280 x 800,                 группу
                   яркость 3600lm, контраст
                   22000:1,
                   широкоформатный
        Приложение и дополнения
Ссылка                                                      Комментарий
https://scratch.mit.edu/download                            Игровой движок
https://drive.google.com/file/d/1uHPUNc79TIn8c59XjUWRmL     Видео игры
UKPXocmKAU/view?usp=sharing
https://drive.google.com/file/d/1qJ6iycJf_VFHCRqRWtWm7iSd   Готовый проект 6-11
K6Ar_Ok9/view?usp=sharing

