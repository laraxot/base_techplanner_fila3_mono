<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\UI\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Modules\UI\Models\Asset;
use Modules\UI\Models\Component;
use Modules\UI\Models\Theme;
use Modules\UI\Services\ComponentService;
use Modules\UI\Services\ThemeService;
=======
use Modules\UI\Models\Component;
use Modules\UI\Models\Theme;
use Modules\UI\Models\Asset;
use Modules\UI\Services\ComponentService;
use Modules\UI\Services\ThemeService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
>>>>>>> 60908d2 (.)

describe('UI Business Logic Integration', function () {
    beforeEach(function () {
        $this->theme = Theme::factory()->create([
            'name' => 'Default Theme',
<<<<<<< HEAD
            'is_active' => true,
        ]);

        $this->component = Component::factory()->create([
            'name' => 'test-component',
            'theme_id' => $this->theme->id,
            'is_active' => true,
=======
            'is_active' => true
        ]);
        
        $this->component = Component::factory()->create([
            'name' => 'test-component',
            'theme_id' => $this->theme->id,
            'is_active' => true
>>>>>>> 60908d2 (.)
        ]);
    });

    describe('Theme Management Business Rules', function () {
        it('enforces theme activation rules', function () {
            $theme = Theme::factory()->create([
                'name' => 'Test Theme',
<<<<<<< HEAD
                'is_active' => false,
            ]);

            // Verifica stato iniziale
            expect($theme->is_active)->toBeFalse();

            // Attivazione tema
            $theme->update(['is_active' => true]);
            expect($theme->is_active)->toBeTrue();

            // Verifica che solo un tema possa essere attivo per volta
            $activeThemes = Theme::where('is_active', true)->get();
            expect($activeThemes)->toHaveCount(2); // Default + Test

=======
                'is_active' => false
            ]);
            
            // Verifica stato iniziale
            expect($theme->is_active)->toBeFalse();
            
            // Attivazione tema
            $theme->update(['is_active' => true]);
            expect($theme->is_active)->toBeTrue();
            
            // Verifica che solo un tema possa essere attivo per volta
            $activeThemes = Theme::where('is_active', true)->get();
            expect($activeThemes)->toHaveCount(2); // Default + Test
            
>>>>>>> 60908d2 (.)
            // Disattivazione tema precedente
            $this->theme->update(['is_active' => false]);
            $activeThemes = Theme::where('is_active', true)->get();
            expect($activeThemes)->toHaveCount(1);
        });

        it('enforces theme configuration validation', function () {
            $theme = Theme::factory()->create([
                'name' => 'Configurable Theme',
                'config' => [
                    'primary_color' => '#007bff',
                    'secondary_color' => '#6c757d',
<<<<<<< HEAD
                    'font_family' => 'Arial, sans-serif',
                ],
            ]);

=======
                    'font_family' => 'Arial, sans-serif'
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che la configurazione sia valida
            expect($theme->config)->toBeArray();
            expect($theme->config['primary_color'])->toMatch('/^#[0-9a-fA-F]{6}$/');
            expect($theme->config['secondary_color'])->toMatch('/^#[0-9a-fA-F]{6}$/');
            expect($theme->config['font_family'])->toContain('Arial');
        });

        it('enforces theme inheritance rules', function () {
            $parentTheme = Theme::factory()->create([
                'name' => 'Parent Theme',
<<<<<<< HEAD
                'is_active' => false,
            ]);

            $childTheme = Theme::factory()->create([
                'name' => 'Child Theme',
                'parent_id' => $parentTheme->id,
                'is_active' => false,
            ]);

            // Verifica relazione di ereditarietà
            expect($childTheme->parent_id)->toBe($parentTheme->id);
            expect($childTheme->parent)->toBe($parentTheme);

            // Verifica che il tema figlio erediti le configurazioni del padre
            $parentConfig = $parentTheme->config ?? [];
            $childConfig = $childTheme->config ?? [];

=======
                'is_active' => false
            ]);
            
            $childTheme = Theme::factory()->create([
                'name' => 'Child Theme',
                'parent_id' => $parentTheme->id,
                'is_active' => false
            ]);
            
            // Verifica relazione di ereditarietà
            expect($childTheme->parent_id)->toBe($parentTheme->id);
            expect($childTheme->parent)->toBe($parentTheme);
            
            // Verifica che il tema figlio erediti le configurazioni del padre
            $parentConfig = $parentTheme->config ?? [];
            $childConfig = $childTheme->config ?? [];
            
>>>>>>> 60908d2 (.)
            // Merge delle configurazioni
            $mergedConfig = array_merge($parentConfig, $childConfig);
            expect($mergedConfig)->toBeArray();
        });
    });

    describe('Component Management Business Rules', function () {
        it('enforces component naming conventions', function () {
            $validNames = [
                'button',
                'card',
                'form-input',
                'navigation-menu',
<<<<<<< HEAD
                'data-table',
            ];

            foreach ($validNames as $name) {
                $component = Component::factory()->create([
                    'name' => $name,
                    'theme_id' => $this->theme->id,
                ]);

=======
                'data-table'
            ];
            
            foreach ($validNames as $name) {
                $component = Component::factory()->create([
                    'name' => $name,
                    'theme_id' => $this->theme->id
                ]);
                
>>>>>>> 60908d2 (.)
                // Verifica che il nome sia nel formato corretto
                expect($component->name)->toMatch('/^[a-z]+(-[a-z]+)*$/');
                expect($component->name)->not->toContain('_');
                expect($component->name)->not->toContain(' ');
            }
        });

        it('enforces component versioning rules', function () {
            $component = Component::factory()->create([
                'name' => 'versioned-component',
                'theme_id' => $this->theme->id,
<<<<<<< HEAD
                'version' => '1.0.0',
            ]);

            // Verifica formato versione semantica
            expect($component->version)->toMatch('/^\d+\.\d+\.\d+$/');

            // Aggiornamento versione
            $component->update(['version' => '1.1.0']);
            expect($component->version)->toBe('1.1.0');

=======
                'version' => '1.0.0'
            ]);
            
            // Verifica formato versione semantica
            expect($component->version)->toMatch('/^\d+\.\d+\.\d+$/');
            
            // Aggiornamento versione
            $component->update(['version' => '1.1.0']);
            expect($component->version)->toBe('1.1.0');
            
>>>>>>> 60908d2 (.)
            // Verifica che la versione sia incrementale
            $major = (int) explode('.', $component->version)[0];
            $minor = (int) explode('.', $component->version)[1];
            $patch = (int) explode('.', $component->version)[2];
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            expect($major)->toBeGreaterThanOrEqual(1);
            expect($minor)->toBeGreaterThanOrEqual(1);
            expect($patch)->toBeGreaterThanOrEqual(0);
        });

        it('enforces component dependency rules', function () {
            $component = Component::factory()->create([
                'name' => 'dependent-component',
                'theme_id' => $this->theme->id,
<<<<<<< HEAD
                'dependencies' => ['jquery', 'bootstrap'],
            ]);

=======
                'dependencies' => ['jquery', 'bootstrap']
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che le dipendenze siano un array
            expect($component->dependencies)->toBeArray();
            expect($component->dependencies)->toContain('jquery');
            expect($component->dependencies)->toContain('bootstrap');
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che le dipendenze siano stringhe valide
            foreach ($component->dependencies as $dependency) {
                expect(is_string($dependency))->toBeTrue();
                expect($dependency)->toMatch('/^[a-zA-Z0-9-]+$/');
            }
        });
    });

    describe('Asset Management Business Rules', function () {
        it('enforces asset file validation', function () {
            $asset = Asset::factory()->create([
                'name' => 'main.css',
                'type' => 'css',
                'path' => '/assets/css/main.css',
<<<<<<< HEAD
                'theme_id' => $this->theme->id,
            ]);

            // Verifica che il tipo di asset sia valido
            $validTypes = ['css', 'js', 'image', 'font', 'icon'];
            expect($validTypes)->toContain($asset->type);

            // Verifica che il percorso sia valido
            expect($asset->path)->toMatch('/^\/[a-zA-Z0-9\/-]+\.[a-zA-Z]+$/');

=======
                'theme_id' => $this->theme->id
            ]);
            
            // Verifica che il tipo di asset sia valido
            $validTypes = ['css', 'js', 'image', 'font', 'icon'];
            expect($validTypes)->toContain($asset->type);
            
            // Verifica che il percorso sia valido
            expect($asset->path)->toMatch('/^\/[a-zA-Z0-9\/-]+\.[a-zA-Z]+$/');
            
>>>>>>> 60908d2 (.)
            // Verifica che il nome del file corrisponda al percorso
            $fileName = basename($asset->path);
            expect($asset->name)->toBe($fileName);
        });

        it('enforces asset optimization rules', function () {
            $asset = Asset::factory()->create([
                'name' => 'optimized.js',
                'type' => 'js',
                'path' => '/assets/js/optimized.js',
                'theme_id' => $this->theme->id,
                'is_minified' => true,
<<<<<<< HEAD
                'is_compressed' => true,
            ]);

            // Verifica che gli asset ottimizzati abbiano le flag corrette
            expect($asset->is_minified)->toBeTrue();
            expect($asset->is_compressed)->toBeTrue();

=======
                'is_compressed' => true
            ]);
            
            // Verifica che gli asset ottimizzati abbiano le flag corrette
            expect($asset->is_minified)->toBeTrue();
            expect($asset->is_compressed)->toBeTrue();
            
>>>>>>> 60908d2 (.)
            // Verifica che gli asset CSS e JS possano essere minificati
            if (in_array($asset->type, ['css', 'js'])) {
                expect($asset->is_minified)->toBeTrue();
            }
        });

        it('enforces asset loading order', function () {
            $assets = collect([
                Asset::factory()->create([
                    'name' => 'jquery.js',
                    'type' => 'js',
                    'order' => 1,
<<<<<<< HEAD
                    'theme_id' => $this->theme->id,
=======
                    'theme_id' => $this->theme->id
>>>>>>> 60908d2 (.)
                ]),
                Asset::factory()->create([
                    'name' => 'bootstrap.js',
                    'type' => 'js',
                    'order' => 2,
<<<<<<< HEAD
                    'theme_id' => $this->theme->id,
=======
                    'theme_id' => $this->theme->id
>>>>>>> 60908d2 (.)
                ]),
                Asset::factory()->create([
                    'name' => 'app.js',
                    'type' => 'js',
                    'order' => 3,
<<<<<<< HEAD
                    'theme_id' => $this->theme->id,
                ]),
            ]);

=======
                    'theme_id' => $this->theme->id
                ])
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che l'ordine di caricamento sia rispettato
            $orderedAssets = $assets->sortBy('order');
            expect($orderedAssets->first()->order)->toBe(1);
            expect($orderedAssets->last()->order)->toBe(3);
<<<<<<< HEAD

            // Verifica che jQuery sia caricato prima di Bootstrap
            $jquery = $assets->where('name', 'jquery.js')->first();
            $bootstrap = $assets->where('name', 'bootstrap.js')->first();

=======
            
            // Verifica che jQuery sia caricato prima di Bootstrap
            $jquery = $assets->where('name', 'jquery.js')->first();
            $bootstrap = $assets->where('name', 'bootstrap.js')->first();
            
>>>>>>> 60908d2 (.)
            expect($jquery->order)->toBeLessThan($bootstrap->order);
        });
    });

    describe('Component Service Business Rules', function () {
        it('enforces component rendering rules', function () {
<<<<<<< HEAD
            $service = new ComponentService;

=======
            $service = new ComponentService();
            
>>>>>>> 60908d2 (.)
            $component = Component::factory()->create([
                'name' => 'renderable-component',
                'theme_id' => $this->theme->id,
                'template' => '<div class="test-component">{{ $content }}</div>',
<<<<<<< HEAD
                'is_active' => true,
            ]);

=======
                'is_active' => true
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che il componente sia renderizzabile
            expect($component->is_active)->toBeTrue();
            expect($component->template)->not->toBeEmpty();
            expect($component->template)->toContain('{{ $content }}');
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che il template sia HTML valido
            expect($component->template)->toContain('<div');
            expect($component->template)->toContain('</div>');
        });

        it('enforces component caching rules', function () {
<<<<<<< HEAD
            $service = new ComponentService;

=======
            $service = new ComponentService();
            
>>>>>>> 60908d2 (.)
            $component = Component::factory()->create([
                'name' => 'cacheable-component',
                'theme_id' => $this->theme->id,
                'is_cacheable' => true,
<<<<<<< HEAD
                'cache_ttl' => 3600,
            ]);

            // Verifica che il componente sia cacheabile
            expect($component->is_cacheable)->toBeTrue();
            expect($component->cache_ttl)->toBeGreaterThan(0);

            // Verifica che il TTL sia in secondi
            expect($component->cache_ttl)->toBe(3600); // 1 ora

=======
                'cache_ttl' => 3600
            ]);
            
            // Verifica che il componente sia cacheabile
            expect($component->is_cacheable)->toBeTrue();
            expect($component->cache_ttl)->toBeGreaterThan(0);
            
            // Verifica che il TTL sia in secondi
            expect($component->cache_ttl)->toBe(3600); // 1 ora
            
>>>>>>> 60908d2 (.)
            // Verifica che il TTL non sia troppo lungo
            expect($component->cache_ttl)->toBeLessThan(86400); // 24 ore
        });

        it('enforces component validation rules', function () {
<<<<<<< HEAD
            $service = new ComponentService;

=======
            $service = new ComponentService();
            
>>>>>>> 60908d2 (.)
            $component = Component::factory()->create([
                'name' => 'validated-component',
                'theme_id' => $this->theme->id,
                'validation_rules' => [
                    'required' => true,
                    'min_length' => 3,
<<<<<<< HEAD
                    'max_length' => 100,
                ],
            ]);

=======
                    'max_length' => 100
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che le regole di validazione siano valide
            expect($component->validation_rules)->toBeArray();
            expect($component->validation_rules['required'])->toBeTrue();
            expect($component->validation_rules['min_length'])->toBeGreaterThan(0);
            expect($component->validation_rules['max_length'])->toBeGreaterThan($component->validation_rules['min_length']);
        });
    });

    describe('Theme Service Business Rules', function () {
        it('enforces theme compilation rules', function () {
<<<<<<< HEAD
            $service = new ThemeService;

=======
            $service = new ThemeService();
            
>>>>>>> 60908d2 (.)
            $theme = Theme::factory()->create([
                'name' => 'Compilable Theme',
                'source_path' => '/themes/compilable',
                'compiled_path' => '/public/themes/compilable',
<<<<<<< HEAD
                'needs_compilation' => true,
            ]);

=======
                'needs_compilation' => true
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che il tema necessiti di compilazione
            expect($theme->needs_compilation)->toBeTrue();
            expect($theme->source_path)->not->toBeEmpty();
            expect($theme->compiled_path)->not->toBeEmpty();
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che i percorsi siano diversi
            expect($theme->source_path)->not->toBe($theme->compiled_path);
        });

        it('enforces theme asset compilation', function () {
<<<<<<< HEAD
            $service = new ThemeService;

            $theme = $this->theme;
            $assets = Asset::factory()->count(3)->create([
                'theme_id' => $theme->id,
                'type' => 'css',
            ]);

            // Verifica che il tema abbia asset da compilare
            expect($theme->assets)->toHaveCount(3);

=======
            $service = new ThemeService();
            
            $theme = $this->theme;
            $assets = Asset::factory()->count(3)->create([
                'theme_id' => $theme->id,
                'type' => 'css'
            ]);
            
            // Verifica che il tema abbia asset da compilare
            expect($theme->assets)->toHaveCount(3);
            
>>>>>>> 60908d2 (.)
            // Verifica che tutti gli asset siano dello stesso tipo
            foreach ($theme->assets as $asset) {
                expect($asset->type)->toBe('css');
            }
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che gli asset appartengano al tema corretto
            foreach ($theme->assets as $asset) {
                expect($asset->theme_id)->toBe($theme->id);
            }
        });

        it('enforces theme configuration inheritance', function () {
<<<<<<< HEAD
            $service = new ThemeService;

=======
            $service = new ThemeService();
            
>>>>>>> 60908d2 (.)
            $parentTheme = Theme::factory()->create([
                'name' => 'Parent Theme',
                'config' => [
                    'colors' => ['primary' => '#007bff'],
<<<<<<< HEAD
                    'fonts' => ['main' => 'Arial'],
                ],
            ]);

=======
                    'fonts' => ['main' => 'Arial']
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            $childTheme = Theme::factory()->create([
                'name' => 'Child Theme',
                'parent_id' => $parentTheme->id,
                'config' => [
                    'colors' => ['secondary' => '#6c757d'],
<<<<<<< HEAD
                    'fonts' => ['heading' => 'Georgia'],
                ],
            ]);

=======
                    'fonts' => ['heading' => 'Georgia']
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che il tema figlio erediti le configurazioni del padre
            $mergedConfig = array_merge_recursive(
                $parentTheme->config ?? [],
                $childTheme->config ?? []
            );
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            expect($mergedConfig['colors']['primary'])->toBe('#007bff');
            expect($mergedConfig['colors']['secondary'])->toBe('#6c757d');
            expect($mergedConfig['fonts']['main'])->toBe('Arial');
            expect($mergedConfig['fonts']['heading'])->toBe('Georgia');
        });
    });

    describe('UI Rendering Business Rules', function () {
        it('enforces view compilation rules', function () {
            $component = Component::factory()->create([
                'name' => 'view-component',
                'theme_id' => $this->theme->id,
                'view_path' => 'components.test-component',
<<<<<<< HEAD
                'is_active' => true,
            ]);

            // Verifica che il componente abbia un percorso view valido
            expect($component->view_path)->not->toBeEmpty();
            expect($component->view_path)->toMatch('/^[a-z-]+\.[a-z-]+$/');

=======
                'is_active' => true
            ]);
            
            // Verifica che il componente abbia un percorso view valido
            expect($component->view_path)->not->toBeEmpty();
            expect($component->view_path)->toMatch('/^[a-z-]+\.[a-z-]+$/');
            
>>>>>>> 60908d2 (.)
            // Verifica che il componente sia attivo
            expect($component->is_active)->toBeTrue();
        });

        it('enforces component data binding', function () {
            $component = Component::factory()->create([
                'name' => 'data-component',
                'theme_id' => $this->theme->id,
                'data_schema' => [
                    'title' => 'string',
                    'content' => 'text',
<<<<<<< HEAD
                    'items' => 'array',
                ],
            ]);

=======
                    'items' => 'array'
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che lo schema dei dati sia valido
            expect($component->data_schema)->toBeArray();
            expect($component->data_schema['title'])->toBe('string');
            expect($component->data_schema['content'])->toBe('text');
            expect($component->data_schema['items'])->toBe('array');
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che i tipi di dati siano validi
            $validTypes = ['string', 'text', 'array', 'object', 'number', 'boolean'];
            foreach ($component->data_schema as $field => $type) {
                expect($validTypes)->toContain($type);
            }
        });

        it('enforces responsive design rules', function () {
            $component = Component::factory()->create([
                'name' => 'responsive-component',
                'theme_id' => $this->theme->id,
                'responsive_breakpoints' => [
                    'mobile' => 'max-width: 768px',
                    'tablet' => 'min-width: 769px and max-width: 1024px',
<<<<<<< HEAD
                    'desktop' => 'min-width: 1025px',
                ],
            ]);

=======
                    'desktop' => 'min-width: 1025px'
                ]
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che i breakpoint siano definiti
            expect($component->responsive_breakpoints)->toBeArray();
            expect($component->responsive_breakpoints['mobile'])->toContain('max-width');
            expect($component->responsive_breakpoints['tablet'])->toContain('min-width');
            expect($component->responsive_breakpoints['desktop'])->toContain('min-width');
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che i breakpoint siano ordinati correttamente
            $mobileMax = (int) preg_replace('/[^0-9]/', '', $component->responsive_breakpoints['mobile']);
            $tabletMin = (int) preg_replace('/[^0-9]/', '', $component->responsive_breakpoints['tablet']);
            $tabletMax = (int) preg_replace('/[^0-9]/', '', $component->responsive_breakpoints['tablet']);
            $desktopMin = (int) preg_replace('/[^0-9]/', '', $component->responsive_breakpoints['desktop']);
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            expect($mobileMax)->toBeLessThan($tabletMin);
            expect($tabletMax)->toBeLessThan($desktopMin);
        });
    });

    describe('Performance and Optimization Business Rules', function () {
        it('enforces asset bundling rules', function () {
            $theme = $this->theme;
            $cssAssets = Asset::factory()->count(3)->create([
                'theme_id' => $theme->id,
                'type' => 'css',
<<<<<<< HEAD
                'should_bundle' => true,
            ]);

            $jsAssets = Asset::factory()->count(2)->create([
                'theme_id' => $theme->id,
                'type' => 'js',
                'should_bundle' => true,
            ]);

=======
                'should_bundle' => true
            ]);
            
            $jsAssets = Asset::factory()->count(2)->create([
                'theme_id' => $theme->id,
                'type' => 'js',
                'should_bundle' => true
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che gli asset siano marcati per il bundling
            foreach ($cssAssets as $asset) {
                expect($asset->should_bundle)->toBeTrue();
            }
<<<<<<< HEAD

            foreach ($jsAssets as $asset) {
                expect($asset->should_bundle)->toBeTrue();
            }

            // Verifica che il bundling riduca il numero di file
            $bundledCssCount = 1; // Un file CSS bundle
            $bundledJsCount = 1;  // Un file JS bundle

=======
            
            foreach ($jsAssets as $asset) {
                expect($asset->should_bundle)->toBeTrue();
            }
            
            // Verifica che il bundling riduca il numero di file
            $bundledCssCount = 1; // Un file CSS bundle
            $bundledJsCount = 1;  // Un file JS bundle
            
>>>>>>> 60908d2 (.)
            expect($bundledCssCount)->toBeLessThan($cssAssets->count());
            expect($bundledJsCount)->toBeLessThan($jsAssets->count());
        });

        it('enforces lazy loading rules', function () {
            $component = Component::factory()->create([
                'name' => 'lazy-component',
                'theme_id' => $this->theme->id,
                'supports_lazy_loading' => true,
<<<<<<< HEAD
                'lazy_loading_threshold' => 0.5,
            ]);

=======
                'lazy_loading_threshold' => 0.5
            ]);
            
>>>>>>> 60908d2 (.)
            // Verifica che il componente supporti il lazy loading
            expect($component->supports_lazy_loading)->toBeTrue();
            expect($component->lazy_loading_threshold)->toBeGreaterThan(0);
            expect($component->lazy_loading_threshold)->toBeLessThan(1);
<<<<<<< HEAD

=======
            
>>>>>>> 60908d2 (.)
            // Verifica che la threshold sia ragionevole
            expect($component->lazy_loading_threshold)->toBe(0.5);
        });

        it('enforces caching strategies', function () {
            $component = Component::factory()->create([
                'name' => 'cacheable-ui-component',
                'theme_id' => $this->theme->id,
                'cache_strategy' => 'aggressive',
<<<<<<< HEAD
                'cache_duration' => 7200,
            ]);

            // Verifica che la strategia di cache sia valida
            $validStrategies = ['none', 'conservative', 'moderate', 'aggressive'];
            expect($validStrategies)->toContain($component->cache_strategy);

            // Verifica che la durata della cache sia ragionevole
            expect($component->cache_duration)->toBeGreaterThan(0);
            expect($component->cache_duration)->toBeLessThan(86400); // 24 ore

=======
                'cache_duration' => 7200
            ]);
            
            // Verifica che la strategia di cache sia valida
            $validStrategies = ['none', 'conservative', 'moderate', 'aggressive'];
            expect($validStrategies)->toContain($component->cache_strategy);
            
            // Verifica che la durata della cache sia ragionevole
            expect($component->cache_duration)->toBeGreaterThan(0);
            expect($component->cache_duration)->toBeLessThan(86400); // 24 ore
            
>>>>>>> 60908d2 (.)
            // Verifica che le strategie aggressive abbiano durate più lunghe
            if ($component->cache_strategy === 'aggressive') {
                expect($component->cache_duration)->toBeGreaterThan(3600); // 1 ora
            }
        });
    });
});
