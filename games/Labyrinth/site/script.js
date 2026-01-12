// Пример карты лабиринта: 0 - путь, 1 - стена, 2 - игрок, 3 - враг, 4 - выход
const mazeMap = [
    [1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
    [1, 2, 0, 0, 0, 0, 0, 0, 3, 1],
    [1, 0, 1, 1, 1, 1, 1, 1, 0, 1],
    [1, 0, 1, 0, 0, 0, 0, 1, 0, 1],
    [1, 0, 1, 0, 1, 1, 0, 1, 0, 1],
    [1, 0, 0, 0, 0, 1, 0, 0, 0, 1],
    [1, 1, 1, 1, 0, 1, 1, 1, 0, 1],
    [1, 0, 0, 0, 0, 0, 0, 0, 0, 1],
    [1, 3, 1, 1, 1, 1, 1, 1, 4, 1],
    [1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
];

const gameArea = document.getElementById('game-area');
const scoreElement = document.getElementById('score');
let score = 0;
let playerPosition = { x: 1, y: 1 };
const enemies = [];

function createMaze() {
    gameArea.style.gridTemplateColumns = `repeat(${mazeMap[0].length}, 20px)`;
    for (let y = 0; y < mazeMap.length; y++) {
        for (let x = 0; x < mazeMap[y].length; x++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            if (mazeMap[y][x] === 1) {
                cell.classList.add('wall');
            } else if (mazeMap[y][x] === 0) {
                cell.classList.add('path');
            } else if (mazeMap[y][x] === 2) {
                cell.classList.add('player');
                playerPosition = { x, y };
            } else if (mazeMap[y][x] === 3) {
                cell.classList.add('enemy');
                enemies.push({ x, y, direction: 1 }); // direction: 1 (право), -1 (лево)
            } else if (mazeMap[y][x] === 4) {
                cell.classList.add('exit');
            }
            gameArea.appendChild(cell);
        }
    }
}

function updateDisplay() {
    gameArea.innerHTML = ''; // Очистить и перерисовать поле
    createMaze(); // Простой способ обновления, в более сложных играх лучше обновлять только измененные ячейки
    scoreElement.textContent = score;
}

// Движение игрока
document.addEventListener('keydown', (e) => {
    let newX = playerPosition.x;
    let newY = playerPosition.y;

    switch (e.key) {
        case 'ArrowUp': newY--; break;
        case 'ArrowDown': newY++; break;
        case 'ArrowLeft': newX--; break;
        case 'ArrowRight': newX++; break;
    }

    if (newY >= 0 && newY < mazeMap.length && newX >= 0 && newX < mazeMap[0].length && mazeMap[newY][newX] !== 1) {
        // Очищаем старую позицию игрока
        mazeMap[playerPosition.y][playerPosition.x] = 0;

        // Проверяем на выход
        if (mazeMap[newY][newX] === 4) {
            alert('Поздравляем! Вы выбрались из лабиринта!');
            // Здесь можно добавить логику завершения игры
        }

        // Перемещаем игрока
        playerPosition = { x: newX, y: newY };
        mazeMap[playerPosition.y][playerPosition.x] = 2;

        // Начисляем очки за каждый ход
        score += 10;
        updateDisplay();
        checkCollisions();
    }
});

// Движение врагов (очень простая логика влево/вправо)
function moveEnemies() {
    for (const enemy of enemies) {
        let newX = enemy.x + enemy.direction;
        // Проверяем границы или стены для изменения направления
        if (newX <= 0 || newX >= mazeMap[0].length - 1 || mazeMap[enemy.y][newX] === 1) {
            enemy.direction *= -1; // Меняем направление
            newX = enemy.x + enemy.direction; // Делаем ход в новом направлении
        }

        // Очищаем старую позицию врага
        if (mazeMap[enemy.y][enemy.x] === 3) mazeMap[enemy.y][enemy.x] = 0;

        // Перемещаем врага
        enemy.x = newX;
        mazeMap[enemy.y][enemy.x] = 3;
    }
    updateDisplay();
    checkCollisions();
}

// Проверка столкновений игрока с врагами
function checkCollisions() {
    for (const enemy of enemies) {
        if (enemy.x === playerPosition.x && enemy.y === playerPosition.y) {
            alert('Вас поймали! Игра окончена.');
            // Здесь можно добавить логику перезапуска игры
        }
    }
}

// Инициализация и запуск движения врагов
createMaze();
// Враги двигаются каждые 500мс
setInterval(moveEnemies, 500);
