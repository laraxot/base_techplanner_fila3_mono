<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\NotificationType;
use Tests\TestCase;

class NotificationTypeTest extends TestCase
{


    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_create_notification_type(): void
    {
        $notificationType = NotificationType::create([
            'name' => 'Email Notification',
            'description' => 'Email notification type for sending emails',
            'template' => 'email_template_1',
        ]);

        $this->assertDatabaseHas('notification_types', [
            'id' => $notificationType->id,
            'name' => 'Email Notification',
            'description' => 'Email notification type for sending emails',
            'template' => 'email_template_1',
        ]);

        expect(NotificationType::class, $notificationType);
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $notificationType = new NotificationType;

        $expectedFillable = [
            'name',
            'description',
            'template',
        ];

        expect($expectedFillable, $notificationType->getFillable());
    }

    /** @test */
    public function it_can_update_notification_type(): void
    {
        $notificationType = NotificationType::create([
            'name' => 'Original Name',
            'description' => 'Original description',
            'template' => 'original_template',
        ]);

        $notificationType->update([
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'template' => 'updated_template',
        ]);

        $this->assertDatabaseHas('notification_types', [
            'id' => $notificationType->id,
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'template' => 'updated_template',
        ]);

        expect('Updated Name', $notificationType->fresh()->name);
        expect('Updated description', $notificationType->fresh()->description);
        expect('updated_template', $notificationType->fresh()->template);
    }

    /** @test */
    public function it_can_find_by_name(): void
    {
        $notificationType = NotificationType::create([
            'name' => 'SMS Notification',
            'description' => 'SMS notification type',
            'template' => 'sms_template',
        ]);

        $found = NotificationType::where('name', 'SMS Notification')->first();

        expect($found);
        expect($notificationType->id, $found->id);
        expect('SMS Notification', $found->name);
        expect('SMS notification type', $found->description);
        expect('sms_template', $found->template);
    }

    /** @test */
    public function it_can_find_by_template(): void
    {
        NotificationType::create([
            'name' => 'Email Type 1',
            'description' => 'First email template',
            'template' => 'email_template_1',
        ]);

        NotificationType::create([
            'name' => 'Email Type 2',
            'description' => 'Second email template',
            'template' => 'email_template_2',
        ]);

        $template1Types = NotificationType::where('template', 'email_template_1')->get();
        $template2Types = NotificationType::where('template', 'email_template_2')->get();

        expect(1, $template1Types);
        expect(1, $template2Types);
        expect('email_template_1', $template1Types[0]->template);
        expect('email_template_2', $template2Types[0]->template);
    }

    /** @test */
    public function it_can_find_by_description_pattern(): void
    {
        NotificationType::create([
            'name' => 'Email Type',
            'description' => 'Email notification type for users',
            'template' => 'email_template',
        ]);

        NotificationType::create([
            'name' => 'SMS Type',
            'description' => 'SMS notification type for users',
            'template' => 'sms_template',
        ]);

        NotificationType::create([
            'name' => 'Push Type',
            'description' => 'Push notification type for mobile',
            'template' => 'push_template',
        ]);

        $userTypes = NotificationType::where('description', 'like', '%for users%')->get();
        $mobileTypes = NotificationType::where('description', 'like', '%mobile%')->get();

        expect(2, $userTypes);
        expect(1, $mobileTypes);
        $this->assertStringContainsString('for users', $userTypes[0]->description);
        $this->assertStringContainsString('for users', $userTypes[1]->description);
        $this->assertStringContainsString('mobile', $mobileTypes[0]->description);
    }

    /** @test */
    public function it_can_handle_null_values(): void
    {
        $notificationType = NotificationType::create([
            'name' => 'No Description Type',
            'description' => null,
            'template' => null,
        ]);

        expect($notificationType->description);
        expect($notificationType->template);
        $this->assertDatabaseHas('notification_types', [
            'id' => $notificationType->id,
            'description' => null,
            'template' => null,
        ]);
    }

    /** @test */
    public function it_can_create_multiple_types(): void
    {
        $types = [
            ['name' => 'Email', 'description' => 'Email notifications', 'template' => 'email'],
            ['name' => 'SMS', 'description' => 'SMS notifications', 'template' => 'sms'],
            ['name' => 'Push', 'description' => 'Push notifications', 'template' => 'push'],
            ['name' => 'Database', 'description' => 'Database notifications', 'template' => 'database'],
            ['name' => 'Slack', 'description' => 'Slack notifications', 'template' => 'slack'],
        ];

        foreach ($types as $typeData) {
            NotificationType::create($typeData);
        }

        $this->assertDatabaseCount('notification_types', 5);

        $emailType = NotificationType::where('name', 'Email')->first();
        $smsType = NotificationType::where('name', 'SMS')->first();
        $pushType = NotificationType::where('name', 'Push')->first();

        expect('Email notifications', $emailType->description);
        expect('SMS notifications', $smsType->description);
        expect('Push notifications', $pushType->description);
        expect('email', $emailType->template);
        expect('sms', $smsType->template);
        expect('push', $pushType->template);
    }

    /** @test */
    public function it_can_find_by_multiple_criteria(): void
    {
        NotificationType::create([
            'name' => 'High Priority Email',
            'description' => 'High priority email notifications',
            'template' => 'high_priority_email',
        ]);

        NotificationType::create([
            'name' => 'Low Priority Email',
            'description' => 'Low priority email notifications',
            'template' => 'low_priority_email',
        ]);

        NotificationType::create([
            'name' => 'High Priority SMS',
            'description' => 'High priority SMS notifications',
            'template' => 'high_priority_sms',
        ]);

        $highPriorityEmailTypes = NotificationType::where('name', 'like', '%High Priority%')
            ->where('description', 'like', '%email%')
            ->get();

        expect(1, $highPriorityEmailTypes);
        expect('High Priority Email', $highPriorityEmailTypes[0]->name);
        expect('High priority email notifications', $highPriorityEmailTypes[0]->description);
        expect('high_priority_email', $highPriorityEmailTypes[0]->template);
    }
}
