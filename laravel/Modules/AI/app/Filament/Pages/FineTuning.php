<?php

declare(strict_types=1);

namespace Modules\AI\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Modules\Xot\Filament\Pages\XotBasePage;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Webmozart\Assert\Assert;

use function Safe\file_get_contents;

class FineTuning extends XotBasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'ai::filament.pages.fine-tuning';

    public string $learning_rate = '0.001';

    public int $batch_size = 32;

    public int $epochs = 10;

    public string $dataset = 'dataset1';

    /** @var TemporaryUploadedFile */
    public $dataset_file;

    /**
     * Schema del form.
     */
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('learning_rate')
                ->label(__('ai::fine_tuning.learning_rate'))  // Usiamo la traduzione per il label
                ->required()
                ->numeric()
                ->minValue(0)
                ->helperText(__('ai::fine_tuning.learning_rate_helper')),

            TextInput::make('batch_size')
                ->label(__('ai::fine_tuning.batch_size'))  // Traduzione per batch size
                ->required()
                ->numeric()
                ->minValue(1)
                ->helperText(__('ai::fine_tuning.batch_size_helper')),

            TextInput::make('epochs')
                ->label(__('ai::fine_tuning.epochs'))  // Traduzione per epochs
                ->required()
                ->numeric()
                ->minValue(1)
                ->helperText(__('ai::fine_tuning.epochs_helper')),

            Select::make('dataset')
                ->label(__('ai::fine_tuning.dataset'))  // Traduzione per dataset
                ->options([
                    'dataset1' => __('ai::fine_tuning.dataset1'),
                    'dataset2' => __('ai::fine_tuning.dataset2'),
                ])
                ->required(),
            Forms\Components\FileUpload::make('dataset_file')
                ->label(__('ai::fine_tuning.dataset_file'))
                ->required()
                ->helperText(__('ai::fine_tuning.dataset_file_helper')),
        ];
    }

    /**
     * Avvia il processo di fine-tuning.
     */
    public function startFineTuning(): void
    {
        $data = [
            'learning_rate' => (float) $this->learning_rate,
            'batch_size' => (int) $this->batch_size,
            'epochs' => (int) $this->epochs,
            'dataset' => $this->dataset,
        ];

        if ($this->dataset_file) {
            $data['dataset_file'] = $this->dataset_file->getRealPath(); // Percorso del file caricato
        }

        Assert::string($apiEndpoint = Config::get('ai.backend_api.fine_tuning_url'));

        $response = $this->sendFineTuningRequest($data, $apiEndpoint);

        if ($response->successful()) {
            Notification::make()
                ->title(__('ai::fine_tuning.success_title'))  // Traduzione per il titolo di successo
                ->body(__('ai::fine_tuning.success_body'))    // Traduzione per il messaggio di successo
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title(__('ai::fine_tuning.error_title'))  // Traduzione per il titolo di errore
                ->body(__('ai::fine_tuning.error_body'))    // Traduzione per il messaggio di errore
                ->danger()
                ->send();
        }
    }

    protected function sendFineTuningRequest(array $data, string $endpoint): Response
    {
        Assert::string($dataset_file = $data['dataset_file']);
        Assert::string($content = file_get_contents($dataset_file));

        return Http::attach('dataset_file', $content, basename($dataset_file))
            ->post($endpoint, $data);
    }

    /**
     * Restituisce le azioni del form, come il pulsante per avviare il fine-tuning.
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label(__('ai::fine_tuning.action_label'))
                ->action('startFineTuning')
                ->color('primary'),
        ];
    }
}
