<?php

namespace App\Infrastructure\Traits\Test;

use Carbon\Carbon;

trait CustomAssertionsTrait
{
    protected function assertIsDate(string $date) {
        $this->assertIsString($date);

        $isValidDate = false;

        try {
            $parsedDate = Carbon::parse($date);
            $isValidDate = true;
        } catch (\Exception $exception) {}

        $this->assertTrue($isValidDate);
    }
}
