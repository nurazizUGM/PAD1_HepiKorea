<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Setup

1.  clone repository

    -   master

        ```bash
        git clone https://github.com/nurazizUGM/PAD1_HepiKorea.git;

        cd PAD1_HepiKorea
        ```

    -   development

        ```bash

        git clone https://github.com/nurazizUGM/PAD1_HepiKorea.git -b development;

        cd PAD1_HepiKorea

        ```

2.  install dependencies

    ```bash
    composer install
    npm install
    ```

3.  setup .env file

4.  generate session key

    ```bash
    php artisan key:generate
    ```

5.  migrate database

    ```bash
    php artisan migrate:fresh
    ```

6.  setup default administrator account

    email: `admin@admin.com`

    password: `123`

    ```bash
    php artisan db:seed AdminSeeder
    ```

7.  setup `tailwind` & `flowbite` UI framework

    -   development

        ```bash
        npm run dev
        ```

    -   production

        ```bash
        npm run build
        ```

8.  serve project

    ```bash
    php artisan serve
    ```
