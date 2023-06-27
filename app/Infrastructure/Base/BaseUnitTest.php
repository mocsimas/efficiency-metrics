<?php

namespace App\Infrastructure\Base;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

abstract class BaseUnitTest extends TestCase
{
    use CreatesApplication, RefreshDatabase;
}
