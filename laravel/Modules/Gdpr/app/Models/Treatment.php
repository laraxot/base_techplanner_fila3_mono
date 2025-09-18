<?php

declare(strict_types=1);

namespace Modules\Gdpr\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Xot\Contracts\ProfileContract;

/**
 * Modules\Gdpr\Models\Treatment.
 *
 * @property string $id
 * @property int                             $active
 * @property int                             $required
 * @property string $name
 * @property string $description
 * @property string|null                     $documentVersion
 * @property string|null                     $documentUrl
 * @property int                             $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
 *
>>>>>>> cb0fd7e5 (.)
=======
 *
>>>>>>> 6f6abe7c (.)
=======
 *
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
 * @method static \Modules\Gdpr\Database\Factories\TreatmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDocumentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDocumentVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereWeight($value)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
 *
>>>>>>> cb0fd7e5 (.)
=======
 *
>>>>>>> 6f6abe7c (.)
=======
 *
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
 *
>>>>>>> cb0fd7e5 (.)
=======
 *
>>>>>>> 6f6abe7c (.)
=======
 *
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDocumentVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedBy($value)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * @property string|null $deleted_by
=======
 *
 * @property string|null $deleted_by
 *
>>>>>>> cb0fd7e5 (.)
=======
 *
 * @property string|null $deleted_by
 *
>>>>>>> 6f6abe7c (.)
=======
 *
 * @property string|null $deleted_by
 *
>>>>>>> ee97d89f (.)
=======
 * @property string|null $deleted_by
>>>>>>> faeca70 (.)
 * @method static \Modules\Gdpr\Database\Factories\TreatmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDocumentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereDocumentVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment   whereWeight($value)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @mixin IdeHelperTreatment
=======
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
 *
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> cb0fd7e5 (.)
=======
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 * @mixin IdeHelperTreatment
>>>>>>> faeca70 (.)
 * @mixin \Eloquent
 */
class Treatment extends BaseModel
{
    use HasUuids;

    // protected $table = 'treatment';
    public $incrementing = false;

    protected $fillable = [''];
}
