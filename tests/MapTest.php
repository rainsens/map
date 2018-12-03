<?php

/*
 * This file is part of the rainsens/map.
 *
 * (c) rainsens <yusen@rainsen.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rainsens\Map\Tests;

use Mockery;
use Rainsens\Map\Map;
use GuzzleHttp\Client;
use Mockery\Matcher\AnyArgs;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Rainsens\Map\Exceptions\Exception;
use Rainsens\Map\Exceptions\HttpException;
use Rainsens\Map\Exceptions\InvalidArgumentException;

class MapTest extends TestCase
{
    public function testGetGeocodeWithInvalidFormat()
    {
        $map = new Map('mock-key');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid response format: array');

        $map->getGeocode('北京市朝阳区阜通东大街6号', '北京', 'array');

        $this->fail('Failed to assert getGeocode throw exception with invalid argument.');
    }

    public function testGetGeocodeWithGuzzleRuntimeException()
    {
        $client = Mockery::mock(Client::class);
        $client->allows()->get(new AnyArgs())->andThrow(new Exception('request timeout'));

        $map = Mockery::mock(Map::class, ['mock-key'])->makePartial();
        $map->allows()->getHttpClient()->andReturn($client);

        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('request timeout');

        $map->getGeocode('北京市朝阳区阜通东大街6号', '北京');
    }

    public function testGetHttpClient()
    {
        $map = new Map('mock-key');
        $this->assertInstanceOf(ClientInterface::class, $map->getHttpClient());
    }

    public function testSetGuzzleOptions()
    {
        $map = new Map('mock-key');
        $this->assertNull($map->getHttpClient()->getConfig('timeout'));

        $map->setGuzzleOptions(['timeout' => 5000]);
        $this->assertSame(5000, $map->getHttpClient()->getConfig('timeout'));
    }

    public function testGetGeocode()
    {
        //----- Test argument json --------------------------------------------------
        $response = new Response(200, [], '{"success": true}');
        $client = Mockery::mock(Client::class);
        $client->allows()->get('https://restapi.amap.com/v3/geocode/geo', [
            'query' => [
                'key'       => 'mock-key',
                'address'   => '北京市朝阳区阜通东大街6号',
                'city'      => '北京',
                'output'    => 'json',
	            'batch'     => 'true',
            ],
        ])->andReturn($response);
        $map = Mockery::mock(Map::class, ['mock-key'])->makePartial();
        $map->allows()->getHttpClient()->andReturn($client);
        $this->assertSame(['success' => true], $map->getGeocode('北京市朝阳区阜通东大街6号', '北京'));

        //----- Test argument xml ---------------------------------------------------
        $response = new Response(200, [], '<hello>content</hello>');
        $client = Mockery::mock(Client::class);
        $client->allows()->get('https://restapi.amap.com/v3/geocode/geo', [
            'query' => [
                'key'       => 'mock-key',
                'address'   => '北京市朝阳区阜通东大街6号',
                'city'      => '北京',
                'output'    => 'xml',
	            'batch'     => 'true',
            ],
        ])->andReturn($response);
        $map = Mockery::mock(Map::class, ['mock-key'])->makePartial();
        $map->allows()->getHttpClient()->andReturn($client);
        $this->assertSame('<hello>content</hello>', $map->getGeocode('北京市朝阳区阜通东大街6号', '北京', 'xml'));
    }
}
