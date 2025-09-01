<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\BaseUser;

beforeEach(function () {
    $this->baseUser = new class extends BaseUser
    {
=======
use Modules\User\Models\BaseUser;
use Modules\User\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Model;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->baseUser = new class extends BaseUser {
>>>>>>> 8055579 (.)
        protected $table = 'test_users';
    };
});

test('base user extends eloquent model', function () {
    expect($this->baseUser)->toBeInstanceOf(Model::class);
});

test('base user has correct table name', function () {
    expect($this->baseUser->getTable())->toBe('test_users');
});

test('base user can be instantiated', function () {
    expect($this->baseUser)->toBeInstanceOf(BaseUser::class);
});

test('base user has proper inheritance chain', function () {
    expect($this->baseUser)->toBeInstanceOf(BaseUser::class);
    expect($this->baseUser)->toBeInstanceOf(Model::class);
});

test('base user has authentication traits', function () {
    $traits = class_uses($this->baseUser);
<<<<<<< HEAD

=======
    
>>>>>>> 8055579 (.)
    expect($traits)->toContain(\Illuminate\Foundation\Auth\User::class);
    expect($traits)->toContain(\Illuminate\Notifications\Notifiable::class);
});
