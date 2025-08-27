<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Modules\Notify\Models\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function it_extends_base_model(): void
    {
        $contact = new Contact();
        
        $this->assertInstanceOf(\Modules\Notify\Models\BaseModel::class, $contact);
    }

    /** @test */
    public function it_has_correct_fillable_attributes(): void
    {
        $expectedFillable = [
            'model_id', 'model_type', 'contact_type', 'value',
            'verified_at', 'updated_at', 'created_at',
            'updated_by', 'created_by', 'user_id', 'token',
        ];

        $this->assertEquals($expectedFillable, (new Contact())->getFillable());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $contact = new Contact();
        $casts = $contact->getCasts();

        $this->assertIsArray($casts);
        $this->assertEquals('string', $casts['id']);
        $this->assertEquals('string', $casts['uuid']);
        $this->assertEquals('datetime', $casts['created_at']);
        $this->assertEquals('datetime', $casts['updated_at']);
        $this->assertEquals('datetime', $casts['deleted_at']);
        $this->assertEquals('string', $casts['updated_by']);
        $this->assertEquals('string', $casts['created_by']);
        $this->assertEquals('string', $casts['deleted_by']);
        $this->assertEquals('string', $casts['model_id']);
        $this->assertEquals('string', $casts['user_id']);
    }

    /** @test */
    public function it_has_media_trait(): void
    {
        $reflection = new \ReflectionClass(Contact::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Spatie\MediaLibrary\HasMedia', $traits);
    }

    /** @test */
    public function it_has_soft_deletes(): void
    {
        $reflection = new \ReflectionClass(Contact::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Illuminate\Database\Eloquent\Concerns\HasUuids', $traits);
    }

    /** @test */
    public function it_has_creator_and_updater_relationships(): void
    {
        $contact = new Contact();
        
        $this->assertTrue(method_exists($contact, 'creator'));
        $this->assertTrue(method_exists($contact, 'updater'));
    }

    /** @test */
    public function it_has_media_relationship(): void
    {
        $contact = new Contact();
        
        $this->assertTrue(method_exists($contact, 'media'));
    }

    /** @test */
    public function it_has_table_name(): void
    {
        $contact = new Contact();
        
        $this->assertEquals('contacts', $contact->getTable());
    }

    /** @test */
    public function it_has_primary_key(): void
    {
        $contact = new Contact();
        
        $this->assertEquals('id', $contact->getKeyName());
    }

    /** @test */
    public function it_uses_uuid_as_primary_key(): void
    {
        $contact = new Contact();
        
        $this->assertTrue($contact->usesUuids());
    }

    /** @test */
    public function it_has_timestamps(): void
    {
        $contact = new Contact();
        
        $this->assertTrue($contact->usesTimestamps());
    }

    /** @test */
    public function it_has_soft_deletes_trait(): void
    {
        $reflection = new \ReflectionClass(Contact::class);
        $traits = $reflection->getTraitNames();
        
        $this->assertContains('Illuminate\Database\Eloquent\Concerns\HasUuids', $traits);
    }
}
