<?php
namespace Rainsens\Map\Contracts;

interface GeoFenceInterface
{
	public function create();
	public function search();
	public function update();
	public function enable();
	public function disable();
	public function delete();
	public function monitor();
}