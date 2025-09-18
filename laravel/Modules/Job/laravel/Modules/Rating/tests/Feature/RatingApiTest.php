<?php

namespace Modules\Rating\Tests\Feature;

use Modules\Rating\Tests\TestCase;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RatingApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_list_ratings(): void
    {
        Rating::create([
            'title' => 'Test Rating 1',
            'value' => 5
        ]);

        Rating::create([
            'title' => 'Test Rating 2',
            'value' => 4
        ]);

        $response = $this->getJson('/api/ratings');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'value',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function test_can_create_rating(): void
    {
        $data = [
            'title' => 'New Rating',
            'value' => 5,
            'color' => '#00FF00',
            'icon' => 'star',
            'rule' => 'test',
            'txt' => 'Test description'
        ];

        $response = $this->postJson('/api/ratings', $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'New Rating',
                    'value' => 5
                ]
            ]);
    }

    public function test_can_update_rating(): void
    {
        $rating = Rating::create([
            'title' => 'Test Rating',
            'value' => 5
        ]);

        $data = [
            'title' => 'Updated Rating',
            'value' => 4
        ];

        $response = $this->putJson("/api/ratings/{$rating->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'Updated Rating',
                    'value' => 4
                ]
            ]);
    }

    public function test_can_delete_rating(): void
    {
        $rating = Rating::create([
            'title' => 'Test Rating',
            'value' => 5
        ]);

        $response = $this->deleteJson("/api/ratings/{$rating->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('ratings', ['id' => $rating->id]);
    }

    public function test_can_rate_model(): void
    {
        $rating = Rating::create([
            'title' => 'Test Rating',
            'value' => 5
        ]);

        $data = [
            'model_type' => 'test_model',
            'model_id' => 1,
            'value' => 4.5,
            'note' => 'Great!'
        ];

        $response = $this->postJson("/api/ratings/{$rating->id}/rate", $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'rating_id' => $rating->id,
                    'value' => 4.5,
                    'note' => 'Great!'
                ]
            ]);
    }
} 