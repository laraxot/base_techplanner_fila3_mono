<?php

declare(strict_types=1);

namespace Modules\Gdpr\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Carbon;

/**
 * Modules\Gdpr\Models\Treatment.
 *
 * @property string $id
 * @property int $active
 * @property int $required
 * @property string $name
 * @property string $description
 * @property string|null $documentVersion
 * @property string|null $documentUrl
 * @property int $weight
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Modules\Gdpr\Database\Factories\TreatmentFactory factory($count = null, $state = [])
 * @method static Builder|Treatment newModelQuery()
 * @method static Builder|Treatment newQuery()
 * @method static Builder|Treatment query()
 * @method static Builder|Treatment whereActive($value)
 * @method static Builder|Treatment whereCreatedAt($value)
 * @method static Builder|Treatment whereDescription($value)
 * @method static Builder|Treatment whereDocumentUrl($value)
 * @method static Builder|Treatment whereDocumentVersion($value)
 * @method static Builder|Treatment whereId($value)
 * @method static Builder|Treatment whereName($value)
 * @method static Builder|Treatment whereRequired($value)
 * @method static Builder|Treatment whereUpdatedAt($value)
 * @method static Builder|Treatment whereWeight($value)
 *
 * @mixin \Eloquent
 */
class Treatment extends BaseModel
{
    use HasUuids;

    protected $fillable = [
        'active',
        'required',
        'name',
        'description',
        'documentVersion',
        'documentUrl',
        'weight',
    ];

    // protected $table = 'treatment';
    public $incrementing = false;
}
