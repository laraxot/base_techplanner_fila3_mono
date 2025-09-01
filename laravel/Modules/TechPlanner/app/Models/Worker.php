<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\Geo\Models\Place;
// --- traits ---
use Modules\Geo\Models\Traits\GeoTrait;
use Modules\TechPlanner\Contracts\WorkerContract;

/**
 * Modules\TechPlanner\Models\Worker.
 *
 * @property mixed $address
 * @property string $full_address
 * @property float|null $latitude
 * @property float|null $longitude
 */
class Worker extends BaseModel implements WorkerContract
{
    use GeoTrait;
    // protected $connection = 'customer'; // this will use the specified database conneciton

    /** @var list<string> */
    protected $fillable = ['id', 'type',
        'first_name', 'last_name', 'full_name',
        'address', 'full_address',
        'note', 'birth_day', 'birth_place',
        'cod_fisc', 'p_iva', 'address',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'address' => 'array',
        ];
    }

    // protected $dateFormat = 'Y-m-d H:i';

    /*
    public function getFillable() {
        $shorts = collect(Place::$address_components)->map(function ($item) {
            return $item.'_short';
        })->all();
        $fillable = array_merge($this->fillable, Place::$address_components, $shorts, ['latitude', 'longitude']);

        return $fillable;
    }
    */
    // ---------------- relationships ----------------
    /*
    public function neighbors(){
        //hasMany()
        $related=Customer::class;
        $foreignKey='1';
        $localKey='1';
        return $this->hasMany($related, $foreignKey, $localKey);
    }
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany(Device::class); // ,customer_id,id
    }

    // ---------------- mutators --------------------------

    public function setBirthDayAttribute(mixed $value): void
    {
        try {
            $valueString = $this->safeStringCast($value);
            if ($valueString !== '') {
                $this->attributes['birth_day'] = \Carbon\Carbon::createFromFormat('d/m/Y', $valueString);
            }
        } catch (\Exception $e) {
            // Ignore invalid date formats
        }
    }

    public function getFullNameAttribute(mixed $value): string
    {
        if ($value != '') {
            return $this->safeStringCast($value);
        }
        $type = $this->getAttribute('type');
        $lastName = $this->getAttribute('last_name');
        $firstName = $this->getAttribute('first_name');

        // Safe string casting for all components
        $typeStr = $this->safeStringCast($type);
        $lastNameStr = $this->safeStringCast($lastName);
        $firstNameStr = $this->safeStringCast($firstName);

        $value = $typeStr.' '.$lastNameStr.' '.$firstNameStr;
        $value = trim($value);
        $this->full_name = $value;
        $this->save();

        return $value;
    }

    /*
    public function getBirthDayAttribute($value)
    {
        if()
        ddd($value);
    }
    */
    /**
     * Converte in modo sicuro un valore mixed in string usando l'action centralizzata.
     *
     * @param  mixed  $value  Il valore da convertire
     * @return string Il valore convertito in string
     */
    private function safeStringCast(mixed $value): string
    {
        return app(\Modules\Xot\Actions\Cast\SafeStringCastAction::class)->execute($value);
    }

    // ------------------- scopes ------------------------

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeOfJobRoleId($query, int $id)
    {
        return $query->whereHas(
            'jobRoles', function (Builder $query) use ($id) {
                $query->where('job_role_id', $id);
            }
        );
    }

    /*
    public function scopeNeighbors($query) {
        return $query;
    }


    public function getAddress() {
        if ('' == $this->country) {
            $this->country = 'Italia';
        }

        return $this->route.', '.$this->street_number.', '.$this->locality.', '.$this->administrative_area_level_2.', '.$this->country;
    }

    public function getAddressAttribute($value) {
        if ('' != $value) {
            return json_decode($value);
        }

        if ('' == $this->country) {
            $this->country = 'Italia';
        }
        $val1 = (object) [
            'value' => $this->route.', '.$this->street_number.', '.$this->locality.', '.$this->administrative_area_level_2.', '.$this->country,
        ];
        $val1->latlng = (object) [
            'lat' => $this->latitude,
            'lng' => $this->longitude,
        ];
        foreach (Place::$address_components as $v) {
            $val1->$v = $this->$v;
            $val1->{$v.'_short'} = $this->{$v.'_short'};
        }

        return json_encode($val1, 1);
        //return response()->json($val1);
    }

    //*/

    public function getCodFiscAttribute(?string $value): ?string
    {
        if ($value == null) {
            return null;
        }
        $value = str_replace(' ', '', $value);
        $value = trim($value);
        $nome = substr($value, 0, 3);
        $cognome = substr($value, 3, 3);
        $data = substr($value, 6, 5);
        $citta = substr($value, 11, 4);
        $crc = substr($value, 15, 1);

        return $nome.' '.$cognome.' '.$data.' '.$citta.' '.$crc;
    }
}
