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
	
	/**
	 * '0123456789imei'
	 * '0123456789idfv'
	 * @var string
	 */
	private $defaultEquipmentId = '0123456789';
	
	/**
	 * GeoFence constructor.
	 * @param string $key
	 */
	public function __construct(string $key)
	{
		$this->key = $key;
	}
	
	/**
	 * @param array $params
	 * @return array
	 */
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
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
	
	/**
	 * @param array $params
	 * @return array
	 */
	public function search(array $params): array
	{
		$params['key'] = $this->key;
		try {
			$response = $this->getHttpClient()->get($this->searchUrl, ['query' => $params])->getBody()->getContents();
			return json_decode($response, true);
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
	
	/**
	 * @param array $params
	 * @return array
	 */
	public function update(array $params): array
	{
		if (empty($params['name'])) {
			throw new InvalidArgumentException('Invalid argument name.');
		}
		
		if (empty($params['gid'])) {
			throw new InvalidArgumentException('Invalid argument gid.');
		}
		
		if (empty($params['center']) && empty($params['radius']) && empty($params['points'])) {
			throw new InvalidArgumentException('Either center or points have to choose.');
		}
		
		$query = ['key' => $this->key, 'gid' => $params['gid']];
		unset($params['gid']);
		try {
			$response = $this->getHttpClient()
				->patch($this->updateUrl, ['query' => $query, 'json' => $params])
				->getBody()->getContents();
			$result = json_decode($response, true);
			return [
				'status' => isset($result['data']['status']) && (int)$result['data']['status'] === 0 ? 'success' : 'failed',
				'result' => $result,
			];
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
	
	/**
	 * @param string $gid
	 * @param bool $status
	 * @return array
	 */
	public function enable(string $gid, bool $status = true): array
	{
		if (empty($gid)) {
			throw new InvalidArgumentException('Invalid argument gid.');
		}
		
		$query = ['key' => $this->key, 'gid' => $gid];
		try {
			$response = $this->getHttpClient()
				->patch($this->enableUrl, ['query' => $query, 'json' => ['enable' => $status]])
				->getBody()->getContents();
			$result = json_decode($response, true);
			return [
				'status' => isset($result['data']['status']) && (int)$result['data']['status'] === 0 ? 'success' : 'failed',
				'result' => $result
			];
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
	
	/**
	 * @param string $gid
	 * @return array
	 */
	public function delete(string $gid): array
	{
		if (empty($gid)) {
			throw new InvalidArgumentException('Invalid argument gid.');
		}
		
		$query = ['key' => $this->key, 'gid' => $gid];
		
		try {
			$response = $this->getHttpClient()->delete($this->deleteUrl, ['query' => $query])->getBody()->getContents();
			$result = json_decode($response, true);
			return [
				'status' => isset($result['data']['status']) && (int)$result['data']['status'] === 0 ? 'success' : 'failed',
				'result' => $result,
			];
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
	
	/**
	 * @param array $params
	 * @return array
	 */
	public function monitor(array $params): array
	{
		if (empty($params['diu'])) {
			throw new InvalidArgumentException('Invalid argument diu.');
		}
		
		$params['key'] = $this->key;
		$params['diu'] = $this->defaultEquipmentId . $params['diu'];
		
		try {
			$response = $this->getHttpClient()->get($this->monitorUrl, ['query' => $params])->getBody()->getContents();
			$result = json_decode($response, true);
			return [
				'status' => isset($result['data']['status']) && (int)$result['data']['status'] === 0 ? 'success' : 'failed',
				'result' => $result,
			];
		} catch (\Exception $exception) {
			throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
		}
	}
}