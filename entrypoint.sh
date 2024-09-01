#!/bin/bash

chown www-data:www-data -R /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

exec "$@"
