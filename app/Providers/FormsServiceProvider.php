<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class FormsServiceProvider extends ServiceProvider {
	
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot() {
    $txtDebug = "FormsServiceProvider->boot()";
    ///echo "<pre>{$txtDebug}</pre>";
    //die("<pre>{$txtDebug}</pre>");
  }
  
  /**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return array('foo');
	}

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register() {
    $txtDebug = "FormsServiceProvider->register()";
    $this->app->bindShared('forms', function() {
    	//die("Foo-ing");
			//return new Foo();
			return new App\Forms;
    });
    ///echo "<pre>{$txtDebug}</pre>";
    ///die("<pre>{$txtDebug}</pre>");
  }
}
