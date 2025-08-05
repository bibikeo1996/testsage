#!/bin/bash

echo "=== Cài đặt Sage Theme ==="

# Sử dụng Docker container để cài đặt Sage
echo "Cài đặt Sage theme bằng Docker..."

# Tạo container tạm thời với Composer
docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html composer:latest composer create-project roots/sage wp-content/themes/sage

# Cài đặt dependencies cho Sage theme
echo "Cài đặt dependencies cho Sage theme..."
docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage composer:latest composer install

# Cài đặt Node.js dependencies
echo "Cài đặt Node.js dependencies..."
docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage node:18 npm install

echo "=== Hoàn thành cài đặt Sage Theme ==="
echo "Truy cập WordPress admin để kích hoạt theme: http://localhost:8000/wp-admin" 