#!/bin/bash

echo "=== Cài đặt Sage Theme (Thông minh) ==="

# Kiểm tra xem Sage theme đã tồn tại chưa
if [ -d "wordpress/wp-content/themes/sage" ]; then
    echo "✅ Sage theme đã tồn tại, chỉ cài dependencies..."
    
    # Cài đặt PHP dependencies (Composer)
    echo "📦 Cài đặt PHP dependencies..."
    docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage composer:latest composer install
    
    # Cài đặt Node.js dependencies
    echo "📦 Cài đặt Node.js dependencies..."
    docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage node:18 npm install
    
    echo "=== Hoàn thành cài đặt Dependencies ==="
    echo "Bây giờ có thể build assets: ./build-assets.sh"
    
else
    echo "🆕 Sage theme chưa tồn tại, cài đặt mới..."
    
    # Tạo container tạm thời với Composer
    echo "Cài đặt Sage theme bằng Docker..."
    docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html composer:latest composer create-project roots/sage wp-content/themes/sage
    
    # Cài đặt dependencies cho Sage theme
    echo "Cài đặt dependencies cho Sage theme..."
    docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage composer:latest composer install
    
    # Cài đặt Node.js dependencies
    echo "Cài đặt Node.js dependencies..."
    docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage node:18 npm install
    
    echo "=== Hoàn thành cài đặt Sage Theme ==="
    echo "Truy cập WordPress admin để kích hoạt theme: /wp-admin"
fi