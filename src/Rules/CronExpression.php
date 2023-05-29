<?php

namespace Cyberfusion\ValidationRules\Rules;

use Closure;
use Cron\CronExpression as CronExpressionParser;
use Illuminate\Contracts\Validation\ValidationRule;

class CronExpression implements ValidationRule
{
    public function passes(mixed $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        return CronExpressionParser::isValidExpression($value);
    }

    public function message(): string
    {
        return __('cyberfusion_validation_rules.cron_expression');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->passes($value)) {
            $fail($this->message());
        }
    }
}
