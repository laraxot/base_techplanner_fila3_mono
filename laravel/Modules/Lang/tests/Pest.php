<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
=======
>>>>>>> aee7a32 (.)
use Modules\Lang\Tests\TestCase;

/*
|--------------------------------------------------------------------------
<<<<<<< HEAD
| Test Configuration
|--------------------------------------------------------------------------
|
| This file configures Pest testing for the Lang module.
| It sets up the test environment, custom expectations, and helper functions.
|
*/

<<<<<<< HEAD
uses(
    TestCase::class,
    RefreshDatabase::class,
    WithFaker::class,
)->in('Feature', 'Unit');

uses()->group('lang')->in('Feature', 'Unit');
=======
pest()->extend(TestCase::class)
<<<<<<< HEAD
<<<<<<< HEAD
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
=======
>>>>>>> 0cd7164 (.)
=======
>>>>>>> 0f52eb1 (.)
    ->in('Feature', 'Unit');
>>>>>>> 685d248 (.)

/*
|--------------------------------------------------------------------------
| Custom Expectations
|--------------------------------------------------------------------------
|
| Custom expectations for testing Lang module specific functionality.
| These expectations extend the base Pest expectations with module-specific assertions.
=======
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(TestCase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
>>>>>>> aee7a32 (.)
|
*/

expect()->extend('toBeTranslation', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\Translation::class);
});

<<<<<<< HEAD
expect()->extend('toBeTranslationFile', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\TranslationFile::class);
=======
expect()->extend('toBeLanguage', function () {
    return $this->toBeInstanceOf(\Modules\Lang\Models\Language::class);
>>>>>>> aee7a32 (.)
});

/*
|--------------------------------------------------------------------------
<<<<<<< HEAD
| Helper Functions
|--------------------------------------------------------------------------
|
| Helper functions to create test data for the Lang module.
| These functions provide a clean API for test setup.
|
*/

/**
 * Create a translation record for testing.
 *
 * @param array<string, mixed> $attributes
 * @return \Modules\Lang\Models\Translation
 */
=======
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

>>>>>>> aee7a32 (.)
function createTranslation(array $attributes = []): \Modules\Lang\Models\Translation
{
    return \Modules\Lang\Models\Translation::factory()->create($attributes);
}

<<<<<<< HEAD
/**
 * Make a translation record without saving to database.
 *
 * @param array<string, mixed> $attributes
 * @return \Modules\Lang\Models\Translation
 */
=======
>>>>>>> aee7a32 (.)
function makeTranslation(array $attributes = []): \Modules\Lang\Models\Translation
{
    return \Modules\Lang\Models\Translation::factory()->make($attributes);
}

<<<<<<< HEAD
/**
 * Create a translation file record for testing.
 *
 * @param array<string, mixed> $attributes
 * @return \Modules\Lang\Models\TranslationFile
 */
function createTranslationFile(array $attributes = []): \Modules\Lang\Models\TranslationFile
{
    return \Modules\Lang\Models\TranslationFile::factory()->create($attributes);
}

/**
 * Make a translation file record without saving to database.
 *
 * @param array<string, mixed> $attributes
 * @return \Modules\Lang\Models\TranslationFile
 */
function makeTranslationFile(array $attributes = []): \Modules\Lang\Models\TranslationFile
{
    return \Modules\Lang\Models\TranslationFile::factory()->make($attributes);
}

/**
 * Create a complete translation setup for testing.
 *
 * @param array<string, mixed> $translationAttributes
 * @param array<string, mixed> $fileAttributes
 * @return array{
 *     translation: \Modules\Lang\Models\Translation,
 *     file: \Modules\Lang\Models\TranslationFile
 * }
 */
function createTranslationSetup(
    array $translationAttributes = [],
    array $fileAttributes = []
): array {
    $translation = createTranslation($translationAttributes);
    $file = createTranslationFile($fileAttributes);

    return [
        'translation' => $translation,
        'file' => $file,
    ];
=======
function createLanguage(array $attributes = []): \Modules\Lang\Models\Language
{
    return \Modules\Lang\Models\Language::factory()->create($attributes);
}

function makeLanguage(array $attributes = []): \Modules\Lang\Models\Language
{
    return \Modules\Lang\Models\Language::factory()->make($attributes);
>>>>>>> aee7a32 (.)
}
