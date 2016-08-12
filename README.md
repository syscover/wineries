# Wineries for Laravel 5.2

[![Total Downloads](https://poser.pugx.org/syscover/wineries/downloads)](https://packagist.org/packages/syscover/wineries)

## Installation

**1 - After install Laravel framework, insert on file composer.json, inside require object this value**
```
"syscover/wineries": "~1.0"
```
and execute on console:
```
composer install
```

**2 - Register service provider, on file config/app.php add to providers array**

```
Syscover\Wineries\WineriesServiceProvider::class,

```

**3 - To publish package and migrate**

and execute composer update again:
```
composer update
```

**4 - Run seed database**

```
php artisan db:seed --class="WineriesTableSeeder"
```

**5 - Activate package**

Access to Pulsar Panel, and go to Administration -> Permissions -> Profiles, and set all permissions to your profile by clicking on the open lock.