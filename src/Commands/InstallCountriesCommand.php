<?php

namespace BCleverly\Backend\Commands;

use BCleverly\Backend\Models\Country;
use Illuminate\Console\Command;

class InstallCountriesCommand extends Command
{
    public $signature = 'backend:install-countries';

    public $description = 'Automatically installs countries for ease of use';

    private array $countries;

    public function __construct()
    {
        parent::__construct();

        $this->countries = json_decode(file_get_contents(__DIR__.'/../../data/world_countries.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    public function handle(): int
    {
        if (Country::count() > 0) {
            $this->alert('Countries already in place.');

            return 0;
        }

        $this->withProgressBar($this->countries, function ($country) {
            Country::create($country);
        });
        $this->comment('All done');

        return 0;
    }
}
