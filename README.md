### Установка в Docker

1. Подготовить файл *.env*

    ```sh
    make env-prepare
    ```

2. Указать параметры подключения к БД в файле *.env*

    ```dotenv
    DB_CONNECTION=
    DB_HOST=database
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```

3. Собрать и запустить приложение

    ```sh
    make up # собрать проект в docker-контейнере
    make start # запустить приложение dashboard: http://localhost:8888/public/, api: http://localhost:8888/public/api/news/{service}
    make down # остановить docker-контейнер
    make compose-bash  # запустить сессию bash в docker-контейнере
    ```
