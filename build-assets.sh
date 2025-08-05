#!/bin/bash

echo "=== Build Sage Assets ==="

# Vào thư mục Sage theme
cd wordpress/wp-content/themes/sage

# Build assets
echo "Building assets..."
docker run --rm -v "$(pwd):/app" -w /app node:18 npm run build

echo "=== Hoàn thành build assets ==="