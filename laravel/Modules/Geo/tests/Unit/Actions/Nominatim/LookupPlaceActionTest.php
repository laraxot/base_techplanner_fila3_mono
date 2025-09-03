<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Modules\Geo\Actions\Nominatim\LookupPlaceAction;
use Modules\Geo\Datas\LocationData;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->mockClient = $this->mock(Client::class);
    $this->action = new LookupPlaceAction();

    // Replace the client instance with our mock
    $reflection = new \ReflectionClass($this->action);
    $property = $reflection->getProperty('client');
    $property->setAccessible(true);
    $property->setValue($this->action, $this->mockClient);
});

test('lookup place action returns location data for valid osm id', function () {
    $mockResponse = new Response(200, [], json_encode([
        [
            'lat' => '41.9028',
            'lon' => '12.4964',
            'display_name' => 'Rome, Metropolitan City of Rome Capital, Lazio, Italy',
        ],
    ]));

    $this->mockClient
        ->shouldReceive('get')
        ->once()
        ->with('https://nominatim.openstreetmap.org/lookup', [
            'query' => [
                'osm_ids' => 'R123456',
                'format' => 'json',
            ],
            'headers' => [
                'User-Agent' => 'TechPlanner/1.0',
            ],
        ])
        ->andReturn($mockResponse);

    $result = $this->action->execute('R123456');

    expect($result)->toBeInstanceOf(LocationData::class)
        ->and($result->latitude)->toBe(41.9028)
        ->and($result->longitude)->toBe(12.4964)
        ->and($result->address)->toBe('Rome, Metropolitan City of Rome Capital, Lazio, Italy');
});

test('lookup place action throws exception for empty results', function () {
    $mockResponse = new Response(200, [], json_encode([]));

    $this->mockClient
        ->shouldReceive('get')
        ->once()
        ->andReturn($mockResponse);

    expect(fn () => $this->action->execute('R999999'))
        ->toThrow(\RuntimeException::class, 'No results found for OSM ID: R999999');
});

test('lookup place action handles guzzle exceptions', function () {
    $this->mockClient
        ->shouldReceive('get')
        ->once()
        ->andThrow(new GuzzleException('API unavailable'));

    expect(fn () => $this->action->execute('R123456'))
        ->toThrow(GuzzleException::class, 'API unavailable');
});

test('lookup place action uses correct user agent header', function () {
    $mockResponse = new Response(200, [], json_encode([
        ['lat' => '0', 'lon' => '0', 'display_name' => 'Test'],
    ]));

    $this->mockClient
        ->shouldReceive('get')
        ->once()
        ->withArgs(function ($url, $options) {
            return isset($options['headers']['User-Agent']) &&
                   $options['headers']['User-Agent'] === 'TechPlanner/1.0';
        })
        ->andReturn($mockResponse);

    $result = $this->action->execute('R123456');

    expect($result)->toBeInstanceOf(LocationData::class);
});
