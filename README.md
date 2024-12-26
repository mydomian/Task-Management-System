# Task Management System
---
## Prerequisites
- **PHP**: Version 8.2 (compatible with Laravel version used)
- **Composer**: Dependency manager for PHP
- **Node.js**: For front-end dependencies
- **MySQL**: Mysql compatible database
- **Git**: To clone the repository
---
## Installation
```bash
git clone https://github.com/mydomian/Task-Management-System.git
cd Task-Management-System
composer udpate
cp .env.example .env
php artisan key:generate
create database task_management
php artisan migrate
php artisan storage:link
php artisan serve

