# Развертывание

Для работы проекта необходим `docker`.

`make start` - развертывание окружения в режиме продакшена

`make node-install` - выполнение `npm install` и `bower install`

`make shell` или  - для входа в PHP-Cli проекта

`make shell-node` - для входа в node-cli

`make scheduler-run` - запуск планировщика в контейнере

и много еще чего полезного можно найти в `Makefile`

После изменений в конфиге nginx выполнить `make stop && docker-compose build nginx && make start`

Для разварачивания проекта первый раз необходимо выполнить
`make start && make shell`

#### Настройка nginx для доступа к сайту по нормальному имени
```
server {
    server_name billboards;
    listen 80;

    location / {
        proxy_pass              http://localhost:59080;
        proxy_set_header Host   billboards.loc;
    }
}
```

### Настройка дебаг сессии
PhpStorm перейдите во вкладку Language & frameworks -> php -> servers
Для localhost настройки mapping. app/app -> app/htdocs/

### Пример запуска задач из очереди по крону
```*  *  *  *  *       cd /home/deploy/billboards && /usr/bin/make scheduler-run >> /dev/null 2>&1```
