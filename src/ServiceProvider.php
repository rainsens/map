<?php

/*
 * This file is part of the rainsens/weather.
 *
 * (c) rainsens <yusen@rainsen.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE. 
 */

namespace Rainsens\Map;

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
