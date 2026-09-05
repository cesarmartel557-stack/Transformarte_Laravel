<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use Sujip\Filament\Turnstile\Contracts\TurnstileClientContract;
use Sujip\Filament\Turnstile\Support\TurnstileVerificationResult;

abstract class TestCase extends BaseTestCase
{
    /**
     * Configura un mock para la verificación de Cloudflare Turnstile en tests.
     */
    protected function fakeTurnstile(bool $success = true): void
    {
        $mock = Mockery::mock(TurnstileClientContract::class);
        $mock->shouldReceive('siteKey')->andReturn('test-site-key');
        $mock->shouldReceive('isConfigured')->andReturn(true);
        $mock->shouldReceive('verify')->andReturn(
            new TurnstileVerificationResult(
                success: $success,
                errorCodes: $success ? [] : ['invalid-input-response'],
            )
        );

        $this->app->instance(TurnstileClientContract::class, $mock);
    }
}
