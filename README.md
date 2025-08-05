# WordPress Sports Website với Sage Theme

Dự án WordPress sử dụng Sage theme để hiển thị dữ liệu thể thao.

## Yêu cầu hệ thống
- Docker Desktop
- Docker Compose
- PHP >= 8.2

## Quick Start

### 1. Khởi động Docker & Containers
```bash
# Khởi động Docker Desktop
open -a Docker

# Khởi động containers
docker-compose up -d

# Kiểm tra containers
docker-compose ps
```

### 2. Cài đặt Sage Theme
```bash
# Script thông minh: tự động kiểm tra nếu theme có sẵn thì chỉ cài dependencies
./install-sage.sh
```

### 3. Thiết lập Database
```bash
# Copy và chạy script tạo database
docker cp setup-database.php wordpress_wordpress_1:/var/www/html/setup-database.php
docker exec wordpress_wordpress_1 php /var/www/html/setup-database.php
```

### 4. Build Assets
```bash
# Build CSS, JS cho Sage theme
./build-assets.sh
```

### 5. Truy cập Website
- **Website**: http://localhost:8000
- **Admin**: http://localhost:8000/wp-admin
- **phpMyAdmin**: http://localhost:8081 (wordpress/wordpress)

## Development Commands

### Docker Commands
```bash
# Khởi động
docker-compose up -d

# Dừng
docker-compose down

# Dừng và xóa data
docker-compose down -v

# Xem logs
docker-compose logs wordpress
docker-compose logs db

# Rebuild containers
docker-compose up -d --build
```

### Asset Commands
```bash
# Build assets
./build-assets.sh

# Watch mode (development)
docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage node:18 npm run dev
```

### Database Commands
```bash
# Vào MySQL container
docker-compose exec db mysql -u wordpress -p wordpress

# Backup database
docker-compose exec db mysqldump -u wordpress -p wordpress > backup.sql

# Restore database
docker-compose exec -T db mysql -u wordpress -p wordpress < backup.sql
```

## Troubleshooting

### Port Conflicts
```bash
# Kiểm tra ports
lsof -i :8000
lsof -i :8081
lsof -i :3306

# Đổi ports trong docker-compose.yml nếu cần
```

### Common Issues
```bash
# Lỗi Vite manifest not found
./build-assets.sh

# Lỗi Composer autoloader
./install-sage.sh

# Lỗi phpMyAdmin connection
docker-compose restart
```

## Cấu trúc dự án
- `wordpress/` - Thư mục WordPress
- `docker-compose.yml` - Cấu hình Docker
- `install-sage.sh` - Script cài đặt Sage theme
- `build-assets.sh` - Script build assets
- `setup-database.php` - Script tạo database và sample data