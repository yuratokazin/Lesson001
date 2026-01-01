Чтобы сделать на вашем сайте **аналог GitHub‑редактора Markdown** (с вкладками «Edit» и «Preview»), понадобится комбинация HTML, CSS, JavaScript и библиотеки для парсинга Markdown.

Ниже — пошаговое решение.

------

### 1. Структура HTML

Создайте две панели:

- **левая** — редактор текста (textarea);
- **правая** — превью (div для отрендеренного HTML).

html

```html
<div class="editor-container">
  <!-- Вкладки -->
  <div class="tabs">
    <button class="tab-active" onclick="showTab('edit')">Edit</button>
    <button onclick="showTab('preview')">Preview</button>
  </div>


  <!-- Редактор -->
  <div id="edit-panel" class="panel">
    <textarea id="markdown-input" placeholder="Введите Markdown..."></textarea>
  </div>

  <!-- Превью -->
  <div id="preview-panel" class="panel">
    <div id="markdown-output"></div>
  </div>
</div>
```

------

### 2. Стили (CSS)

css

```css
.editor-container {
  display: flex;
  flex-direction: column;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.tabs {
  display: flex;
  border-bottom: 1px solid #e1e4e8;
}

.tabs button {
  padding: 12px 16px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 14px;
  color: #586069;
}

.tab-active {
  color: #24292e;
  border-bottom: 2px solid #0366d6;
}

.panel {
  height: calc(100vh - 80px);
  overflow-y: auto;
}

#edit-panel {
  flex: 1;
}

#preview-panel {
  flex: 1;
  background-color: #f6f8fa;
  padding: 20px;
}

textarea {
  width: 100%;
  height: 100%;
  border: none;
  resize: none;
  padding: 16px;
  font-size: 14px;
  line-height: 1.6;
  box-sizing: border-box;
}

/* Стили под GitHub (упрощённо) */
#markdown-output h1 { font-size: 24px; font-weight: 600; margin: 24px 0 16px; }
#markdown-output h2 { font-size: 20px; font-weight: 600; margin: 24px 0 16px; }
#markdown-output p { margin: 0 0 16px; }
#markdown-output ul, ol { padding-left: 2em; margin: 0 0 16px; }
#markdown-output code { background-color: rgba(27,31,35,0.05); padding: 0.2em 0.4em; border-radius: 3px; }
#markdown-output pre { background-color: #f6f8fa; border: 1px solid #e1e4e8; border-radius: 6px; padding: 16px; overflow: auto; }
```

------

### 3. JavaScript (логика)

#### 3.1. Подключите библиотеку для Markdown

Используйте `marked` (проще) или `remark` + `rehype`.

html

```html
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
```

#### 3.2. Код для переключения вкладок и рендера

javascript

```javascript
// Элементы
const editPanel = document.getElementById('edit-panel');
const previewPanel = document.getElementById('preview-panel');
const markdownInput = document.getElementById('markdown-input');
const markdownOutput = document.getElementById('markdown-output');

// Переключение вкладок
function showTab(tabName) {
  if (tabName === 'edit') {
    editPanel.style.display = 'block';
    previewPanel.style.display = 'none';
    document.querySelector('.tabs button:nth-child(1)').classList.add('tab-active');
    document.querySelector('.tabs button:nth-child(2)').classList.remove('tab-active');
  } else {
    editPanel.style.display = 'none';
    previewPanel.style.display = 'block';
    document.querySelector('.tabs button:nth-child(1)').classList.remove('tab-active');
    document.querySelector('.tabs button:nth-child(2)').classList.add('tab-active');
    renderMarkdown();
  }
}

// Рендеринг Markdown в HTML
function renderMarkdown() {
  const markdownText = markdownInput.value;
  markdownOutput.innerHTML = marked.parse(markdownText);
}

// Авто-рендеринг при вводе (опционально)
markdownInput.addEventListener('input', () => {
  if (document.querySelector('.tab-active').textContent === 'Preview') {
    renderMarkdown();
  }
});

// Инициализация: показать «Edit» по умолчанию
showTab('edit');
```

------

### 4. Дополнительные улучшения (по желанию)

#### 4.1. Подсветка синтаксиса в коде

Добавьте `Prism.js`:

html

```html
<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/9.1.1/themes/prism.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9.1.1/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9.1.1/components/prism-javascript.min.js"></script>
<!-- Другие языки по необходимости -->
```

В `renderMarkdown()` добавьте:

javascript

```javascript
marked.use({
  renderer: new marked.Renderer(),
  highlight: function(code, lang) {
    const language = Prism.languages[lang] || Prism.languages.clike;
    return Prism.highlight(code, language, lang);
  }
});
```

#### 4.2. Поддержка GFM (таблицы, задачи и т.п.)

Включите расширения в `marked`:

javascript

```javascript
marked.use({
  gfm: true,
  breaks: true,
  pedantic: false
});
```

#### 4.3. Сохранение в localStorage

Чтобы не терять текст при перезагрузке:

javascript

```javascript
// При загрузке
if (localStorage.getItem('markdown')) {
  markdownInput.value = localStorage.getItem('markdown');
}

// При вводе
markdownInput.addEventListener('input', () => {
  localStorage.setItem('markdown', markdownInput.value);
});
```

------

### Итоговый пример (минимальный)

html

```html
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Markdown Editor как на GitHub</title>
  <style>
    /* Вставьте CSS из раздела 2 */
  </style>
</head>
<body>
  <!-- HTML из раздела 1 -->
  
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <script>
    /* JavaScript из раздела 3.2 */
  </script>
</body>
</html>
```

------

### Что получилось

- **Две вкладки**: «Edit» (редактор) и «Preview» (превью).
- **Живой рендеринг**: текст преобразуется в HTML при переключении на «Preview».
- **Стили как на GitHub**: шрифты, отступы, цвета блоков кода.
- **Поддержка GFM**: списки задач (`- [x]`), таблицы, ссылки.
- **Подсветка кода**: если добавили Prism.js.

------

---



### Итого = index.html + styles.css + script.js

## HTML

index.html

```html
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Markdown Editor как на GitHub</title>
  <!-- CSS из раздела 2 -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
  <!-- HTML из раздела 1 -->
  <div class="editor-container">
    <!-- Вкладки -->
    <div class="tabs">
      <button class="tab-active" onclick="showTab('edit')">Edit</button>
      <button onclick="showTab('preview')">Preview</button>
    </div>

    <!-- Редактор -->
    <div id="edit-panel" class="panel">
      <textarea id="markdown-input" placeholder="Введите Markdown..."></textarea>
    </div>

    <!-- Превью -->
    <div id="preview-panel" class="panel">
      <div id="markdown-output"></div>
    </div>
  </div>
  <!-- конец HTML из раздела 1 -->
    
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <!--  JavaScript из раздела 3.2  -->
    <script src="script.js"></script>
</body>
</html>
```

------



### Стиль (CSS)

styles.css

```css
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.editor-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.tabs {
  flex: 0 0 auto;
  display: flex;
  border-bottom: 1px solid #e1e4e8;
}

.tabs button {
  padding: 12px 16px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 14px;
  color: #586069;
}

.tab-active {
  color: #24292e;
  border-bottom: 2px solid #0366d6;
}

.panel {
  flex: 1 1 auto;
  overflow-y: auto;
  position: relative;
}

#edit-panel {
  display: flex;
}

textarea {
  width: 100%;
  border: none;
  resize: none;
  padding: 16px;
  font-size: 14px;
  line-height: 1.6;
  outline: none;
}

/* Стили для превью (как у GitHub) */
#markdown-output {
  padding-left: 24px;
  padding-right: 24px;
  box-sizing: border-box;
}

#markdown-output h1 {
  font-size: 24px;
  font-weight: 600;
  margin: 24px 0 16px;
}

#markdown-output h2 {
  font-size: 20px;
  font-weight: 600;
  margin: 24px 0 16px;
}

#markdown-output p {
  margin: 0 0 16px;
}

#markdown-output ul, ol {
  padding-left: 2em;
  margin: 0 0 16px;
}

#markdown-output code {
  background-color: rgba(27, 31, 35, 0.05);
  padding: 0.2em 0.4em;
  border-radius: 3px;
}

#markdown-output pre {
  background-color: #f6f8fa;
  border: 1px solid #e1e4e8;
  border-radius: 6px;
  padding: 16px;
  overflow: auto;
}
```

------



### JavaScript (логика)

#### Код для переключения вкладок и рендера

script.js

```javascript
// Элементы
const editPanel = document.getElementById('edit-panel');
const previewPanel = document.getElementById('preview-panel');
const markdownInput = document.getElementById('markdown-input');
const markdownOutput = document.getElementById('markdown-output');

// Переключение вкладок
function showTab(tabName) {
  if (tabName === 'edit') {
    editPanel.style.display = 'block';
    previewPanel.style.display = 'none';
    document.querySelector('.tabs button:nth-child(1)').classList.add('tab-active');
    document.querySelector('.tabs button:nth-child(2)').classList.remove('tab-active');
  } else {
    editPanel.style.display = 'none';
    previewPanel.style.display = 'block';
    document.querySelector('.tabs button:nth-child(1)').classList.remove('tab-active');
    document.querySelector('.tabs button:nth-child(2)').classList.add('tab-active');
    renderMarkdown();
  }
}

// Рендеринг Markdown в HTML
function renderMarkdown() {
  const markdownText = markdownInput.value;
  markdownOutput.innerHTML = marked.parse(markdownText);
}

// Авто-рендеринг при вводе (опционально)
markdownInput.addEventListener('input', () => {
  if (document.querySelector('.tab-active').textContent === 'Preview') {
    renderMarkdown();
  }
});

// Инициализация: показать «Edit» по умолчанию
showTab('edit');
```



---

---

---



## Добавим кнопку сохранения Markdown‑файла

Чтобы добавить кнопку сохранения Markdown‑файла (`*.md`) в ту же папку, где лежит ваш HTML, нужно учесть **ограничения браузера**:

> **Важно**:
>
> - Браузер не может напрямую записывать файлы на диск пользователя без его участия.
> - Решение — сгенерировать файл и предложить его скачать через `<a download>`.

------

### Шаг 1. Добавьте кнопку «Сохранить»

Вставьте в HTML (например, над вкладками):

html

```html
<div class="controls">
  <button onclick="saveMarkdown()">Сохранить как .md</button>
</div>
```

**Полное место вставки** (обновлённый фрагмент `<body>`):

html

```html
<body>
  <div class="editor-container">
    <!-- Кнопки управления -->
    <div class="controls">
      <button onclick="saveMarkdown()">Сохранить как .md</button>
    </div>

    <!-- Вкладки -->
    <div class="tabs">
      <button class="tab-active" onclick="showTab('edit')">Edit</button>
      <button onclick="showTab('preview')">Preview</button>
    </div>

    <!-- Редактор -->
    <div id="edit-panel" class="panel">
      <textarea id="markdown-input" placeholder="Введите Markdown..."></textarea>
    </div>

    <!-- Превью -->
    <div id="preview-panel" class="panel">
      <div id="markdown-output"></div>
    </div>
  </div>
```

------

### Шаг 2. Добавьте стили для кнопки

В секцию `<style>` добавьте:

css

```css
.controls {
  padding: 12px 16px;
  background-color: #f6f8fa;
  border-bottom: 1px solid #e1e4e8;
}

.controls button {
  padding: 6px 12px;
  background-color: #24292e;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size: 14px;
}

.controls button:hover {
  background-color: #1a1e23;
}
```

------

### Шаг 3. Добавьте JavaScript‑функцию сохранения

Вставьте перед закрывающим `</script>`:

javascript

```javascript
function saveMarkdown() {
  // Получаем текст из редактора
  const markdownText = markdownInput.value;

  // Если текста нет — предупреждаем
  if (!markdownText) {
    alert("Нет текста для сохранения!");
    return;
  }

  // Создаём Blob с текстом и типом text/markdown
  const blob = new Blob([markdownText], { type: 'text/markdown' });

  // Создаём ссылку для скачивания
  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = 'document.md';  // Имя файла по умолчанию

  // Добавляем ссылку в документ и имитируем клик
  document.body.appendChild(link);
  link.click();

  // Удаляем ссылку после скачивания
  document.body.removeChild(link);
  URL.revokeObjectURL(link.href);
}
```

------

### Итоговый код (с кнопкой сохранения)

index.html

```html
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Markdown Editor как на GitHub</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .editor-container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .controls {
      padding: 12px 16px;
      background-color: #f6f8fa;
      border-bottom: 1px solid #e1e4e8;
    }

    .controls button {
      padding: 6px 12px;
      background-color: #24292e;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 14px;
    }

    .controls button:hover {
      background-color: #1a1e23;
    }

    .tabs {
      flex: 0 0 auto;
      display: flex;
      border-bottom: 1px solid #e1e4e8;
    }

    .tabs button {
      padding: 12px 16px;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 14px;
      color: #586069;
    }

    .tab-active {
      color: #24292e;
      border-bottom: 2px solid #0366d6;
    }

    .panel {
      flex: 1 1 auto;
      overflow-y: auto;
      position: relative;
    }

    #edit-panel {
      display: flex;
    }

    textarea {
      width: 100%;
      border: none;
      resize: none;
      padding: 16px;
      font-size: 14px;
      line-height: 1.6;
      outline: none;
    }

    /* Стили для превью (как у GitHub) */
    #markdown-output {
      padding-left: 24px;
      padding-right: 24px;
      box-sizing: border-box;
    }

    #markdown-output h1 {
      font-size: 24px;
      font-weight: 600;
      margin: 24px 0 16px;
    }

    #markdown-output h2 {
      font-size: 20px;
      font-weight: 600;
      margin: 24px 0 16px;
    }

    #markdown-output p {
      margin: 0 0 16px;
    }

    #markdown-output ul, ol {
      padding-left: 2em;
      margin: 0 0 16px;
    }

    #markdown-output code {
      background-color: rgba(27, 31, 35, 0.05);
      padding: 0.2em 0.4em;
      border-radius: 3px;
    }

    #markdown-output pre {
      background-color: #f6f8fa;
      border: 1px solid #e1e4e8;
      border-radius: 6px;
      padding: 16px;
      overflow: auto;
    }
  </style>
</head>
<body>
  <div class="editor-container">
    <!-- Кнопки управления -->
    <div class="controls">
      <button onclick="saveMarkdown()">Сохранить как .md</button>
    </div>

    <!-- Вкладки -->
    <div class="tabs">
      <button class="tab-active" onclick="showTab('edit')">Edit</button>
      <button onclick="showTab('preview')">Preview</button>
    </div>

    <!-- Редактор -->
    <div id="edit-panel" class="panel">
      <textarea id="markdown-input" placeholder="Введите Markdown..."></textarea>
    </div>

    <!-- Превью -->
    <div id="preview-panel" class="panel">
      <div id="markdown-output"></div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
  // Элементы
  const editPanel = document.getElementById('edit-panel');
  const previewPanel = document.getElementById('preview-panel');
  const markdownInput = document.getElementById('markdown-input');
  const markdownOutput = document.getElementById('markdown-output');

  // Переключение вкладок
  function showTab(tabName) {
    if (tabName === 'edit') {
      editPanel.style.display = 'flex';
      previewPanel.style.display = 'none';
      document.querySelector('.tabs button:nth-child(1)').classList.add('tab-active');
      document.querySelector('.tabs button:nth-child(2)').classList.remove('tab-active');
    } else {
      editPanel.style.display = 'none';
      previewPanel.style.display = 'block';
      document.querySelector('.tabs button:nth-child(1)').classList.remove('tab-active');
      document.querySelector('.tabs button:nth-child(2)').classList.add('tab-active');
      renderMarkdown();
    }
  }

  // Рендеринг Markdown в HTML
  function renderMarkdown() {
    const markdownText = markdownInput.value;
    markdownOutput.innerHTML = marked.parse(markdownText);
  }

  // Авто-рендеринг при вводе (только если открыта вкладка Preview)
  markdownInput.addEventListener('input', () => {
    if (document.querySelector('.tab-active').textContent === 'Preview') {
      renderMarkdown();
    }
  });

  // Функция сохранения Markdown-файла
  function saveMarkdown() {
    const markdownText = markdownInput.value;

    // Проверка на пустой текст
    if (!markdownText) {
      alert('Нет текста для сохранения!');
      return;
    }

    // Создаём Blob с содержимым
    const blob = new Blob([markdownText], { type: 'text/markdown' });

    // Создаём ссылку для скачивания
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'document.md'; // Имя файла по умолчанию

    // Добавляем ссылку в документ и запускаем скачивание
    document.body.appendChild(link);
    link.click();

    // Очищаем ресурсы
    document.body.removeChild(link);
    URL.revokeObjectURL(link.href);
  }

  // Инициализация: открываем вкладку Edit при загрузке
  showTab('edit');
</script>
</body>
</html>
```



---

### Что делает код

1. **Переключение вкладок** (`showTab`):
   - При выборе *Edit* показывает текстовое поле, скрывает превью.
   - При выборе *Preview* скрывает редактор, показывает отрендеренный Markdown.
2. **Рендеринг Markdown** (`renderMarkdown`):
   - Преобразует текст из `textarea` в HTML через библиотеку `marked`.
   - Вставляет результат в `#markdown-output`.
3. **Авто-обновление превью**:
   - При вводе текста в редакторе автоматически обновляет превью, если открыта вкладка *Preview*.
4. **Сохранение файла** (`saveMarkdown`):
   - Проверяет, есть ли текст для сохранения.
   - Создаёт файл `document.md` с текущим содержимым.
   - Предлагает скачать через браузерный диалог.
5. **Инициализация**:
   - При загрузке страницы автоматически открывает вкладку *Edit*.

### Теперь наш редактор:

- переключает вкладки *Edit/Preview*;
- автоматически отображает Markdown в превью;
- позволяет сохранить текст в файл `.md` одним кликом.



---

---

---

