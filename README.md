# Rockeseat DevOps API

This project is a simple API setup using PHP, PostgreSQL, and Docker Compose. It demonstrates how to set up a development environment with Docker and manage database connections securely.

## Project Structure

```.env.example``` # Environment variables example <br>
```docker-compose.yml``` # Docker Compose configuration <br>
```Dockerfile``` # Dockerfile for the API container <br>
```index.php``` # API entry point <br>
```init.sql``` # Database initialization script <br>
```src/``` # Source code directory <br>
```vendor/``` # Composer dependencies <br>
```.gitignore``` # Git ignore rules <br>
```.dockerignore``` # Docker ignore unecessary files and folders <br>



## Prerequisites

- Docker installed on your machine
- Docker Compose installed (using `docker compose` CLI)

## Configuration

1. Copy the `.env.example` file to `.env` and adjust the values as needed:
   ```
   cp .env.example .env
   ```
2. Set root password and database name in the `.env` file:
   ```
   POSTGRES_USER=root
   POSTGRES_PASSWORD=strongpasswordhere
   POSTGRES_DB=mydb
   ```
3. Ensure the `init.sql` file contains the correct password for the `app_user`. The default password is: `sua_senha_forte_aqui`.

## Usage
To build and run the application, use the following command:
```
docker compose --env-file .env up --build
```

### This will:

* Start a PostgreSQL database container with the credentials defined in .env.example.
* Start the API container and connect it to the database.

## API
The API is accessible at http://localhost:8080. It includes a simple route:

* GET /: Returns a message indicating whether the API successfully connected to the database.

## Database Initialization
The `init.sql` file is used to initialize the database. 
It creates a restricted user (`app_user`) with the necessary permissions for the application. 
Ensure the password in `init.sql` matches the `APP_DB_PASSWORD` in `.env`.

## Stopping the Application
To stop the application, run:
```
docker compose down
```
or
```
Ctrl + c
```

## License
This project is licensed under the MIT License. 