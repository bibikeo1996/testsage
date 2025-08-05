#!/bin/bash

echo "=== Tạo Migrations với Acorn ==="

# Vào thư mục Sage theme
cd wordpress/wp-content/themes/sage

# Tạo migration cho bảng countries
echo "Tạo migration cho bảng countries..."
docker run --rm -v "$(pwd):/app" -w /app composer:latest php vendor/bin/acorn make:migration create_countries_table

# Tạo migration cho bảng competitions
echo "Tạo migration cho bảng competitions..."
docker run --rm -v "$(pwd):/app" -w /app composer:latest php vendor/bin/acorn make:migration create_competitions_table

# Tạo migration cho bảng teams
echo "Tạo migration cho bảng teams..."
docker run --rm -v "$(pwd):/app" -w /app composer:latest php vendor/bin/acorn make:migration create_teams_table

# Tạo migration cho bảng matches
echo "Tạo migration cho bảng matches..."
docker run --rm -v "$(pwd):/app" -w /app composer:latest php vendor/bin/acorn make:migration create_matches_table

echo "=== Hoàn thành tạo migrations ===" 