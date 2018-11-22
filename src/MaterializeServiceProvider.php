<?php

namespace nazmulpcc\LaravelMaterialize;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class MaterializeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('materialize', function ($command)
        {
			MaterializePreset::install($command);
			$command->info("Materialize preset has been installed successfully.");
			$command->info("Visit https://materializecss.com/getting-started.html for documentation.");
			$command->comment("Pleas run 'npm install && npm run dev' to compile the fresh scaffolding.");
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
