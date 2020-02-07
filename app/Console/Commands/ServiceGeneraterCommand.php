<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class ServiceGeneraterCommand extends GeneratorCommand
{
   
    protected $name = 'make:service';

    protected $description = 'Create Service File';

    protected $type = 'Service';

    protected function getStub(){
        return __DIR__ . '/stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace){
        return $rootNamespace . '\Services';
    }
}