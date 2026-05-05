# Travel Landing Page CMS

Laravel 12 travel landing page with a database-driven CMS. The landing page uses Blade as the Laravel entry view and React components for the animated UI.

## Features

- Laravel 12 backend with MySQL database.
- CMS page to edit landing page content from the database.
- React landing page mounted through Vite.
- Tailwind CSS styling.
- Framer Motion animations.
- Lucide React and Heroicons icons.
- Local optimized assets in `public/assets/images`.
- Feature tests for CMS update flow.

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL 8.4
- Node.js / npm
- Vite
- React
- Tailwind CSS
- Docker Compose for MySQL and phpMyAdmin

## Main Routes

- Landing page: `http://localhost:8000/`
- CMS page: `http://localhost:8000/cms`
- phpMyAdmin: `http://localhost:8080`

## Database

This project uses MySQL.

Default local credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_laravel
DB_USERNAME=travel_user
DB_PASSWORD=travel_password
```

The CMS content is stored in the `page_contents` table.

Important files:

- Model: `app/Models/PageContent.php`
- Migration: `database/migrations/2026_05_05_083830_create_page_contents_table.php`
- Seeder: `database/seeders/PageContentSeeder.php`
- SQL submission/export: `assignment.sql`

## Setup With Docker MySQL

Start MySQL and phpMyAdmin:

```bash
docker compose up -d
```

Install dependencies:

```bash
composer install
npm install
```

Create environment file if needed:

```bash
cp .env.example .env
php artisan key:generate
```

Run migrations and seed CMS content:

```bash
php artisan migrate:fresh --seed
```

Build frontend assets:

```bash
npm run build
```

Start Laravel server:

```bash
php artisan serve
```

Open:

```text
http://localhost:8000
```

## Development Mode

Run Laravel and Vite separately:

```bash
php artisan serve
npm run dev
```

Or use the Laravel script:

```bash
composer run dev
```

## CMS Usage

Open:

```text
http://localhost:8000/cms
```

The CMS is divided into sections:

- `Hero` for brand, headline, search info, and hero images.
- `Navigation` for menu labels.
- `Values Section` for the benefit cards.
- `Decorative Assets` for optional icon paths.

Each section includes a preview so the admin can understand which landing page area is being edited.

After editing content, click `Save Content`. The landing page reads the latest values from the database.

## Assets

CMS image paths should point to public assets, for example:

```text
/assets/images/gunung-optimized.webp
/assets/images/pantai-optimized.webp
/assets/images/earth.svg
/assets/images/suitcase.svg
/assets/images/ticket.svg
```

Public assets are stored in:

```text
public/assets/images
```

## Testing

Run all tests:

```bash
php artisan test
```

Current CMS tests cover:

- CMS page loads successfully.
- Admin can update CMS content.
- Landing page receives updated CMS content.
- Empty CMS fields fail validation.

## Code Quality

Run formatter:

```bash
./vendor/bin/pint
```

Build frontend:

```bash
npm run build
```

Recommended final check before submission:

```bash
php artisan test
npm run build
./vendor/bin/pint
```

## Docker Services

`docker-compose.yml` provides:

- `mysql` on port `3306`
- `phpmyadmin` on port `8080`

Stop containers:

```bash
docker compose down
```

Stop containers and remove database volume:

```bash
docker compose down -v
```

Use `down -v` only when you want to delete local MySQL data.
