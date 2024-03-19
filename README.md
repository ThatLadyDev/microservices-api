<p>
    <a href="https://laravel.com" target="_blank">
        <img src="https://kinsta.com/wp-content/uploads/2022/04/microservices-vs-api.jpg" alt="Microservices API Logo"/>
    </a>
</p>

## About This Project

This project is a simple, action-based microservice API application built using Laravel, optimized for
workload efficiency, leveraging Laravel Octane. This application handles specific POST
and GET requests, process tasks asynchronously, and is developed using Test-Driven
Development (TDD) with Pest. It is containerized and runnable via Docker using Laravel
Sail (for dev purposes).

### API Functionality

#### POST Endpoint
- Endpoint to receive POST requests containing a text and a list of tasks (array format).
- Validate the received text against a predefined maximum length.
- Validate the tasks against a specific set of task enums (available tasks: ‘**call_reason**’, ‘**call_actions**’, ‘**satisfaction**’, ‘**call_segments**’, ‘**summary**’).
- On successful validation, add a mock result action to a queue and return a Job ID.
- Store the Job in a database (model is composed of an uuid and timestamps).

#### Asynchronous Task Processing
- Develop an action to provide a mock result for each task.
- This action should be processed asynchronously.

#### GET Endpoint
- Implement a GET route to retrieve the mock results.
- This route should accept a Job ID and return the corresponding mock results.

## Application Requirements

**Test-Driven Development**

1. Employ TDD methodologies throughout the development.
2. Use Pest for writing and running tests.
3. Ensure comprehensive test coverage for all functionalities.


**Docker Integration via Laravel Sail**
1. Ensure the application is containerized and can be run using Docker.
2. Utilize Laravel Sail for easy Docker management.
3. Include Swoole within the Docker setup for Octane.
