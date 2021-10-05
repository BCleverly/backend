<?php

namespace BCleverly\Backend\Commands;

use BCleverly\Backend\BackendServiceProvider;
use Illuminate\Console\Command;
use OwenIt\Auditing\AuditingServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

class InstallBackend extends Command
{
    public $signature = 'backend:install';

    public $description = 'Trigger all third party dependencies to allow the dashboard to run.';

    protected array $providerConfigs = [
        [
            '--provider' => AuditingServiceProvider::class,
            '--tag' => 'config',
        ],
    ];

    protected array $providerMigrations = [
        [
            '--provider' => AuditingServiceProvider::class,
            '--tag' => 'migrations',
        ],
    ];

    protected array $providers = [
        [
            '--provider' => PermissionServiceProvider::class,
        ],
        [
            '--provider' => BackendServiceProvider::class,
        ],
        [
            '--provider' => MediaLibraryServiceProvider::class,
        ],
    ];

    protected array $providerAssets = [
        [
            '--provider' => BackendServiceProvider::class,
            '--tag' => 'assets',
        ],
    ];

    public function __construct(protected \Illuminate\Contracts\Console\Kernel $kernel)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Getting configs...');
        foreach ($this->providerConfigs as $config) {
            $this->kernel->call('vendor:publish', $config);
        }

        $this->info('Getting migrations...');
        foreach ($this->providerMigrations as $config) {
            $this->kernel->call('vendor:publish', $config);
        }
        foreach ($this->providers as $config) {
            $this->kernel->call('vendor:publish', $config);
        }

        $this->info('Getting assets...');
        foreach ($this->providerAssets as $config) {
            $this->kernel->call('vendor:publish', $config);
        }

        return 0;
    }
}
