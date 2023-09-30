FROM php:8.3.0RC3-zts-bookworm
COPY . /usr/src/app
WORKDIR /usr/src/app
CMD [ "php", "index.php" ]
