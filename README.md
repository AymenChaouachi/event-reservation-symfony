# Event Reservation Web Application

## Overview

This project is a web application developed using Symfony 7.  
It allows users to browse events and make reservations, while administrators can manage events and view reservations.

---

## Technologies

- Symfony 7
- PHP 8.2
- PostgreSQL
- Doctrine ORM
- Twig
- Docker (PHP, Nginx, PostgreSQL)

---

## Features

### User
- Login
- View events
- View event details
- Make a reservation

### Admin
- Login with ROLE_ADMIN
- Dashboard
- Create event
- Edit event
- Delete event
- View reservations

---

## Installation

### 1. Clone the project


git clone https://github.com/YOUR_USERNAME/event-reservation-symfony.git
cd event-reservation-symfony
### 2. Start Docker
docker compose up -d --build

### 3.Enter container
docker compose exec php bash

### 4.Install dependencies
composer install

### 5.Setup database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate


## Access
Application: http://localhost:8000
Admin: http://localhost:8000/admin


## Credentials

### Admin:

username: admin
password: admin123

### User:

username: user
password: user123
