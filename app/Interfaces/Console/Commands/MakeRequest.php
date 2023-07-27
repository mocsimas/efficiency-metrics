<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Foundation\Console\RequestMakeCommand;

class MakeRequest extends RequestMakeCommand
{
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Infrastructure\Requests';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/app/Infrastructure/Stubs/request.stub');
    }
}
