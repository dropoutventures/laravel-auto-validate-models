# Automatically validate your Laravel models

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/laravel-auto-validate-models.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-auto-validate-models)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/laravel-auto-validate-models.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/laravel-auto-validate-models)

This package provides a simple trait that can be used on your models to provide automatic validation when creating, saving and updating.

## Installation

You can install the package via composer:

```bash
composer require ryangjchandler/laravel-auto-validate-models
```

## Usage

1. Use the trait on your model.

``` php
use RyanChandler\AutoValidateModels\Concerns\AutoValidates;

class Post extends Model
{
    use AutoValidates;
}
```

2. Define a `public static $rules` property on the model.

```php
class Post extends Model
{
    use AutoValidates;

    public static $rules = [
        'title' => 'required|max:255',
    ];
}
```

3. Define a `protected static $validationEvents` property on the model and specify which events should perform validation.

```php
class Post extends Model
{
    use AutoValidates;

    public static $rules = [
        'title' => 'required|max:255',
    ];

    protected static $validationEvents = [
        'creating', 'updating', 'saving',
    ];
}
```

This will perform the validating when using the `Model::create()`, `Model::update()` or `Model::save()` methods.

## Security

If you discover any security related issues, please email security@ryangjchandler.co.uk instead of using the issue tracker.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
