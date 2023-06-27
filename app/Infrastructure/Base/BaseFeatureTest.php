<?php

namespace App\Infrastructure\Base;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
    }

    protected function assertPreConditions(): void {
        parent::assertPreConditions();
    }
}
