<?php

namespace Cyberfusion\ValidationRules\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CommonName implements ValidationRule
{
    public function passes(mixed $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        // When the commonName contains a wildcard, the wildcard must be the first, i.e. *.example.com,
        // not sub.*.example.com
        if (Str::contains($value, '*') && ! Str::startsWith($value, '*.')) {
            return false;
        }

        // The commonName must be a valid hostname, when wildcards are used, skip the wildcard part
        if (Str::startsWith($value, '*.')) {
            $value = Str::substr($value, 2);
        }

        // At least one dot is required
        if (! Str::contains($value, '.')) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) !== false;
    }

    public function message(): string
    {
        return __('cyberfusion_validation_rules.common_name');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->passes($value)) {
            $fail($this->message());
        }
    }
}
