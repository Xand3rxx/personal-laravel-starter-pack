## Personal Laravel Starter Pack

This Laravel starter pack is configured to get you up and running with basic Laravel authentication with two distinct user roles with segmented URl's.

## Laravel Version

9^

## Personal Laravel Starter Pack

This web application features the following:

1. A custom user url middleware.
2. User and Role seeders.
3. Tailwind CSS configuration
4. Web route configuration.
5. Traits
   - Change password
   - Generate UUID for models.
   - Generate a unique identifier.
   - Recursive model status column update.

## Expenses and Budgeting Application Setup

1. CD into the application root directory with your command prompt/terminal/git bash.

2. Run `cp .env.example .env`.

3. Inside `.env` file, setup database, mail and other configurations.

4. Run `composer install`.

5. Run `php artisan key:generate` command.

6. Run `php artisan migrate:fresh --seed` command.

7. Run `php artisan serve` command.

8. Define your routes in `web.php`.

9. To run a single migration `php artisan migrate --path=/database/migrations/my_migration.php`.

10. To run single seeder `php artisan db:seed --class=UserSeeder`.
