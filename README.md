## The Project

This is a project that creates a Laravel package for automatically generating a Service file in `app\Services` with the default namespace `App\Services`.

## Prerequisites

- Laravel framework: ">=9.0"
- PHP: ">=8.0"

## Installation

To install the package, run the following command:

```shell
composer require masterskill/service-package
```

## Publish the config file

To publish the config file, run the command:

```shell
php artisan vendor:publish --tag=config
```

The config file will be registered as 'service-package.php' under config folder.

## Creating a Service

To create a new service, use the following Artisan command:

```shell
php artisan make:service MyService
```

## Author

- Name : Clairmont RAJAONARISON - masterSkill77
- Email: clairmont.rajaonarison@gmail.com
- Email: clairmont@saha-technology.com

## Note

- Namespace is based on App\

Enjoy it :)
