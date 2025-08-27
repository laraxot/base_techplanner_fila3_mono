<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\Media\Models\Media;

test('media can be created', function () {
    $media = createMedia([
        'name' => 'test-image.jpg',
        'file_name' => 'test-image.jpg',
        'mime_type' => 'image/jpeg',
        'size' => 1024,
    ]);

    expect($media)
        ->toBeMedia()
        ->and($media->name)->toBe('test-image.jpg')
        ->and($media->mime_type)->toBe('image/jpeg')
        ->and($media->size)->toBe(1024);
});

test('media has required attributes', function () {
    $media = makeMedia();

    expect($media)
        ->toHaveProperty('name')
        ->toHaveProperty('file_name')
        ->toHaveProperty('mime_type')
        ->toHaveProperty('size')
        ->toHaveProperty('disk')
        ->toHaveProperty('collection_name');
});

test('media can determine if it is image', function () {
    $imageMedia = createMedia(['mime_type' => 'image/jpeg']);
    $documentMedia = createMedia(['mime_type' => 'application/pdf']);
    
    expect($imageMedia->isImage())->toBeTrue()
        ->and($documentMedia->isImage())->toBeFalse();
});

test('media can get url', function () {
    $media = createMedia([
        'file_name' => 'test.jpg',
        'disk' => 'public',
    ]);
    
    expect($media->getUrl())->toBeString()->toContain('test.jpg');
=======
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
>>>>>>> c59deef (.)
});
