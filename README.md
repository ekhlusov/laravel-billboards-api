# Развертывание

Для работы проекта необходим `docker`.

`make start` - развертывание окружения в режиме продакшена

`make start-dev` - развертывание окружения в режиме dev

`make node-install` - выполнение `npm install` и `bower install`

`make shell` или `make shell-dev` - для входа в PHP-Cli проекта

`make shell-node` - для входа в node-cli

`make scheduler-run-dev` - запуск планировщика в dev контейнере

`make scheduler-run` - запуск планировщика в контейнере

и много еще чего полезного можно найти в `Makefile`

После изменений в конфиге nginx выполнить `make stop && docker-compose build nginx-dev && make start-dev`

Для разварачивания проекта первый раз необходимо выполнить
`make start && make shell`
`composer install && php artisan migrate:refresh --seed`

#### !!! Внимание !!! При запуске подключение к консоли происходит не сразу.  Возможно через 1-2 минуты
#### При входе в консоль контейнера разверните окно терминала иначе возможны проблемы со входом

#### Настройка nginx для доступа к сайту по нормальному имени
```
server {
    server_name notification-service;
    listen 80;

    location / {
        proxy_pass              http://localhost:55080;
        proxy_set_header Host   onlinedemo.dev;
    }
}
```

###Настройка дебаг сессии
PhpStorm перейдите во вкладку Language & frameworks -> php -> servers
Для localhost настройки mapping. app/app -> app/htdocs/

###Запуск задач из очереди по крону
*  *  *  *  *       cd /home/deploy/notification-service && /usr/bin/make scheduler-run >> /dev/null 2>&1
# My project's README
