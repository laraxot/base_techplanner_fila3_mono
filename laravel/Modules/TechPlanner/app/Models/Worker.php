<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Builder;
use Modules\Geo\Models\Place;
// --- traits ---
use Modules\Geo\Models\Traits\GeoTrait;
use Modules\TechPlanner\Contracts\WorkerContract;
use Modules\Xot\Services\PanelService;

/**
 * Modules\TechPlanner\Models\Worker.
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $birth_place
 * @property \Illuminate\Support\Carbon|null $birth_day
 * @property string|null $birth_day_1
 * @property string|null $date_start
 * @property string|null $date_end
 * @property array|null $address
 * @property string|null $full_address
 * @property string|null $note
 * @property string|null $premise
 * @property string|null $premise_short
 * @property string|null $locality
 * @property string|null $locality_short
 * @property string|null $postal_town
 * @property string|null $postal_town_short
 * @property string|null $administrative_area_level_3
 * @property string|null $administrative_area_level_3_short
 * @property string|null $administrative_area_level_2
 * @property string|null $administrative_area_level_2_short
 * @property string|null $administrative_area_level_1
 * @property string|null $administrative_area_level_1_short
 * @property string|null $country
 * @property string|null $country_short
 * @property string|null $street_number
 * @property string|null $street_number_short
 * @property string|null $route
 * @property string|null $route_short
 * @property string|null $postal_code
 * @property string|null $postal_code_short
 * @property string|null $googleplace_url
 * @property string|null $googleplace_url_short
 * @property string|null $point_of_interest
 * @property string|null $point_of_interest_short
 * @property string|null $political
 * @property string|null $political_short
 * @property string|null $campground
 * @property string|null $campground_short
 * @property string|null $phone
 * @property string|null $website
 * @property string|null $email
 * @property string|null $formatted_address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $full_name
 * @property string|null $p_iva
 * @property string|null $cod_fisc
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\Customer[] $customers
 * @property int|null $customers_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\Device[] $devices
 * @property int|null $devices_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\CustomerXWorkerXJobRole[] $jobRoles
 * @property int|null $job_roles_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\JobRole[] $jobRoles_one
 * @property int|null $job_roles_one_count
 *
 * @method static Builder|Worker newModelQuery()
 * @method static Builder|Worker newQuery()
 * @method static Builder|Worker ofJobRoleId($id)
 * @method static Builder|Worker query()
 * @method static Builder|Worker whereAddress($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel1($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel1Short($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel2($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel2Short($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel3($value)
 * @method static Builder|Worker whereAdministrativeAreaLevel3Short($value)
 * @method static Builder|Worker whereBirthDay($value)
 * @method static Builder|Worker whereBirthDay1($value)
 * @method static Builder|Worker whereBirthPlace($value)
 * @method static Builder|Worker whereCampground($value)
 * @method static Builder|Worker whereCampgroundShort($value)
 * @method static Builder|Worker whereCodFisc($value)
 * @method static Builder|Worker whereCountry($value)
 * @method static Builder|Worker whereCountryShort($value)
 * @method static Builder|Worker whereCreatedAt($value)
 * @method static Builder|Worker whereCreatedBy($value)
 * @method static Builder|Worker whereDateEnd($value)
 * @method static Builder|Worker whereDateStart($value)
 * @method static Builder|Worker whereEmail($value)
 * @method static Builder|Worker whereFirstName($value)
 * @method static Builder|Worker whereFormattedAddress($value)
 * @method static Builder|Worker whereFullAddress($value)
 * @method static Builder|Worker whereFullName($value)
 * @method static Builder|Worker whereGoogleplaceUrl($value)
 * @method static Builder|Worker whereGoogleplaceUrlShort($value)
 * @method static Builder|Worker whereId($value)
 * @method static Builder|Worker whereLastName($value)
 * @method static Builder|Worker whereLatitude($value)
 * @method static Builder|Worker whereLocality($value)
 * @method static Builder|Worker whereLocalityShort($value)
 * @method static Builder|Worker whereLongitude($value)
 * @method static Builder|Worker whereNote($value)
 * @method static Builder|Worker wherePIva($value)
 * @method static Builder|Worker wherePhone($value)
 * @method static Builder|Worker wherePointOfInterest($value)
 * @method static Builder|Worker wherePointOfInterestShort($value)
 * @method static Builder|Worker wherePolitical($value)
 * @method static Builder|Worker wherePoliticalShort($value)
 * @method static Builder|Worker wherePostalCode($value)
 * @method static Builder|Worker wherePostalCodeShort($value)
 * @method static Builder|Worker wherePostalTown($value)
 * @method static Builder|Worker wherePostalTownShort($value)
 * @method static Builder|Worker wherePremise($value)
 * @method static Builder|Worker wherePremiseShort($value)
 * @method static Builder|Worker whereRoute($value)
 * @method static Builder|Worker whereRouteShort($value)
 * @method static Builder|Worker whereStreetNumber($value)
 * @method static Builder|Worker whereStreetNumberShort($value)
 * @method static Builder|Worker whereType($value)
 * @method static Builder|Worker whereUpdatedAt($value)
 * @method static Builder|Worker whereUpdatedBy($value)
 * @method static Builder|Worker whereWebsite($value)
 * @method static Builder|Worker withDistance($lat, $lng)
 *
 * @mixin \Eloquent
 */
class Worker extends BaseModel implements WorkerContract
{
    use GeoTrait;
    // protected $connection = 'customer'; // this will use the specified database conneciton

    /**
     * @var string[]
     */
    protected $fillable = ['id', 'type',
        'first_name', 'last_name', 'full_name',
        'address', 'full_address',
        'note', 'birth_day', 'birth_place',
        'cod_fisc', 'p_iva', 'address',
    ];

    /*
     * @var string[]
     */
    // protected $dates = ['created_at', 'updated_at', 'birth_day'];

    // 'created_by','updated_by',

    /**
     * @var string[]
     */
    protected $casts = [
        'address' => 'array',
    ];

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

    /*
    public function customer()
    {
        return $this->belongsTo(Customer::class); //,customer_id,id
    }
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        // return $this->hasMany(Worker::class); //,customer_id,id

        $pivot_class = CustomerXWorker::class;
        $pivot_table = app($pivot_class)->getTable();

        return $this->belongsToMany(Customer::class, $pivot_table)
            ->using($pivot_class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobRoles_one()
    {
        $pivot_class = WorkerXJobRole::class;
        $pivot_table = app($pivot_class)->getTable();

        return $this->belongsToMany(JobRole::class, $pivot_table)
            ->using($pivot_class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobRoles()
    {
        /*//-- DA RIFARE
        if (is_object($this->pivot)) {
            $move = WorkerXJobRole::where('worker_id', $this->id)->get();
            foreach ($move as $v) {
                $this->pivot->jobRoles()->syncWithoutDetaching($v->job_role_id);
                $v->delete();
            }

            return $this->pivot->jobRoles();
        } else {
            return $this->hasManyThrough(CustomerXWorkerXJobRole::class, CustomerXWorker::class,
                        null, 'customer_x_worker_id'
                    );
            //return $this->hasManyThrough(JobRole::class,CustomerXWorkerXJobRole::class);
        }
        */
        /*
        return $this->hasManyThrough(CustomerXWorkerXJobRole::class, CustomerXWorker::class,
            null, 'customer_x_worker_id'
        );
        */
        // return $this->hasManyThrough(JobRole::class,CustomerXWorkerXJobRole::class,null,'id',null,'job_role_id');
        // dddx($this->pivot);
        $rows = $this->belongsToMany(JobRole::class, CustomerXWorkerXJobRole::class);
        if (is_object($this->pivot)) {
            // $pivot_panel= PanelService::make()->get($this->pivot);
            $rows = $rows->where('customer_id', $this->getRelationValue('pivot')->customer_id);
        }

        return $rows;
    }

    // ---------------- mutators --------------------------

    public function setBirthDayAttribute($value): void
    {
        try {
            $this->attributes['birth_day'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        } catch (\Exception $e) {
        }
    }

    /**
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        if ($value != '') {
            return $value;
        }
        $value = $this->type.' '.$this->last_name.' '.$this->first_name;
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

        return json_encode($val1, true);
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
