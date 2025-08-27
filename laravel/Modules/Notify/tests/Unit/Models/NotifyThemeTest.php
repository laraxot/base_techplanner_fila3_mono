<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Modules\Notify\Models\NotifyTheme;
use PHPUnit\Framework\TestCase;

class NotifyThemeTest extends TestCase
{
    /** @test */
    public function it_extends_base_model(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertInstanceOf(\Modules\Notify\Models\BaseModel::class, $theme);
    }

    /** @test */
    public function it_has_correct_fillable_attributes(): void
    {
        $expectedFillable = [
            'id', 'lang', 'type', 'subject', 'body', 'body_html', 'from',
            'from_email', 'post_type', 'post_id', 'theme', 'logo_src',
            'logo_width', 'logo_height', 'view_params',
        ];

        $this->assertEquals($expectedFillable, (new NotifyTheme())->getFillable());
    }

    /** @test */
    public function it_has_correct_appends(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertIsArray($theme->getAppends());
        $this->assertContains('logo', $theme->getAppends());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $theme = new NotifyTheme();
        $casts = $theme->getCasts();

        $this->assertIsArray($casts);
        $this->assertEquals('string', $casts['id']);
        $this->assertEquals('string', $casts['uuid']);
        $this->assertEquals('datetime', $casts['created_at']);
        $this->assertEquals('datetime', $casts['updated_at']);
        $this->assertEquals('datetime', $casts['deleted_at']);
        $this->assertEquals('string', $casts['updated_by']);
        $this->assertEquals('string', $casts['created_by']);
        $this->assertEquals('string', $casts['deleted_by']);
        $this->assertEquals('array', $casts['view_params']);
    }

    /** @test */
    public function it_has_get_logo_attribute_method(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'getLogoAttribute'));
    }

    /** @test */
    public function it_has_linkable_relationship(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'linkable'));
    }

    /** @test */
    public function it_has_media_trait(): void
    {
        $reflection = new \ReflectionClass(NotifyTheme::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Spatie\MediaLibrary\HasMedia', $traits);
    }

    /** @test */
    public function it_has_factory_trait(): void
    {
        $reflection = new \ReflectionClass(NotifyTheme::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Modules\Xot\Traits\HasFactory', $traits);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $reflection = new \ReflectionClass(NotifyTheme::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Illuminate\Database\Eloquent\Concerns\HasUuids', $traits);
    }

    /** @test */
    public function it_has_table_name(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertEquals('notify_themes', $theme->getTable());
    }

    /** @test */
    public function it_has_primary_key(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertEquals('id', $theme->getKeyName());
    }

    /** @test */
    public function it_uses_timestamps(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue($theme->usesTimestamps());
    }

    /** @test */
    public function it_has_creator_and_updater_relationships(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'creator'));
        $this->assertTrue(method_exists($theme, 'updater'));
    }

    /** @test */
    public function it_has_media_relationship(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'media'));
    }

    /** @test */
    public function get_logo_attribute_returns_array(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'getLogoAttribute'));
        
        // Verifica che il metodo restituisca array
        $reflection = new \ReflectionMethod($theme, 'getLogoAttribute');
        $returnType = $reflection->getReturnType();
        
        $this->assertEquals('array', $returnType->getName());
    }

    /** @test */
    public function linkable_returns_morph_to(): void
    {
        $theme = new NotifyTheme();
        
        $this->assertTrue(method_exists($theme, 'linkable'));
        
        // Verifica che il metodo restituisca MorphTo
        $reflection = new \ReflectionMethod($theme, 'linkable');
        $returnType = $reflection->getReturnType();
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\MorphTo', $returnType->getName());
    }
}
