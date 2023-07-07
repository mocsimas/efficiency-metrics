<?php

namespace App\Domain\Events\Import;

use App\Domain\Models\Import\Import;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportEnded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private readonly Import $import,
    ) {}

//    public function broadcastOn(): array
//    {
//        return [
//            new PrivateChannel('channel-name'),
//        ];
//    }
}
