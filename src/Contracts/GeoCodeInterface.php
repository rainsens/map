<?php
namespace Rainsens\Map\Contracts;

interface GeoCodeInterface {
	public function getGeoCode(string $address, string $city, string $format = 'json');
}