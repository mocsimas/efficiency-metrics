<?php

namespace App\Infrastructure\Base;

use App\Infrastructure\Traits\Test\CustomAssertionsTrait;
use App\Infrastructure\Traits\Test\NotifiableTestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class BaseFeatureTest extends TestCase
{
    use RefreshDatabase, NotifiableTestTrait, CustomAssertionsTrait;

    protected function setUp(): void {
        parent::setUp();
    }

    protected function assertPreConditions(): void {
        parent::assertPreConditions();
    }
}
