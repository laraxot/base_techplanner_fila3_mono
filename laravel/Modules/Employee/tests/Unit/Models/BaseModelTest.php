<?php

declare(strict_types=1);

namespace Modules\Employee\Tests\Unit\Models;

use Modules\Employee\Models\BaseModel;
use Illuminate\Foundation\Testing\RefreshDatabase;use Illuminate\Database\Eloquent\Model;
use Modules\Employee\Models\BaseModel;

beforeEach(function () {
    $this->baseModel = new class extends BaseModel {

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->baseModel = new class() extends BaseModel
    {
    $this->baseModel = new class extends BaseModel {
        protected $table = 'test_employee_table';
    };
});

test('base model extends eloquent model', function () {
    expect($this->baseModel)->toBeInstanceOf(Model::class);
});

test('base model has correct table name', function () {
    expect($this->baseModel->getTable())->toBe('test_employee_table');
});

test('base model can be instantiated', function () {
    expect($this->baseModel)->toBeInstanceOf(BaseModel::class);
});

test('base model has proper inheritance chain', function () {
    expect($this->baseModel)->toBeInstanceOf(BaseModel::class);
    expect($this->baseModel)->toBeInstanceOf(Model::class);
});

test('base model has timestamps enabled', function () {
    expect($this->baseModel->usesTimestamps())->toBeTrue();
});
