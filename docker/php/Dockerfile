FROM php:7.3-fpm

ARG JWT_PASSPHRASE=s3cr3t
ARG JWT_SECRET_KEY=/var/jwt/private.pem
ARG JWT_PUBLIC_KEY=/var/jwt/public.pem

RUN docker-php-ext-install pdo_mysql

RUN mkdir -p /var/jwt && \
    openssl genpkey -out $JWT_SECRET_KEY -aes256 -pass pass:$JWT_PASSPHRASE -algorithm rsa -pkeyopt rsa_keygen_bits:4096 && \
    openssl pkey -in $JWT_SECRET_KEY -out $JWT_PUBLIC_KEY -passin pass:$JWT_PASSPHRASE -pubout && \
    chown www-data:www-data $JWT_SECRET_KEY $JWT_PUBLIC_KEY && \
    chmod 600 $JWT_SECRET_KEY $JWT_PUBLIC_KEY