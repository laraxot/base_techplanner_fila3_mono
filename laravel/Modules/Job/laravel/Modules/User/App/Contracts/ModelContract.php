<?php

/**
 * -- controllare.
 */

declare(strict_types=1);

namespace Modules\User\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Contracts\ModelContract.
 *
 * @phpstan-require-extends Model
 *
 * @mixin \Eloquent
 */
interface ModelContract
{
    /**
     * Duplicate the instance and unset all the loaded relations.
     *
     * @return $this
     */
    public function withoutRelations();

    /**
     * Fill the model with an array of attributes. Force mass assignment.
     *
     * @return $this
     */
    public function forceFill(array $attributes);

    /**
     * Save the model to the database.
     *
     * @return bool
     */
    public function save(array $options = []);

    /*
         * Save a new model and return the instance. Allow mass-assignment.
         *
         * @return \Illuminate\Database\Eloquent\Model|$this

        public function forceCreate(array $attributes);
        */

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Get the value of the model's primary key.
     *
     * @return string|int
     */
    public function getKey();

    /*
     * Add a basic where clause to the query.
     *
     * @param  \Closure|string|array|\Illuminate\Contracts\Database\Query\Expression  $column
     * @param  mixed  $operator
     * @param  mixed  $value
     * @param  string  $boolean
     * @return $this

    public function where($column, $operator = null, $value = null, $boolean = 'and');
    */

    /*
     * Execute the query and get the first result or throw an exception.
     *
     * @param  array|string  $columns
     * @return \Illuminate\Database\Eloquent\Model|static
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException<\Illuminate\Database\Eloquent\Model>

    public function firstOrFail($columns = ['*']);
    */
}
