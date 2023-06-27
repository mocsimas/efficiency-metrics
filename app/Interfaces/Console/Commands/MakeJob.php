<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\JobMakeCommand;

class MakeJob extends JobMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('sync')
                        ? $this->resolveStubPath('/stubs/job.stub')
                        : $this->resolveStubPath('/app/Infrastructure/Stubs/job.queued.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Interfaces\Http\Jobs';
    }
}
