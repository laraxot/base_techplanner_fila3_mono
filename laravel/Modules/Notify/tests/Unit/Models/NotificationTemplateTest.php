<?php

declare(strict_types=1);

namespace Modules\Notify\Tests\Unit\Models;

use Modules\Notify\Models\NotificationTemplate;
use Modules\Notify\Models\NotificationType;
use Modules\Notify\Models\NotifyTheme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->template = NotificationTemplate::factory()->create();
});

test('notification template can be created', function () {
    expect($this->template)->toBeInstanceOf(NotificationTemplate::class);
});

test('notification template has fillable attributes', function () {
    $fillable = $this->template->getFillable();
    
    expect($fillable)->toContain('name');
    expect($fillable)->toContain('subject');
    expect($fillable)->toContain('content');
    expect($fillable)->toContain('notification_type_id');
});

test('notification template has casts defined', function () {
    $casts = $this->template->getCasts();
    
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
    expect($casts)->toHaveKey('is_active');
});

test('notification template belongs to notification type', function () {
    $type = NotificationType::factory()->create();
    $this->template->update(['notification_type_id' => $type->id]);
    
    expect($this->template->notificationType)->toBeInstanceOf(NotificationType::class);
    expect($this->template->notificationType->id)->toBe($type->id);
});

test('notification template has versions', function () {
    expect($this->template->versions)->toBeInstanceOf(Collection::class);
    expect($this->template->versions)->toHaveCount(0);
});

test('notification template has themes', function () {
    expect($this->template->themes)->toBeInstanceOf(Collection::class);
    expect($this->template->versions)->toHaveCount(0);
});

test('notification template has proper table name', function () {
    expect($this->template->getTable())->toBe('notification_templates');
});

test('notification template can be active', function () {
    $this->template->update(['is_active' => true]);
    
    expect($this->template->fresh()->is_active)->toBeTrue();
});

test('notification template can be inactive', function () {
    $this->template->update(['is_active' => false]);
    
    expect($this->template->fresh()->is_active)->toBeFalse();
});

test('notification template has proper relationships', function () {
    expect($this->template->notificationType())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    expect($this->template->versions())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    expect($this->template->themes())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class);
});

test('notification template can be scoped by active status', function () {
    $activeTemplate = NotificationTemplate::factory()->create(['is_active' => true]);
    $inactiveTemplate = NotificationTemplate::factory()->create(['is_active' => false]);
    
    $activeTemplates = NotificationTemplate::active()->get();
    
    expect($activeTemplates)->toHaveCount(1);
    expect($activeTemplates->first()->id)->toBe($activeTemplate->id);
});
