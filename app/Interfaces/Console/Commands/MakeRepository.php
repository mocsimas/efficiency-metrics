<?php

namespace App\Interfaces\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRepository extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new repository class';

    protected $type = 'Repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (parent::handle() === false && !$this->option('force'))
            return false;
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/app/Infrastructure/Stubs/repository.stub');
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

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return is_dir(app_path('Models')) ? $rootNamespace.'\\Models' : $rootNamespace;
    }

    protected function rootNamespace()
    {
        return 'App\\Domain\\Models\\';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceModel($stub, $name)
            ->replaceClass($stub, $name);
    }

    protected function replaceModel(&$stub, $name) {
        $explodedName = explode('\\', $name);

        $model = Str::studly($explodedName[array_key_last($explodedName)]);
        if(Str::endsWith($model, 'Repository'))
            $model = substr($model, 0, strlen($model) - 10);

        $stub = str_replace('{{ model }}', Str::singular($model), $stub);


        return $this;
    }
}
