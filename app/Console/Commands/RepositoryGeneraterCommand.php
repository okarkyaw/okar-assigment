<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class RepositoryGeneraterCommand extends GeneratorCommand
{
   
    protected $name = 'make:repository';

    protected $description = 'Create Repository File';

    protected $type = 'Repository';

    protected function getStub(){
        return __DIR__ . '/stubs/repository.stub';
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Repositories';
    }
}