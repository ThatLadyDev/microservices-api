<p>
    <a href="https://github.com/ThatLadyDev/microservices-api" target="_blank">
        <img src="https://kinsta.com/wp-content/uploads/2022/04/microservices-vs-api.jpg" alt="Microservices API Logo"/>
    </a>
</p>

## About This Project

This project is a simple, action-based microservice API application built using Laravel, optimized for
workload efficiency, leveraging Laravel Octane. This application handles specific POST
and GET requests, process tasks asynchronously, and is developed using Test-Driven
Development (TDD) with Pest. It is containerized and runnable via Docker using Laravel
Sail (for dev purposes).

To learn more about the application's functionalities, do [check out this wiki I crafted 
for this application.](https://github.com/ThatLadyDev/microservices-api/wiki/About-This-Application)

## How to setup this project
1. Install docker onto your PC/Laptop if you haven't done so already.
2. Clone this repository:
```shell
git clone git@github.com:ThatLadyDev/microservices-api.git
```
3. Setup the application's containers and services
```shell
docker compose build
```
4. Configure the application's environment variables:
```shell
cp .env.example .env
```
4. Install the application's dependencies
```shell
docker compose exec backend bash
composer install
php artisan key:generate
```
5. Setup the application's database and tables
```shell
php artisan migrate
```

### Application Must Haves
- a .env file
  - This .env file must contain some necessary variables:
    - `APP_PORT=6745`
    - `APP_URL=http://localhost:6745`
    - `REDIS_HOST=redis`
    - `OCTANE_SERVER=swoole`


### Tools, Services and Principles Used
- Tools
  - Swoole
  - Redis
  - Laravel Actions Package
  - Laravel Octane
  - Laravel Sail
  - PHP Pest
- Principles
  - TDD
  - DDD


