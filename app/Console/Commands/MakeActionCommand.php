<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

final class MakeActionCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name : The name of the action class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Action';

    /**
     * Execute the console command.
     */
    public function handle(): ?bool
    {
        $actionName = $this->getNameInput();
        $actionPath = app_path("Actions/{$actionName}.php");

        if (File::exists($actionPath)) {
            $this->fail("The action {$actionName} already exists.");
        }

        return parent::handle();
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('/stubs/action.stub');
    }

    /**
     * Get the desired class name from the input.
     */
    protected function getNameInput(): string
    {
        return Str::of($this->argument('name'))
            ->trim()
            ->before('.php')
            ->before('Action')
            ->append('Action')
            ->toString();
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }
}
