<h1 align="center"> Map </h1>

<p align="center"> A map sdk only for getting geocoding at the moment.</p>


## Installing

```shell
$ composer require rainsens/map -vvv
```

## Configuration
You have to get the API Key from [Amap](https://lbs.amap.com) before use.

## Usage
```php
use Rainsens\Map\Map;
$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$map = new Map($key);
```

## Getting one geocoding once
```php
$map->getGeocode('北京市朝阳区阜通东大街6号', '北京');
$map->getGeocode('北京市朝阳区阜通东大街6号', '北京', 'json');
$map->getGeocode('北京市朝阳区阜通东大街6号', '北京', 'xml');
```

## Getting multi geocoding once
```php
$cities = [
    '北京市朝阳区阜通东大街6号',
    '北京市通州区运河东大街6号',
];

$map->getGeocode($cities, '北京');
```

## Example
```php
"status": "1",
"info": "OK",
"infocode": "10000",
"count": "1",
"geocodes": [
    {
        "formatted_address": "北京市朝阳区阜通东大街|6号",
        "country": "中国",
        "province": "北京市",
        "citycode": "010",
        "city": "北京市",
        "district": "朝阳区",
        "township": [],
        "neighborhood": {
            "name": [],
            "type": []
        },
        "building": {
            "name": [],
            "type": []
        },
        "adcode": "110105",
        "street": "阜通东大街",
        "number": "6号",
        "location": "116.483038,39.990633",
        "level": "门牌号"
    }
]
```
```php
<response>
    <status>1</status>
    <info>OK</info>
    <infocode>10000</infocode>
    <count>1</count>
    <geocodes type="list">
        <geocode>
            <formatted_address>北京市朝阳区阜通东大街|6号</formatted_address>
            <country>中国</country>
            <province>北京市</province>
            <citycode>010</citycode>
            <city>北京市</city>
            <district>朝阳区</district>
            <township></township>
            <neighborhood>
                <name></name>
                <type></type>
            </neighborhood>
            <building>
                <name></name>
                <type></type>
            </building>
            <adcode>110105</adcode>
            <street>阜通东大街</street>
            <number>6号</number>
            <location>116.483038,39.990633</location>
            <level>门牌号</level>
        </geocode>
    </geocodes>
</response>
```

## Using in Laravel
Install with the same way and put the API Key in `config/services.php`
```php
    .
    .
    .
     'map' => [
        'key' => env('MAP_API_KEY'),
    ],
```
Then configure the MAP_API_KEY in .env
```php
MAP_API_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```
You can get instance by two ways:
```php
public func edit(Map $map)
{
    $response = $map->getGeocode(['北京市朝阳区阜通东大街6号'], '北京');
}
```
```php
public function edit()
{
    $response = app('map')->getGeocode(['北京市朝阳区阜通东大街6号'], '北京');
}
```

## Reference
[Amap](https://lbs.amap.com/api/webservice/guide/api/georegeo)


## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/rainsens/map/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/rainsens/map/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT