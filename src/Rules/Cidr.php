<?php

namespace Cyberfusion\ValidationRules\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use IPTools\Exception\IpException;
use IPTools\Exception\NetworkException;
use IPTools\Network;

class Cidr implements ValidationRule
{
    private bool $strict = false;

    public function strict(): self
    {
        $this->strict = true;

        return $this;
    }

    public function passes(mixed $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        $cidrParts = explode('/', $value, 2);

        if (! isset($cidrParts[1]) || ! ctype_digit($cidrParts[1]) || $cidrParts[0] === '') {
            return false;
        }

        $ipAddress = $cidrParts[0];
        $netmask = (int) $cidrParts[1];

        $validV4 = filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && $netmask <= 32;
        $validV6 = filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) && $netmask <= 128;

        if (! $validV4 && ! $validV6) {
            return false;
        }

        try {
            $network = Network::parse($value);
        } catch (IpException|NetworkException) {
            return false;
        }

        if ($this->strict) {
            return $network->getNetwork()->toBin() === $network->getIP()->toBin();
        }

        return true;
    }

    public function message(): string
    {
        return __('cyberfusion_validation_rules.cidr');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->passes($value)) {
            $fail($this->message());
        }
    }
}
