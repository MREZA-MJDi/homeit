# HomeIT

HomeIT is a Laravel web platform foundation for connecting customers with on-site IT technicians. Its intended service catalogue covers computer troubleshooting, operating-system and software setup, network/Wi-Fi configuration, remote support, and technical consulting. The repository currently includes the Laravel application foundation and authentication; do not assume every service workflow is production-complete.

## Technology
- PHP `^8.2`, Laravel `^12.0`
- Blade, Tailwind CSS, Alpine.js, Vite
- Database supported by Laravel (configure via `.env`)
- Spatie Laravel Permission for role/permission support
- Pest/Laravel test tooling

## Requirements
PHP 8.2+, Composer, Node.js/npm, and a supported database such as MySQL or MariaDB.

## Local installation
```bash
git clone https://github.com/MREZA-MJDi/homeit.git
cd homeit
composer install
```

Create `.env` by copying `.env.example` (Windows CMD: `copy .env.example .env`; macOS/Linux: `cp .env.example .env`), then set the database connection and other environment values. Create the database before running migrations.

```bash
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

Open the URL printed by Artisan, usually `http://127.0.0.1:8000`. For frontend hot reload, run `npm run dev` in a separate terminal instead of relying only on the production build.

## Tests
```bash
php artisan test
```

## Configuration notes
Never commit `.env`, credentials, real customer data, or production keys. Review migrations and seeders before running them against any database containing data. Use only seeders that exist in this repository; this README does not promise demo accounts.

## Project status
This repository is under active development. Verify feature completeness in the source and tests before using it for real service bookings.

## Links
- Repository: https://github.com/MREZA-MJDi/homeit
- Laravel documentation: https://laravel.com/docs/12.x
