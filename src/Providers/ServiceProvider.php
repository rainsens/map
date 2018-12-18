<?php
namespace Rainsens\Map\Providers;

use Rainsens\Map\Map;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
    	$this->app->singleton(Map::class, function () {
    		return new Map(config('services.map.key'));
	    });
    	$this->app->alias(Map::class, 'map');
    }
    
    public function provides()
    {
    	return [Map::class, 'map'];
    }
}
