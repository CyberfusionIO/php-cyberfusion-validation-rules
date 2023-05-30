# Validation rules

This package contains a set of validation rules available for all Laravel projects at Cyberfusion.

# Usage

## Requirements

This package requires Laravel 10 and PHP 8.1 or higher.

## Translations

The package includes both English and Dutch translations.

Publish them using the following command:

`php artisan vendor:publish --provider="Cyberfusion\ValidationRules\ValidationRulesServiceProvider" --tag="translations"`

## Available rules

### Cidr

Used to validate if a given value is a valid CIDR notation.

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

Used to validate if a given value is a valid common name.

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

Used to validate if a given value is a valid cron expression.

```php
use Cyberfusion\ValidationRules\Rules\CronExpression;

public function rules(): array
{
    return [
        'field' => [new CronExpression()],
    ];
}
```
