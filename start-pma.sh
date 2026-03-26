#!/bin/bash
# Start phpMyAdmin for this project

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PORT=${1:-8081}

cd "$PROJECT_DIR/.phpmyadmin_server"

if [ ! -d "public" ]; then
    echo "❌ phpMyAdmin not installed. Run: ./setup-phpmyadmin.sh"
    exit 1
fi

echo "=========================================="
echo "Starting phpMyAdmin for projectCMS"
echo "=========================================="
echo "URL: http://localhost:$PORT"
echo "Username: cms"
echo "Password: @Cms123456"
echo "Database: cms"
echo ""
echo "Press Ctrl+C to stop"
echo "=========================================="

php -S localhost:$PORT -t public
