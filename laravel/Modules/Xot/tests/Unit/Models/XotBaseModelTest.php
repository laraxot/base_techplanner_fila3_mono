<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\Xot\Models\XotBaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

// Mock class per testare XotBaseModel
class MockXotModel extends XotBaseModel
{
    protected $table = 'mock_table';
    protected $fillable = ['name', 'email', 'status'];
    
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'status' => 'boolean',
        ];
    }
}

beforeEach(function () {
    $this->model = new MockXotModel();
});

describe('XotBaseModel Inheritance', function () {
    it('extends Eloquent Model', function () {
        expect($this->model)->toBeInstanceOf(Model::class);
    });

    it('extends XotBaseModel', function () {
        expect($this->model)->toBeInstanceOf(XotBaseModel::class);
    });

    it('has correct table name', function () {
        expect($this->model->getTable())->toBe('mock_table');
    });

    it('has fillable attributes', function () {
        expect($this->model->getFillable())->toContain('name', 'email', 'status');
    });
});

describe('XotBaseModel Casts', function () {
    it('casts timestamps correctly', function () {
        $casts = $this->model->casts();
        
        expect($casts)->toHaveKey('created_at');
        expect($casts)->toHaveKey('updated_at');
        expect($casts['created_at'])->toBe('datetime');
        expect($casts['updated_at'])->toBe('datetime');
    });

    it('casts custom fields correctly', function () {
        $casts = $this->model->casts();
        
        expect($casts)->toHaveKey('status');
        expect($casts['status'])->toBe('boolean');
    });

    it('returns array of casts', function () {
        $casts = $this->model->casts();
        
        expect($casts)->toBeArray();
        expect($casts)->toHaveCount(3);
    });
});

describe('XotBaseModel Timestamps', function () {
    it('uses timestamps by default', function () {
        expect($this->model->usesTimestamps())->toBeTrue();
    });

    it('has created_at and updated_at columns', function () {
        $this->model->created_at = now();
        $this->model->updated_at = now();
        
        expect($this->model->created_at)->toBeInstanceOf(Carbon::class);
        expect($this->model->updated_at)->toBeInstanceOf(Carbon::class);
    });

    it('can disable timestamps', function () {
        $this->model->timestamps = false;
        
        expect($this->model->usesTimestamps())->toBeFalse();
    });
});

describe('XotBaseModel Database Connection', function () {
    it('uses default database connection', function () {
        $connection = $this->model->getConnectionName();
        
        expect($connection)->toBeNull(); // Default connection
    });

    it('can set custom database connection', function () {
        $this->model->setConnection('custom_connection');
        
        expect($this->model->getConnectionName())->toBe('custom_connection');
    });
});

describe('XotBaseModel Query Builder', function () {
    it('can create new query builder', function () {
        $query = $this->model->newQuery();
        
        expect($query)->toBeInstanceOf(Builder::class);
    });

    it('can create query builder with connection', function () {
        $this->model->setConnection('custom_connection');
        $query = $this->model->newQuery();
        
        expect($query)->toBeInstanceOf(Builder::class);
        expect($query->getConnection()->getName())->toBe('custom_connection');
    });

    it('can create query builder for specific table', function () {
        $query = $this->model->newQuery();
        
        expect($query->from)->toBe('mock_table');
    });
});

describe('XotBaseModel Attribute Access', function () {
    it('can access fillable attributes', function () {
        $this->model->name = 'Test Name';
        $this->model->email = 'test@example.com';
        $this->model->status = true;
        
        expect($this->model->name)->toBe('Test Name');
        expect($this->model->email)->toBe('test@example.com');
        expect($this->model->status)->toBeTrue();
    });

    it('can access timestamps', function () {
        $now = now();
        $this->model->created_at = $now;
        $this->model->updated_at = $now;
        
        expect($this->model->created_at)->toBe($now);
        expect($this->model->updated_at)->toBe($now);
    });

    it('can access primary key', function () {
        $this->model->id = 123;
        
        expect($this->model->id)->toBe(123);
        expect($this->model->getKey())->toBe(123);
    });
});

describe('XotBaseModel Attribute Setting', function () {
    it('can set fillable attributes', function () {
        $this->model->name = 'New Name';
        $this->model->email = 'new@example.com';
        $this->model->status = false;
        
        expect($this->model->name)->toBe('New Name');
        expect($this->model->email)->toBe('new@example.com');
        expect($this->model->status)->toBeFalse();
    });

    it('can set timestamps', function () {
        $createdAt = now()->subDay();
        $updatedAt = now();
        
        $this->model->created_at = $createdAt;
        $this->model->updated_at = $updatedAt;
        
        expect($this->model->created_at)->toBe($createdAt);
        expect($this->model->updated_at)->toBe($updatedAt);
    });

    it('can set primary key', function () {
        $this->model->id = 456;
        
        expect($this->model->id)->toBe(456);
        expect($this->model->getKey())->toBe(456);
    });
});

describe('XotBaseModel Mass Assignment', function () {
    it('can fill attributes via array', function () {
        $data = [
            'name' => 'Mass Assigned Name',
            'email' => 'mass@example.com',
            'status' => true,
        ];
        
        $this->model->fill($data);
        
        expect($this->model->name)->toBe('Mass Assigned Name');
        expect($this->model->email)->toBe('mass@example.com');
        expect($this->model->status)->toBeTrue();
    });

    it('can create model with attributes', function () {
        $data = [
            'name' => 'Created Name',
            'email' => 'created@example.com',
            'status' => false,
        ];
        
        $model = MockXotModel::create($data);
        
        expect($model)->toBeInstanceOf(MockXotModel::class);
        expect($model->name)->toBe('Created Name');
        expect($model->email)->toBe('created@example.com');
        expect($model->status)->toBeFalse();
    });

    it('can update model with attributes', function () {
        $this->model->name = 'Original Name';
        $this->model->email = 'original@example.com';
        
        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];
        
        $this->model->update($updateData);
        
        expect($this->model->name)->toBe('Updated Name');
        expect($this->model->email)->toBe('updated@example.com');
    });
});

describe('XotBaseModel Relationships', function () {
    it('can define belongs to relationship', function () {
        $this->model->shouldReceive('belongsTo')
            ->with(MockXotModel::class)
            ->andReturn(new \Illuminate\Database\Eloquent\Relations\BelongsTo(
                $this->model->newQuery(),
                $this->model,
                'parent_id',
                'id',
                'parent'
            ));
        
        $relationship = $this->model->parent();
        
        expect($relationship)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
    });

    it('can define has many relationship', function () {
        $this->model->shouldReceive('hasMany')
            ->with(MockXotModel::class, 'parent_id')
            ->andReturn(new \Illuminate\Database\Eloquent\Relations\HasMany(
                $this->model->newQuery(),
                $this->model,
                'parent_id',
                'id'
            ));
        
        $relationship = $this->model->children();
        
        expect($relationship)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class);
    });

    it('can define has one relationship', function () {
        $this->model->shouldReceive('hasOne')
            ->with(MockXotModel::class, 'parent_id')
            ->andReturn(new \Illuminate\Database\Eloquent\Relations\HasOne(
                $this->model->newQuery(),
                $this->model,
                'parent_id',
                'id'
            ));
        
        $relationship = $this->model->child();
        
        expect($relationship)->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class);
    });
});

describe('XotBaseModel Scopes', function () {
    it('can define local scope', function () {
        $this->model->shouldReceive('scopeActive')
            ->andReturnUsing(function ($query) {
                return $query->where('status', true);
            });
        
        $query = $this->model->newQuery();
        $activeQuery = $this->model->scopeActive($query);
        
        expect($activeQuery)->toBeInstanceOf(Builder::class);
    });

    it('can define global scope', function () {
        $this->model->shouldReceive('addGlobalScope')
            ->andReturn($this->model);
        
        $this->model->addGlobalScope('active', function ($query) {
            $query->where('status', true);
        });
        
        expect($this->model)->toBeInstanceOf(MockXotModel::class);
    });
});

describe('XotBaseModel Events', function () {
    it('can fire model events', function () {
        $this->model->shouldReceive('fireModelEvent')
            ->with('creating')
            ->andReturn(true);
        
        $result = $this->model->fireModelEvent('creating');
        
        expect($result)->toBeTrue();
    });

    it('can listen to model events', function () {
        $this->model->shouldReceive('listen')
            ->andReturn($this->model);
        
        $this->model->listen('creating', function ($model) {
            // Event handler
        });
        
        expect($this->model)->toBeInstanceOf(MockXotModel::class);
    });
});

describe('XotBaseModel Serialization', function () {
    it('can convert to array', function () {
        $this->model->id = 789;
        $this->model->name = 'Serialized Name';
        $this->model->email = 'serialized@example.com';
        $this->model->status = true;
        $this->model->created_at = now();
        $this->model->updated_at = now();
        
        $array = $this->model->toArray();
        
        expect($array)->toBeArray();
        expect($array)->toHaveKey('id');
        expect($array)->toHaveKey('name');
        expect($array)->toHaveKey('email');
        expect($array)->toHaveKey('status');
        expect($array)->toHaveKey('created_at');
        expect($array)->toHaveKey('updated_at');
    });

    it('can convert to JSON', function () {
        $this->model->id = 101;
        $this->model->name = 'JSON Name';
        $this->model->email = 'json@example.com';
        $this->model->status = false;
        
        $json = $this->model->toJson();
        
        expect($json)->toBeString();
        expect(json_decode($json, true))->toHaveKey('id');
        expect(json_decode($json, true))->toHaveKey('name');
        expect(json_decode($json, true))->toHaveKey('email');
        expect(json_decode($json, true))->toHaveKey('status');
    });
});

describe('XotBaseModel Validation', function () {
    it('can validate attributes', function () {
        $this->model->shouldReceive('validate')
            ->andReturn(true);
        
        $result = $this->model->validate();
        
        expect($result)->toBeTrue();
    });

    it('can get validation rules', function () {
        $this->model->shouldReceive('rules')
            ->andReturn([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:mock_table',
                'status' => 'boolean',
            ]);
        
        $rules = $this->model->rules();
        
        expect($rules)->toBeArray();
        expect($rules)->toHaveKey('name');
        expect($rules)->toHaveKey('email');
        expect($rules)->toHaveKey('status');
    });
});

describe('XotBaseModel Performance', function () {
    it('can handle large attribute sets efficiently', function () {
        $startTime = microtime(true);
        
        for ($i = 0; $i < 1000; $i++) {
            $this->model->{"attribute_{$i}"} = "value_{$i}";
        }
        
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
        expect($this->model->attribute_999)->toBe('value_999');
    });

    it('can handle mass assignment efficiently', function () {
        $largeData = [];
        for ($i = 0; $i < 1000; $i++) {
            $largeData["field_{$i}"] = "data_{$i}";
        }
        
        $startTime = microtime(true);
        $this->model->fill($largeData);
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
        expect($executionTime)->toBeLessThan(1.0); // Dovrebbe essere veloce
        expect($this->model->field_999)->toBe('data_999');
    });
});

describe('XotBaseModel Edge Cases', function () {
    it('handles null values correctly', function () {
        $this->model->name = null;
        $this->model->email = null;
        $this->model->status = null;
        
        expect($this->model->name)->toBeNull();
        expect($this->model->email)->toBeNull();
        expect($this->model->status)->toBeNull();
    });

    it('handles empty strings correctly', function () {
        $this->model->name = '';
        $this->model->email = '';
        
        expect($this->model->name)->toBe('');
        expect($this->model->email)->toBe('');
    });

    it('handles special characters in attributes', function () {
        $this->model->name = 'José García-López';
        $this->model->email = 'test+tag@example.com';
        
        expect($this->model->name)->toBe('José García-López');
        expect($this->model->email)->toBe('test+tag@example.com');
    });

    it('handles very long attribute values', function () {
        $longName = str_repeat('Very long name ', 100);
        $this->model->name = $longName;
        
        expect($this->model->name)->toBe($longName);
        expect(strlen($this->model->name))->toBe(1600); // 16 * 100
    });
});

describe('XotBaseModel Integration', function () {
    it('works with different model types', function () {
        $models = [
            new MockXotModel(),
            new class extends XotBaseModel {
                protected $table = 'another_table';
                protected $fillable = ['title', 'content'];
                
                protected function casts(): array
                {
                    return [
                        'created_at' => 'datetime',
                        'updated_at' => 'datetime',
                    ];
                }
            },
        ];
        
        foreach ($models as $model) {
            expect($model)->toBeInstanceOf(XotBaseModel::class);
            expect($model)->toHaveMethod('casts');
            expect($model)->toHaveMethod('getFillable');
        }
    });

    it('maintains consistent behavior across instances', function () {
        $model1 = new MockXotModel();
        $model2 = new MockXotModel();
        
        $model1->name = 'Test Name 1';
        $model2->name = 'Test Name 2';
        
        expect($model1->name)->toBe('Test Name 1');
        expect($model2->name)->toBe('Test Name 2');
        expect($model1->name)->not->toBe($model2->name);
    });
=======
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
>>>>>>> 68b3eda (.)
});
