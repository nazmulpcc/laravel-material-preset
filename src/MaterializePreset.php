<?php

namespace nazmulpcc\LaravelMaterialize;

use File;
use Artisan;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class MaterializePreset extends Preset
{
	/**
     * Install materialize preset.
     *
     * @return void
     */
	public static function install($command)
	{
		static::updatePackages();
		static::updateSass();
		static::updateScripts();
		static::updateWebPack();
		static::updateViews($command);
		// static::update();
	}

	/*
	* Update packages array
	*
	* @param array $packages
	* @return array
	 */
	public static function updatePackageArray(array $packages)
	{
		return [
			'jquery' => '^3.2.1',
			'materialize-css' => 'next'
		] + Arr::except($packages, ['bootstrap', 'lodash', 'popper.js', 'vue']);
	}

	/*
	* Update the sass files
	 */
	 public static function updateSass()
	 {
	 	File::cleanDirectory(resource_path('sass'));
		copy(__DIR__. '/stubs/app.scss', resource_path('sass/app.scss'));
	 }

	 /*
	 * Update the JS directory
	  */
	 public static function updateScripts()
	 {
	 	File::cleanDirectory(resource_path('js'));
		copy(__DIR__. '/stubs/bootstrap.js', resource_path('js/bootstrap.js'));
		copy(__DIR__. '/stubs/app.js', resource_path('js/app.js'));
	 }

	 /*
	 * Update the webpack config file
	  */
	 public static function updateWebPack()
	 {
	 	copy(__DIR__. '/stubs/webpack.mix.js', base_path('webpack.mix.js'));
	 }

	 public static function updateViews($command)
	 {
		 if(file_exists(resource_path('views/welcome.blade.php'))){
			 if($command->confirm("The file resources/views/welcome.blade.php already exists. Are you sure you want to override it?", true)){
				 copy(__DIR__. '/stubs/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
			 }
		 }
	 }
}
