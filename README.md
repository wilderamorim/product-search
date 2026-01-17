# Busca de Produtos com Laravel + Livewire

Projeto de teste prático que implementa um mecanismo de busca de produtos com filtros combinados (nome, categorias e marcas) usando Laravel, Livewire e PostgreSQL.

## Stack

- Laravel 12
- Livewire 4
- PostgreSQL
- Tailwind CSS
- Docker com Laravel Sail

## Subindo o projeto com Sail

```bash
cp .env.example .env
```

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$PWD:/var/www/html" \
    -w /var/www/html \
    composer:2 \
    composer install
```

```bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail artisan key:generate
```

## Migrations e seeders

```bash
./vendor/bin/sail artisan migrate --seed
```

## Rodando os testes

```bash
./vendor/bin/sail artisan test
```

## Observações

- O banco de dados padrão é PostgreSQL (pgsql).
- Após `migrate --seed`, o sistema já possui categorias, marcas e produtos para testar a busca.
- Os filtros do Livewire persistem na URL via query string e permanecem após refresh.
