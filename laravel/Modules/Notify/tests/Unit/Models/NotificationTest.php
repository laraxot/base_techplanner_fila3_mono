<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Notify\Models\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{


    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_create_notification(): void
    {
        $notification = Notification::create([
            'message' => 'Test notification message',
            'type' => 'info',
            'tenant_id' => 1,
            'user_id' => 123,
            'subject_type' => 'App\Models\User',
            'subject_id' => 456,
            'channels' => ['mail', 'database'],
            'status' => 'pending',
            'sent_at' => now(),
            'data' => [
                'title' => 'Test Title',
                'body' => 'Test Body',
                'action_url' => 'https://example.com',
                'priority' => 'high',
            ],
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'message' => 'Test notification message',
            'type' => 'info',
            'tenant_id' => 1,
            'user_id' => 123,
            'subject_type' => 'App\Models\User',
            'subject_id' => 456,
            'status' => 'pending',
        ]);

        expect(Notification::class, $notification);
    }

    /** @test */
    public function it_has_correct_fillable_fields(): void
    {
        $notification = new Notification;

        $expectedFillable = [
            'message',
            'type',
            'read_at',
            'tenant_id',
            'user_id',
            'subject_type',
            'subject_id',
            'channels',
            'status',
            'sent_at',
            'data',
        ];

        expect($expectedFillable, $notification->getFillable());
    }

    /** @test */
    public function it_has_correct_casts(): void
    {
        $notification = new Notification;

        $expectedCasts = [
            'read_at' => 'datetime',
            'sent_at' => 'datetime',
            'data' => 'array',
            'channels' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];

        expect($expectedCasts, $notification->casts());
    }

    /** @test */
    public function it_can_store_json_data(): void
    {
        $data = [
            'title' => 'Welcome to our platform',
            'body' => 'Thank you for joining us!',
            'action_url' => 'https://example.com/welcome',
            'priority' => 'high',
            'category' => 'welcome',
            'metadata' => [
                'source' => 'registration',
                'campaign' => 'new_users_2024',
                'tags' => ['welcome', 'onboarding'],
            ],
        ];

        $notification = Notification::create([
            'message' => 'Welcome notification',
            'type' => 'welcome',
            'data' => $data,
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'data' => json_encode($data),
        ]);

        $this->assertIsArray($notification->data);
        expect('Welcome to our platform', $notification->data['title']);
        expect('Thank you for joining us!', $notification->data['body']);
        expect('high', $notification->data['priority']);
        expect('registration', $notification->data['metadata']['source']);
        expect(['welcome', 'onboarding'], $notification->data['metadata']['tags']);
    }

    /** @test */
    public function it_can_store_channels_array(): void
    {
        $channels = ['mail', 'database', 'sms', 'push'];

        $notification = Notification::create([
            'message' => 'Multi-channel notification',
            'type' => 'alert',
            'channels' => $channels,
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'channels' => json_encode($channels),
        ]);

        $this->assertIsArray($notification->channels);
        expect(4, $notification->channels);
        $this->assertContains('mail', $notification->channels);
        $this->assertContains('database', $notification->channels);
        $this->assertContains('sms', $notification->channels);
        $this->assertContains('push', $notification->channels);
    }

    /** @test */
    public function it_can_mark_as_read(): void
    {
        $notification = Notification::create([
            'message' => 'Unread notification',
            'type' => 'info',
        ]);

        expect($notification->read_at);

        $notification->update(['read_at' => now()]);

        expect($notification->fresh()->read_at);
        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'read_at' => $notification->fresh()->read_at,
        ]);
    }

    /** @test */
    public function it_can_mark_as_sent(): void
    {
        $notification = Notification::create([
            'message' => 'Pending notification',
            'type' => 'info',
            'status' => 'pending',
        ]);

        expect($notification->sent_at);

        $notification->update([
            'sent_at' => now(),
            'status' => 'sent',
        ]);

        expect($notification->fresh()->sent_at);
        expect('sent', $notification->fresh()->status);
        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'sent_at' => $notification->fresh()->sent_at,
            'status' => 'sent',
        ]);
    }

    /** @test */
    public function it_can_update_notification(): void
    {
        $notification = Notification::create([
            'message' => 'Original message',
            'type' => 'info',
            'status' => 'pending',
        ]);

        $notification->update([
            'message' => 'Updated message',
            'type' => 'warning',
            'status' => 'sent',
            'data' => ['updated' => true],
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'message' => 'Updated message',
            'type' => 'warning',
            'status' => 'sent',
        ]);

        expect('Updated message', $notification->fresh()->message);
        expect('warning', $notification->fresh()->type);
        expect('sent', $notification->fresh()->status);
        expect(['updated' => true], $notification->fresh()->data);
    }

    /** @test */
    public function it_can_find_by_type(): void
    {
        Notification::create([
            'message' => 'Info notification',
            'type' => 'info',
        ]);

        Notification::create([
            'message' => 'Warning notification',
            'type' => 'warning',
        ]);

        Notification::create([
            'message' => 'Error notification',
            'type' => 'error',
        ]);

        $infoNotifications = Notification::where('type', 'info')->get();
        $warningNotifications = Notification::where('type', 'warning')->get();
        $errorNotifications = Notification::where('type', 'error')->get();

        expect(1, $infoNotifications);
        expect(1, $warningNotifications);
        expect(1, $errorNotifications);
        expect('info', $infoNotifications[0]->type);
        expect('warning', $warningNotifications[0]->type);
        expect('error', $errorNotifications[0]->type);
    }

    /** @test */
    public function it_can_find_by_status(): void
    {
        Notification::create([
            'message' => 'Pending notification',
            'type' => 'info',
            'status' => 'pending',
        ]);

        Notification::create([
            'message' => 'Sent notification',
            'type' => 'info',
            'status' => 'sent',
        ]);

        Notification::create([
            'message' => 'Failed notification',
            'type' => 'info',
            'status' => 'failed',
        ]);

        $pendingNotifications = Notification::where('status', 'pending')->get();
        $sentNotifications = Notification::where('status', 'sent')->get();
        $failedNotifications = Notification::where('status', 'failed')->get();

        expect(1, $pendingNotifications);
        expect(1, $sentNotifications);
        expect(1, $failedNotifications);
        expect('pending', $pendingNotifications[0]->status);
        expect('sent', $sentNotifications[0]->status);
        expect('failed', $failedNotifications[0]->status);
    }

    /** @test */
    public function it_can_find_by_tenant_id(): void
    {
        Notification::create([
            'message' => 'Tenant 1 notification',
            'type' => 'info',
            'tenant_id' => 1,
        ]);

        Notification::create([
            'message' => 'Tenant 2 notification',
            'type' => 'info',
            'tenant_id' => 2,
        ]);

        Notification::create([
            'message' => 'Tenant 1 another notification',
            'type' => 'warning',
            'tenant_id' => 1,
        ]);

        $tenant1Notifications = Notification::where('tenant_id', 1)->get();
        $tenant2Notifications = Notification::where('tenant_id', 2)->get();

        expect(2, $tenant1Notifications);
        expect(1, $tenant2Notifications);
        expect(1, $tenant1Notifications[0]->tenant_id);
        expect(1, $tenant1Notifications[1]->tenant_id);
        expect(2, $tenant2Notifications[0]->tenant_id);
    }

    /** @test */
    public function it_can_find_by_user_id(): void
    {
        Notification::create([
            'message' => 'User 123 notification',
            'type' => 'info',
            'user_id' => 123,
        ]);

        Notification::create([
            'message' => 'User 456 notification',
            'type' => 'info',
            'user_id' => 456,
        ]);

        Notification::create([
            'message' => 'User 123 another notification',
            'type' => 'warning',
            'user_id' => 123,
        ]);

        $user123Notifications = Notification::where('user_id', 123)->get();
        $user456Notifications = Notification::where('user_id', 456)->get();

        expect(2, $user123Notifications);
        expect(1, $user456Notifications);
        expect(123, $user123Notifications[0]->user_id);
        expect(123, $user123Notifications[1]->user_id);
        expect(456, $user456Notifications[0]->user_id);
    }

    /** @test */
    public function it_can_find_by_subject(): void
    {
        Notification::create([
            'message' => 'User subject notification',
            'type' => 'info',
            'subject_type' => 'App\Models\User',
            'subject_id' => 123,
        ]);

        Notification::create([
            'message' => 'Company subject notification',
            'type' => 'info',
            'subject_type' => 'App\Models\Company',
            'subject_id' => 456,
        ]);

        Notification::create([
            'message' => 'User subject another notification',
            'type' => 'warning',
            'subject_type' => 'App\Models\User',
            'subject_id' => 789,
        ]);

        $userSubjectNotifications = Notification::where('subject_type', 'App\Models\User')->get();
        $companySubjectNotifications = Notification::where('subject_type', 'App\Models\Company')->get();

        expect(2, $userSubjectNotifications);
        expect(1, $companySubjectNotifications);
        expect('App\Models\User', $userSubjectNotifications[0]->subject_type);
        expect('App\Models\User', $userSubjectNotifications[1]->subject_type);
        expect('App\Models\Company', $companySubjectNotifications[0]->subject_type);
    }

    /** @test */
    public function it_can_find_by_channel(): void
    {
        Notification::create([
            'message' => 'Mail notification',
            'type' => 'info',
            'channels' => ['mail'],
        ]);

        Notification::create([
            'message' => 'SMS notification',
            'type' => 'info',
            'channels' => ['sms'],
        ]);

        Notification::create([
            'message' => 'Multi-channel notification',
            'type' => 'info',
            'channels' => ['mail', 'database', 'sms'],
        ]);

        $mailNotifications = Notification::whereJsonContains('channels', 'mail')->get();
        $smsNotifications = Notification::whereJsonContains('channels', 'sms')->get();
        $databaseNotifications = Notification::whereJsonContains('channels', 'database')->get();

        expect(2, $mailNotifications);
        expect(2, $smsNotifications);
        expect(1, $databaseNotifications);
    }

    /** @test */
    public function it_can_find_by_data_pattern(): void
    {
        Notification::create([
            'message' => 'High priority notification',
            'type' => 'alert',
            'data' => [
                'priority' => 'high',
                'category' => 'security',
            ],
        ]);

        Notification::create([
            'message' => 'Low priority notification',
            'type' => 'info',
            'data' => [
                'priority' => 'low',
                'category' => 'general',
            ],
        ]);

        Notification::create([
            'message' => 'Medium priority notification',
            'type' => 'warning',
            'data' => [
                'priority' => 'medium',
                'category' => 'maintenance',
            ],
        ]);

        $highPriorityNotifications = Notification::whereJsonPath('data.priority', 'high')->get();
        $securityNotifications = Notification::whereJsonPath('data.category', 'security')->get();

        expect(1, $highPriorityNotifications);
        expect(1, $securityNotifications);
        expect('high', $highPriorityNotifications[0]->data['priority']);
        expect('security', $securityNotifications[0]->data['category']);
    }

    /** @test */
    public function it_can_find_by_read_status(): void
    {
        Notification::create([
            'message' => 'Unread notification',
            'type' => 'info',
            'read_at' => null,
        ]);

        Notification::create([
            'message' => 'Read notification',
            'type' => 'info',
            'read_at' => now(),
        ]);

        Notification::create([
            'message' => 'Another unread notification',
            'type' => 'warning',
            'read_at' => null,
        ]);

        $unreadNotifications = Notification::whereNull('read_at')->get();
        $readNotifications = Notification::whereNotNull('read_at')->get();

        expect(2, $unreadNotifications);
        expect(1, $readNotifications);
        expect($unreadNotifications[0]->read_at);
        expect($unreadNotifications[1]->read_at);
        expect($readNotifications[0]->read_at);
    }

    /** @test */
    public function it_can_find_by_sent_status(): void
    {
        Notification::create([
            'message' => 'Unsent notification',
            'type' => 'info',
            'sent_at' => null,
        ]);

        Notification::create([
            'message' => 'Sent notification',
            'type' => 'info',
            'sent_at' => now(),
        ]);

        Notification::create([
            'message' => 'Another unsent notification',
            'type' => 'warning',
            'sent_at' => null,
        ]);

        $unsentNotifications = Notification::whereNull('sent_at')->get();
        $sentNotifications = Notification::whereNotNull('sent_at')->get();

        expect(2, $unsentNotifications);
        expect(1, $sentNotifications);
        expect($unsentNotifications[0]->sent_at);
        expect($unsentNotifications[1]->sent_at);
        expect($sentNotifications[0]->sent_at);
    }

    /** @test */
    public function it_can_find_by_date_range(): void
    {
        $yesterday = now()->subDay();
        $today = now();
        $tomorrow = now()->addDay();

        Notification::create([
            'message' => 'Yesterday notification',
            'type' => 'info',
            'created_at' => $yesterday,
        ]);

        Notification::create([
            'message' => 'Today notification',
            'type' => 'info',
            'created_at' => $today,
        ]);

        Notification::create([
            'message' => 'Tomorrow notification',
            'type' => 'info',
            'created_at' => $tomorrow,
        ]);

        $todayNotifications = Notification::whereDate('created_at', $today->toDateString())->get();
        $recentNotifications = Notification::where('created_at', '>=', $yesterday)->get();

        expect(1, $todayNotifications);
        expect(2, $recentNotifications); // yesterday and today
        expect('Today notification', $todayNotifications[0]->message);
    }

    /** @test */
    public function it_can_find_by_multiple_criteria(): void
    {
        Notification::create([
            'message' => 'High priority security alert',
            'type' => 'alert',
            'status' => 'pending',
            'tenant_id' => 1,
            'data' => [
                'priority' => 'high',
                'category' => 'security',
            ],
        ]);

        Notification::create([
            'message' => 'Low priority general info',
            'type' => 'info',
            'status' => 'sent',
            'tenant_id' => 1,
            'data' => [
                'priority' => 'low',
                'category' => 'general',
            ],
        ]);

        Notification::create([
            'message' => 'Medium priority maintenance warning',
            'type' => 'warning',
            'status' => 'pending',
            'tenant_id' => 2,
            'data' => [
                'priority' => 'medium',
                'category' => 'maintenance',
            ],
        ]);

        $pendingHighPriorityTenant1 = Notification::where('status', 'pending')
            ->where('tenant_id', 1)
            ->whereJsonPath('data.priority', 'high')
            ->get();

        expect(1, $pendingHighPriorityTenant1);
        expect('High priority security alert', $pendingHighPriorityTenant1[0]->message);
        expect('pending', $pendingHighPriorityTenant1[0]->status);
        expect(1, $pendingHighPriorityTenant1[0]->tenant_id);
        expect('high', $pendingHighPriorityTenant1[0]->data['priority']);
    }

    /** @test */
    public function it_can_handle_empty_data(): void
    {
        $notification = Notification::create([
            'message' => 'Empty data notification',
            'type' => 'info',
            'data' => [],
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'data' => json_encode([]),
        ]);

        $this->assertIsArray($notification->data);
        $this->assertEmpty($notification->data);
    }

    /** @test */
    public function it_can_handle_empty_channels(): void
    {
        $notification = Notification::create([
            'message' => 'No channels notification',
            'type' => 'info',
            'channels' => [],
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'channels' => json_encode([]),
        ]);

        $this->assertIsArray($notification->channels);
        $this->assertEmpty($notification->channels);
    }

    /** @test */
    public function it_can_handle_null_values(): void
    {
        $notification = Notification::create([
            'message' => 'Null values notification',
            'type' => 'info',
            'tenant_id' => null,
            'user_id' => null,
            'subject_type' => null,
            'subject_id' => null,
            'channels' => null,
            'status' => null,
            'sent_at' => null,
            'data' => null,
        ]);

        expect($notification->tenant_id);
        expect($notification->user_id);
        expect($notification->subject_type);
        expect($notification->subject_id);
        expect($notification->channels);
        expect($notification->status);
        expect($notification->sent_at);
        expect($notification->data);
    }
}
