<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Foundation\Console\ListenerMakeCommand;

class MakeListener extends ListenerMakeCommand
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Application\Listeners';
    }
}
