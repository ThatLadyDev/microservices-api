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

**To learn more about the application's functionalities, do [check out the wiki I crafted 
for this application.](https://github.com/ThatLadyDev/microservices-api/wiki/About-This-Application)**

## How to set up this project locally
The installation process for this project has been simplified through the use of a `Makefile`.
All you need do is run a single `make` command and this project will be setup on your computer.

### Before You Proceed

Before you proceed, ensure Docker is installed on your computer. If not, follow this step below:

> **Install Docker**: Install Docker on your PC/Laptop by following the instructions on the [official Docker website](https://docs.docker.com/get-docker/).

Once Docker is installed, follow these steps:

1. **Clone the Repository**: Clone this repository to your local machine:

    ```shell
    git clone git@github.com:ThatLadyDev/microservices-api.git
    ```

2. **Set Up the Application**: Run the following command to set up the application:

    ```shell
    make setup:app
    ```
   This command automates the setup process for your application, including pulling necessary Docker images, creating containers, setting up Composer, installing dependencies, generating encryption keys, configuring Supervisor, and setting up the database.


3. **Access the Application**: If all services and containers are created successfully, you can interact with the API using your preferred API testing tool, such as Postman etc.

   **Use the following base URL to send requests to the API:**
   
    > [http://localhost:6745](#)

    You should see this below on successful installation:

    <img src="https://res.cloudinary.com/xxsavage/image/upload/v1710905422/microservices-api/2024-03-20_04-30.png">

## API Endpoints

### GET /api/tasks

- **Description**: Retrieves the mock results associated with a Job ID
- **Usage**: Send a GET request to this endpoint to retrieve mock results.
- **Parameter**: `{joId}` - Specifies the Job ID used to fetch mock results.
- **Response**: A JSON array containing the mock results.

### Sample Request
<img src="https://res.cloudinary.com/xxsavage/image/upload/v1710905950/microservices-api/2024-03-20_04-38.png">

### Sample Response
<img src="https://res.cloudinary.com/xxsavage/image/upload/v1710906010/microservices-api/2024-03-20_04-39.png">

### POST /api/tasks

- **Description**: Creates a new task, adds a mock result action to a queue for asynchronous processing, returns a Job ID, and stores the Job in a database.
- **Usage**: Send a POST request to this endpoint with the necessary input data to create a new task.
- **Input**: The request body should contain the necessary data to create a new task.
- **Response**: If successful, returns a successful JSON response.

### Sample Request
<img src="https://res.cloudinary.com/xxsavage/image/upload/v1710906258/microservices-api/2024-03-20_04-43.png">

### Sample Response
<img src="https://res.cloudinary.com/xxsavage/image/upload/v1710906265/microservices-api/2024-03-20_04-44.png">

### 💡Quick One
1. The `make setup:app` command simplifies the setup process of this application on your local environment. 
It automates the following steps:
   - **Pulls Required Docker Images:** Fetches necessary Docker images for PostgreSQL, Redis, and Laravel Sail.
   - **Creates Essential Containers:** Initializes PostgreSQL, Redis, and Laravel Sail containers.
   - **Sets Up Composer:** Prepares Composer for dependency management.
   - **Installs Dependencies:** Executes composer install to install project dependencies.
   - **Generates Encryption Key:** Creates a unique encryption key for your Laravel application.
   - **Configures Supervisor:** Sets up Supervisor to manage critical processes.
   - **Database Setup:** Initializes the application's database, creating required tables.
2. The `.env` file must have the folloiwng key variables
   - `APP_PORT=6745`
   - `APP_URL=http://localhost:6745`
   - `REDIS_HOST=redis`
   - `OCTANE_SERVER=swoole`

## Extra Commands
Run php pest tests
```shell
make run-test
```

Start running the application
```shell
make start
```

Stop the application containers
```shell
make stop
```

### Tools, Services and Principles Used
- **DB Service:** Postgres
- **Queue Service:** Redis
- **Tools**
  - Swoole
  - Redis
  - Laravel Actions Package
  - Laravel Octane
  - Laravel Sail
  - PHP Pest
- **Principles**
  - TDD
  - DDD


