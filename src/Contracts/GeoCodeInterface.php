<?php
namespace Rainsens\Map\Contracts;

interface GeoCodeInterface {
	/**
	 * Get a geo code for a specified address.
	 *
	 * @param string $address
	 * @param string $city
	 * @param string $format
	 * @return mixed
	 */
	public function get(string $address, string $city, string $format = 'json');
}