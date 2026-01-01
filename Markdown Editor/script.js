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
