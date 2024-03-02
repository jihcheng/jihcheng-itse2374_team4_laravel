# Dockerfile
FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev
cmd composer install


WORKDIR /app
COPY . /app


EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000

