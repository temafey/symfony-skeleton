FROM temafey/alpine-php:7.2-dev as builder

WORKDIR /app

ENV APP_ENV prod
ENV APP_SECRET default-secret
ENV APP_DEBUG 0
ENV RABBITMQ_URL amqp://guest:guest@rmq:5672

COPY bin /app/bin
COPY config /app/config
COPY src /app/src
COPY public /app/public
COPY var /app/var
COPY composer.json /app
COPY composer.lock /app
COPY symfony.lock /app

RUN composer install --no-ansi --no-dev --no-interaction --no-progress --optimize-autoloader && php /app/bin/console c:w

FROM temafey/alpine-php:7.2

ENV APP_ENV prod

WORKDIR /app

COPY --from=builder /app /app
