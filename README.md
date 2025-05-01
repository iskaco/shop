# Iskaco Shop Platform

## About MeemHome

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Install

-   Run `composer install`.
-   Run `npm install`.
-   Make a copy of .env `cp .env.exapmle .env`.
-   Config your DB on .env file.
-   Run `php artisan migrate`.

## Learning ISAP

### Making ISAP resource

-   Run `php artisan make:isap-resource ResourceName`.
    -   For example `php artisan make:isap-resource Student`.

### Making ISAP custom activity

-   Run `php artisan make:isap-activity`
-   Or run `php artisan make:isap-activity {uri? : Uri of activity}
{method? : Http method}
{action? : ControllerFullName@functionName}
{title? : Title for users}
{description? : Description for users}
{is_active? : Is active}
{is_menu? : Is menu}
{parent_id? : Parent Id}
{middleware?* : Array of middlewares};`

### Making ISAP model activity

-   Run `php artisan make:isap-model-activity ResrouceName`

### Removing ISAP Resource

-   Run `php artisan isap:remove-resource ResourceName`
    -   For example `php artisan isap:remove-resource Student`.
-   This command will purge all files and data associated with the resource.
-   Executing this command allows you to delete all files and data, or only the data related to activities, based on the selected parameters.

## Requirements

## Testing

### PHPStan

-   In this project, we utilize Larastan for automated code analysis, which itself leverages PHPStan.

-   To use this tool, execute the following command:
    `./vendor/bin/phpstan analyze`
-   Before running this command, create a configuration file named phpstan.neon and add a configuration similar to the following:

```neon
includes:
    - ./vendor/nunomaduro/larastan/extension.neon
parameters:
    paths:
        - app
    level: 2
    ignoreErrors:
    excludePaths:
```
