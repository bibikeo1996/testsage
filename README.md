# WordPress Sports Website với Sage Theme

Dự án WordPress sử dụng Sage theme để hiển thị dữ liệu thể thao.

## Yêu cầu hệ thống
- Docker Desktop
- Docker Compose
- Git

## Kiểm tra hệ thống trước khi cài đặt

### Bước 1: Kiểm tra Docker
```bash
# Kiểm tra Docker đã cài chưa
docker --version
docker-compose --version

# Nếu chưa cài Docker Desktop:
# macOS: https://docs.docker.com/desktop/install/mac-install/
# Windows: https://docs.docker.com/desktop/install/windows-install/
# Linux: https://docs.docker.com/desktop/install/linux-install/
```

### Bước 2: Kiểm tra Git
```bash
# Kiểm tra Git
git --version

# Nếu chưa cài:
# macOS: brew install git
# Windows: https://git-scm.com/download/win
# Linux: sudo apt-get install git
```

### Bước 3: Kiểm tra ports
```bash
# Kiểm tra ports có đang được sử dụng không
lsof -i :8000  # WordPress
lsof -i :8081  # phpMyAdmin
lsof -i :3306  # MySQL

# Nếu ports bị chiếm, dừng services hoặc đổi ports trong docker-compose.yml
```

## Quick Start

### Bước 1: Clone và chuẩn bị
```bash
# Clone project
git clone [repository-url]
cd [project-folder]

# Kiểm tra cấu trúc project
ls -la
# Phải có: docker-compose.yml, install-sage.sh, build-assets.sh, setup-database.php
```

### Bước 2: Khởi chạy Docker & Containers
```bash
# Khởi động Docker Desktop
open -a Docker  # macOS
# Hoặc mở Docker Desktop từ menu

# Đợi Docker khởi động xong (icon Docker màu xanh)
# Kiểm tra Docker đã sẵn sàng
docker info

# Khởi động containers
docker-compose up -d

# Kiểm tra containers đã chạy
docker-compose ps
# Phải thấy: wordpress_wordpress_1, wordpress_db_1, wordpress_phpmyadmin_1
```

### Bước 3: Cài đặt Sage Theme
```bash
# Script thông minh: tự động kiểm tra nếu theme có sẵn thì chỉ cài dependencies
./install-sage.sh

# Kiểm tra theme đã được tạo
ls -la wordpress/wp-content/themes/
# Phải thấy thư mục sage/
```

### Bước 4: Thiết lập Database
```bash
# Copy script vào container
docker cp setup-database.php wordpress_wordpress_1:/var/www/html/setup-database.php

# Chạy script tạo database
docker exec wordpress_wordpress_1 php /var/www/html/setup-database.php

# Kiểm tra database đã được tạo
# Truy cập phpMyAdmin: http://localhost:8081
# Login: wordpress/wordpress
# Kiểm tra các bảng: countries, competitions, teams, matches
```

### Bước 5: Build Assets
```bash
# Build CSS, JS cho Sage theme
./build-assets.sh

# Kiểm tra assets đã được build
ls -la wordpress/wp-content/themes/sage/public/build/
# Phải thấy: manifest.json, app.css, app.js
```

### Bước 6: Cài đặt WordPress
```bash
# Truy cập: http://localhost:8000
# Làm theo hướng dẫn cài đặt WordPress:
# - Site Title: Sports Website
# - Username: admin
# - Password: [tạo password mạnh]
# - Email: [email của bạn]

# Sau khi cài xong, vào Admin: http://localhost:8000/wp-admin
# Appearance > Themes > Activate Sage theme
```

### Bước 7: Truy cập Website
- **Website**: http://localhost:8000
- **Admin**: http://localhost:8000/wp-admin
- **phpMyAdmin**: http://localhost:8081 (wordpress/wordpress)

## Development Commands

### Khởi động/Dừng
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
```

### Rebuild Assets
```bash
# Khi thay đổi CSS/JS
./build-assets.sh

# Hoặc watch mode (development)
docker run --rm -v "$(pwd)/wordpress:/var/www/html" -w /var/www/html/wp-content/themes/sage node:18 npm run dev
```

### Troubleshooting

#### Lỗi ports bị chiếm:
```bash
# Kiểm tra ports
lsof -i :8000
lsof -i :8081
lsof -i :3306

# Dừng services đang chiếm ports
sudo lsof -ti:8000 | xargs kill -9

# Hoặc đổi ports trong docker-compose.yml
```

#### Lỗi phpMyAdmin không kết nối được MySQL:
```bash
# Kiểm tra MySQL container
docker-compose logs db

# Restart containers
docker-compose restart

# Hoặc rebuild
docker-compose down
docker-compose up -d --build
```

#### Lỗi Vite manifest not found:
```bash
# Build lại assets
./build-assets.sh

# Kiểm tra file manifest.json
ls -la wordpress/wp-content/themes/sage/public/build/manifest.json
```

#### Lỗi Composer autoloader:
```bash
# Cài lại dependencies
./install-sage.sh
```

#### Lỗi PHP version:
```bash
# Kiểm tra PHP version trong container
docker-compose exec wordpress php -v

# Nếu cần update PHP, sửa docker-compose.yml:
# image: wordpress:php8.2
```

## Cấu trúc dự án
- `wordpress/` - Thư mục WordPress
- `docker-compose.yml` - Cấu hình Docker
- `install-sage.sh` - Script cài đặt Sage theme
- `build-assets.sh` - Script build assets
- `setup-database.php` - Script tạo database và sample data
- `README.md` - Hướng dẫn này

## Luồng dữ liệu
1. **Database**: MySQL chứa dữ liệu thể thao
2. **WordPress**: CMS với Sage theme
3. **Sage Theme**: Sử dụng Blade templates
4. **Controllers**: Xử lý logic và query data
5. **Views**: Hiển thị dữ liệu ra giao diện

## Support
- **Docker**: https://docs.docker.com/
- **WordPress**: https://wordpress.org/support/
- **Sage Theme**: https://roots.io/sage/docs/