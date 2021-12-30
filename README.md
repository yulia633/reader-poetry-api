### Poetry Api 📖 Wrapper (PoetryDB is an API for internet poets.)

[PoetryDB](https://poetrydb.org/index.html) это первый в мире API для интернет-поэтов следующего поколения.

### Установка в Docker

1. Подготовить файл *.env*

    ```sh
    make env-prepare
    ```

2. Указать параметры подключения к REDIS в файле *.env*

    ```dotenv
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379
   REDIS_PASSWORD=
    ```

3. Собрать и запустить приложение

    ```sh
    make up # собрать проект в docker-контейнере
    make start # запустить приложение dashboard: http://localhost:8888/public/, api: http://localhost:8888/public/api/texts/{service},  где {service} poetry
    make down # остановить docker-контейнер
    make compose-bash  # запустить сессию bash в docker-контейнере
    docker exec -it redis redis-cli # открыть новую сессию и интерфейс командной строки redis в docker-контейнере
    ```

### To-do

- [ ] GitHub Actions
- [ ] Tests
- [ ] Code Sniffer
- [ ] Pagination
- [x] Redis
- [ ] New Service
- [x] Front dashboard
