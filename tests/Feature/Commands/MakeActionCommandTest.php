<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

function cleanUp(): void
{
    $actionPath = app_path('Actions/CreateUserAction.php');

    if (File::exists($actionPath)) {
        File::delete($actionPath);
    }
}

beforeEach(fn () => cleanUp());
afterEach(fn () => cleanUp());

it('creates a new action file', function (string $actionName): void {
    $exitCode = Artisan::call('make:action', ['name' => $actionName]);

    expect($exitCode)->toBe(0);

    $expectedFilePath = app_path('Actions/CreateUserAction.php');

    expect(File::exists($expectedFilePath))->toBeTrue();

    expect(File::get($expectedFilePath))
        ->toContain('declare(strict_types=1);')
        ->toContain('namespace App\Actions;')
        ->toContain('final readonly class CreateUserAction')
        ->toContain('public function handle()');
})->with([
    'CreateUserAction',
    'CreateUserAction.php',
]);

it('fils when the action already exists', function (): void {
    $actionName = 'CreateUserAction';

    Artisan::call('make:action', ['name' => $actionName]);

    $exitCode = Artisan::call('make:action', ['name' => $actionName]);

    expect($exitCode)->toBe(1);
});

it('add suffix "Action" to action name if not provided', function (string $actionName): void {
    $exitCode = Artisan::call('make:action', ['name' => $actionName]);

    expect($exitCode)->toBe(0);

    $expectedFilePath = app_path('Actions/CreateUserAction.php');

    expect(File::exists($expectedFilePath))->toBeTrue();

    expect(File::get($expectedFilePath))
        ->toContain('final readonly class CreateUserAction');
})->with([
    'CreateUser',
    'CreateUser.php',
]);
