FROM laravelsail/php83-composer:latest
RUN apt-get update && apt-get install -y nodejs npm
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
RUN cp .env.example .env && php artisan key:generate
EXPOSE 8000
CMD ["sh", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
