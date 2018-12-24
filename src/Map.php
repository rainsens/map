<?php
namespace Rainsens\Map;

use Rainsens\Map\Components\GeoCode;
use Rainsens\Map\Components\GeoFence;

class Map
{
	const VERSION = '2.1.1';
	
	/**
	 * @var string
	 */
	protected $key;
	
	/**
	 * Map constructor.
	 * @param string $key
	 */
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	/**
	 * @return GeoCode
	 */
	public function geoCode()
    {
    	return new GeoCode($this->key);
	}
	
	/**
	 * @return GeoFence
	 */
	public function geoFence()
	{
		return new GeoFence($this->key);
	}
}
