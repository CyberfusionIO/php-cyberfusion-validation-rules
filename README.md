# php-cyberfusion-validation-rules

Library with general-purpose validation rules.

# Install

## Composer

Run the following command to install the package from Packagist:

    composer require cyberfusion/validation-rules

# Usage

## Rules

### `Cidr`

Valid [CIDR notation](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) (e.g. `127.0.0.0/32`). 

```php
use Cyberfusion\ValidationRules\Rules\Cidr;

public function rules(): array
{
    return [
        'field' => [new Cidr()],
    ];
}
```

### `CommonName`

Valid common name (e.g. `example.com` or `sub.example.com`).

```php
use Cyberfusion\ValidationRules\Rules\CommonName;

public function rules(): array
{
    return [
        'field' => [new CommonName()],
    ];
}
```

### `CronExpression`

Valid cron expression (e.g. `0 0 1 1 *`).

```php
use Cyberfusion\ValidationRules\Rules\CronExpression;

public function rules(): array
{
    return [
        'field' => [new CronExpression()],
    ];
}
```

## Translations

The package includes English and Dutch translations.

Publish them using the following command:

    php artisan vendor:publish --provider="Cyberfusion\ValidationRules\ValidationRulesServiceProvider" --tag="translations"

