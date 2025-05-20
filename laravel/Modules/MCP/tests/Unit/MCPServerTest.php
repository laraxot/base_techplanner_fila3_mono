<?php

declare(strict_types=1);

namespace Modules\MCP\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\MCP\Services\MCPServer;
use Tests\TestCase;

class MCPServerTest extends TestCase
{
    use RefreshDatabase;

    protected MCPServer $mcp;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mcp = app(MCPServer::class);
    }

    public function test_validate_model_context(): void
    {
        $violations = $this->mcp->validateModelContext('App\Models\User');

        $this->assertIsArray($violations);
    }

    public function test_get_model_context(): void
    {
        $context = $this->mcp->getModelContext('App\Models\User');

        $this->assertIsArray($context);
        $this->assertArrayHasKey('type', $context);
        $this->assertArrayHasKey('traits', $context);
        $this->assertArrayHasKey('relationships', $context);
    }

    public function test_get_related_models(): void
    {
        $related = $this->mcp->getRelatedModels('App\Models\User');

        $this->assertIsArray($related);
    }

    public function test_store_and_retrieve_data(): void
    {
        $key = 'test:key';
        $data = ['test' => 'data'];

        $stored = $this->mcp->memory()->store($key, $data);
        $this->assertTrue($stored);

        $retrieved = $this->mcp->memory()->retrieve($key);
        $this->assertEquals($data, $retrieved);
    }

    public function test_fetch_and_cache(): void
    {
        $url = 'https://api.example.com/test';
        $key = 'test:external';
        $ttl = 3600;

        $data = $this->mcp->getCachedOrFetch($url, $key, $ttl);

        $this->assertNotNull($data);

        $cached = $this->mcp->memory()->retrieve($key);
        $this->assertEquals($data, $cached);
    }

    public function test_filesystem_operations(): void
    {
        $path = 'test/file.txt';
        $content = 'Test content';

        $stored = $this->mcp->filesystem()->store($path, $content);
        $this->assertTrue($stored);

        $exists = $this->mcp->filesystem()->exists($path);
        $this->assertTrue($exists);

        $retrieved = $this->mcp->filesystem()->retrieve($path);
        $this->assertEquals($content, $retrieved);

        $deleted = $this->mcp->filesystem()->delete($path);
        $this->assertTrue($deleted);

        $exists = $this->mcp->filesystem()->exists($path);
        $this->assertFalse($exists);
    }
}
