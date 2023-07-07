<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\EventMakeCommand;

class MakeEvent extends EventMakeCommand
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Domain\Events';
    }
}
