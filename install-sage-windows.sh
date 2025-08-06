#!/bin/bash

# Xử lý Ctrl+C để thoát script an toàn
trap 'echo -e "\n\n❌ Script bị dừng bởi người dùng (Ctrl+C)"; exit 1' INT

echo "=== Cài đặt Sage Theme (Windows Git Bash) ==="
echo "💡 Nhấn Ctrl+C để thoát bất cứ lúc nào"

# Lấy đường dẫn hiện tại
CURRENT_DIR=$(pwd)
echo "📍 Đường dẫn hiện tại: ${CURRENT_DIR}"

# Chuyển đổi đường dẫn Git Bash sang Windows path cho Docker
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "cygwin" ]]; then
    # Windows Git Bash: chuyển /e/Project/testsage thành E:/Project/testsage
    CURRENT_DIR=$(echo "$CURRENT_DIR" | sed 's|^/\([a-z]\)/|\1:/|i')
    echo "🔧 Đã chuyển đổi đường dẫn cho Windows: ${CURRENT_DIR}"
fi

# Kiểm tra xem Sage theme đã tồn tại chưa
if [ -d "wordpress/wp-content/themes/sage" ]; then
    echo "✅ Sage theme đã tồn tại, chỉ cài dependencies..."
    
    # Cài đặt PHP dependencies (Composer)
    echo "📦 Cài đặt PHP dependencies..."
    docker run --rm -v "${CURRENT_DIR}/wordpress:/var/www/html" -w "/var/www/html/wp-content/themes/sage" composer:latest composer install
    
    # Cài đặt Node.js dependencies
    echo "📦 Cài đặt Node.js dependencies..."
    docker run --rm -v "${CURRENT_DIR}/wordpress:/var/www/html" -w "/var/www/html/wp-content/themes/sage" node:18 npm install
    
    echo "=== Hoàn thành cài đặt Dependencies ==="
    echo "Bây giờ có thể build assets: ./build-assets.sh"
    
else
    echo "🆕 Sage theme chưa tồn tại, cài đặt mới..."
    
    # Tạo container tạm thời với Composer
    echo "Cài đặt Sage theme bằng Docker..."
    docker run --rm -v "${CURRENT_DIR}/wordpress:/var/www/html" -w "/var/www/html" composer:latest composer create-project roots/sage wp-content/themes/sage
    
    # Cài đặt dependencies cho Sage theme
    echo "Cài đặt dependencies cho Sage theme..."
    docker run --rm -v "${CURRENT_DIR}/wordpress:/var/www/html" -w "/var/www/html/wp-content/themes/sage" composer:latest composer install
    
    # Cài đặt Node.js dependencies
    echo "Cài đặt Node.js dependencies..."
    docker run --rm -v "${CURRENT_DIR}/wordpress:/var/www/html" -w "/var/www/html/wp-content/themes/sage" node:18 npm install
    
    echo "=== Hoàn thành cài đặt Sage Theme ==="
    echo "Truy cập WordPress admin để kích hoạt theme: /wp-admin"
fi

# Giữ terminal mở sau khi hoàn thành
echo ""
echo "🎉 Script đã hoàn thành!"
echo "💡 Nhấn Enter để đóng terminal..."
read -p "" 