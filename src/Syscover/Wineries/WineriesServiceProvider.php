<?php namespace Syscover\Wineries;

use Illuminate\Support\ServiceProvider;

class WineriesServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// include route.php file
		if (!$this->app->routesAreCached())
			require __DIR__ . '/../../routes.php';

		// register views
		$this->loadViewsFrom(__DIR__ . '/../../views', 'wineries');

        // register translations
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'wineries');

        // register public files
        $this->publishes([
            __DIR__ . '/../../../public' 					=> public_path('/packages/syscover/wineries')
        ]);

        // register config files
        $this->publishes([
            __DIR__ . '/../../config/wineries.php' 			=> config_path('wineries.php')
        ]);

        // register migrations
        $this->publishes([
            __DIR__ . '/../../database/migrations/' 		=> base_path('/database/migrations'),
            __DIR__ . '/../../database/migrations/updates/' => base_path('/database/migrations/updates'),
        ], 'migrations');

        // register seeds
        $this->publishes([
            __DIR__ . '/../../database/seeds/' 				=> base_path('/database/seeds')
        ], 'seeds');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        //
	}
}