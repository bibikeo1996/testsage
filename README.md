# WordPress Sports Website với Sage Theme

Dự án WordPress sử dụng Sage theme để hiển thị dữ liệu thể thao.

## Yêu cầu hệ thống
- Docker
- Docker Compose

## Quick Start

### Bước 1: Khởi chạy Docker & Containers
```bash
# Khởi động Docker
open -a Docker

# Khởi động containers
docker-compose up -d

# Dừng tất cả containers
docker-compose down

# Xóa containers cũ
docker system prune
```

```
Trường hợp `phpMyAdmin tried to connect to the MySQL server, and the server rejected the connection.` thì đổi port line 15 docker composer
`ports:
   - "3307:3306"`
```

### Bước 2: Cài đặt Sage Theme
```bash
./install-sage.sh
```

### Bước 3: Thiết lập Database
```bash
docker cp setup-database.php [project-name]-wordpress-1:/var/www/html/setup-database.php
docker exec [project-name]-wordpress-1 php /var/www/html/setup-database.php
```

### Bước 4: Build Assets
```bash
./build-assets.sh
```

### Bước 5: Truy cập Website
- Website: http://localhost:8000
- phpMyAdmin: http://localhost:8081 (wordpress/wordpress)

## Cấu trúc dự án
- `wordpress/` - Thư mục WordPress
- `docker-compose.yml` - Cấu hình Docker
- `README.md` - Hướng dẫn này