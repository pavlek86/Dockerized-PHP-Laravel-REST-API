## Dockerized PHP/Laravel REST API

### Installation

1. Clone the repository
2. Run the application with command `docker-compose up -d`
3. Install defined dependencies with command `docker-compose exec app composer install`
4. Run migrations with `docker-compose exec app php artisan migrate`

Application is configured to run on `http://localhost`, and API is at `http://localhost/api`.

There are two unguarded routes:
1. Register `http://localhost/api/auth/register` [POST] - email and password are required in order to create an account
2. Login `http://localhost/api/auth/login` [POST] - valid email and password are required in order to obtain an JWT token

Other routes are guarded with Auth middleware (Valid JWT token must be passed)
