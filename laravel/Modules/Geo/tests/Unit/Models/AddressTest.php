<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\Geo\Models\Address;

test('address can be created', function () {
    $address = createAddress([
        'street' => 'Via Roma 123',
        'city' => 'Milano',
        'province' => 'MI',
        'region' => 'Lombardia',
        'postal_code' => '20100',
        'country' => 'IT',
    ]);

    expect($address)
        ->toBeAddress()
        ->and($address->street)->toBe('Via Roma 123')
        ->and($address->city)->toBe('Milano')
        ->and($address->province)->toBe('MI')
        ->and($address->postal_code)->toBe('20100');
});

test('address has required attributes', function () {
    $address = makeAddress();

    expect($address)
        ->toHaveProperty('street')
        ->toHaveProperty('city')
        ->toHaveProperty('province')
        ->toHaveProperty('region')
        ->toHaveProperty('postal_code')
        ->toHaveProperty('country');
});

test('address full address is formatted correctly', function () {
    $address = createAddress([
        'street' => 'Via Roma 123',
        'city' => 'Milano',
        'province' => 'MI',
        'postal_code' => '20100',
    ]);
    
    expect($address->full_address)
        ->toContain('Via Roma 123')
        ->toContain('Milano')
        ->toContain('MI')
        ->toContain('20100');
=======
namespace Modules\Geo\Tests\Unit\Models;

use Modules\Geo\Models\Address;
use Modules\Geo\Models\Comune;
use Modules\Geo\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->address = Address::factory()->create();
});

test('address can be created', function () {
    expect($this->address)->toBeInstanceOf(Address::class);
});

test('address has fillable attributes', function () {
    $fillable = $this->address->getFillable();
    
    expect($fillable)->toContain('street');
    expect($fillable)->toContain('number');
    expect($fillable)->toContain('postal_code');
    expect($fillable)->toContain('city');
});

test('address has casts defined', function () {
    $casts = $this->address->getCasts();
    
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
    expect($casts)->toHaveKey('coordinates');
});

test('address has proper table name', function () {
    expect($this->address->getTable())->toBe('addresses');
});

test('address belongs to comune', function () {
    $comune = Comune::factory()->create();
    $this->address->update(['comune_id' => $comune->id]);
    
    expect($this->address->fresh()->comune)->toBeInstanceOf(Comune::class);
    expect($this->address->fresh()->comune->id)->toBe($comune->id);
});

test('address belongs to province', function () {
    $province = Province::factory()->create();
    $this->address->update(['province_id' => $province->id]);
    
    expect($this->address->fresh()->province)->toBeInstanceOf(Province::class);
    expect($this->address->fresh()->province->id)->toBe($province->id);
});

test('address can get full address', function () {
    $this->address->update([
        'street' => 'Via Roma',
        'number' => '123',
        'postal_code' => '00100',
        'city' => 'Roma'
    ]);
    
    $fullAddress = $this->address->getFullAddressAttribute();
    
    expect($fullAddress)->toBe('Via Roma, 123 - 00100 Roma');
});

test('address can be searched by street', function () {
    $searchResult = Address::search('test')->get();
    
    expect($searchResult)->toHaveCount(1);
    expect($searchResult->first()->id)->toBe($this->address->id);
});

test('address can be filtered by city', function () {
    $cityAddresses = Address::byCity('test')->get();
    
    expect($cityAddresses)->toHaveCount(1);
    expect($cityAddresses->first()->id)->toBe($this->address->id);
});

test('address can be filtered by postal code', function () {
    $postalCodeAddresses = Address::byPostalCode('test')->get();
    
    expect($postalCodeAddresses)->toHaveCount(1);
    expect($postalCodeAddresses->first()->id)->toBe($this->address->id);
});

test('address has proper relationships', function () {
    expect($this->address->comune())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($this->address->province())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
});

test('address can validate coordinates', function () {
    $this->address->update(['coordinates' => ['lat' => 41.9028, 'lng' => 12.4964]]);
    
    expect($this->address->fresh()->hasValidCoordinates())->toBeTrue();
    
    $this->address->update(['coordinates' => null]);
    
    expect($this->address->fresh()->hasValidCoordinates())->toBeFalse();
>>>>>>> f0f95d7 (.)
});
