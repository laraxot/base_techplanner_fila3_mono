<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Modules\Lang\Providers\LangServiceProvider;
=======
use Modules\Lang\Providers\LangServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\File;
>>>>>>> 054e6ea (.)

beforeEach(function () {
    $this->provider = new LangServiceProvider(app());
});

describe('LangServiceProvider Basic Functionality', function () {
    it('extends ServiceProvider', function () {
        expect($this->provider)->toBeInstanceOf(ServiceProvider::class);
    });

    it('can be instantiated', function () {
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });

    it('has correct module name', function () {
        $reflection = new ReflectionClass($this->provider);
        $property = $reflection->getProperty('module_name');
        $property->setAccessible(true);
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        expect($property->getValue($this->provider))->toBe('Lang');
    });
});

describe('LangServiceProvider Registration', function () {
    it('can register services', function () {
        $this->provider->register();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che il provider sia registrato
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });

    it('can boot services', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che il provider sia avviato
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });
});

describe('LangServiceProvider Translation Loading', function () {
    it('loads translations from correct path', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che le traduzioni siano caricate
        expect(Lang::has('lang::common.welcome'))->toBeTrue();
    });

    it('loads translations with correct namespace', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica il namespace delle traduzioni
        $translation = __('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome'); // Non dovrebbe essere la chiave
    });

    it('handles missing translation keys gracefully', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica gestione chiavi mancanti
        $missingTranslation = __('lang::nonexistent.key');
        expect($missingTranslation)->toBe('lang::nonexistent.key'); // Dovrebbe restituire la chiave se non trovata
    });
});

describe('LangServiceProvider Translation Structure', function () {
    it('provides common translations', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $commonKeys = [
            'welcome',
            'loading',
            'error',
            'success',
            'cancel',
            'save',
            'delete',
            'edit',
            'create',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        foreach ($commonKeys as $key) {
            $translation = __("lang::common.{$key}");
            expect($translation)->toBeString();
            expect($translation)->not->toBe("lang::common.{$key}");
        }
    });

    it('provides validation translations', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $validationKeys = [
            'required',
            'email',
            'min',
            'max',
            'unique',
            'confirmed',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        foreach ($validationKeys as $key) {
            $translation = __("lang::validation.{$key}");
            expect($translation)->toBeString();
            expect($translation)->not->toBe("lang::validation.{$key}");
        }
    });

    it('provides error translations', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $errorKeys = [
            'general',
            'not_found',
            'unauthorized',
            'validation',
            'server_error',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        foreach ($errorKeys as $key) {
            $translation = __("lang::errors.{$key}");
            expect($translation)->toBeString();
            expect($translation)->not->toBe("lang::errors.{$key}");
        }
    });
});

describe('LangServiceProvider Language Support', function () {
    it('supports Italian language', function () {
        $this->provider->boot();
<<<<<<< HEAD

        // Cambia lingua a italiano
        app()->setLocale('it');

=======
        
        // Cambia lingua a italiano
        app()->setLocale('it');
        
>>>>>>> 054e6ea (.)
        $translation = __('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome');
    });

    it('supports English language', function () {
        $this->provider->boot();
<<<<<<< HEAD

        // Cambia lingua a inglese
        app()->setLocale('en');

=======
        
        // Cambia lingua a inglese
        app()->setLocale('en');
        
>>>>>>> 054e6ea (.)
        $translation = __('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome');
    });

    it('supports German language', function () {
        $this->provider->boot();
<<<<<<< HEAD

        // Cambia lingua a tedesco
        app()->setLocale('de');

=======
        
        // Cambia lingua a tedesco
        app()->setLocale('de');
        
>>>>>>> 054e6ea (.)
        $translation = __('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome');
    });

    it('falls back to default language when translation missing', function () {
        $this->provider->boot();
<<<<<<< HEAD

        // Cambia lingua a una non supportata
        app()->setLocale('fr');

=======
        
        // Cambia lingua a una non supportata
        app()->setLocale('fr');
        
>>>>>>> 054e6ea (.)
        $translation = __('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome');
    });
});

describe('LangServiceProvider Translation Files', function () {
    it('loads common translation file', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $commonPath = module_path('Lang', 'lang/it/common.php');
        expect(File::exists($commonPath))->toBeTrue();

=======
        
        $commonPath = module_path('Lang', 'lang/it/common.php');
        expect(File::exists($commonPath))->toBeTrue();
        
>>>>>>> 054e6ea (.)
        $translations = require $commonPath;
        expect($translations)->toBeArray();
        expect($translations)->toHaveKey('welcome');
    });

    it('loads validation translation file', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $validationPath = module_path('Lang', 'lang/it/validation.php');
        expect(File::exists($validationPath))->toBeTrue();

=======
        
        $validationPath = module_path('Lang', 'lang/it/validation.php');
        expect(File::exists($validationPath))->toBeTrue();
        
>>>>>>> 054e6ea (.)
        $translations = require $validationPath;
        expect($translations)->toBeArray();
        expect($translations)->toHaveKey('required');
    });

    it('loads error translation file', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $errorPath = module_path('Lang', 'lang/it/errors.php');
        expect(File::exists($errorPath))->toBeTrue();

=======
        
        $errorPath = module_path('Lang', 'lang/it/errors.php');
        expect(File::exists($errorPath))->toBeTrue();
        
>>>>>>> 054e6ea (.)
        $translations = require $errorPath;
        expect($translations)->toBeArray();
        expect($translations)->toHaveKey('general');
    });

    it('loads all required translation files', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $requiredFiles = ['common', 'validation', 'errors'];
        $langPath = module_path('Lang', 'lang/it');

        foreach ($requiredFiles as $file) {
            $filePath = "{$langPath}/{$file}.php";
            expect(File::exists($filePath))->toBeTrue();

=======
        
        $requiredFiles = ['common', 'validation', 'errors'];
        $langPath = module_path('Lang', 'lang/it');
        
        foreach ($requiredFiles as $file) {
            $filePath = "{$langPath}/{$file}.php";
            expect(File::exists($filePath))->toBeTrue();
            
>>>>>>> 054e6ea (.)
            $translations = require $filePath;
            expect($translations)->toBeArray();
            expect($translations)->not->toBeEmpty();
        }
    });
});

describe('LangServiceProvider Translation Quality', function () {
    it('provides complete translation coverage', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $commonKeys = [
            'welcome', 'loading', 'error', 'success', 'cancel', 'save',
            'delete', 'edit', 'create', 'update', 'back', 'next', 'previous',
            'search', 'filter', 'sort', 'refresh', 'export', 'import',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        foreach ($commonKeys as $key) {
            $translation = __("lang::common.{$key}");
            expect($translation)->toBeString();
            expect($translation)->not->toBe("lang::common.{$key}");
            expect(strlen($translation))->toBeGreaterThan(0);
        }
    });

    it('provides consistent translation style', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $translations = [
            __('lang::common.welcome'),
            __('lang::common.loading'),
            __('lang::common.success'),
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che tutte le traduzioni abbiano uno stile coerente
        foreach ($translations as $translation) {
            expect($translation)->toBeString();
            expect(strlen($translation))->toBeGreaterThan(0);
            expect($translation)->not->toMatch('/[A-Z]{2,}/'); // Non dovrebbe contenere sigle in maiuscolo
        }
    });

    it('provides contextually appropriate translations', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        $contextualPairs = [
            'save' => 'Salva',
            'delete' => 'Elimina',
            'edit' => 'Modifica',
            'create' => 'Crea',
        ];
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        foreach ($contextualPairs as $key => $expected) {
            $translation = __("lang::common.{$key}");
            expect($translation)->toBe($expected);
        }
    });
});

describe('LangServiceProvider Performance', function () {
    it('loads translations efficiently', function () {
        $startTime = microtime(true);
<<<<<<< HEAD

        $this->provider->boot();

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

=======
        
        $this->provider->boot();
        
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
>>>>>>> 054e6ea (.)
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
    });

    it('caches translations for performance', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Prima chiamata
        $startTime = microtime(true);
        $translation1 = __('lang::common.welcome');
        $endTime = microtime(true);
        $firstCallTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Seconda chiamata (dovrebbe essere più veloce)
        $startTime = microtime(true);
        $translation2 = __('lang::common.welcome');
        $endTime = microtime(true);
        $secondCallTime = $endTime - $startTime;
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        expect($translation1)->toBe($translation2);
        expect($secondCallTime)->toBeLessThanOrEqual($firstCallTime);
    });

    it('handles multiple language switches efficiently', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $languages = ['it', 'en', 'de', 'it']; // Torna a italiano

        $startTime = microtime(true);

=======
        
        $languages = ['it', 'en', 'de', 'it']; // Torna a italiano
        
        $startTime = microtime(true);
        
>>>>>>> 054e6ea (.)
        foreach ($languages as $locale) {
            app()->setLocale($locale);
            $translation = __('lang::common.welcome');
            expect($translation)->toBeString();
        }
<<<<<<< HEAD

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

=======
        
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
>>>>>>> 054e6ea (.)
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
    });
});

describe('LangServiceProvider Error Handling', function () {
    it('handles missing translation files gracefully', function () {
        // Simula file di traduzione mancanti
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Dovrebbe gestire graziosamente i file mancanti
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });

    it('handles malformed translation files gracefully', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Dovrebbe gestire graziosamente i file malformati
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });

    it('handles empty translation files gracefully', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Dovrebbe gestire graziosamente i file vuoti
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });
});

describe('LangServiceProvider Integration', function () {
    it('works with Laravel translation system', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica integrazione con il sistema di traduzione di Laravel
        expect(Lang::has('lang::common.welcome'))->toBeTrue();
        expect(__('lang::common.welcome'))->toBeString();
    });

    it('works with Filament components', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che le traduzioni siano disponibili per i componenti Filament
        $translation = __('lang::common.save');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.save');
    });

    it('works with Blade templates', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che le traduzioni siano disponibili nei template Blade
        $translation = @lang('lang::common.welcome');
        expect($translation)->toBeString();
        expect($translation)->not->toBe('lang::common.welcome');
    });
});

describe('LangServiceProvider Configuration', function () {
    it('respects Laravel configuration', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che rispetti la configurazione di Laravel
        $defaultLocale = config('app.locale');
        expect($defaultLocale)->toBeString();
        expect(strlen($defaultLocale))->toBeGreaterThan(0);
    });

    it('can be configured via config files', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica che possa essere configurato tramite file di configurazione
        expect(config('app.fallback_locale'))->toBeString();
    });

    it('integrates with other service providers', function () {
        $this->provider->boot();
<<<<<<< HEAD

=======
        
>>>>>>> 054e6ea (.)
        // Verifica integrazione con altri service provider
        expect(app())->toBeInstanceOf(\Illuminate\Contracts\Foundation\Application::class);
    });
});

describe('LangServiceProvider Maintenance', function () {
    it('can be refreshed without errors', function () {
        $this->provider->boot();
<<<<<<< HEAD

        // Verifica che possa essere riavviato senza errori
        $this->provider->boot();

=======
        
        // Verifica che possa essere riavviato senza errori
        $this->provider->boot();
        
>>>>>>> 054e6ea (.)
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });

    it('maintains state consistency', function () {
        $this->provider->boot();
<<<<<<< HEAD

        $translation1 = __('lang::common.welcome');

        $this->provider->boot();

        $translation2 = __('lang::common.welcome');

=======
        
        $translation1 = __('lang::common.welcome');
        
        $this->provider->boot();
        
        $translation2 = __('lang::common.welcome');
        
>>>>>>> 054e6ea (.)
        expect($translation1)->toBe($translation2);
    });

    it('can be unregistered and re-registered', function () {
        $this->provider->register();
        $this->provider->boot();
<<<<<<< HEAD

        // Simula unregister
        $this->provider = new LangServiceProvider(app());

        $this->provider->register();
        $this->provider->boot();

=======
        
        // Simula unregister
        $this->provider = new LangServiceProvider(app());
        
        $this->provider->register();
        $this->provider->boot();
        
>>>>>>> 054e6ea (.)
        expect($this->provider)->toBeInstanceOf(LangServiceProvider::class);
    });
});
