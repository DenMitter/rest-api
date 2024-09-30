<h1 align="center">
    <b>Rest API</b> project
</h1>

This project was written for a portfolio on <b>Laravel</b>, the project currently has a<br> normal CRUD for posts. The project will be supplemented with greater functionality

<br>
<p>
    <div align="center">
        <h3>Technologies used</h3>
        <img src="https://img.shields.io/badge/-HTML-c58545?style=for-the-badge&logo=html5&logoColor=c58545&labelColor=282828">
        <img src="https://img.shields.io/badge/-Bootstrap-9754ed?style=for-the-badge&logo=bootstrap&logoColor=9754ed&labelColor=282828">
        <img src="https://img.shields.io/badge/-PHP-609ad3?style=for-the-badge&logo=php&logoColor=609ad3&labelColor=282828">
        <img src="https://img.shields.io/badge/-Laravel-df5065?style=for-the-badge&logo=laravel&logoColor=df5065&labelColor=282828">
    </div>
</p>

<h1>Posts</h1>

```php
// Route for get posts from first page (GET)
/api/posts

// Route for get posts from desired page (GET)
/api/posts?page={desired number}
```
```php
// Route for create post (POST)
/api/posts

// Arguments
title ( min 10, max 99 symbols)
contents ( min 100, max 999 symbols)
```
```php
// Route for show post (GET)
/api/posts/{desired post ID}
```
```php
// Route for update post (PUT)
/api/posts/{desired post ID}

// Headers
Key: Content-Type
Value: application/x-www-form-urlencoded
```
```php
// Route for delete post (DELETE)
/api/posts/{desired post ID}
```

<br>
<br>

<h1>Users</h1>

```php
// Route for create user (POST)
/api/register

// Arguments
username ( min 2, max 99 symbols)
password ( min 2, max 999 symbols)
```


<br>

## <b>Installation and Setup</b>
1. Clone the Repository: Clone this repository to your local machine using the command:

```bash
git clone https://github.com/DenMitter/rest-api.git
```

1. Install Dependencies: Run the composer install command to install the necessary packages.

1. Configure Environment: Copy the .env.example file to .env and configure the database access parameters.
```bash
cp .env.example .env
php artisan key:generate
```

1. Run Migrations and seeders: Execute the php artisan migrate command to run migrations and create tables in the database.
```bash
php artisan migrate
php artisan db:seed
```

1. Run the Local Server: Run the php artisan serve command to start the local server.
```bash
php artisan serve
```

1. Access the System: Open a web browser and go to http://localhost:8000 to access the blog's homepage.
