<?php

declare(strict_types=1);

namespace Modules\Job\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Job\Models\Schedule;
use Webmozart\Assert\Assert;

class ScheduleService
{
    /**
     * Undocumented variable.
     *
     * @var Schedule
     */
    private $model;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function __construct(): void {
=======
    public function __construct()
    {
>>>>>>> de0f89b5 (.)
=======
    public function __construct()
    {
>>>>>>> 2e199498 (.)
=======
    public function __construct()
    {
>>>>>>> eaeb6531 (.)
        Assert::string($modelClass = config('job::model'), '['.__LINE__.']['.class_basename($this).']');
        $this->model = app($modelClass);
    }

    /**
     * Undocumented function.
     *
     * @return Collection
     */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    public function getActives(): void {
=======
    public function getActives()
    {
>>>>>>> de0f89b5 (.)
=======
    public function getActives()
    {
>>>>>>> 2e199498 (.)
=======
    public function getActives()
    {
>>>>>>> eaeb6531 (.)
        if (config('job::cache.enabled')) {
            return $this->getFromCache();
        }

        return $this->model->active()->get();
    }

    public function clearCache(): void
    {
        Assert::string($store = config('job::cache.store'), '['.__LINE__.']['.class_basename($this).']');
        Assert::string($key = config('job::cache.key'), '['.__LINE__.']['.class_basename($this).']');

        Cache::store($store)->forget($key);
    }

    /**
     * Undocumented function.
     *
     * @return Collection
     */
    private function getFromCache()
    {
        Assert::string($store = config('job::cache.store'), '['.__LINE__.']['.class_basename($this).']');
        Assert::string($key = config('job::cache.key'), '['.__LINE__.']['.class_basename($this).']');

        return Cache::store($store)->rememberForever($key, fn () => $this->model->active()->get());
    }
}
