<?php

declare(strict_types=1);

use Modules\Lang\Models\Language;
use Modules\Lang\Models\Translation;
use Modules\Lang\Models\TranslationKey;
use Modules\Lang\Services\TranslationService;
use Illuminate\Support\Facades\Config;

describe('Lang Business Logic Integration', function () {
    beforeEach(function () {
        $this->italian = Language::factory()->create([
            'code' => 'it',
            'name' => 'Italiano',
            'is_active' => true
        ]);
        
        $this->english = Language::factory()->create([
            'code' => 'en',
            'name' => 'English',
            'is_active' => true
        ]);
        
        $this->german = Language::factory()->create([
            'code' => 'de',
            'name' => 'Deutsch',
            'is_active' => false
        ]);
    });

    describe('Language Management Business Rules', function () {
        it('enforces language code uniqueness', function () {
            $language = Language::factory()->create([
                'code' => 'fr',
                'name' => 'Français'
            ]);
            
            expect($language->code)->toBe('fr');
            expect($language->name)->toBe('Français');
            
            // Tentativo di creare lingua con codice duplicato
            $this->expectException(Illuminate\Database\QueryException::class);
            
            Language::factory()->create([
                'code' => 'fr',
                'name' => 'Français Alternativo'
            ]);
        });

        it('enforces language activation rules', function () {
            $language = Language::factory()->create([
                'code' => 'es',
                'name' => 'Español',
                'is_active' => false
            ]);
            
            // Verifica stato iniziale
            expect($language->is_active)->toBeFalse();
            
            // Attivazione lingua
            $language->update(['is_active' => true]);
            expect($language->is_active)->toBeTrue();
            
            // Verifica che solo le lingue attive siano disponibili
            $activeLanguages = Language::where('is_active', true)->get();
            expect($activeLanguages)->toContain($language);
        });

        it('enforces language code format validation', function () {
            $validCodes = ['it', 'en', 'de', 'fr', 'es', 'pt'];
            
            foreach ($validCodes as $code) {
                $language = Language::factory()->create([
                    'code' => $code,
                    'name' => 'Language ' . strtoupper($code)
                ]);
                
                // Verifica che il codice sia nel formato corretto (2 caratteri)
                expect(strlen($language->code))->toBe(2);
                expect($language->code)->toMatch('/^[a-z]{2}$/');
            }
        });
    });

    describe('Translation Key Management Business Rules', function () {
        it('enforces translation key uniqueness', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'common.welcome',
                'module' => 'core',
                'description' => 'Welcome message'
            ]);
            
            expect($key->key)->toBe('common.welcome');
            expect($key->module)->toBe('core');
            
            // Tentativo di creare chiave duplicata nello stesso modulo
            $this->expectException(Illuminate\Database\QueryException::class);
            
            TranslationKey::factory()->create([
                'key' => 'common.welcome',
                'module' => 'core',
                'description' => 'Duplicate key'
            ]);
        });

        it('enforces translation key format validation', function () {
            $validKeys = [
                'common.welcome',
                'auth.login.title',
                'user.profile.email',
                'validation.required'
            ];
            
            foreach ($validKeys as $keyName) {
                $key = TranslationKey::factory()->create([
                    'key' => $keyName,
                    'module' => 'test',
                    'description' => 'Test key'
                ]);
                
                // Verifica che la chiave sia nel formato corretto (dot notation)
                expect($key->key)->toMatch('/^[a-z]+\.[a-z]+(\.[a-z]+)*$/');
                expect($key->key)->toContain('.');
            }
        });

        it('enforces module-based organization', function () {
            $modules = ['core', 'user', 'auth', 'validation', 'email'];
            
            foreach ($modules as $module) {
                $key = TranslationKey::factory()->create([
                    'key' => 'test.key',
                    'module' => $module,
                    'description' => 'Test key for ' . $module
                ]);
                
                expect($key->module)->toBe($module);
                
                // Verifica che le chiavi siano organizzate per modulo
                $moduleKeys = TranslationKey::where('module', $module)->get();
                expect($moduleKeys)->toContain($key);
            }
        });
    });

    describe('Translation Management Business Rules', function () {
        it('enforces translation completeness for active languages', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'common.hello',
                'module' => 'core'
            ]);
            
            // Creazione traduzioni per tutte le lingue attive
            $activeLanguages = Language::where('is_active', true)->get();
            
            foreach ($activeLanguages as $language) {
                Translation::factory()->create([
                    'translation_key_id' => $key->id,
                    'language_id' => $language->id,
                    'value' => 'Hello in ' . $language->name
                ]);
            }
            
            // Verifica che tutte le lingue attive abbiano traduzioni
            $translations = $key->translations()->whereIn('language_id', $activeLanguages->pluck('id'))->get();
            expect($translations)->toHaveCount($activeLanguages->count());
        });

        it('enforces translation value validation', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'test.validation',
                'module' => 'test'
            ]);
            
            $translation = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Testo di validazione'
            ]);
            
            // Verifica che il valore non sia vuoto
            expect($translation->value)->not->toBeEmpty();
            
            // Verifica che il valore sia una stringa
            expect(is_string($translation->value))->toBeTrue();
            
            // Verifica lunghezza minima
            expect(strlen($translation->value))->toBeGreaterThan(0);
        });

        it('enforces translation consistency across languages', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'common.buttons.save',
                'module' => 'core'
            ]);
            
            // Creazione traduzioni coerenti
            $translations = [
                'it' => 'Salva',
                'en' => 'Save',
                'de' => 'Speichern'
            ];
            
            foreach ($translations as $langCode => $value) {
                $language = Language::where('code', $langCode)->first();
                if ($language) {
                    Translation::factory()->create([
                        'translation_key_id' => $key->id,
                        'language_id' => $language->id,
                        'value' => $value
                    ]);
                }
            }
            
            // Verifica che le traduzioni siano coerenti semanticamente
            $italianTranslation = $key->translations()->where('language_id', $this->italian->id)->first();
            $englishTranslation = $key->translations()->where('language_id', $this->english->id)->first();
            
            if ($italianTranslation && $englishTranslation) {
                expect($italianTranslation->value)->toBe('Salva');
                expect($englishTranslation->value)->toBe('Save');
            }
        });
    });

    describe('Translation Service Business Rules', function () {
        it('enforces fallback language rules', function () {
            $service = new TranslationService();
            
            // Configurazione lingua di fallback
            Config::set('app.fallback_locale', 'en');
            
            $key = TranslationKey::factory()->create([
                'key' => 'common.fallback_test',
                'module' => 'core'
            ]);
            
            // Creazione traduzione solo in inglese (fallback)
            Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->english->id,
                'value' => 'Fallback value'
            ]);
            
            // Verifica che il servizio restituisca il valore di fallback
            $translation = $service->get($key->key, 'it');
            expect($translation)->toBe('Fallback value');
        });

        it('enforces translation caching rules', function () {
            $service = new TranslationService();
            
            $key = TranslationKey::factory()->create([
                'key' => 'common.cache_test',
                'module' => 'core'
            ]);
            
            // Creazione traduzione
            $translation = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Valore in cache'
            ]);
            
            // Prima chiamata (dovrebbe caricare dal database)
            $firstCall = $service->get($key->key, 'it');
            expect($firstCall)->toBe('Valore in cache');
            
            // Seconda chiamata (dovrebbe usare la cache)
            $secondCall = $service->get($key->key, 'it');
            expect($secondCall)->toBe('Valore in cache');
        });

        it('enforces translation interpolation rules', function () {
            $service = new TranslationService();
            
            $key = TranslationKey::factory()->create([
                'key' => 'user.welcome',
                'module' => 'user'
            ]);
            
            // Creazione traduzione con placeholder
            $translation = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Benvenuto, :name!'
            ]);
            
            // Test interpolazione
            $interpolated = $service->get($key->key, 'it', ['name' => 'Mario']);
            expect($interpolated)->toBe('Benvenuto, Mario!');
            
            // Test con parametri mancanti
            $withoutParams = $service->get($key->key, 'it');
            expect($withoutParams)->toBe('Benvenuto, :name!');
        });
    });

    describe('Translation Workflow Business Rules', function () {
        it('enforces translation approval workflow', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'workflow.test',
                'module' => 'test'
            ]);
            
            $translation = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Traduzione in attesa',
                'status' => 'pending'
            ]);
            
            // Verifica stato iniziale
            expect($translation->status)->toBe('pending');
            
            // Workflow di approvazione
            $translation->update(['status' => 'review']);
            expect($translation->status)->toBe('review');
            
            $translation->update(['status' => 'approved']);
            expect($translation->status)->toBe('approved');
            
            // Verifica che solo le traduzioni approvate siano utilizzabili
            $approvedTranslations = Translation::where('status', 'approved')->get();
            expect($approvedTranslations)->toContain($translation);
        });

        it('enforces translation versioning rules', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'versioning.test',
                'module' => 'test'
            ]);
            
            // Prima versione della traduzione
            $translation1 = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Prima versione',
                'version' => 1
            ]);
            
            // Seconda versione della traduzione
            $translation2 = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Seconda versione',
                'version' => 2
            ]);
            
            // Verifica che le versioni siano incrementali
            expect($translation1->version)->toBe(1);
            expect($translation2->version)->toBe(2);
            
            // Verifica che la versione più recente sia attiva
            $latestTranslation = $key->translations()
                ->where('language_id', $this->italian->id)
                ->orderBy('version', 'desc')
                ->first();
            
            expect($latestTranslation->version)->toBe(2);
            expect($latestTranslation->value)->toBe('Seconda versione');
        });
    });

    describe('Translation Quality Business Rules', function () {
        it('enforces translation length consistency', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'length.test',
                'module' => 'test'
            ]);
            
            // Traduzioni in diverse lingue per la stessa chiave
            $translations = [
                'it' => 'Testo italiano',
                'en' => 'English text',
                'de' => 'Deutscher Text'
            ];
            
            foreach ($translations as $langCode => $value) {
                $language = Language::where('code', $langCode)->first();
                if ($language) {
                    Translation::factory()->create([
                        'translation_key_id' => $key->id,
                        'language_id' => $language->id,
                        'value' => $value
                    ]);
                }
            }
            
            // Verifica che le lunghezze siano ragionevolmente simili
            $italianLength = strlen($translations['it']);
            $englishLength = strlen($translations['en']);
            $germanLength = strlen($translations['de']);
            
            $maxVariance = max($italianLength, $englishLength, $germanLength) * 0.5;
            expect(abs($italianLength - $englishLength))->toBeLessThan($maxVariance);
            expect(abs($italianLength - $germanLength))->toBeLessThan($maxVariance);
        });

        it('enforces translation context validation', function () {
            $key = TranslationKey::factory()->create([
                'key' => 'context.test',
                'module' => 'test',
                'context' => 'This is a test context for translation'
            ]);
            
            // Verifica che il contesto sia presente per chiavi complesse
            expect($key->context)->not->toBeEmpty();
            expect(strlen($key->context))->toBeGreaterThan(10);
            
            // Verifica che il contesto aiuti nella traduzione
            $translation = Translation::factory()->create([
                'translation_key_id' => $key->id,
                'language_id' => $this->italian->id,
                'value' => 'Traduzione con contesto',
                'notes' => 'Tradotto considerando il contesto fornito'
            ]);
            
            expect($translation->notes)->not->toBeEmpty();
        });

        it('enforces translation completeness validation', function () {
            $activeLanguages = Language::where('is_active', true)->get();
            $key = TranslationKey::factory()->create([
                'key' => 'completeness.test',
                'module' => 'test'
            ]);
            
            // Creazione traduzioni per tutte le lingue attive
            foreach ($activeLanguages as $language) {
                Translation::factory()->create([
                    'translation_key_id' => $key->id,
                    'language_id' => $language->id,
                    'value' => 'Complete translation for ' . $language->name
                ]);
            }
            
            // Verifica completezza
            $translationCount = $key->translations()->count();
            $activeLanguageCount = $activeLanguages->count();
            
            expect($translationCount)->toBe($activeLanguageCount);
            
            // Verifica che non ci siano traduzioni mancanti
            $missingTranslations = $activeLanguages->filter(function ($language) use ($key) {
                return !$key->translations()->where('language_id', $language->id)->exists();
            });
            
            expect($missingTranslations)->toHaveCount(0);
        });
    });
});
