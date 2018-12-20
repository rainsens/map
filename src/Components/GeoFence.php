<?php
namespace Rainsens\Map\Components;

use Rainsens\Map\BaseMap;
use Rainsens\Map\Contracts\GeoFenceInterface;
use Rainsens\Map\Exceptions\HttpException;

class GeoFence extends BaseMap implements GeoFenceInterface
{
	protected $url = 'https://restapi.amap.com/v4/geofence/meta';
	
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	public function create(array $params): array
	{
		try {
			$response = $this->getHttpClient()
				->post($this->url, ['query' => ['key' => $this->key], 'json' => $params])
				->getBody()->getContents();
			$result = json_decode($response, true);
			return [
				'status' => isset($result['data']['id']) ? 'success' : 'failed',
				'result' => $result
			];
		} catch (\Exception $e) {
			throw new HttpException($e->getMessage(), $e->getCode(), $e);
		}
	}
	
	public function search(array $params): array
	{
		// TODO: Implement search() method.
	}
}