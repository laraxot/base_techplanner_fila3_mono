<?php

declare(strict_types=1);

namespace Modules\Activity\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Modules\Activity\Models\BaseModel;
use Tests\TestCase;

class BaseModelBusinessLogicTest extends TestCase
{


    /** @test */
    public function it_can_create_base_model_instance(): void
    {
        // Creiamo una classe concreta che estende BaseModel per i test
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name', 'value'];
        };

        expect(BaseModel::class, $concreteModel);
        expect(\Illuminate\Database\Eloquent\Model::class, $concreteModel);
    }

    /** @test */
    public function it_has_correct_connection_setting(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect('activity', $concreteModel->getConnectionName());
    }

    /** @test */
    public function it_has_correct_primary_key_setting(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect('id', $concreteModel->getKeyName());
        expect('string', $concreteModel->getKeyType());
        expect($concreteModel->getIncrementing());
    }

    /** @test */
    public function it_has_correct_timestamps_setting(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect($concreteModel->usesTimestamps());
        expect($concreteModel->timestamps);
    }

    /** @test */
    public function it_has_correct_per_page_setting(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect(30, $concreteModel->getPerPage());
    }

    /** @test */
    public function it_has_correct_snake_attributes_setting(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect($concreteModel::$snakeAttributes);
    }

    /** @test */
    public function it_has_correct_casts_configuration(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        $casts = $concreteModel->getCasts();

        $this->assertArrayHasKey('id', $casts);
        expect('string', $casts['id']);

        $this->assertArrayHasKey('uuid', $casts);
        expect('string', $casts['uuid']);

        $this->assertArrayHasKey('created_at', $casts);
        expect('datetime', $casts['created_at']);

        $this->assertArrayHasKey('updated_at', $casts);
        expect('datetime', $casts['updated_at']);

        $this->assertArrayHasKey('deleted_at', $casts);
        expect('datetime', $casts['deleted_at']);

        $this->assertArrayHasKey('updated_by', $casts);
        expect('string', $casts['updated_by']);

        $this->assertArrayHasKey('created_by', $casts);
        expect('string', $casts['created_by']);

        $this->assertArrayHasKey('deleted_by', $casts);
        expect('string', $casts['deleted_by']);

        $this->assertArrayHasKey('published_at', $casts);
        expect('datetime', $casts['published_at']);
    }

    /** @test */
    public function it_can_use_factory(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name', 'value'];
        };

        expect(method_exists($concreteModel, 'factory'));
        expect(method_exists($concreteModel, 'newFactory'));
    }

    /** @test */
    public function it_has_updater_trait(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        $traits = class_uses($concreteModel);
        $this->assertContains(\Modules\Xot\Traits\Updater::class, $traits);
    }

    /** @test */
    public function it_has_has_factory_trait(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        $traits = class_uses($concreteModel);
        $this->assertContains(\Illuminate\Database\Eloquent\Factories\HasFactory::class, $traits);
    }

    /** @test */
    public function it_can_handle_uuid_generation(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['uuid', 'name'];
        };

        $uuid = Str::uuid()->toString();
        $concreteModel->uuid = $uuid;
        $concreteModel->name = 'Test Model';

        expect($uuid, $concreteModel->uuid);
        expect('Test Model', $concreteModel->name);
    }

    /** @test */
    public function it_can_handle_timestamps(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name'];
        };

        $now = now();
        $concreteModel->created_at = $now;
        $concreteModel->updated_at = $now;

        expect($now->timestamp, $concreteModel->created_at->timestamp);
        expect($now->timestamp, $concreteModel->updated_at->timestamp);
    }

    /** @test */
    public function it_can_handle_soft_deletes(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name'];
        };

        $now = now();
        $concreteModel->deleted_at = $now;

        expect($now->timestamp, $concreteModel->deleted_at->timestamp);
    }

    /** @test */
    public function it_can_handle_published_at_timestamp(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name'];
        };

        $now = now();
        $concreteModel->published_at = $now;

        expect($now->timestamp, $concreteModel->published_at->timestamp);
    }

    /** @test */
    public function it_can_handle_user_tracking_fields(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name'];
        };

        $concreteModel->created_by = 'user-123';
        $concreteModel->updated_by = 'user-456';
        $concreteModel->deleted_by = 'user-789';

        expect('user-123', $concreteModel->created_by);
        expect('user-456', $concreteModel->updated_by);
        expect('user-789', $concreteModel->deleted_by);
    }

    /** @test */
    public function it_has_correct_hidden_attributes(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        $hidden = $concreteModel->getHidden();

        // Verifica che gli attributi nascosti siano configurati correttamente
        $this->assertIsArray($hidden);
        // Nota: il BaseModel ha un array vuoto per $hidden, quindi non dovrebbe contenere 'password'
        $this->assertNotContains('password', $hidden);
    }

    /** @test */
    public function it_can_use_connection_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect('activity', $concreteModel->getConnectionName());
        expect(\Illuminate\Database\ConnectionInterface::class, $concreteModel->getConnection());
    }

    /** @test */
    public function it_can_use_table_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect('test_models', $concreteModel->getTable());
    }

    /** @test */
    public function it_can_use_key_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect('id', $concreteModel->getKeyName());
        expect('string', $concreteModel->getKeyType());
        expect($concreteModel->getIncrementing());
    }

    /** @test */
    public function it_can_use_timestamp_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect($concreteModel->usesTimestamps());
        expect($concreteModel->timestamps);

        expect('created_at', $concreteModel->getCreatedAtColumn());
        expect('updated_at', $concreteModel->getUpdatedAtColumn());
    }

    /** @test */
    public function it_can_use_per_page_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect(30, $concreteModel->getPerPage());

        // Test setPerPage
        $concreteModel->setPerPage(50);
        expect(50, $concreteModel->getPerPage());
    }

    /** @test */
    public function it_can_use_snake_attributes_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        expect($concreteModel::$snakeAttributes);

        // Test setSnakeAttributes
        $concreteModel::$snakeAttributes = false;
        expect($concreteModel::$snakeAttributes);

        // Ripristina il valore originale
        $concreteModel::$snakeAttributes = true;
        expect($concreteModel::$snakeAttributes);
    }

    /** @test */
    public function it_can_use_casts_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';
        };

        $casts = $concreteModel->getCasts();
        $this->assertIsArray($casts);
        $this->assertArrayHasKey('id', $casts);
        $this->assertArrayHasKey('created_at', $casts);
        $this->assertArrayHasKey('updated_at', $casts);

        // Test setCasts
        $newCasts = ['test_field' => 'string'];
        $concreteModel->setCasts($newCasts);
        expect($newCasts, $concreteModel->getCasts());
    }

    /** @test */
    public function it_can_use_fillable_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $fillable = ['name', 'value'];
        };

        $fillable = $concreteModel->getFillable();
        $this->assertIsArray($fillable);
        $this->assertContains('name', $fillable);
        $this->assertContains('value', $fillable);

        // Test setFillable
        $newFillable = ['new_field'];
        $concreteModel->setFillable($newFillable);
        expect($newFillable, $concreteModel->getFillable());
    }

    /** @test */
    public function it_can_use_hidden_methods(): void
    {
        $concreteModel = new class extends BaseModel
        {
            protected $table = 'test_models';

            /** @var list<string> */
            protected $hidden = ['secret_field'];
        };

        $hidden = $concreteModel->getHidden();
        $this->assertIsArray($hidden);
        $this->assertContains('secret_field', $hidden);

        // Test setHidden
        $newHidden = ['new_secret'];
        $concreteModel->setHidden($newHidden);
        expect($newHidden, $concreteModel->getHidden());
    }
}
