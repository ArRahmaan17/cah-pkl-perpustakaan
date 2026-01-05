#!/bin/bash
set -e
u_host="perpustakaan-db"
u_user="root"
u_pass=""

until php -r "try { new PDO('mysql:host=$u_host;port=3306', '$u_user', '$u_pass'); exit(0); } catch (Exception \$e) { exit(1); }" ; do
  echo "Cek Database selesai dibuild apa belom"
  sleep 2
done
echo "Database konek"
echo "Eksekusi migrate laravel"
php artisan migrate:fresh --force
echo "Memulai Server..."
exec "$@"