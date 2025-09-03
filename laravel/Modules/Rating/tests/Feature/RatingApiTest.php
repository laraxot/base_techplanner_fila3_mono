<?php

namespace Modules\Rating\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Rating\Models\Rating;
use Modules\Rating\Tests\TestCase;

class RatingApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_list_ratings(): void
    {
        Rating::create([
            'name' => 'Test Rating 1',
        ]);

        Rating::create([
            'name' => 'Test Rating 2',
        ]);

        $response = $this->getJson('/api/ratings');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function test_can_create_rating(): void
    {
        $data = [
            'name' => 'New Rating',
            'color' => '#00FF00',
        ];

        $response = $this->postJson('/api/ratings', $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'New Rating',
                ],
            ]);
    }

    public function test_can_update_rating(): void
    {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $data = [
            'name' => 'Updated Rating',
        ];

        $response = $this->putJson("/api/ratings/{$rating->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Updated Rating',
                ],
            ]);
    }

    public function test_can_delete_rating(): void
    {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $response = $this->deleteJson("/api/ratings/{$rating->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('ratings', ['id' => $rating->id]);
    }

    public function test_can_rate_model(): void
    {
        $rating = Rating::create([
            'name' => 'Test Rating',
        ]);

        $data = [
            'model_type' => 'test_model',
            'model_id' => 1,
            'value' => 4.5,
            'note' => 'Great!',
        ];

        $response = $this->postJson("/api/ratings/{$rating->id}/rate", $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'rating_id' => $rating->id,
                    'value' => 4.5,
                    'note' => 'Great!',
                ],
            ]);
    }
}
