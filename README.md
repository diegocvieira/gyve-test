# Gyve.io Test

Order Management System created as requested in the test.

* Users registration
* Users Log in
* Users administration
* Orders creating
* Orders state changing
* Unit Testing

## Getting Started

To use the project you need to download or clone it (via SSH or HTTPS), and place it on a environment that allows the use of the PHP language ([XAMPP](https://www.apachefriends.org/pt_br/index.html), [WAMP](https://bitnami.com/stack/wamp), [LAMP](https://bitnami.com/stack/lamp), [Laravel Homestead](https://laravel.com/docs/8.x/homestead), [Laradock](https://laradock.io/), etc.).

```sh
$ git clone git@github.com:diegocvieira/gyve-test.git # SSH
$ git clone https://github.com/diegocvieira/gyve-test.git # HTTPS
```

To run the project you will need to install [Composer](https://getcomposer.org/download/) and [MySQL](https://dev.mysql.com/). All the environments mentioned above already have MySQL, however, only Laravel Homestead and Laradock have Composer.

After installation, create the database with the name you prefer. After creating the database, access the project folder, you will see a file called `.env.example`, it is in the project's root folder. You must copy it to a file called `.env`.

In `.env` look for the code block below:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

By default Laravel is configured to use MySQL, inform in the fields `DB_DATABASE`,` DB_USERNAME` and `DB_PASSWORD`, the name of the database, the database user and the user password, respectively. Save and close the file.

After that, in your terminal at the project location, execute the commands:

```php
$ composer install
``` 

```php
$ php artisan key:generate
``` 

```php
$ php artisan migrate
``` 

```php
$ php artisan db:seed
``` 

```php
$ php artisan serve
``` 

After all the steps done, the project can be accessed. As it is a test, the Administrator's credentials are login `admin@admin.com` and password `admin`.

## Testing

```php
$ php artisan test
```

## Stack

* [Laravel](https://laravel.com/) 8.0
* [PHP](https://www.php.net/) 7.3
* [MySQL](https://dev.mysql.com/) 5.7
* [Materialize](https://materializecss.com/) 1.0

## License

My Test is a free software project licensed by [MIT](LICENSE).
