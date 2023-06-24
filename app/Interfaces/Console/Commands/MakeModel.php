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

        return $this->replaceNamespace($stub, $name)
            ->replaceClass($stub, $name);
    }
}
