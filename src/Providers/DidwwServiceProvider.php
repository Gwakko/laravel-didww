<?php

namespace Didww\Providers;

use Illuminate\Support\ServiceProvider;

class DidwwServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        //
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('didww', function($app) {
		    return new \Didww\Didww;
		});

		$this->app->booting(function() {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Didww', 'Didww\Facades\Didww');
		});

        $configPath = config_path('didww.php');
        if (!\Illuminate\Support\Facades\File::exists($configPath)) {
            $this->publishes([
                __DIR__ . '/../config/didww.php' => $configPath
            ]);
        }

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('didww');
	}

}
