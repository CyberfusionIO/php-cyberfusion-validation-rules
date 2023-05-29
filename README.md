# Validation rules

This package contains a set of validation rules available for all Laravel projects at Cyberfusion.

## Getting started

### Requirements

This package requires Laravel 10 and PHP 8.1 or higher.

### Installation

Make sure the Satis repository is added to your composer.json file:

```
"repositories": [
        {
            "type": "composer",
            "url": "https://satis.cyberfusion.nl"
        }
    ],
```

Require the package using composer:

`composer require cyberfusion/validation-rules`

### Translations

The package includes both English and Dutch translations. The translations can be published using the following command:

`php artisan vendor:publish --provider="Cyberfusion\ValidationRules\ValidationRulesServiceProvider" --tag="translations"`

## Available rules

### Cidr

The Cidr rule can be used to validate if a given value is a valid CIDR notation.

```php
use Cyberfusion\ValidationRules\Rules\Cidr;

public function rules(): array
{
    return [
        'field' => [new Cidr()],
    ];
}
```

