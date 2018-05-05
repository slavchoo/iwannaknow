# iwannaknow
Your GitHub routine summary to Slack.

## Docker

### Run project locally

Install docker to your local env. 

Run in terminal:

```bash
docker-compose up -d
```

### Stop all containers

```bash
docker rm $(docker ps -aq)
```

### Log in into the php-fpm container shell

```bash
docker-compose exec php-fpm bash
```

## Tools

### Buld assets locally (via Webpach Encore)

```bash 
docker-compose exec php-fpm bash

# then inside the container
yarn dev
```


## Heroku


### In order to force yarn work on heroku

heroku buildpacks:add --index 1 --app iwannaknow https://github.com/deviantbits/heroku-buildpack-multiple-apps
