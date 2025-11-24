# Audit Polteksi - Sistem Audit Internal

Aplikasi Laravel untuk manajemen audit internal dengan Docker support.

## 🚀 Quick Start (Untuk Teman yang Clone Repository)

### Prerequisites
- Docker & Docker Compose terinstall
- Git terinstall

### Langkah-langkah Setup

```bash
# 1. Clone repository
git clone https://github.com/IvanRoyPandhe/audit-polteksi.git
cd audit-polteksi

# 2. Copy environment file
cp .env.example .env

# 3. Jalankan setup script (OTOMATIS)
chmod +x docker-setup.sh
./docker-setup.sh
```

**ATAU Manual:**

```bash
# 3a. Build dan jalankan containers
docker compose up --build -d

# 3b. Install dependencies
docker compose exec app composer install
docker compose exec app npm install

# 3c. Generate app key
docker compose exec app php artisan key:generate

# 3d. Jalankan migrasi dan seeder
docker compose exec app php artisan migrate --seed

# 3e. Build assets
docker compose exec app npm run build
```

### 🌐 Akses Aplikasi

- **Laravel App**: http://localhost:8000
- **PgAdmin**: http://localhost:8081
  - Email: admin@gmail.com
  - Password: admin123
- **PostgreSQL**: localhost:5433

### 🔐 Login Credentials

- **Admin**: admin@audit.com / password
- **Auditor**: auditor@audit.com / password
- **Validator**: validator@audit.com / password
- **Staff**: staff.teknik@audit.com / password
- **Pimpinan**: dekan.ekonomi@audit.com / password

## 🔧 Troubleshooting

### Port Conflict
Jika port sudah digunakan, edit `compose.yml`:
```yaml
ports:
  - "8001:8000"  # Ganti 8000 ke 8001
```

### Permission Error
```bash
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

### Database Error
```bash
docker compose down -v
docker compose up --build -d
```

### Cek Logs
```bash
docker compose logs app
docker compose logs db
```

## 📋 Perintah Docker Berguna

```bash
# Stop containers
docker compose down

# Restart containers
docker compose restart

# Rebuild containers
docker compose up --build -d

# Masuk ke container app
docker compose exec app bash

# Jalankan artisan command
docker compose exec app php artisan [command]
```

## 🛠️ Development

```bash
# Install dependencies baru
docker compose exec app composer require [package]
docker compose exec app npm install [package]

# Jalankan migration
docker compose exec app php artisan migrate

# Rollback migration
docker compose exec app php artisan migrate:rollback

# Fresh migration dengan seeder
docker compose exec app php artisan migrate:fresh --seed
```

## 📦 Tech Stack

- Laravel 11
- PostgreSQL 16
- PHP 8.3
- Node.js & NPM
- Docker & Docker Compose

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
