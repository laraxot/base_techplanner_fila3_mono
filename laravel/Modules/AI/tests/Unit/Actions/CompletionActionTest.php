<?php

declare(strict_types=1);

namespace Modules\AI\Tests\Unit\Actions;

use Modules\AI\Actions\CompletionAction;
use Modules\AI\Datas\CompletionData;
use Tests\TestCase;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;
use OpenAI\Responses\Completions\CreateResponseChoice;
use OpenAI\Responses\Completions\CreateResponseUsage;
use Mockery;

class CompletionActionTest extends TestCase
{
    private CompletionAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new CompletionAction();
    }

    /** @test */
    public function it_creates_completion_with_valid_prompt(): void
    {
        // Arrange
        $prompt = 'Explain what PHP is';
        $expectedText = 'PHP is a server-side scripting language designed for web development.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 5;
        $mockUsage->completionTokens = 20;
        $mockUsage->totalTokens = 25;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->with([
                'model' => 'gpt-3.5-turbo-instruct',
                'prompt' => $prompt,
                'temperature' => 0.5,
                'max_tokens' => 100,
                'top_p' => 1.0,
                'frequency_penalty' => 0.0,
                'presence_penalty' => 0.0,
            ])
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText)
            ->and($result->promptTokens)->toBe(5)
            ->and($result->completionTokens)->toBe(20)
            ->and($result->totalTokens)->toBe(25);
    }

    /** @test */
    public function it_handles_empty_prompt(): void
    {
        // Arrange
        $prompt = '';
        $expectedText = 'No prompt provided.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 0;
        $mockUsage->completionTokens = 5;
        $mockUsage->totalTokens = 5;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_long_prompt(): void
    {
        // Arrange
        $prompt = str_repeat('This is a very long prompt that tests the handling of extended text content. ', 50);
        $expectedText = 'Response to long prompt.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 250;
        $mockUsage->completionTokens = 10;
        $mockUsage->totalTokens = 260;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText)
            ->and($result->promptTokens)->toBe(250);
    }

    /** @test */
    public function it_handles_special_characters_in_prompt(): void
    {
        // Arrange
        $prompt = 'What is the meaning of life? 42! @#$%^&*()';
        $expectedText = 'The meaning of life is a philosophical question.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 15;
        $mockUsage->completionTokens = 12;
        $mockUsage->totalTokens = 27;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_multilingual_prompt(): void
    {
        // Arrange
        $prompt = '¿Qué es PHP? Explain in Spanish and English.';
        $expectedText = 'PHP es un lenguaje de programación. PHP is a programming language.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 12;
        $mockUsage->completionTokens = 18;
        $mockUsage->totalTokens = 30;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_code_prompt(): void
    {
        // Arrange
        $prompt = 'Write a PHP function to calculate factorial: function factorial($n) {';
        $expectedText = 'return $n <= 1 ? 1 : $n * factorial($n - 1); }';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 20;
        $mockUsage->completionTokens = 25;
        $mockUsage->totalTokens = 45;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_technical_prompt(): void
    {
        // Arrange
        $prompt = 'Explain the SOLID principles in software development.';
        $expectedText = 'SOLID principles are five design principles for object-oriented programming.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 10;
        $mockUsage->completionTokens = 15;
        $mockUsage->totalTokens = 25;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_question_prompt(): void
    {
        // Arrange
        $prompt = 'What are the best practices for Laravel development?';
        $expectedText = 'Laravel best practices include using Eloquent ORM, following PSR standards, and implementing proper validation.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 12;
        $mockUsage->completionTokens = 22;
        $mockUsage->totalTokens = 34;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    /** @test */
    public function it_handles_creative_prompt(): void
    {
        // Arrange
        $prompt = 'Write a short story about a developer who discovers a magical bug.';
        $expectedText = 'Once upon a time, there was a developer named Alex who found a bug that glowed with an otherworldly light.';
        
        $mockChoice = Mockery::mock(CreateResponseChoice::class);
        $mockChoice->text = $expectedText;
        
        $mockUsage = Mockery::mock(CreateResponseUsage::class);
        $mockUsage->promptTokens = 15;
        $mockUsage->completionTokens = 30;
        $mockUsage->totalTokens = 45;
        
        $mockResponse = Mockery::mock(CreateResponse::class);
        $mockResponse->choices = [$mockChoice];
        $mockResponse->usage = $mockUsage;
        
        OpenAI::shouldReceive('completions->create')
            ->once()
            ->andReturn($mockResponse);

        // Act
        $result = $this->action->execute($prompt);

        // Assert
        expect($result)->toBeInstanceOf(CompletionData::class)
            ->and($result->text)->toBe($expectedText);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
