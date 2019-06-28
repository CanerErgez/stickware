<?php

namespace Caner\Stickware\Tests;

use Caner\Stickware\StickwareServiceProvider;
use Caner\Stickware\Tests\Stubs\Models\User;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/../migrations/');
        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate', ['--database' => 'testbench']);
        $this->setUpBaseModels();
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        Eloquent::unguard();
    }

    /**
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [StickwareServiceProvider::class];
    }

    protected function setUpBaseModels()
    {
        /** @var User $user */
        User::create([
            'email' => 'test@test.com',
            'name' => 'Test Account',
            'password' => bcrypt('123456')
        ]);
    }
}