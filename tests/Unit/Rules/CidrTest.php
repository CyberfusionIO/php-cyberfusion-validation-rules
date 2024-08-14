<?php

namespace Cyberfusion\ValidationRules\Tests\Unit\Rules;

use Cyberfusion\ValidationRules\Rules\Cidr;
use Cyberfusion\ValidationRules\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CidrTest extends TestCase
{
    public function test_null_is_invalid(): void
    {
        $rule = new Cidr();

        $this->assertFalse($rule->passes(null));
    }

    public function test_empty_string_is_invalid(): void
    {
        $rule = new Cidr();

        $this->assertFalse($rule->passes(''));
    }

    public function test_expects_string_compatible_type(): void
    {
        $rule = new Cidr();

        $this->assertFalse($rule->passes(123456));
    }

    #[DataProvider('getInvalid')]
    public function test_invalid_cidr(string $cidr): void
    {
        $rule = new Cidr();

        $this->assertFalse($rule->passes($cidr));
    }

    #[DataProvider('getValid')]
    public function test_valid_cidr(string $cidr, bool $strictlyValid): void
    {
        $rule = new Cidr();

        $this->assertTrue($rule->passes($cidr));

        $rule->strict();

        $this->assertEquals($strictlyValid, $rule->passes($cidr));
    }

    public function test_message(): void
    {
        $rule = new Cidr();

        $this->assertSame(__('cyberfusion_validation_rules.cidr'), $rule->message());
    }

    public static function getValid(): array
    {
        return [
            '127.0.0.0/32' => ['127.0.0.0/32', true],
            '0.0.0.0/32' => ['0.0.0.0/32', true],
            '10.0.0.0/24' => ['10.0.0.0/24', true],
            '123.45.67.178/20' => ['123.45.67.178/20', false],
            '172.16.0.0/12' => ['172.16.0.0/12', true],
            '192.168.1.0/25' => ['192.168.1.0/25', true],
            '224.0.0.1/10' => ['224.0.0.1/10', false],
            '255.255.255.255/20' => ['255.255.255.255/20', false],
            '2001:0db8:85a3:0000:0000:8a2e:0370:7334/128' => ['2001:0db8:85a3:0000:0000:8a2e:0370:7334/128', true],
            '2001:0DB8:85A3:0000:0000:8A2E:0370:7334/128' => ['2001:0DB8:85A3:0000:0000:8A2E:0370:7334/128', true],
            '2001:0Db8:85a3:0000:0000:8A2e:0370:7334/32' => ['2001:0Db8:85a3:0000:0000:8A2e:0370:7334/32', false],
            'fdfe:dcba:9876:ffff:fdc6:c46b:bb8f:7d4c/28' => ['fdfe:dcba:9876:ffff:fdc6:c46b:bb8f:7d4c/28', false],
            'fdc6:c46b:bb8f:7d4c:fdc6:c46b:bb8f:7d4c/55' => ['fdc6:c46b:bb8f:7d4c:fdc6:c46b:bb8f:7d4c/55', false],
            'fdc6:c46b:bb8f:7d4c:0000:8a2e:0370:7334/60' => ['fdc6:c46b:bb8f:7d4c:0000:8a2e:0370:7334/60', false],
            'fe80:0000:0000:0000:0202:b3ff:fe1e:8329/20' => ['fe80:0000:0000:0000:0202:b3ff:fe1e:8329/20', false],
            'fe80:0:0:0:202:b3ff:fe1e:8329/4' => ['fe80:0:0:0:202:b3ff:fe1e:8329/4', false],
            'fe80::202:b3ff:fe1e:8329/0' => ['fe80::202:b3ff:fe1e:8329/0', false],
            '0:0:0:0:0:0:0:0/1' => ['0:0:0:0:0:0:0:0/1', true],
            '::/20' => ['::/20', true],
            '0::/120' => ['0::/120', true],
            '::0/128' => ['::0/128', true],
            '0::0/56' => ['0::0/56', true],
            '2001:0db8:85a3:0000:0000:8a2e:0.0.0.0/128' => ['2001:0db8:85a3:0000:0000:8a2e:0.0.0.0/128', true],
            '::0.0.0.0/128' => ['::0.0.0.0/128', true],
            '::255.255.255.255/32' => ['::255.255.255.255/32', false],
            '::123.45.67.178/120' => ['::123.45.67.178/120', false],
            '2a0c:eb00:0:f7::/64' => ['2a0c:eb00:0:f7::/64', true],
            '2a0c:eb00:0:f7:185:233:175:161/64' => ['2a0c:eb00:0:f7:185:233:175:161/64', false],
        ];
    }

    public static function getInvalid(): array
    {
        return [
            // Invalid IP addresses
            '0/20' => ['0/20'],
            '0.0/20' => ['0.0/20'],
            '0.0.0/20' => ['0.0.0/20'],
            '256.0.0.0/20' => ['256.0.0.0/20'],
            '0.256.0.0/21' => ['0.256.0.0/21'],
            '0.0.256.0/22' => ['0.0.256.0/22'],
            '0.0.0.256/30' => ['0.0.0.256/30'],
            '-1.0.0.0/15' => ['-1.0.0.0/15'],
            'foobar/10' => ['foobar/10'],
            'z001:0db8:85a3:0000:0000:8a2e:0370:7334/20' => ['z001:0db8:85a3:0000:0000:8a2e:0370:7334/20'],
            'fe80/100' => ['fe80/100'],
            'fe80:8329/15' => ['fe80:8329/15'],
            'fe80:::202:b3ff:fe1e:8329/128' => ['fe80:::202:b3ff:fe1e:8329/128'],
            'fe80::202:b3ff::fe1e:8329/48' => ['fe80::202:b3ff::fe1e:8329/48'],
            '2001:0db8:85a3:0000:0000:8a2e:0370:0.0.0.0/32' => ['2001:0db8:85a3:0000:0000:8a2e:0370:0.0.0.0/32'],
            '::0.0/32' => ['::0.0/32'],
            '::0.0.0/32' => ['::0.0.0/32'],
            '::256.0.0.0/32' => ['::256.0.0.0/32'],
            '::0.256.0.0/32' => ['::0.256.0.0/32'],
            '::0.0.256.0/32' => ['::0.0.256.0/32'],
            '::0.0.0.256/32' => ['::0.0.0.256/32'],
            '/32' => ['/32'],
            '/128' => ['/128'],

            // Valid IP addresses with invalid netmasks
            '192.168.1.0/-1' => ['192.168.1.0/-1'],
            '0.0.0.0/foobar' => ['0.0.0.0/foobar'],
            '123.45.67.178/aaa' => ['123.45.67.178/aaa'],
            '172.16.0.0//' => ['172.16.0.0//'],
            '255.255.255.255/1/4' => ['255.255.255.255/1/4'],
            '224.0.0.1' => ['224.0.0.1'],
            '127.0.0.0/28c' => ['127.0.0.0/28c'],
            '2001:0Db8:85a3:0000:0000:8A2e:0370:7334/28a' => ['2001:0Db8:85a3:0000:0000:8A2e:0370:7334/28a'],
            'fdfe:dcba:9876:ffff:fdc6:c46b:bb8f:7d4c/neko' => ['fdfe:dcba:9876:ffff:fdc6:c46b:bb8f:7d4c/neko'],
            'fdc6:c46b:bb8f:7d4c:fdc6:c46b:bb8f:7d4c/-8amba' => ['fdc6:c46b:bb8f:7d4c:fdc6:c46b:bb8f:7d4c/-8amba'],
            'fdc6:c46b:bb8f:7d4c:0000:8a2e:0370:7334/-1aa' => ['fdc6:c46b:bb8f:7d4c:0000:8a2e:0370:7334/-1aa'],
            'fe80:0000:0000:0000:0202:b3ff:fe1e:8329/11*' => ['fe80:0000:0000:0000:0202:b3ff:fe1e:8329/11*'],
            '127.0.0.0/40' => ['127.0.0.0/40'],
            '2001:0db8:85a3:0000:0000:8a2e:0.0.0.0/140' => ['2001:0db8:85a3:0000:0000:8a2e:0.0.0.0/140'],
            '10.0.0.0/128' => ['10.0.0.0/128'],
        ];
    }
}
