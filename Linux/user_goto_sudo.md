## Добавьте пользователя user в группу sudo

````
user@debian:~$ sudo nano /etc/apt/sources.list
[sudo] пароль для user:
user is not in the sudoers file.
````

Вы столкнулись с ошибкой: пользователь user не имеет прав sudo, поэтому не может редактировать системные файлы (в частности, /etc/apt/sources.list).

#### Как решить проблему

Добавить пользователя в группу sudo (требуется доступ к root)

Если у вас есть пароль root:

Войдите как root (su -).

Добавьте пользователя user в группу sudo:

    usermod -aG sudo user

Выйдите из root (exit) и заново войдите в систему (или перезапустите сеанс).

Теперь команда sudo должна работать.

#### Синтаксис sources.list.

При редактировании следите за правильностью строк (пример для Debian 12 Bookworm):

    #deb cdrom:[Debian GNU/Linux 12.7.0 _Bookworm_ - Official amd64 DVD Binary-1 with firmware 20240831-10:40]/ bookworm main
    
    deb http://deb.debian.org/debian bookworm main contrib non-free
    deb-src http://deb.debian.org/debian bookworm main contrib non-free
    
    Для постоянного использования репозиториев лучше подключить сетевые источники (например, deb https://deb.debian.org/debian bookworm main).

#### Проверка после правки

Обновите список пакетов:

    sudo apt update

Убедитесь, что ошибок нет.



---



### Автоматический вход в KDE Plasma на Debian 12

Чтобы настроить автоматический вход в KDE Plasma на Debian 12 без ввода  пароля, необходимо изменить настройки дисплейного менеджера SDDM. 

Вот  пошаговая инструкция:

**Откройте терминал** и выполните команду для редактирования конфигурационного файла SDDM:

```bash
sudo nano /etc/sddm.conf.d/kde_settings.conf
```

Если папка `/etc/sddm.conf.d/` не существует, создайте её командой:

```bash
sudo mkdir -p /etc/sddm.conf.d/
```

**Добавьте в файл следующие строки**:

```ini
[Autologin]
Session=plasma
User=ваше_имя_пользователя
```

Замените `ваше_имя_пользователя` на фактическое имя вашего пользователя. Параметр `Session` можно оставить как `plasma` для KDE Plasma, но если требуется другая сессия, узнайте её название командой `echo



---



### Запретить блокировку экрана и переход в ждущий режим

````
sudo nano ~/.config/kscreenlockerrc
````

Содержание файла                           

````
[$Version]
update_info=kscreenlocker.upd:0.1-autolock

[Daemon]
LockOnResume=false
Timeout=false
````

как можно его изменить чтобы он запретил блокировку экрана и переход в ждущий режим

Чтобы **полностью отключить блокировку экрана** в KDE Plasma через файл `kscreenlockerrc`, нужно изменить параметр `Timeout`. Для **отключения перехода в ждущий режим** потребуются дополнительные настройки вне этого файла.

### Изменение kscreenlockerrc (отключение блокировки экрана)

Откройте файл в текстовом редакторе:

```bash
sudo nano ~/.config/kscreenlockerrc
```

Измените значение `Timeout` на `0` (отключает таймаут):

```ini
[$Version]
update_info=kscreenlocker.upd:0.1-autolock

[Daemon]
Autolock=false
LockOnResume=false
```

**Объяснение параметров:**

- `Timeout=0` — полностью отключает автоматическую блокировку экрана по таймеру;
- `LockOnResume=false` — уже стоит верное значение (экран не блокируется после выхода из сна).

После сохранения файла:

1. Перезапустите сеанс (выйдите и войдите в учётную запись) **или**
2. Примените изменения командой:

```bash
qdbus org.kde.ksmserver /KSMServer reconfigure
```



### Отключение перехода в ждущий режим (сна)

Файл `kscreenlockerrc` **не управляет** переходом в ждущий режим. Для этого нужны отдельные настройки.

#### Вариант 1. Через системные настройки (GUI)

1. Откройте **«Системные настройки»** → **«Энергосбережение»**.
2. В разделе **«Спящий режим»**:
   - Установите **«Никогда»** для «Переход в спящий режим при бездействии»;
   - Отключите «Автоматически переходить в спящий режим».
3. В разделе **«Экран»**:
   - Установите **«Никогда»** для отключения экрана.
4. Нажмите **«Применить»**.

#### Вариант 2. Через конфигурационные файлы

**1. Отключение сна через systemd**
Создайте файл:

```bash
sudo nano /etc/systemd/sleep.conf.d/disable-suspend.conf
```

Если папка `/etc/sddm.conf.d/` не существует, создайте её командой:

```bash
sudo mkdir -p /etc/sddm.conf.d/
```

Добавьте:

```ini
[Sleep]
AllowSuspend=no
AllowHibernation=no
AllowSuspendThenHibernate=no
AllowHybridSleep=no
```

Перезапустите сервис:

```bash
sudo systemctl restart systemd-logind.service
```

**2. Отключение реакции на закрытие крышки**
Отредактируйте:

```bash
sudo nano /etc/systemd/logind.conf
```

Добавьте/измените:

```ini
HandleLidSwitch=ignore
HandleLidSwitchDocked=ignore
```

Перезапустите сервис:

```bash
sudo systemctl restart systemd-logind.service
```

### Проверка текущих настроек

Убедитесь, что блокировка отключена:

```bash
cat ~/.config/kscreenlockerrc | grep Timeout
# Должно вывести: Timeout=0
```

Проверьте статус сна:

```bash
systemctl status sleep.target
```

### Итоговые действия

1. Измените `Timeout=0` в `kscreenlockerrc`.
2. Настройте энергосбережение через GUI **или** отредактируйте файлы systemd.
3. Перезапустите сеанс или соответствующие сервисы.
4. Проверьте, что экран не блокируется и система не уходит в сон.



Ссылка на мой репозиторий:

https://github.com/yuratokazin
