# Validation rules

This package contains a set of validation rules available for all Laravel projects at Cyberfusion.

# Usage

## Requirements

This package requires Laravel 10+ and PHP 8.3 or higher.

## Installation

You can install the package via composer:

```bash
composer require cyberfusion/validation-rules
```

## Translations

The package includes both English and Dutch translations.

Publish them using the following command:

`php artisan vendor:publish --provider="Cyberfusion\ValidationRules\ValidationRulesServiceProvider" --tag="translations"`

## Available rules

### Cidr

Used to validate if a given value is a valid [CIDR notation](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) (i.e. `127.0.0.0/32`). 

```php
use Cyberfusion\ValidationRules\Rules\Cidr;

public function rules(): array
{
    return [
        'field' => [new Cidr()],
    ];
}
```

### CommonName

Used to validate if a given value is a valid common name (i.e. `example.com` or `sub.example.com`).

```php
use Cyberfusion\ValidationRules\Rules\CommonName;

public function rules(): array
{
    return [
        'field' => [new CommonName()],
    ];
}
```

### CronExpression

Used to validate if a given value is a valid cron expression (i.e. `0 0 1 1 *`).

```php
use Cyberfusion\ValidationRules\Rules\CronExpression;

public function rules(): array
{
    return [
        'field' => [new CronExpression()],
    ];
}
```

## Tests

Unit tests are available in the `tests` directory. Run:

`composer test`

To generate a code coverage report in the `build/report` directory, run:

`composer test:coverage`

## Contributing

Contributions are welcome. See the [contributing guidelines](CONTRIBUTING.md).

## Security

If you discover any security related issues, please email support@cyberfusion.io instead of using the issue tracker.

## License

This client is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

