FROM composer:2.2.6 as vendor

WORKDIR /tmp/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --prefer-dist
    

FROM php:7.4-cli

WORKDIR /
COPY . /usr/share/divido/src/

COPY --from=vendor /tmp/vendor/ /usr/share/divido/src/vendor/

WORKDIR /usr/share/divido/src/
CMD ["./vendor/bin/phpunit", "--testdox", "tests"]

