<?php

namespace Cyberfusion\ValidationRules;

use Illuminate\Support\ServiceProvider;

class ValidationRulesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'cyberfusion_validation_rules');

        $this->publishes([
            __DIR__.'/../resources/lang' => lang_path('vendor/cyberfusion_validation_rules'),
        ]);
    }
}
