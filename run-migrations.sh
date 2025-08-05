#!/bin/bash

echo "=== Chạy Migrations và Seeders ==="

# Vào thư mục Sage theme
cd wordpress/wp-content/themes/sage

# Tạo thư mục config nếu chưa có
mkdir -p config

# Tạo file config database đơn giản
echo "Tạo file config database..."
cat > config/database.php << 'EOF'
<?php

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'db',
            'port' => '3306',
            'database' => 'wordpress',
            'username' => 'wordpress',
            'password' => 'wordpress',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ],
];
EOF

echo "=== Hoàn thành setup database ==="
echo "Bây giờ bạn cần:"
echo "1. Truy cập WordPress admin: http://localhost:8000/wp-admin"
echo "2. Kích hoạt Sage theme"
echo "3. Chạy migrations và seeders thông qua WordPress admin" 