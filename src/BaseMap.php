<?php
namespace Rainsens\Map;

use GuzzleHttp\Client;

abstract class BaseMap
{
	protected $key;
	protected $url;
	protected $guzzleOptions = [];
	
	public function setGuzzleOptions(array $options)
	{
		$this->guzzleOptions = $options;
	}
	
	public function getHttpClient()
	{
		return new Client($this->guzzleOptions);
	}
}