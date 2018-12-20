<?php
namespace Rainsens\Map\Contracts;

interface GeoFenceInterface
{
	/**
	 * Create a new fence.
	 *
	 * [
	 *      name            => 'A Name',
	 *
	 *      // Either one
	 *      center          => '115.672126,38.817129',
	 *      radius          => '1000',
	 *      points          => '',
	 *
	 *      enable          => '',
	 *      valid_time      => '2020-12-31'
	 *      repeat          => '',
	 *      fixed_date      => '',
	 *      time            => '',
	 *      desc            => '',
	 *      alert_condition => 'enter;leave',
	 * ]
	 * @param array $params
	 * @return array
	 */
	public function create(array $params): array ;
	
	/**
	 * Search an existing fence.
	 *
	 * [
	 *      id          => '',
	 *      gid         => '',
	 *      name        => '',
	 *      page_no     => '',
	 *      page_size   => '',
	 *      enable      => '',
	 *      start_time  => '',
	 *      end_time    => '',
	 * ]
	 *
	 * @param array $params
	 * @return array
	 */
	public function search(array $params): array ;
	
	/**
	 * Update an existing fence.
	 *
	 * [
	 *      gid                 => 'e7859ac4-4e57-4078-bb1a-d940b0158b4d',
	 *      name                => '更新圆形围栏',
	 *
	 *      // Either one
	 *      center              => '116.328037,39.962379',
	 *      radius              => '1148.8',
	 *      points              => '',
	 *
	 *      enable              => '',
	 *      valid_time          => '',
	 *      repeat              => '',
	 *      fixed_date          => '',
	 *      time                => '',
	 *      desc                => '',
	 *      alert_condition     => '',
	 * ]
	 *
	 * @param array $params
	 * @return array
	 */
	public function update(array $params): array ;
	
	/**
	 * Enable or disable an existing fence.
	 *
	 * @param string $gid
	 * @param bool $status
	 * @return array
	 */
	public function enable(string $gid, bool $status = true): array ;
	
	/**
	 * Delete an existing fence.
	 *
	 * @param string $gid
	 * @return array
	 */
	public function delete(string $gid): array ;
	
	/**
	 * Match the equipments near by fence.
	 *
	 * [
	 *      diu         => 'imei/idfv',
	 *      uid         => '',
	 *      locations   => '116.472407,39.993322,1484816232',
	 *      sig         => '',
	 * ]
	 *
	 * @param array $params
	 * @return array
	 */
	public function monitor(array $params): array ;
	
}