# Laravel Imageoptimizer

[![License](https://poser.pugx.org/approached/laravel-image-optimizer/license)](https://packagist.org/packages/approached/laravel-image-optimizer)
[![Latest Stable Version](https://poser.pugx.org/approached/laravel-image-optimizer/v/stable)](https://packagist.org/packages/approached/laravel-image-optimizer)
[![Total Downloads](https://poser.pugx.org/approached/laravel-image-optimizer/downloads)](https://packagist.org/packages/approached/laravel-image-optimizer)

With this package you can easy optimize your image in laravel. Read the google instruction https://developers.google.com/speed/docs/insights/OptimizeImages about image optimize.


## Installation

Convert packages:
```
sudo apt-get install optipng jpegoptim
```

Require this package with composer:
```
composer require approached/laravel-image-optimizer
```

After updating composer, add the ServiceProvider to the providers array in config/app.php
```
'Approached\LaravelImageOptimizer\ServiceProvider'
```

Copy the package config to your local config with the publish command:
```
php artisan vendor:publish
```

## Demo
// TODO

## License
MIT
