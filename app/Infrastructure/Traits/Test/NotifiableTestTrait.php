<?php

namespace App\Infrastructure\Traits\Test;

use PHPUnit\Event;

trait NotifiableTestTrait
{
    protected function markTestAsRisky(string $message): void {
        Event\Facade::emitter()->testConsideredRisky($this->valueObjectForEvents(), $message);
    }
}
