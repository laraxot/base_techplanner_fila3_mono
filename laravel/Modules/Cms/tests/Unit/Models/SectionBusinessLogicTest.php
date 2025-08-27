<?php

declare(strict_types=1);

use Modules\Cms\Models\Section;
use Modules\Tenant\Models\Traits\SushiToJsons;
use Spatie\Translatable\HasTranslations;

test('section model uses required traits', function () {
    $section = new Section();
    
    expect($section)->toBeInstanceOf(SushiToJsons::class);
    expect(in_array(HasTranslations::class, class_uses($section)))->toBeTrue();
});

test('section has correct translatable attributes', function () {
    $section = new Section();
    
    $expectedTranslatable = [
        'name',
        'blocks',
    ];
    
    expect($section->translatable)->toBe($expectedTranslatable);
});

test('section has correct fillable attributes', function () {
    $section = new Section();
    
    $expectedFillable = [
        'name',
        'slug',
        'blocks',
    ];
    
    expect($section->getFillable())->toBe($expectedFillable);
});

test('section has correct schema definition', function () {
    $section = new Section();
    
    $expectedSchema = [
        'id' => 'integer',
        'name' => 'json',
        'slug' => 'string',
        'blocks' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string',
    ];
    
    expect($section->schema)->toBe($expectedSchema);
});

test('section has correct casts', function () {
    $section = new Section();
    
    $expectedCasts = [
        'id' => 'string',
        'name' => 'array',
        'slug' => 'string',
        'blocks' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    expect($section->casts())->toBe($expectedCasts);
});

test('section can be created with basic data', function () {
    $section = Section::factory()->create([
        'slug' => 'hero-section',
        'name' => ['en' => 'Hero Section', 'it' => 'Sezione Hero'],
        'blocks' => [['type' => 'hero', 'title' => 'Welcome']]
    ]);
    
    expect($section)
        ->slug->toBe('hero-section')
        ->name->toBe(['en' => 'Hero Section', 'it' => 'Sezione Hero'])
        ->blocks->toBe([['type' => 'hero', 'title' => 'Welcome']]);
});

test('section blocks support complex structures', function () {
    $blocks = [
        [
            'type' => 'carousel',
            'title' => 'Featured Items',
            'items' => [
                ['image' => 'slide1.jpg', 'title' => 'Slide 1', 'description' => 'First slide'],
                ['image' => 'slide2.jpg', 'title' => 'Slide 2', 'description' => 'Second slide'],
                ['image' => 'slide3.jpg', 'title' => 'Slide 3', 'description' => 'Third slide']
            ],
            'settings' => ['autoplay' => true, 'interval' => 5000]
        ],
        [
            'type' => 'grid',
            'title' => 'Content Grid',
            'columns' => 3,
            'items' => array_map(fn($i) => [
                'title' => "Item {$i}",
                'content' => "Content for item {$i}",
                'icon' => "icon{$i}.svg"
            ], range(1, 6))
        ],
        [
            'type' => 'stats',
            'title' => 'Our Statistics',
            'numbers' => [
                ['value' => 1000, 'label' => 'Happy Customers', 'prefix' => '+'],
                ['value' => 500, 'label' => 'Projects Completed', 'prefix' => '+'],
                ['value' => 99.9, 'label' => 'Uptime', 'suffix' => '%'],
                ['value' => 24, 'label' => 'Support Hours', 'suffix' => '/7']
            ]
        ]
    ];
    
    $section = Section::factory()->create(['blocks' => $blocks]);
    
    expect($section->blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('carousel')->items->toHaveCount(3),
            fn($block) => $block->type->toBe('grid')->items->toHaveCount(6),
            fn($block) => $block->type->toBe('stats')->numbers->toHaveCount(4)
        );
});

test('section supports multilingual name', function () {
    $section = Section::factory()->create([
        'name' => [
            'en' => 'Features Section',
            'it' => 'Sezione Funzionalità',
            'es' => 'Sección de Características',
            'fr' => 'Section des Fonctionnalités'
        ]
    ]);
    
    expect($section->name)
        ->toBeArray()
        ->toHaveKey('en', 'Features Section')
        ->toHaveKey('it', 'Sezione Funzionalità')
        ->toHaveKey('es', 'Sección de Características')
        ->toHaveKey('fr', 'Section des Fonctionnalités');
});

test('section supports multilingual blocks', function () {
    $blocks = [
        'en' => [
            ['type' => 'text', 'content' => 'English content']
        ],
        'it' => [
            ['type' => 'text', 'content' => 'Contenuto italiano']
        ],
        'es' => [
            ['type' => 'text', 'content' => 'Contenido español']
        ]
    ];
    
    $section = Section::factory()->create(['blocks' => $blocks]);
    
    expect($section->blocks)
        ->toBeArray()
        ->toHaveKeys(['en', 'it', 'es'])
        ->en->toBeArray()->toHaveCount(1)
        ->it->toBeArray()->toHaveCount(1)
        ->es->toBeArray()->toHaveCount(1);
});

test('section factory creates valid instances', function () {
    $section = Section::factory()->make();
    
    expect($section)
        ->slug->toBeString()->not->toBeEmpty()
        ->name->toBeArray()->not->toBeEmpty()
        ->blocks->toBeArray();
});

test('section slug must be unique', function () {
    $section1 = Section::factory()->create(['slug' => 'unique-section']);
    
    expect(fn() => Section::factory()->create(['slug' => 'unique-section']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('section blocks validation', function () {
    $section = Section::factory()->make(['blocks' => 'invalid-string']);
    
    expect(fn() => $section->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('section handles large blocks efficiently', function () {
    $largeBlocks = array_map(fn($i) => [
        'type' => 'card',
        'title' => "Card {$i}",
        'content' => "Content for card {$i}",
        'image' => "card{$i}.jpg",
        'actions' => [
            ['label' => 'View Details', 'url' => "/card/{$i}"],
            ['label' => 'Learn More', 'url' => "/learn/{$i}"]
        ]
    ], range(1, 30));
    
    $section = Section::factory()->create(['blocks' => $largeBlocks]);
    
    expect($section->fresh()->blocks)
        ->toBeArray()
        ->toHaveCount(30);
});

test('section name validation for multilingual support', function () {
    $section = Section::factory()->make(['name' => 'invalid-string']);
    
    expect(fn() => $section->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('section getRows method returns sushi rows', function () {
    $section = new Section();
    
    $rows = $section->getRows();
    
    expect($rows)->toBeArray();
});

test('section with complex interactive block structures', function () {
    $complexBlocks = [
        [
            'type' => 'interactive_form',
            'title' => 'Contact Form',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Full Name',
                    'required' => true,
                    'placeholder' => 'Enter your name',
                    'validation' => ['min' => 2, 'max' => 100]
                ],
                [
                    'type' => 'email',
                    'name' => 'email',
                    'label' => 'Email Address',
                    'required' => true,
                    'placeholder' => 'Enter your email',
                    'validation' => ['email' => true]
                ],
                [
                    'type' => 'textarea',
                    'name' => 'message',
                    'label' => 'Message',
                    'required' => false,
                    'placeholder' => 'Enter your message',
                    'rows' => 4,
                    'validation' => ['max' => 1000]
                ],
                [
                    'type' => 'select',
                    'name' => 'department',
                    'label' => 'Department',
                    'options' => [
                        ['value' => 'sales', 'label' => 'Sales'],
                        ['value' => 'support', 'label' => 'Support'],
                        ['value' => 'billing', 'label' => 'Billing'],
                        ['value' => 'other', 'label' => 'Other']
                    ],
                    'required' => true
                ]
            ],
            'submit_button' => [
                'text' => 'Send Message',
                'style' => 'primary',
                'icon' => 'send'
            ],
            'success_message' => 'Thank you for your message!',
            'error_message' => 'Please check the form for errors.'
        ],
        [
            'type' => 'interactive_map',
            'title' => 'Our Locations',
            'center' => ['lat' => 41.9028, 'lng' => 12.4964],
            'zoom' => 10,
            'markers' => [
                [
                    'position' => ['lat' => 41.9028, 'lng' => 12.4964],
                    'title' => 'Rome Office',
                    'description' => 'Main headquarters',
                    'icon' => 'office',
                    'info_window' => '<h3>Rome Office</h3><p>Via Appia 123</p>'
                ],
                [
                    'position' => ['lat' => 45.4642, 'lng' => 9.1900],
                    'title' => 'Milan Office',
                    'description' => 'Regional office',
                    'icon' => 'office',
                    'info_window' => '<h3>Milan Office</h3><p>Via Dante 456</p>'
                ],
                [
                    'position' => ['lat' => 40.8518, 'lng' => 14.2681],
                    'title' => 'Naples Office',
                    'description' => 'Southern office',
                    'icon' => 'office',
                    'info_window' => '<h3>Naples Office</h3><p>Via Toledo 789</p>'
                ]
            ],
            'controls' => ['zoom', 'fullscreen', 'streetview'],
            'styles' => [
                ['featureType' => 'all', 'stylers' => [['saturation' => -30]]]
            ]
        ],
        [
            'type' => 'data_table',
            'title' => 'Performance Metrics',
            'columns' => [
                ['key' => 'metric', 'label' => 'Metric', 'sortable' => true],
                ['key' => 'value', 'label' => 'Value', 'sortable' => true],
                ['key' => 'trend', 'label' => 'Trend', 'sortable' => false],
                ['key' => 'status', 'label' => 'Status', 'sortable' => true]
            ],
            'data' => array_map(fn($i) => [
                'metric' => "Metric {$i}",
                'value' => rand(100, 1000),
                'trend' => rand(0, 1) ? 'up' : 'down',
                'status' => ['good', 'warning', 'critical'][rand(0, 2)]
            ], range(1, 25)),
            'pagination' => ['enabled' => true, 'per_page' => 10],
            'sorting' => ['enabled' => true, 'default' => 'metric'],
            'search' => ['enabled' => true, 'placeholder' => 'Search metrics...']
        ]
    ];
    
    $section = Section::factory()->create(['blocks' => $complexBlocks]);
    
    expect($section->fresh()->blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('interactive_form')->fields->toHaveCount(4),
            fn($block) => $block->type->toBe('interactive_map')->markers->toHaveCount(3),
            fn($block) => $block->type->toBe('data_table')->data->toHaveCount(25)
        );
});