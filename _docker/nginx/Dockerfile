FROM nginx:alpine

# Удаляем дефолтную конфигурацию
RUN rm /etc/nginx/conf.d/default.conf

# Копируем нашу конфигурацию
COPY _docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

EXPOSE 80
