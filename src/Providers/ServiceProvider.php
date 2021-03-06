<?php
namespace Rainsens\Map\Providers;

use Rainsens\Map\Map;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
    	$this->app->singleton('map', function () {
    		return new Map(config('services.map.key'));
	    });
    }
    
    public function provides()
    {
    	return [Map::class, 'map'];
    }
}
