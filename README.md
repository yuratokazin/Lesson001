Начни программировать С нуля.
https://itcodik.com/

# Шаг1. 

## Создаем репозиторий **Lesson001** 

Чтобы создать дополнительные репозитории в вашем GitHub аккаунте, следуйте этим шагам:

## Создание нового репозитория

1. **Войдите в GitHub** и перейдите на главную страницу
2. **Нажмите кнопку "+"** в правом верхнем углу
3. **Выберите "New repository"**

## Заполнение информации о репозитории

- **Repository name**: Укажите название репозитория

- **Description**: Добавьте описание (опционально)

- Visibility

  : Выберите:

  - **Public** - виден всем
  - **Private** - только вам и выбранным пользователям

## Дополнительные настройки

- **Initialize with a README** - создаст README файл
- **Add .gitignore** - выберите шаблон для игнорирования файлов
- **Choose a license** - выберите лицензию для проекта

## После создания

После нажатия "Create repository" вы сможете:

- Клонировать репозиторий на локальную машину
- Добавлять файлы и код
- Делать коммиты и пушить изменения

## Альтернативные способы

### Через командную строку

```
# Создать новую папку и инициализировать git
mkdir new-repo
cd new-repo
git init

# Добавить файлы
echo "# Новый проект" > README.md
git add .
git commit -m "Initial commit"

# Добавить удаленный репозиторий
git remote add origin https://github.com/yuratokazin/new-repo.git
git push -u origin main
```

### Через GitHub CLI

```
gh repo create new-repo --public --description "Описание репозитория"
```

Вы можете создавать неограниченное количество публичных репозиториев в своем аккаунте!

------

------

‎как добавить файлы в этот репозиторий‎

Чтобы добавить свои файлы в репозиторий https://github.com/yuratokazin, вам нужно иметь права на запись в этот репозиторий.

Если у вас есть такие права, вот пошаговая инструкция: Способ 1: Через веб-интерфейс GitHub

```
Перейдите на страницу репозитория: https://github.com/yuratokazin

Нажмите "Add file" → "Upload files"

Перетащите файлы или выберите их через диалоговое окно

Добавьте описание коммита (сообщение о изменениях)

Нажмите "Commit changes
```

Чтобы удалить файлы или папки из репозитория на GitHub, у вас есть несколько способов:

# Шаг 2. 

## Клонирование репозитория на ПК

```
user@debian:~$ git clone https://github.com/yuratokazin/Lesson001.git
Клонирование в «Lesson001»...
remote: Enumerating objects: 3, done.
remote: Counting objects: 100% (3/3), done.
remote: Total 3 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
Получение объектов: 100% (3/3), готово.

```



# Шаг 3. 

Заходим в склонированную папку смотри в Дельфине, и переносим в эту папку наши файлы с Рабочего стола

# Шаг 4.

Переносим содержимое папки Lesson001 с ПК на Гитхаб

### Вывод с консоли:

```
user@debian:~/Lesson001-$ ls
index.html  jscript.js  style.css
user@debian:~/Lesson001-$ git status
Текущая ветка: main
Эта ветка соответствует «origin/main».

Изменения, которые не в индексе для коммита:
  (используйте «git add/rm <файл>...», чтобы добавить или удалить файл из индекса)
  (используйте «git restore <файл>...», чтобы отменить изменения в рабочем каталоге)
        удалено:       1

Неотслеживаемые файлы:
  (используйте «git add <файл>...», чтобы добавить в то, что будет включено в коммит)
        index.html
        jscript.js
        style.css

индекс пуст (используйте «git add» и/или «git commit -a»)
user@debian:~/Lesson001-$ git add 
Ничего не проиндексировано.
подсказка: Возможно вы хотели сделать «git add .»?
подсказка: Можно отключить это сообщение командой
подсказка: «git config advice.addEmptyPathspec false»
user@debian:~/Lesson001-$ git add .
user@debian:~/Lesson001-$ git add index.html jscript.js style.css
user@debian:~/Lesson001-$ git status
Текущая ветка: main
Эта ветка соответствует «origin/main».

Изменения, которые будут включены в коммит:
  (используйте «git restore --staged <файл>...», чтобы убрать из индекса)
        удалено:       1
        новый файл:    index.html
        новый файл:    jscript.js
        новый файл:    style.css

user@debian:~/Lesson001-$ git commit -m "Добавлены файлы HTML, CSS и JavaScript"
Author identity unknown

*** Пожалуйста, скажите мне кто вы есть.

Запустите

  git config --global user.email "you@example.com"
  git config --global user.name "Ваше Имя"

для указания идентификационных данных аккаунта по умолчанию.
Пропустите параметр --global для указания данных только для этого репозитория.

fatal: не удалось выполнить автоопределение адреса электронной почты (получено «user@debian.(none)»)
user@debian:~/Lesson001-$ git config --global user.email "yuratokazin@gmail.com"
user@debian:~/Lesson001-$ git config --global user.name "Юрий Викторович"
user@debian:~/Lesson001-$ git commit -m "Добавлены файлы HTML, CSS и JavaScript"
[main 233b801] Добавлены файлы HTML, CSS и JavaScript
 4 files changed, 401 insertions(+), 1 deletion(-)
 delete mode 100644 1
 create mode 100755 index.html
 create mode 100755 jscript.js
 create mode 100755 style.css
user@debian:~/Lesson001-$ git push origin main
Username for 'https://github.com': yuratokazin
Password for 'https://yuratokazin@github.com': 
remote: Invalid username or token. Password authentication is not supported for Git operations.
fatal: Authentication failed for 'https://github.com/yuratokazin/Lesson001-.git/'
user@debian:~/Lesson001-$ 
```



*В дальнейшем нужно учесть следующее:*

> Нужно вспомнить пароль гитхаба, у каждой группы должен быть свой логин на дебиян
> 

---

---

---

Чтобы удалить репозиторий на GitHub, выполните следующие шаги:

## Шаги для удаления репозитория

1. **Войдите в GitHub** и перейдите в ваш профиль
2. **Перейдите в репозиторий**, который хотите удалить
3. **Откройте вкладку "Settings"** - она находится в правой части меню репозитория

4. **Прокрутите вниз** до раздела "Danger Zone" (Зона опасности)

5. **Нажмите "Delete this repository"**

6. **Подтвердите удаление**:
   - Введите название репозитория для подтверждения
   - Нажмите "I understand the consequences, delete this repository"

## Важные предупреждения!

⚠️ **Удаление необратимо!** После удаления:
- Весь код, issues, pull requests будут безвозвратно удалены
- Восстановить репозиторий будет невозможно
- Форки этого репозитория у других пользователей останутся

## Рекомендации перед удалением

Перед удалением рекомендуется:
- **Сделать локальную копию** если нужен код
- **Экспортировать issues/wikis** если они важны
- **Убедиться**, что репозиторий не используется в проектах

## Альтернативные варианты

Если не хотите полностью удалять:
- **Сделать приватным** - скрыть от других пользователей
- **Архивировать** - пометить как read-only
- **Переименовать** - если нужно изменить название

## Удаление через GitHub CLI

```bash
gh repo delete owner/repo-name
```

Будьте осторожны при удалении репозиториев!
