<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## About This Project

This repository is a **Laravel application template** intended to be used as a starting point for new projects.

It provides a clean Laravel setup with sensible defaults, allowing you to start developing immediately without repeating common setup steps.

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- A database (MySQL, PostgreSQL, SQLite, etc.)

## Installation

### 1. Create a project

Use this repository as a template on GitHub **or** clone it:

```bash
git clone https://github.com/feraandrei1/template-laravel-app.git
cd template-laravel-app
````

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Environment configuration

Copy the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Update `.env` with your database and app settings.

### 5. Run migrations and seed

```bash
php artisan migrate:fresh --seed
```

### 6. Build assets

```bash
npm run dev
```

## Laravel

This project is built using the **Laravel framework**.

Laravel documentation: [https://laravel.com/docs](https://laravel.com/docs)

## License

This project is open-sourced software licensed under the **MIT license**.
