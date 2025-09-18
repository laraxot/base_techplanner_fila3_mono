<?php

declare(strict_types=1);

namespace Modules\Gdpr\Tests\Feature;

use Modules\Gdpr\Models\Profile;
use Modules\Gdpr\Models\Treatment;

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> ee97d89f (.)
it('verifica che i file corretti non contengano marcatori di conflitto', function () {
    $files = [
        '/var/www/html/saluteora/laravel/Modules/Gdpr/app/Models/Treatment.php',
        '/var/www/html/saluteora/laravel/Modules/Gdpr/app/Models/Profile.php',
    ];

    foreach ($files as $file) {
        $content = file_get_contents($file);
        expect($content)->not->toContain('<<<<<<< HEAD')
            ->and($content)->not->toContain('=======')
            ->and($content)->not->toContain('>>>>>>> origin');
    }
});

<<<<<<< HEAD
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
it('verifica che le classi corrette siano istanziabili', function () {
    expect(new Treatment())->toBeInstanceOf(Treatment::class);
    expect(new Profile())->toBeInstanceOf(Profile::class);
});

it('verifica che le proprietà delle classi siano accessibili', function () {
    $treatment = new Treatment();
    $profile = new Profile();
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> faeca70 (.)

    // Verifica che le proprietà fillable siano definite
    expect($treatment->getFillable())->toBeArray();
    expect($profile->getFillable())->toBeArray();

<<<<<<< HEAD
=======
=======
>>>>>>> ee97d89f (.)
    
    // Verifica che le proprietà fillable siano definite
    expect($treatment->getFillable())->toBeArray();
    expect($profile->getFillable())->toBeArray();
    
<<<<<<< HEAD
>>>>>>> 6f6abe7c (.)
=======
>>>>>>> ee97d89f (.)
=======
>>>>>>> faeca70 (.)
    // Verifica che la connessione al database sia definita correttamente
    expect($profile->getConnectionName())->toBe('gdpr');
});
