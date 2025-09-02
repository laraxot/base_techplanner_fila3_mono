<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Lang\Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

uses(
    TestCase::class,
    DatabaseTransactions::class, // ✅ CORRETTO - Rollback automatico
    WithFaker::class,
)->in('Feature', 'Unit');

uses()->group('lang')->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Here you may define your custom expectations to be used in your tests.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

expect()->extend('toBeTranslation', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\Translation::class);
});

expect()->extend('toBeLanguage', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\Language::class);
});

expect()->extend('toBePost', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\Post::class);
});

expect()->extend('toHaveTranslationKey', function (string $key) {
    return expect($this->value->hasTranslationKey($key))->toBeTrue();
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Here you may define your custom helper functions to be used in your tests.
|
*/

function createLangTranslation(array $attributes = []): \Modules\Lang\Models\Translation
{
    return \Modules\Lang\Models\Translation::factory()->create($attributes);
}

function createLangTranslationFile(array $attributes = []): \Modules\Lang\Models\TranslationFile
{
    return \Modules\Lang\Models\Language::factory()->create($attributes);
}

function createLangPost(array $attributes = []): \Modules\Lang\Models\Post
{
    return \Modules\Lang\Models\Post::factory()->create($attributes);
}
