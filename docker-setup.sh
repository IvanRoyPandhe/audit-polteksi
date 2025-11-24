#!/bin/bash

echo "🚀 Setting up Laravel with Docker..."

# Copy .env if not exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
    
    # Update database config for Docker
    sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/' .env
    sed -i 's/DB_DATABASE=audit_mutu/DB_DATABASE=laravel_db/' .env
    sed -i 's/DB_USERNAME=postgres/DB_USERNAME=laravel/' .env
    sed -i 's/DB_PASSWORD=password/DB_PASSWORD=secret/' .env
fi

# Build and start containers
echo "🔨 Building Docker containers..."
docker compose up --build -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 15

# Generate APP_KEY
echo "🔑 Generating application key..."
docker compose exec app php artisan key:generate --force

# Run migrations and seeders
echo "🗄️ Running database migrations..."
docker compose exec app php artisan migr