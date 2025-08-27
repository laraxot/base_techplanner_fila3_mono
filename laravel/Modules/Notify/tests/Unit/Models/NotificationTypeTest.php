<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Modules\Notify\Models\NotificationType;
use PHPUnit\Framework\TestCase;

class NotificationTypeTest extends TestCase
{
    /** @test */
    public function it_extends_eloquent_model(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Model::class, $notificationType);
    }

    /** @test */
    public function it_has_correct_fillable_attributes(): void
    {
        $expectedFillable = ['name', 'description', 'template'];

        $this->assertEquals($expectedFillable, (new NotificationType())->getFillable());
    }

    /** @test */
    public function it_has_table_name(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertEquals('notification_types', $notificationType->getTable());
    }

    /** @test */
    public function it_has_primary_key(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertEquals('id', $notificationType->getKeyName());
    }

    /** @test */
    public function it_uses_timestamps(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertTrue($notificationType->usesTimestamps());
    }

    /** @test */
    public function it_has_required_methods(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertTrue(method_exists($notificationType, 'newQuery'));
        $this->assertTrue(method_exists($notificationType, 'newModelQuery'));
    }

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $notificationType = new NotificationType();
        
        $this->assertInstanceOf(NotificationType::class, $notificationType);
    }

    /** @test */
    public function it_has_correct_namespace(): void
    {
        $reflection = new \ReflectionClass(NotificationType::class);
        
        $this->assertEquals('Modules\Notify\Models', $reflection->getNamespaceName());
    }

    /** @test */
    public function it_has_strict_types_declaration(): void
    {
        $reflection = new \ReflectionClass(NotificationType::class);
        $filename = $reflection->getFileName();
        
        $this->assertNotNull($filename);
        $this->assertFileExists($filename);
        
        $fileContents = file_get_contents($filename);
        $this->assertStringContainsString('declare(strict_types=1);', $fileContents);
    }
}
