<?php

namespace Cyberfusion\ValidationRules\Tests\Unit\Rules;

use Cyberfusion\ValidationRules\Rules\CronExpression;
use Cyberfusion\ValidationRules\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CronExpressionTest extends TestCase
{
    public static function validCronExpressions(): array
    {
        return [
            ['0 0 1 1 *'],
            ['1 2-4 * 4,5,6 */3'],
            ['* * * * *'],
        ];
    }

    public static function invalidCronExpressions(): array
    {
        return [
            [2],
            ['0 61 * * *'],
            ['A 1 * * *'],
            ['test'],
        ];
    }

    #[DataProvider('validCronExpressions')]
    public function testTrueForValidCronExpressions($value): void
    {
        $rule = new CronExpression();

        $this->assertTrue($rule->passes($value));
    }

    #[DataProvider('invalidCronExpressions')]
    public function testFalseForInvalidCronExpressions($value): void
    {
        $rule = new CronExpression();

        $this->assertFalse($rule->passes($value));
    }

    public function testMessage(): void
    {
        $rule = new CronExpression();

        $this->assertSame(__('cyberfusion_validation_rules.cron_expression'), $rule->message());
    }
}
