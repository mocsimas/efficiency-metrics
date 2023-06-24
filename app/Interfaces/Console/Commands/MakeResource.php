<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Foundation\Console\ResourceMakeCommand;
use Illuminate\Support\Str;

class MakeResource extends ResourceMakeCommand
{
    protected function getPath($name)
    {
        $name = Str::replaceFirst(parent::rootNamespace(), '', $name);

        $fileName = str_replace('\\', '/', $name);

        return $this->laravel['path']."/$fileName.php";
    }

    protected function rootNamespace()
    {
        return 'App\\Infrastructure\\Resource\\';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->collection()
                    ? $this->resolveStubPath('/stubs/resource-collection.stub')
                    : $this->resolveStubPath('/app/Infrastructure/Stubs/resource.stub');
    }
}
