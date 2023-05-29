<?php

namespace Cyberfusion\ValidationRules\Tests;

use Cyberfusion\ValidationRules\ValidationRulesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            ValidationRulesServiceProvider::class,
        ];
    }
}
