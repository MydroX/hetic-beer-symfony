# Docker Symfony 5 with Nginx - PHP 8.0.2 - MySQL 8.0.23

## Install

Place the folder in at the root of your project preferably otherwise you should have to modify the followings commands and some config files

## Commands

- Build

```bash
docker-compose -f ./docker/docker-compose.yml build
```

- Build & Up

```bash
docker-compose -f ./docker/docker-compose.yml up --build
```

- Down

```bash
docker-compose -f ./docker/docker-compose.yml down
```