<?php
namespace Rainsens\Map\Components;

use Rainsens\Map\BaseMap;
use Rainsens\Map\Contracts\GeoFenceInterface;
use Rainsens\Map\Exceptions\HttpException;
use Rainsens\Map\Exceptions\InvalidArgumentException;

class GeoFence extends BaseMap implements GeoFenceInterface
{
	/**
	 * POST
	 * @var string
	 */
	private $createUrl = 'https://restapi.amap.com/v4/geofence/meta';
	
	/**
	 * GET
	 * @var string
	 */
	private $searchUrl = 'https://restapi.amap.com/v4/geofence/meta';
	
	/**
	 * PATCH
	 * @var string
	 */
	private $updateUrl = 'https://restapi.amap.com/v4/geofence/meta';
	
	/**
	 * PATCH
	 * @var string
	 */
	private $enableUrl = 'https://restapi.amap.com/v4/geofence/meta';
	
	/**
	 * DELETE
	 * @var string
	 */
	private $deleteUrl = 'https://restapi.amap.com/v4/geofence/meta';
	
	/**
	 * GET
	 * @var string
	 */
	private $monitorUrl = 'https://restapi.amap.com/v4/geofence/status';
	
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	public function create(array $params): array
	{
		if (empty($params['name'])) {
			throw new InvalidArgumentException('Invalid argument name.');
		}
		
		if (empty($params['center']) && empty($params['radius']) && empty($params['points'])) {
			throw new InvalidArgumentException('Either center or points have to choose.');
		}
		
		try {
			$response = $this->getHttpClient()
				->post($this->createUrl, ['query' => ['key' => $this->key], 'json' => $params])
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