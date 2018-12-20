<?php
namespace Rainsens\Map\Components;

use Rainsens\Map\BaseMap;
use Rainsens\Map\Exceptions\HttpException;
use Rainsens\Map\Contracts\GeoCodeInterface;
use Rainsens\Map\Exceptions\InvalidArgumentException;

class GeoCode extends BaseMap implements GeoCodeInterface
{
	/**
	 * @var string
	 */
	protected $url = 'https://restapi.amap.com/v3/geocode/geo';
	
	/**
	 * GeoCode constructor.
	 * @param string $key
	 */
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	/**
	 * @param string $address
	 * @param string $city
	 * @param string $format
	 * @return mixed|string
	 */
	public function get(string $address, string $city, string $format = 'json')
	{
		if (!is_array($address)) $address = [$address];
		
		if (!in_array(strtolower($format), ['xml', 'json'])) {
			throw new InvalidArgumentException('Invalid response format: '.$format);
		}
		
		$query = array_filter([
			'key'       => $this->key,
			'address'   => implode('|', $address),
			'city'      => $city,
			'output'    => strtolower($format),
			'batch'     => 'true',
		]);
		
		try {
			$response = $this->getHttpClient()->get($this->url, ['query' => $query])->getBody()->getContents();
			return $format === 'json' ? json_decode($response, true) : $response;
		} catch (\Exception $e) {
			throw new HttpException($e->getMessage(), $e->getCode(), $e);
		}
	}
}