<?php
namespace Rainsens\Map;

use Rainsens\Map\Components\GeoCode;
use Rainsens\Map\Components\GeoFence;

class Map
{
	const VERSION = '2.0.0';
	
	protected $key;
	
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	public function geoCode()
    {
    	return new GeoCode($this->key);
	}
	
	public function geoFence()
	{
		return new GeoFence($this->key);
	}
}
