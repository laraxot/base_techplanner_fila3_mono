<?php

declare(strict_types=1);

use Modules\Cms\Models\Page;
use Modules\Tenant\Models\Traits\SushiToJsons;
use Spatie\Translatable\HasTranslations;

test('page model uses required traits', function () {
    $page = new Page();
    
    expect($page)->toBeInstanceOf(SushiToJsons::class);
    expect(in_array(HasTranslations::class, class_uses($page)))->toBeTrue();
});

test('page has correct translatable attributes', function () {
    $page = new Page();
    
    $expectedTranslatable = [
        'title',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];
    
    expect($page->translatable)->toBe($expectedTranslatable);
});

test('page has correct fillable attributes', function () {
    $page = new Page();
    
    $expectedFillable = [
        'content',
        'slug',
        'title',
        'middleware',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];
    
    expect($page->getFillable())->toBe($expectedFillable);
});

test('page has correct schema definition', function () {
    $page = new Page();
    
    $expectedSchema = [
        'id' => 'integer',
        'title' => 'json',
        'slug' => 'string',
        'middleware' => 'json',
        'content' => 'string',
        'content_blocks' => 'json',
        'sidebar_blocks' => 'json',
        'footer_blocks' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string',
    ];
    
    expect($page->schema)->toBe($expectedSchema);
});

test('page has correct casts', function () {
    $page = new Page();
    
    $expectedCasts = [
        'id' => 'string',
        'uuid' => 'string',
        'date' => 'datetime',
        'published_at' => 'datetime',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'content_blocks' => 'array',
        'sidebar_blocks' => 'array',
        'footer_blocks' => 'array',
        'middleware' => 'array',
    ];
    
    expect($page->casts())->toBe($expectedCasts);
});
test('page can be created with basic data', function () {
    $page = Page::factory()->create([
        'slug' => 'test-page',
        'title' => ['en' => 'Test Page', 'it' => 'Pagina di Test'],
        'content' => 'This is test content'
    ]);
    
    expect($page)
        ->slug->toBe('test-page')
        ->title->toBe(['en' => 'Test Page', 'it' => 'Pagina di Test'])
        ->content->toBe('This is test content');
});

test('page middleware is properly cast to array', function () {
    $middleware = ['auth', 'verified', 'role:admin'];
    $page = Page::factory()->create(['middleware' => $middleware]);
    
    expect($page->middleware)
        ->toBeArray()
        ->toBe($middleware);
});

test('page content blocks support complex structures', function () {
    $contentBlocks = [
        ['type' => 'hero', 'title' => 'Welcome', 'content' => 'Hero content'],
        ['type' => 'text', 'content' => 'Regular text content'],
        ['type' => 'image', 'src' => 'test.jpg', 'alt' => 'Test Image']
    ];
    
    $page = Page::factory()->create(['content_blocks' => $contentBlocks]);
    
    expect($page->content_blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('hero'),
            fn($block) => $block->type->toBe('text'),
            fn($block) => $block->type->toBe('image')
        );
});

test('page sidebar blocks support complex structures', function () {
    $sidebarBlocks = [
        ['type' => 'navigation', 'items' => ['Home', 'About', 'Contact']],
        ['type' => 'widget', 'title' => 'Recent Posts', 'content' => []],
        ['type' => 'ad', 'code' => 'AD123', 'size' => '300x250']
    ];
    
    $page = Page::factory()->create(['sidebar_blocks' => $sidebarBlocks]);
    
    expect($page->sidebar_blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('navigation'),
            fn($block) => $block->type->toBe('widget'),
            fn($block) => $block->type->toBe('ad')
        );
});

test('page footer blocks support complex structures', function () {
    $footerBlocks = [
        ['type' => 'links', 'title' => 'Quick Links', 'items' => ['Privacy', 'Terms', 'Support']],
        ['type' => 'social', 'platforms' => ['facebook', 'twitter', 'instagram']],
        ['type' => 'copyright', 'text' => '© 2024 Company Name']
    ];
    
    $page = Page::factory()->create(['footer_blocks' => $footerBlocks]);
    
    expect($page->footer_blocks)
        ->toBeArray()
        ->toHaveCount(3)
        ->sequence(
            fn($block) => $block->type->toBe('links'),
            fn($block) => $block->type->toBe('social'),
            fn($block) => $block->type->toBe('copyright')
        );
});

test('page getMiddlewareBySlug returns correct middleware', function () {
    $middleware = ['auth', 'verified', 'role:editor'];
    $page = Page::factory()->create([
        'slug' => 'protected-page',
        'middleware' => $middleware
    ]);
    
    $result = Page::getMiddlewareBySlug('protected-page');
    
    expect($result)->toBe($middleware);
});

test('page getMiddlewareBySlug returns empty array for non-existent page', function () {
    $result = Page::getMiddlewareBySlug('non-existent-page');
    
    expect($result)->toBe([]);
});

test('page getMiddlewareBySlug returns empty array for page without middleware', function () {
    $page = Page::factory()->create([
        'slug' => 'public-page',
        'middleware' => null
    ]);
    
    $result = Page::getMiddlewareBySlug('public-page');
    
    expect($result)->toBe([]);
});

test('page supports multilingual title', function () {
    $page = Page::factory()->create([
        'title' => [
            'en' => 'Home Page',
            'it' => 'Pagina Principale',
            'es' => 'Página Principal',
            'fr' => 'Page d\'Accueil'
        ]
    ]);
    
    expect($page->title)
        ->toBeArray()
        ->toHaveKey('en', 'Home Page')
        ->toHaveKey('it', 'Pagina Principale')
        ->toHaveKey('es', 'Página Principal')
        ->toHaveKey('fr', 'Page d\'Accueil');
});

test('page supports multilingual content blocks', function () {
    $contentBlocks = [
        'en' => [
            ['type' => 'hero', 'title' => 'Welcome', 'content' => 'English content']
        ],
        'it' => [
            ['type' => 'hero', 'title' => 'Benvenuto', 'content' => 'Contenuto italiano']
        ],
        'es' => [
            ['type' => 'hero', 'title' => 'Bienvenido', 'content' => 'Contenido español']
        ]
    ];
    
    $page = Page::factory()->create(['content_blocks' => $contentBlocks]);
    
    expect($page->content_blocks)
        ->toBeArray()
        ->toHaveKeys(['en', 'it', 'es'])
        ->en->toBeArray()->toHaveCount(1)
        ->it->toBeArray()->toHaveCount(1)
        ->es->toBeArray()->toHaveCount(1);
});

test('page factory creates valid instances', function () {
    $page = Page::factory()->make();
    
    expect($page)
        ->slug->toBeString()->not->toBeEmpty()
        ->title->toBeArray()->not->toBeEmpty()
        ->content->toBeString();
});

test('page slug must be unique', function () {
    $page1 = Page::factory()->create(['slug' => 'unique-page']);
    
    expect(fn() => Page::factory()->create(['slug' => 'unique-page']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('page middleware validation', function () {
    $page = Page::factory()->make(['middleware' => 'invalid-string']);
    
    expect(fn() => $page->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('page content blocks validation', function () {
    $page = Page::factory()->make(['content_blocks' => 'invalid-string']);
    
    expect(fn() => $page->save())->toThrow(\Illuminate\Database\QueryException::class);
});

test('page handles large content blocks efficiently', function () {
    $largeContentBlocks = array_map(fn($i) => [
        'type' => 'text',
        'content' => "Content block {$i} with some text content.",
        'metadata' => ['index' => $i, 'timestamp' => now()->toISOString()]
    ], range(1, 100));
    
    $page = Page::factory()->create(['content_blocks' => $largeContentBlocks]);
    
    expect($page->fresh()->content_blocks)
        ->toBeArray()
        ->toHaveCount(100);
});