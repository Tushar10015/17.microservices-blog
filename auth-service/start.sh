#!/bin/bash

echo "⏳ Waiting for MySQL at $DB_HOST:$DB_PORT..."

# Wait for DB connection using PHP
until php -r "
    try {
        new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    } catch (PDOException \$e) {
        exit(1);
    }
"
do
    echo "❌ MySQL not ready yet. Retrying in 5s..."
    sleep 5
done

echo "Database is ready! Running migrations..."
php artisan migrate --seed

echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=80
