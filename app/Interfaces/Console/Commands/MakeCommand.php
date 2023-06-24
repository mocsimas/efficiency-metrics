<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Foundation\Console\ConsoleMakeCommand;

class MakeCommand extends ConsoleMakeCommand
{
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $relativePath = '/app/Infrastructure/Stubs/console.stub';

        return file_exists($customPath = $this->laravel->basePath(trim($relativePath, '/')))
            ? $customPath
            : __DIR__.$relativePath;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Interfaces\Console\Commands';
    }
}
