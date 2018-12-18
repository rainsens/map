<?php
namespace Rainsens\Map;

use Rainsens\Map\Components\GeoCode;

class Map
{
	const VERSION = '2.0.0';
	
	protected $key;
	
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	public function GeoCode()
    {
    	return new GeoCode($this->key);
	}
}
