<?php

namespace BCleverly\Backend\Tests;

use BCleverly\Backend\BackendServiceProvider;
use Dotenv\Dotenv;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Application;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        $this->loadEnvironmentVariables();
        
        parent::setUp();

        $this->setUpDatabase($this->app);

        $this->withMiddleware([
           Authenticate::class
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            BackendServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    protected function loadEnvironmentVariables()
    {
        if (! file_exists(__DIR__.'/../.env')) {
            return;
        }

        $dotEnv = Dotenv::createImmutable(__DIR__.'/..');

        $dotEnv->load();
    }

    /**
     * @param  Application  $app
     */
    protected function setUpDatabase(Application $app)
    {
        $festivals = require  './database/migrations/create_festival_tables.php.stub';
        (new $festivals())->up();
    }
}
