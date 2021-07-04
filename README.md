# php-rrmdir

Recursive rmdir for PHP 

## tests results .
![<CircleciTest>](https://circleci.com/gh/takuya/php-rrmdir.svg?style=svg)

## Installing from github.
```

composer config repositories.takuya/php-rrmdir vcs https://github.com/takuya/php-rrmdir
composer config minimum-stability dev
composer require takuya/php-rrmdir
```
## Installing from packagist.
```sh
composer require takuya/php-rrmdir
composer install
````
## Usage example.
This package provides a function `rrmdir()` to your composer project.
```php
<?php

require_once 'vendor/autoload.php';
$ret = rrmdir('/var/www/virtualhosts/example.com/www-data');
is_dir($ret);#=>false
```


## run tests
```
composer install
composer dumpautoload
./vendor/bin/phpunit
```

