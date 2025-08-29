# Blocks System

## Overview

The CMS blocks system provides modular, reusable content components that can be combined to create dynamic page layouts. Each block is a self-contained unit with its own data, styling, and rendering logic.

## Block Categories

### Content Blocks
- **Text Block**: Rich text content with formatting
- **Image Block**: Images with captions and styling options  
- **Video Block**: Video embeds from various sources
- **Gallery Block**: Image collections with navigation
- **Quote Block**: Styled quotations with author attribution

### Layout Blocks
- **Section Block**: Wrapper for grouping other blocks
- **Column Block**: Multi-column layouts
- **Accordion Block**: Collapsible content sections
- **Tabs Block**: Tabbed content interface
- **Carousel Block**: Rotating content carousel
- **Grid Block**: Responsive grid layouts

### Interactive Blocks
- **Contact Block**: Contact forms and information
- **CTA Block**: Call-to-action sections
- **Newsletter Block**: Email subscription forms
- **Social Block**: Social media links and feeds

### Special Blocks
- **Navigation Block**: Menu and navigation elements
- **Header Block**: Page header sections
- **Footer Block**: Page footer content
- **Stats Block**: Statistical data display
- **Info Block**: Information panels and alerts

## Block Usage Examples

### Text Block
```blade
<x-cms::blocks.text :data="[
    'content' => '<h2>Welcome</h2><p>This is <strong>formatted</strong> text.</p>',
    'typography' => 'prose',
    'alignment' => 'left'
]" />
```

### Image Block
```blade
<x-cms::blocks.image :data="[
    'src' => '/images/hero.jpg',
    'alt' => 'Hero image description',
    'caption' => 'Our amazing product',
    'size' => 'large',
    'loading' => 'lazy'
]" />
```

### CTA Block
```blade
<x-cms::blocks.cta :data="[
    'title' => 'Ready to Get Started?',
    'description' => 'Join thousands of satisfied customers',
    'button_text' => 'Start Free Trial',
    'button_url' => '/signup',
    'style' => 'primary'
]" />
```

## Block Data Structure

### Standard Block Properties
```php
[
    'id' => 'unique-block-id',           // Block identifier
    'type' => 'text',                    // Block type
    'data' => [],                        // Block-specific data
    'meta' => [
        'css_class' => 'custom-class',   // Additional CSS classes
        'css_id' => 'custom-id',         // Custom ID attribute
        'visibility' => [                // Visibility conditions
            'desktop' => true,
            'tablet' => true,
            'mobile' => false
        ],
        'animation' => 'fade-in',        // Animation type
        'background' => [                // Background options
            'color' => '#ffffff',
            'image' => '/bg-image.jpg',
            'position' => 'center'
        ]
    ],
    'order' => 1,                        // Display order
    'status' => 'active'                 // Block status
]
```

## Block Implementation

### Creating Custom Blocks

1. **Create Block Component**
```php
// app/View/Components/Blocks/CustomBlock.php
namespace Modules\Cms\View\Components\Blocks;

use Illuminate\View\Component;

class CustomBlock extends Component
{
    public function __construct(
        public array $data = [],
        public array $meta = []
    ) {}
    
    public function render()
    {
        return view('cms::blocks.custom');
    }
}
```

2. **Create Block Template**
```blade
{{-- resources/views/blocks/custom.blade.php --}}
<div {{ $attributes->class([
    'custom-block',
    'p-6',
    'bg-white',
    'rounded-lg'
]) }}>
    <h3>{{ $data['title'] ?? 'Default Title' }}</h3>
    <p>{{ $data['description'] ?? '' }}</p>
</div>
```

## Gestione

### Versionamento
```php
class BlockVersion
{
    public function createVersion(Block $block): void
    {
        Version::create([
            'versionable_type' => $block->getMorphClass(),
            'versionable_id' => $block->id,
            'user_id' => auth()->id(),
            'content' => $block->toArray(),
        ]);
    }
}
```

### Cache
```php
class BlockCache
{
    public function remember(Block $block, Closure $callback): mixed
    {
        return Cache::tags(['blocks', $block->getMorphClass()])
            ->remember(
                "block:{$block->id}",
                now()->addHour(),
                $callback
            );
    }
}
```

## Frontend

### Componente Vue
```javascript
// resources/js/Blocks/TextBlock.vue
<template>
    <div class="text-block" :class="alignment">
        <div v-if="format === 'markdown'" v-html="renderedContent"></div>
        <div v-else>{{ content }}</div>
    </div>
</template>

<script>
export default {
    props: {
        content: String,
        format: String,
        alignment: String,
    },
    computed: {
        renderedContent() {
            return marked(this.content);
        },
    },
};
</script>
```

### Stili
```scss
.text-block {
    @apply prose max-w-none;
    
    &.left {
        @apply text-left;
    }
    
    &.center {
        @apply text-center;
    }
    
    &.right {
        @apply text-right;
    }
}
```

## API

### Endpoints
```php
Route::prefix('api/blocks')->group(function () {
    Route::get('/', [BlockController::class, 'index']);
    Route::post('/', [BlockController::class, 'store']);
    Route::get('/{block}', [BlockController::class, 'show']);
    Route::put('/{block}', [BlockController::class, 'update']);
    Route::delete('/{block}', [BlockController::class, 'destroy']);
});
```

### Resources
```php
class BlockResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'content' => $this->content,
            'config' => $this->config,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
```

## Testing

### Unit Tests
```php
class TextBlockTest extends TestCase
{
    /** @test */
    public function it_renders_markdown(): void
    {
        $block = TextBlock::factory()->create([
            'content' => '# Test',
            'format' => 'markdown',
        ]);
        
        $this->assertStringContainsString(
            '<h1>Test</h1>',
            $block->render()
        );
    }
}
```

### Feature Tests
```php
class BlockApiTest extends TestCase
{
    /** @test */
    public function it_stores_a_block(): void
    {
        $response = $this->postJson('/api/blocks', [
            'type' => 'text',
            'content' => 'Test content',
        ]);
        
        $response->assertCreated();
        $this->assertDatabaseHas('blocks', [
            'type' => 'text',
            'content' => 'Test content',
        ]);
    }
}
```

## File Contenuti

- `system.md`
## Collegamenti tra versioni di README.md
* [README.md](bashscripts/docs/README.md)
* [README.md](bashscripts/docs/it/README.md)
* [README.md](docs/laravel-app/phpstan/README.md)
* [README.md](docs/laravel-app/README.md)
* [README.md](docs/moduli/struttura/README.md)
* [README.md](docs/moduli/README.md)
* [README.md](docs/moduli/manutenzione/README.md)
* [README.md](docs/moduli/core/README.md)
* [README.md](docs/moduli/installati/README.md)
* [README.md](docs/moduli/comandi/README.md)
* [README.md](docs/phpstan/README.md)
* [README.md](docs/README.md)
* [README.md](docs/module-links/README.md)
* [README.md](docs/troubleshooting/git-conflicts/README.md)
* [README.md](docs/tecnico/laraxot/README.md)
* [README.md](docs/modules/README.md)
* [README.md](docs/conventions/README.md)
* [README.md](docs/amministrazione/backup/README.md)
* [README.md](docs/amministrazione/monitoraggio/README.md)
* [README.md](docs/amministrazione/deployment/README.md)
* [README.md](docs/translations/README.md)
* [README.md](docs/roadmap/README.md)
* [README.md](docs/ide/cursor/README.md)
* [README.md](docs/implementazione/api/README.md)
* [README.md](docs/implementazione/testing/README.md)
* [README.md](docs/implementazione/pazienti/README.md)
* [README.md](docs/implementazione/ui/README.md)
* [README.md](docs/implementazione/dental/README.md)
* [README.md](docs/implementazione/core/README.md)
* [README.md](docs/implementazione/reporting/README.md)
* [README.md](docs/implementazione/isee/README.md)
* [README.md](docs/it/README.md)
* [README.md](laravel/vendor/mockery/mockery/docs/README.md)
* [README.md](laravel/Modules/Chart/docs/README.md)
* [README.md](laravel/Modules/Reporting/docs/README.md)
* [README.md](laravel/Modules/Gdpr/docs/phpstan/README.md)
* [README.md](laravel/Modules/Gdpr/docs/README.md)
* [README.md](laravel/Modules/Notify/docs/phpstan/README.md)
* [README.md](laravel/Modules/Notify/docs/README.md)
* [README.md](laravel/Modules/Xot/docs/filament/README.md)
* [README.md](laravel/Modules/Xot/docs/phpstan/README.md)
* [README.md](laravel/Modules/Xot/docs/exceptions/README.md)
* [README.md](laravel/Modules/Xot/docs/README.md)
* [README.md](laravel/Modules/Xot/docs/standards/README.md)
* [README.md](laravel/Modules/Xot/docs/conventions/README.md)
* [README.md](laravel/Modules/Xot/docs/development/README.md)
* [README.md](laravel/Modules/Dental/docs/README.md)
* [README.md](laravel/Modules/User/docs/phpstan/README.md)
* [README.md](laravel/Modules/User/docs/README.md)
* [README.md](laravel/Modules/User/resources/views/docs/README.md)
* [README.md](laravel/Modules/UI/docs/phpstan/README.md)
* [README.md](laravel/Modules/UI/docs/README.md)
* [README.md](laravel/Modules/UI/docs/standards/README.md)
* [README.md](laravel/Modules/UI/docs/themes/README.md)
* [README.md](laravel/Modules/UI/docs/components/README.md)
* [README.md](laravel/Modules/Lang/docs/phpstan/README.md)
* [README.md](laravel/Modules/Lang/docs/README.md)
* [README.md](laravel/Modules/Job/docs/phpstan/README.md)
* [README.md](laravel/Modules/Job/docs/README.md)
* [README.md](laravel/Modules/Media/docs/phpstan/README.md)
* [README.md](laravel/Modules/Media/docs/README.md)
* [README.md](laravel/Modules/Tenant/docs/phpstan/README.md)
* [README.md](laravel/Modules/Tenant/docs/README.md)
* [README.md](laravel/Modules/Activity/docs/phpstan/README.md)
* [README.md](laravel/Modules/Activity/docs/README.md)
* [README.md](laravel/Modules/Patient/docs/README.md)
* [README.md](laravel/Modules/Patient/docs/standards/README.md)
* [README.md](laravel/Modules/Patient/docs/value-objects/README.md)
* [README.md](laravel/Modules/Cms/docs/blocks/README.md)
* [README.md](laravel/Modules/Cms/docs/README.md)
* [README.md](laravel/Modules/Cms/docs/standards/README.md)
* [README.md](laravel/Modules/Cms/docs/content/README.md)
* [README.md](laravel/Modules/Cms/docs/frontoffice/README.md)
* [README.md](laravel/Modules/Cms/docs/components/README.md)
* [README.md](laravel/Themes/Two/docs/README.md)
* [README.md](laravel/Themes/One/docs/README.md)

