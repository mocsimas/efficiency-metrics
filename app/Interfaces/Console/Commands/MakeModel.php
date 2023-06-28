<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;

class MakeModel extends ModelMakeCommand
{
    public function handle()
    {
        parent::handle();

        $this->call('make:repository', [
            'name' => str_replace('\\', '/', $this->getNameInput()) . 'Repository'
        ]);
        $this->call('make:resource', [
            'name' => str_replace('\\', '/', $this->getNameInput()) . 'Resource'
        ]);
    }

    protected function getStub()
    {
        if ($this->option('pivot')) {
            return $this->resolveStubPath('/stubs/model.pivot.stub');
        }

        if ($this->option('morph-pivot')) {
            return $this->resolveStubPath('/stubs/model.morph-pivot.stub');
        }

        return $this->resolveStubPath('/app/Infrastructure/Stubs/model.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst(parent::rootNamespace(), '', $name);

        $fileName = str_replace('\\', '/', $name);

        return $this->laravel['path']."/$fileName.php";
    }

    protected function rootNamespace()
    {
        return 'App\\Domain\\Models\\';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $stub = $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

        return $this->replaceResource($stub, $name);
    }

    /**
     * Replace the resource names for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceResource($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

//        $replacedStub = str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);

//        if(Str::startsWith($name, $this->rootNamespace()))
//            Str::replaceFirst('private-', 'private:', $channel)

        $path = Str::replaceFirst($this->rootNamespace(), '', $name);

        $pathSegments = explode('\\', $path);

        $domain = implode('\\', array_slice($pathSegments, 0, count($pathSegments) - 1));

        $resourceModel = $pathSegments[count($pathSegments) - 1] . 'Resource';

        $replacedStub = str_replace(['{{ resourceNamespace }}', '{{resourceNamespace}}'], "App\Infrastructure\Resource\\$domain\\$resourceModel", $stub);
        $replacedStub = str_replace(['{{ resourceModel }}', '{{resourceModel}}'], $resourceModel, $replacedStub);

        return $replacedStub;
    }
}
