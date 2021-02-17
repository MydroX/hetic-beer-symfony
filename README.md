# Backend project HETIC

## Group
- Wilem DJENNANE
- Jacky SHAO
- Yeonsoo KANG
- Maxime ZINUTTI

##Command docker

Those command has to be executed at the root of the project.

- Start with build
````bash
docker-compose -f docker/docker-compose.yml up --build
````

- Start (without deamon)
````bash
docker-compose -f docker/docker-compose.yml up 
````

- Start (with deamon)
````bash
docker-compose -f docker/docker-compose.yml up -d
````

- Stop containers
````bash
docker-compose -f docker/docker-compose.yml stop
````

- Stop and remove containers
````bash
docker-compose -f docker/docker-compose.yml down
````

- Access to php container with bash
````bash
docker exec -ti app-api bash
````