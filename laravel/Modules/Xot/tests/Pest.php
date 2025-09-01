<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\Xot\Tests;
=======
use Modules\Xot\Tests\TestCase;
>>>>>>> e697a77b (.)

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| Il TestCase di default per tutti i test del modulo Xot.
| Estende il TestCase specifico del modulo che fornisce il setup necessario.
|
*/

<<<<<<< HEAD
uses(TestCase::class)
    ->uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class)
=======
pest()->extend(TestCase::class)
>>>>>>> e697a77b (.)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Qui puoi definire aspettative globali per il modulo Xot.
<<<<<<< HEAD
| Quando definisci here expectation globali, saranno disponibili
=======
| Quando definisci here expectation globali, saranno disponibili 
>>>>>>> e697a77b (.)
| in tutti i test del modulo.
|
*/

// expect()->extend('toBeOne', function () {
//     return $this->toBe(1);
// });

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Qui puoi definire funzioni helper globali per i test del modulo.
| Queste funzioni saranno disponibili in tutti i test.
|
*/

// function something() {
//     // ...
<<<<<<< HEAD
// }
=======
// } 
>>>>>>> e697a77b (.)
