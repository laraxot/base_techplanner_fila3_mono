<?php

declare(strict_types=1);

namespace Modules\Media\Tests\Unit\Models;

use Modules\Media\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->media = Media::factory()->create();
});

test('media can be created', function () {
    expect($this->media)->toBeInstanceOf(Media::class);
});

test('media has fillable attributes', function () {
    $fillable = $this->media->getFillable();
    
    expect($fillable)->toContain('name');
    expect($fillable)->toContain('file_name');
    expect($fillable)->toContain('disk');
    expect($fillable)->toContain('mime_type');
    expect($fillable)->toContain('size');
});

test('media has casts defined', function () {
    $casts = $this->media->getCasts();
    
    expect($casts)->toHaveKey('created_at');
    expect($casts)->toHaveKey('updated_at');
    expect($casts)->toHaveKey('size');
    expect($casts)->toHaveKey('manipulations');
    expect($casts)->toHaveKey('custom_properties');
});

test('media has proper table name', function () {
    expect($this->media->getTable())->toBe('media');
});

test('media can get url', function () {
    $url = $this->media->getUrl();
    
    expect($url)->toBeString();
    expect($url)->not->toBeEmpty();
});

test('media can get full url', function () {
    $fullUrl = $this->media->getFullUrl();
    
    expect($fullUrl)->toBeString();
    expect($fullUrl)->not->toBeEmpty();
});

test('media can check if is image', function () {
    $this->media->update(['mime_type' => 'image/jpeg']);
    
    expect($this->media->fresh()->isImage())->toBeTrue();
    
    $this->media->update(['mime_type' => 'application/pdf']);
    
    expect($this->media->fresh()->isImage())->toBeFalse();
});

test('media can check if is video', function () {
    $this->media->update(['mime_type' => 'video/mp4']);
    
    expect($this->media->fresh()->isVideo())->toBeTrue();
    
    $this->media->update(['mime_type' => 'image/jpeg']);
    
    expect($this->media->fresh()->isVideo())->toBeFalse();
});

test('media can get human readable size', function () {
    $this->media->update(['size' => 1024]);
    
    expect($this->media->fresh()->getHumanReadableSizeAttribute())->toBe('1 KB');
});

test('media has proper relationships', function () {
    expect($this->media->conversions())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
});

test('media can be scoped by type', function () {
    $imageMedia = Media::factory()->create(['mime_type' => 'image/jpeg']);
    $pdfMedia = Media::factory()->create(['mime_type' => 'application/pdf']);
    
    $images = Media::images()->get();
    
    expect($images)->toHaveCount(1);
    expect($images->first()->id)->toBe($imageMedia->id);
});

test('media can be scoped by disk', function () {
    $localMedia = Media::factory()->create(['disk' => 'local']);
    $s3Media = Media::factory()->create(['disk' => 's3']);
    
    $localMedias = Media::onDisk('local')->get();
    
    expect($localMedias)->toHaveCount(1);
    expect($localMedias->first()->id)->toBe($localMedia->id);
});
