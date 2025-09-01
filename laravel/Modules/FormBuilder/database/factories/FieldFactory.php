<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\FormBuilder\Models\Field;
use Modules\FormBuilder\Models\Section;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\FormBuilder\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Modules\FormBuilder\Models\Field>
     */
    protected $model = Field::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fieldTypes = [
            'text' => ['placeholder' => 'Inserisci il testo'],
            'email' => ['placeholder' => 'Inserisci la tua email'],
            'number' => ['placeholder' => 'Inserisci un numero'],
            'textarea' => ['placeholder' => 'Inserisci la descrizione'],
            'select' => ['options' => ['Opzione 1', 'Opzione 2', 'Opzione 3']],
            'checkbox' => ['label' => 'Accetto i termini'],
            'radio' => ['options' => ['Sì', 'No']],
            'date' => ['placeholder' => 'Seleziona una data'],
            'file' => ['accept' => '.pdf,.doc,.docx'],
        ];

        $type = $this->faker->randomElement(array_keys($fieldTypes));
        $fieldConfig = $fieldTypes[$type];

        return [
            'section_id' => Section::factory(),
            'name' => [
                'it' => $this->faker->words(2, true),
                'en' => $this->faker->words(2, true),
            ],
            'description' => $this->faker->optional()->sentence(),
            'type' => $type,
            'ordering' => $this->faker->numberBetween(1, 100),
            'options' => array_merge($fieldConfig, [
                'required' => $this->faker->boolean(70),
                'validation' => $this->getValidationRules($type),
                'help_text' => $this->faker->optional()->sentence(),
            ]),
            'created_by' => $this->faker->optional()->uuid(),
            'updated_by' => $this->faker->optional()->uuid(),
        ];
    }

    /**
     * Indica che il campo è obbligatorio.
     */
    public function required(): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], [
                'required' => true,
            ]),
        ]);
    }

    /**
     * Indica che il campo è opzionale.
     */
    public function optional(): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], [
                'required' => false,
            ]),
        ]);
    }

    /**
     * Crea un campo di tipo testo.
     */
    public function text(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'text',
            'options' => array_merge($attributes['options'] ?? [], [
                'placeholder' => 'Inserisci il testo',
                'max_length' => $this->faker->numberBetween(50, 500),
            ]),
        ]);
    }

    /**
     * Crea un campo di tipo email.
     */
    public function email(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'email',
            'options' => array_merge($attributes['options'] ?? [], [
                'placeholder' => 'Inserisci la tua email',
            ]),
        ]);
    }

    /**
     * Crea un campo di tipo select.
     */
    public function select(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'select',
            'options' => array_merge($attributes['options'] ?? [], [
                'options' => ['Opzione 1', 'Opzione 2', 'Opzione 3', 'Opzione 4'],
                'multiple' => $this->faker->boolean(20),
            ]),
        ]);
    }

    /**
     * Crea un campo di tipo file.
     */
    public function file(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'file',
            'options' => array_merge($attributes['options'] ?? [], [
                'accept' => '.pdf,.doc,.docx,.jpg,.png',
                'max_size' => $this->faker->numberBetween(1, 10) . 'MB',
            ]),
        ]);
    }

    /**
     * Ottiene le regole di validazione per il tipo di campo.
     */
    private function getValidationRules(string $type): array
    {
        $rules = [];

        switch ($type) {
            case 'email':
                $rules[] = 'email';
                break;
            case 'number':
                $rules[] = 'numeric';
                break;
            case 'file':
                $rules[] = 'file';
                break;
            case 'date':
                $rules[] = 'date';
                break;
        }

        return $rules;
    }
}
