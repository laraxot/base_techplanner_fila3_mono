<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Clusters\Test\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Datas\WhatsAppData;
use Modules\Notify\Enums\WhatsAppDriverEnum;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Notify\Notifications\WhatsAppNotification;
use Modules\Xot\Filament\Pages\XotBasePage;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;

/**
 * @property ComponentContainer $whatsappForm
 */
class SendWhatsAppPage extends XotBasePage
{
    public null|array $whatsappData = [];
    protected static null|string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string $view = 'notify::filament.pages.send-whatsapp';
    protected static null|string $cluster = Test::class;

    /**
     * Get the slug of the page
     *
     * This explicit definition ensures consistent URL generation for acronyms
     */
    public static function getSlug(): string
    {
        return 'send-whatsapp-page';
    }

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'whatsappForm',
        ];
    }

    protected function fillForms(): void
    {
        $this->whatsappForm->fill();
    }

    public function whatsappForm(Form $form): Form
    {
        return $form->schema($this->getWhatsAppFormSchema())->model($this->getUser())->statePath('whatsappData');
    }

    public function getWhatsAppFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('to')
                ->tel()
                ->required()
                ->helperText('Inserisci il numero di telefono con prefisso internazionale (es. +39)'),
            Forms\Components\TextInput::make('message')
                ->required()
                ->maxLength(4096)
                ->helperText('Il messaggio non può superare i 4096 caratteri'),
            Forms\Components\Select::make('driver')
                ->options(WhatsAppDriverEnum::options())
                ->default(WhatsAppDriverEnum::getDefault()->value)
                ->required()
                ->helperText(__('notify::whatsapp.fields.driver.helper_text')),
            Forms\Components\TextInput::make('template')->helperText('Nome del template (opzionale)'),
            Forms\Components\KeyValue::make('parameters')->helperText('Parametri per il template (opzionale)'),
            Forms\Components\TextInput::make('media_url')->url()->helperText('URL del media (opzionale)'),
            Forms\Components\Select::make('media_type')
                ->options([
                    'image' => 'Immagine',
                    'video' => 'Video',
                    'document' => 'Documento',
                    'audio' => 'Audio',
                ])
                ->helperText('Tipo di media (opzionale)'),
        ];
    }

    public function sendWhatsApp(): void
    {
        try {
            $data = $this->whatsappForm->getState();
            $user = $this->getUser();

            $message = is_string($data['message']) ? $data['message'] : '';

            Notification::route('whatsapp', $data['to'])->notify(
                new WhatsAppNotification($message, [
                    'driver' => $data['driver'],
                    'template' => $data['template'] ?? null,
                    'parameters' => $data['parameters'] ?? null,
                    'media_url' => $data['media_url'] ?? null,
                    'media_type' => $data['media_type'] ?? null,
                ]),
            );

            FilamentNotification::make()
                ->success()
                ->title('Messaggio WhatsApp inviato con successo')
                ->send();
        } catch (\Exception $e) {
            Log::error('Errore nell\'invio WhatsApp: ' . $e->getMessage());

            FilamentNotification::make()
                ->danger()
                ->title('Errore nell\'invio WhatsApp')
                ->body($e->getMessage())
                ->send();
        }
    }

    protected function getWhatsAppFormActions(): array
    {
        return [
            Action::make('whatsappFormActions')->submit('whatsappFormActions'),
        ];
    }

    #[\Override]
    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

        if (!($user instanceof Model)) {
            throw new \Exception(
                'The authenticated user object must be an Eloquent model to allow the profile page to update it.',
            );
        }

        return $user;
    }
}
