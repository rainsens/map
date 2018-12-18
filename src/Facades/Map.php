<?php
namespace Rainsens\Map\Facades;

use Illuminate\Support\Facades\Facade;

class Map extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'map';
	}
}