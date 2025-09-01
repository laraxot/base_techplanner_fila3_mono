<?php

declare(strict_types=1);

namespace Modules\Gdpr\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * Modules\Gdpr\Models\Treatment.
 *
 * @property string                          $id
 * @property int                             $active
 * @property int                             $required
 * @property string                          $name
 * @property string                          $description
 * @property string|null                     $documentVersion
 * @property string|null                     $documentUrl
 * @property int                             $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Modules\Gdpr\Database\Factories\TreatmentFactory factory($count = null, $state = [])
 *                                                                                                      <<<<<<< HEAD
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
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      =======
 *                                                                                                      =======
 *                                                                                                      >>>>>>> Stashed changes
 *                                                                                                      =======
 *                                                                                                      =======
 *                                                                                                      >>>>>>> Stashed changes
 *                                                                                                      =======
 *                                                                                                      =======
 *                                                                                                      >>>>>>> Stashed changes
 * @method static Builder|Treatment                                 newModelQuery()
 * @method static Builder|Treatment                                 newQuery()
 * @method static Builder|Treatment                                 query()
 * @method static Builder|Treatment                                 whereActive($value)
 * @method static Builder|Treatment                                 whereCreatedAt($value)
 * @method static Builder|Treatment                                 whereDescription($value)
 * @method static Builder|Treatment                                 whereDocumentUrl($value)
 * @method static Builder|Treatment                                 whereDocumentVersion($value)
 * @method static Builder|Treatment                                 whereId($value)
 * @method static Builder|Treatment                                 whereName($value)
 * @method static Builder|Treatment                                 whereRequired($value)
 * @method static Builder|Treatment                                 whereUpdatedAt($value)
 * @method static Builder|Treatment                                 whereWeight($value)
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      <<<<<<< Updated upstream
 *                                                                                                      =======
 *                                                                                                      >>>>>>> 4a1eeab7 (Lint)
 *                                                                                                      >>>>>>> Stashed changes
 *                                                                                                      =======
 *                                                                                                      >>>>>>> 4a1eeab7 (Lint)
 *                                                                                                      >>>>>>> Stashed changes
 *                                                                                                      =======
 *                                                                                                      >>>>>>> 4a1eeab7 (Lint)
 *                                                                                                      >>>>>>> Stashed changes
 *
 * @mixin \Eloquent
 */
class Treatment extends BaseModel
{
    use HasUuids;

    protected $fillable = [''];

    // protected $table = 'treatment';
    public $incrementing = false;
}
