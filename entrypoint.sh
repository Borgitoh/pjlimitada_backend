#!/bin/bash
set -e

# Esperar o MySQL ficar disponível
echo "Aguardando o MySQL..."
while ! nc -z mysql 3306; do
  sleep 1
done

echo "MySQL está pronto! Rodando migrations e seeders..."

# Rodar migrations e seeders
php artisan migrate --force
php artisan db:seed --class=CategoriaSeeder --force
php artisan db:seed --class=MarcaSeeder --force
php artisan db:seed --class=ModeloSeeder --force

# Executar o comando padrão do container
exec "$@"
