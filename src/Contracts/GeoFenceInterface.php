<?php
namespace Rainsens\Map\Contracts;

interface GeoFenceInterface
{
	/**
	 * Create a new fence.
	 *
	 * [
	 *      name            => 'A Name',
	 *      center          => '115.672126,38.817129',
	 *      radius          => '1000',
	 *      points          => '',
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
	public function search(array $params): array ;
}