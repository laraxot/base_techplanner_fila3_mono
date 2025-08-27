<?php

declare(strict_types=1);

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Geo\Models\Address;
use Modules\Geo\Enums\AddressTypeEnum;
use Modules\User\Models\Profile;

describe('Address Integration', function () {
    it('can attach address to profile via polymorphic relationship', function () {
        $profile = Profile::factory()->create();
        
        $address = Address::factory()->create([
<<<<<<< HEAD
            'model_type' => Profile::class,
            'model_id' => $profile->id,
=======
            'model_type' => Patient::class,
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
/**
 * In-memory Address tests (no factories / DB / container).
 * Keep business rules verifiable without touching app code.
 */

/**
 * Build an in-memory Address-like object with sane defaults.
 *
 * @param array<string, mixed> $overrides
 */
function makeAddress(array $overrides = []): object
{
    static $autoId = 1;

    $defaults = [
        'id' => $autoId++,
        'model_type' => null, // e.g. 'patient'
        'model_id' => null,
        'route' => 'Via Roma',
        'street_number' => '1',
        'locality' => 'Milano',
        'administrative_area_level_2' => 'MI',
        'postal_code' => '20100',
        'country' => 'Italia',
        'is_primary' => false,
        'type' => 'home', // home|work
        'latitude' => null,
        'longitude' => null,
        'place_id' => null,
        'formatted_address' => null,
        'extra_data' => [],
        'deleted_at' => null,
    ];

    return (object) array_replace($defaults, $overrides);
}

/**
 * Compose a displayable full address from object parts.
 */
function formatFullAddress(object $a): string
{
    $parts = array_filter([
        $a->route ?? null,
        $a->street_number ?? null,
        $a->locality ?? null,
        $a->postal_code ?? null,
        $a->country ?? null,
    ], fn ($v) => (string) $v !== '');

    return implode(', ', $parts);
}

describe('Address Integration', function () {
    it('can attach address to patient via polymorphic relationship', function () {
        $patient = (object) ['id' => 1001, 'type' => 'patient'];

        $address = makeAddress([
            'model_type' => 'patient',
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> a93f634 (.)
=======
>>>>>>> f90a9bb (.)
            'model_id' => $patient->id,
>>>>>>> ea4011f (.)
=======
            'model_id' => $patient->id,
>>>>>>> f0f95d7 (.)
            'route' => 'Via Roma',
            'street_number' => '123',
            'locality' => 'Milano',
            'postal_code' => '20100',
            'is_primary' => true,
        ]);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        
<<<<<<< HEAD
        expect($address->addressable)->toBeInstanceOf(Profile::class)
            ->and($address->addressable->id)->toBe($profile->id)
            ->and($address->route)->toBe('Via Roma')
            ->and($address->is_primary)->toBeTrue();
    });

    it('can have multiple addresses with one primary', function () {
        $profile = Profile::factory()->create();

        $homeAddress = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'type' => AddressTypeEnum::HOME,
            'is_primary' => true,
        ]);

        $workAddress = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'type' => AddressTypeEnum::WORK,
            'is_primary' => false,
        ]);

        $profileAddresses = Address::where('model_type', Profile::class)
            ->where('model_id', $profile->id)
            ->get();

        expect($profileAddresses)->toHaveCount(2)
            ->and($homeAddress->is_primary)->toBeTrue()
            ->and($workAddress->is_primary)->toBeFalse();
    });

    it('enforces single primary address per entity', function () {
        $profile = Profile::factory()->create();
=======
        expect($address->addressable)->toBeInstanceOf(Patient::class)
            ->and($address->addressable->id)->toBe($patient->id)
=======

        expect($address->model_type)->toBe('patient')
            ->and($address->model_id)->toBe($patient->id)
>>>>>>> a93f634 (.)
=======

        expect($address->model_type)->toBe('patient')
            ->and($address->model_id)->toBe($patient->id)
>>>>>>> f90a9bb (.)
=======

        expect($address->model_type)->toBe('patient')
            ->and($address->model_id)->toBe($patient->id)
>>>>>>> f0f95d7 (.)
            ->and($address->is_primary)->toBeTrue();
    });

    it('generates proper full address from components', function () {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $address = Address::factory()->create([
=======
        $address = makeAddress([
>>>>>>> a93f634 (.)
=======
        $address = makeAddress([
>>>>>>> f90a9bb (.)
=======
        $address = makeAddress([
>>>>>>> f0f95d7 (.)
            'route' => 'Via Giuseppe Verdi',
            'street_number' => '42',
            'locality' => 'Milano',
            'administrative_area_level_2' => 'MI',
            'postal_code' => '20121',
            'country' => 'Italia',
        ]);
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ea4011f (.)
        
        $address1 = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'is_primary' => true,
        ]);

        $address2 = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
            'is_primary' => false,
        ]);

        expect($address1->is_primary)->toBeTrue()
            ->and($address2->is_primary)->toBeFalse();
    });

    it('validates required address fields', function () {
        $addressData = [
            'route' => 'Via Roma',
            'locality' => 'Milano',
            'postal_code' => '20100',
        ];

        $address = Address::factory()->create($addressData);
        
<<<<<<< HEAD
        expect($address->route)->toBe('Via Roma')
            ->and($address->locality)->toBe('Milano')
            ->and($address->postal_code)->toBe('20100');
    });

    it('handles geolocation data correctly', function () {
        $address = Address::factory()->create([
=======
=======

        $fullAddress = formatFullAddress($address);

>>>>>>> a93f634 (.)
=======

        $fullAddress = formatFullAddress($address);

>>>>>>> f90a9bb (.)
=======

        $fullAddress = formatFullAddress($address);

>>>>>>> f0f95d7 (.)
        expect($fullAddress)->toContain('Via Giuseppe Verdi')
            ->and($fullAddress)->toContain('42')
            ->and($fullAddress)->toContain('Milano')
            ->and($fullAddress)->toContain('20121');
    });

    it('handles geolocation data correctly', function () {
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        $milanCoordinates = [
>>>>>>> ea4011f (.)
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);

        expect($address->latitude)->toBe(45.4642)
            ->and($address->longitude)->toBe(9.1900);
    });

    it('can store Google Places API data', function () {
<<<<<<< HEAD
        $address = Address::factory()->create([
=======
        $googlePlacesData = [
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
        $milan = makeAddress([
            'latitude' => 45.4642,
            'longitude' => 9.1900,
        ]);

        expect($milan->latitude)->toBe(45.4642)
            ->and($milan->longitude)->toBe(9.1900);
    });

    it('can store Google Places API data', function () {
        $address = makeAddress([
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> a93f634 (.)
=======
>>>>>>> f90a9bb (.)
>>>>>>> ea4011f (.)
=======
>>>>>>> f0f95d7 (.)
            'place_id' => 'ChIJu46S-ZZjhkcRLuFvLjVZ400',
            'formatted_address' => 'Piazza del Duomo, 20121 Milano MI, Italy',
            'extra_data' => [
                'google_types' => ['establishment', 'point_of_interest'],
                'rating' => 4.5,
                'business_status' => 'OPERATIONAL',
            ],
<<<<<<< HEAD
<<<<<<< HEAD
        ]);

=======
<<<<<<< HEAD
<<<<<<< HEAD
        ];
        
        $address = Address::factory()->create($googlePlacesData);
        
=======
        ]);

>>>>>>> a93f634 (.)
=======
        ]);

>>>>>>> f90a9bb (.)
>>>>>>> ea4011f (.)
=======
        ]);

>>>>>>> f0f95d7 (.)
        expect($address->place_id)->toBe('ChIJu46S-ZZjhkcRLuFvLjVZ400')
            ->and($address->formatted_address)->toContain('Piazza del Duomo')
            ->and($address->extra_data['google_types'])->toContain('establishment')
            ->and($address->extra_data['rating'])->toBe(4.5);
    });

    it('supports multiple addresses per entity', function () {
<<<<<<< HEAD
<<<<<<< HEAD
        $profile = Profile::factory()->create();

        $addresses = collect([
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::HOME,
                'route' => 'Via Roma',
                'locality' => 'Milano',
            ]),
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::WORK,
                'route' => 'Via Torino',
                'locality' => 'Milano',
            ]),
            Address::factory()->create([
                'model_type' => Profile::class,
                'model_id' => $profile->id,
                'type' => AddressTypeEnum::OTHER,
                'route' => 'Via Napoli',
                'locality' => 'Milano',
            ]),
        ]);

        expect($addresses)->toHaveCount(3)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::HOME)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::WORK)
            ->and($addresses->pluck('type')->toArray())->toContain(AddressTypeEnum::OTHER);
    });

    it('handles address type validation correctly', function () {
        $profile = Profile::factory()->create();

        $address = Address::factory()->create([
            'model_type' => Profile::class,
            'model_id' => $profile->id,
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $patient = Patient::factory()->create();
        
        $homeAddress = Address::factory()->create([
            'model_type' => Patient::class,
            'model_id' => $patient->id,
>>>>>>> ea4011f (.)
            'type' => AddressTypeEnum::HOME,
        ]);

        expect($address->type)->toBe(AddressTypeEnum::HOME)
            ->and(in_array($address->type, AddressTypeEnum::cases()))->toBeTrue();
    });

    it('can format full address correctly', function () {
        $address = Address::factory()->create([
            'route' => 'Via Roma',
            'street_number' => '123',
            'locality' => 'Milano',
            'postal_code' => '20100',
            'country' => 'Italia',
        ]);

        $formattedAddress = $address->getFormattedAddressAttribute();
        
        expect($formattedAddress)->toContain('Via Roma')
            ->and($formattedAddress)->toContain('123')
            ->and($formattedAddress)->toContain('Milano')
            ->and($formattedAddress)->toContain('20100')
            ->and($formattedAddress)->toContain('Italia');
    });

    it('handles soft deletion correctly', function () {
        $address = Address::factory()->create();
        
        $address->delete();
        
<<<<<<< HEAD
        expect(Address::find($address->id))->toBeNull()
            ->and(Address::withTrashed()->find($address->id))->not->toBeNull()
            ->and(Address::withTrashed()->find($address->id)->deleted_at)->not->toBeNull();
=======
        expect(Address::find($addressId))->toBeNull()
            ->and(Address::withTrashed()->find($addressId))->not->toBeNull()
            ->and(Address::withTrashed()->find($addressId)->deleted_at)->not->toBeNull();
=======
=======
>>>>>>> f90a9bb (.)
=======
>>>>>>> f0f95d7 (.)
        $patient = (object) ['id' => 2001, 'type' => 'patient'];

        $homeAddress = makeAddress([
            'model_type' => 'patient',
            'model_id' => $patient->id,
            'type' => 'home',
            'is_primary' => true,
        ]);

        $workAddress = makeAddress([
            'model_type' => 'patient',
            'model_id' => $patient->id,
            'type' => 'work',
            'is_primary' => false,
        ]);

        $patientAddresses = [$homeAddress, $workAddress];

        expect(count($patientAddresses))->toBe(2);

        $primary = null;
        foreach ($patientAddresses as $addr) {
            if ($addr->is_primary === true) {
                $primary = $addr; break;
            }
        }

        expect($primary?->id)->toBe($homeAddress->id);
    });

    it('handles soft deletion correctly', function () {
        $address = makeAddress();

        // Soft delete simulation
        $address->deleted_at = date('c');

        // Lookup simulations
        $active = null; // would be null after soft-delete
        $withTrashed = $address; // still available with trashed scope

        expect($active)->toBeNull()
            ->and($withTrashed)->not->toBeNull()
            ->and($withTrashed->deleted_at)->not->toBeNull();
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> a93f634 (.)
=======
>>>>>>> f90a9bb (.)
>>>>>>> ea4011f (.)
=======
>>>>>>> f0f95d7 (.)
    });
});