<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contact TH

This is a basic API that does stores contact to a database which contains: 
1. Name
2. Email
3. Attachment
4. Message

### Requirements

-   [Docker](https://www.docker.com/get-started)

### Installation

<p>Clone the Repository </p>

```
$ git clone https://github.com/JuliRash/contact-th.git
```

<p>Navigate to the repository directory.</p>

```
$ cd contact-th
```

<p> Get the application ready to build</p>

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Copy The ENV example file

```
cp .env.example .env
```

Clear the Cache

```
php artisan config:cache && php artisan optimize:clear
```

<p >Use Sail(Docker) To build the application</p>

```
$ ./vendor/bin/sail up -d
```

<p>Run Migration </p>

```
$ ./vendor/bin/sail  artisan migrate
```

<p> Run Tests </p>

```
$ ./vendor/bin/sail artisan test
```

<img src="https://i.ibb.co/FWx7yy7/Screenshot-2023-02-20-at-12-29-46-PM.png" width="400">





