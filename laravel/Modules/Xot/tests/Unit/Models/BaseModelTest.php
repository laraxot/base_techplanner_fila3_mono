<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Models\BaseModelTest;

namespace Modules\Xot\Tests\Unit\Models;



uses(TestCase::class);

beforeEach(function () {

        protected $table = 'test_table';
    };
});

test('base model extends eloquent model', function () {
    expect($this->baseModel)->toBeInstanceOf(Model::class);
});

test('base model has correct table name', function () {
    expect($this->baseModel->getTable())->toBe('test_table');
});

test('base model has timestamps enabled', function () {
    expect($this->baseModel->usesTimestamps())->toBeTrue();
});

test('base model has soft deletes disabled by default', function () {
    expect($this->baseModel->usesSoftDeletes())->toBeFalse();
});

test('base model can be instantiated', function () {
    expect($this->baseModel)->toBeInstanceOf(BaseModel::class);
});
