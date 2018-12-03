<?php

/*
 * This file is part of the rainsens/map.
 *
 * (c) rainsens <yusen@rainsen.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rainsens\Map;

use GuzzleHttp\Client;
use Rainsens\Map\Exceptions\Exception;
use Rainsens\Map\Exceptions\HttpException;
use Rainsens\Map\Exceptions\InvalidArgumentException;

class Map
{
    protected $key;

    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }
	
	public function setGuzzleOptions(array $options)
	{
		$this->guzzleOptions = $options;
	}

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function getGeocode($address, $city, $format = 'json', $batch = 'false')
    {
        if (!in_array(strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if (!in_array(strtolower($batch), ['true', 'false'])) {
            throw new InvalidArgumentException('Invalid boolean value(true/false): '.$batch);
        }
        
        $url = 'https://restapi.amap.com/v3/geocode/geo';

        $query = array_filter([
            'key'       => $this->key,
            'address'   => $address,
            'city'      => $city,
            'output'    => strtolower($format),
            'batch'     => $batch,
        ]);

        try {
            $response = $this->getHttpClient()->get($url, ['query' => $query])->getBody()->getContents();
            return $format === 'json' ? json_decode($response, true) : $response;
        } catch (Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
