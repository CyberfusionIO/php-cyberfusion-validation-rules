<?php

namespace Cyberfusion\ValidationRules\Tests\Unit\Rules;

use Cyberfusion\ValidationRules\Rules\CommonName;
use Cyberfusion\ValidationRules\Tests\TestCase;

class CommonNameTest extends TestCase
{
    public static function validCommonNames(): array
    {
        return [
            ['example.com'],
            ['sub.example.com'],
            ['sub.sub.example.com'],
            ['*.example.com'],
            ['*.sub.example.com'],
        ];
    }

    public static function invalidCommonNames(): array
    {
        return [
            ['sub.*.example.com'],
            ['sub*.example.com'],
            ['*sub.example.com'],
            ['example'],
        ];
    }

    /**
     * @dataProvider validCommonNames
     */
    public function testTrueForValidCommonNames($value): void
    {
        $rule = new CommonName();

        $this->assertTrue($rule->passes($value));
    }

    /**
     * @dataProvider invalidCommonNames
     */
    public function testFalseForInvalidCommonNames($value): void
    {
        $rule = new CommonName();

        $this->assertFalse($rule->passes($value));
    }

    public function testMessage(): void
    {
        $rule = new CommonName();

        $this->assertSame(__('cyberfusion_validation_rules.common_name'), $rule->message());
    }
}
