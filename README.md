## Laravel E-commerce API with Authentication, Query Optimization, RBAC, and Queues

This project implements a small e-commerce API with authentication, optimized database queries, role-based access control, and email notifications through Laravel's queue system.
Project Setup
- Simple API with Authentication
- Database Optimization & Query Challenge
- Implement Role-Based Access Control (RBAC)
- Implement a Simple Queue for Email Notifications
- Optimize a Complex Query with Eloquent
- Conclusion


## Project Setup

Follow these steps to set up the project on your local machine.
```
git clone https://github.com/Masumrahmanhasan/dash-commerce.git
```

Navigate to the project directory:

```
cd /path/to/your-project
```
Install Dependencies
```
composer install
```
Set up your environment variables by copying the .env.example file:
```
cp .env.example .env
```

```
cp .env.example .env.testing
```
Generate the application key:
```
php artisan key:generate
```
Configure your database and mail settings in .env.
```
php artisan migrate
```
If you're using queues, make sure to configure the queue driver in .env:

```
QUEUE_CONNECTION=database
```

(Optional) If you're using Redis for queues, install Redis:

```
composer require predis/predis
```

Start the server:
```
php artisan serve
```

Run tests from your terminal

```
./vendor/bin/pest
```

here is the api documentation link ( Select the Environment in top right to Development)
https://www.postman.com/funnell/workspace/task-api/collection/29988813-ccc5374b-bb9f-41c5-90c3-1a79bbd97dc1?action=share&creator=29988813&active-environment=29988813-9a57803e-75bb-4e70-a2fa-5e098b8f8e73