<?php
namespace Rainsens\Map\Contracts;

interface GeoCodeInterface {
	public function get(string $address, string $city, string $format = 'json');
}