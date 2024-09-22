#!/bin/bash

chown www-data:www-data -R /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
RUN composer install -n
RUN php artisan migrate
RUN php artisan db:seed --class=RolesSeeder
exec "$@"
