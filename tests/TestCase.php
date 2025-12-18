<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->preventRealHttpRequest();
        $this->fakeSleep();
    }

    // ---------------
    // Helper methods
    // ---------------

    private function preventRealHttpRequest(): void
    {
        Http::preventStrayRequests();
    }

    private function fakeSleep(): void
    {
        Sleep::fake();
    }
}
