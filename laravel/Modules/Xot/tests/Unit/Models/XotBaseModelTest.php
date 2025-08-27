<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Models;

use Modules\Xot\Models\XotBaseModel;
use Modules\Xot\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

uses(TestCase::class);

beforeEach(function () {
    $this->xotBaseModel = new class extends XotBaseModel {
        protected $table = 'test_xot_table';
    };
});

test('xot base model extends eloquent model', function () {
    expect($this->xotBaseModel)->toBeInstanceOf(Model::class);
});

test('xot base model has correct table name', function () {
    expect($this->xotBaseModel->getTable())->toBe('test_xot_table');
});

test('xot base model can be instantiated', function () {
    expect($this->xotBaseModel)->toBeInstanceOf(XotBaseModel::class);
});

test('xot base model has proper inheritance chain', function () {
    expect($this->xotBaseModel)->toBeInstanceOf(XotBaseModel::class);
    expect($this->xotBaseModel)->toBeInstanceOf(Model::class);
});
