<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

use Filament\Forms\Form;
<<<<<<< HEAD
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Illuminate\Http\Request;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Livewire\Attributes\Validate;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Contracts\UserContract;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Illuminate\Support\Facades\Log;

/**
 * EditUserWidget: Widget generico per la modifica dati utente.
 * 
=======
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * EditUserWidget: Widget generico per la modifica dati utente.
 *
>>>>>>> 9831a351 (.)
 * Segue il pattern di delegazione del RegistrationWidget:
 * - Raccoglie i dati dal form
 * - Determina dinamicamente la risorsa, il modello e l'action da eseguire
 * - Delega la logica di salvataggio a una UpdateAction specifica del modulo
<<<<<<< HEAD
 * 
 * Il widget è completamente generico e riutilizzabile per qualsiasi tipo di utente.
 * 
=======
 *
 * Il widget è completamente generico e riutilizzabile per qualsiasi tipo di utente.
 *
>>>>>>> 9831a351 (.)
 * @property-read string $type
 * @property-read string $resource
 * @property-read string $model
 * @property-read string $action
 * @property-read Model $record
 * @property array|null $data
 */
class EditUserWidget extends XotBaseWidget
{
    /** @var array<string, mixed>|null */
    public ?array $data = [];
<<<<<<< HEAD
    
    /** @var array<string, int|null>|int|string */
    protected int | string | array $columnSpan = 'full';
    
    public string $type;
    public string $resource;
    public string $model;
    public string $action;
=======

    /** @var array<string, int|null>|int|string */
    protected int|string|array $columnSpan = 'full';

    public string $type;

    public string $resource;

    public string $model;

    public string $action;

>>>>>>> 9831a351 (.)
    public Model $record;

    /**
     * @phpstan-ignore-next-line
     */
    protected static string $view = 'pub_theme::filament.widgets.edit-user';

    /**
     * Initialize the widget with user type and optional user ID.
<<<<<<< HEAD
     *
     * @param string $type
     * @param int|null $userId
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    public function mount(string $type, ?int $userId = null): void
    {
        $this->type = $type;
        $this->resource = XotData::make()->getUserResourceClassByType($type);
        $this->model = $this->resource::getModel();
        $this->action = Str::of($this->model)->replace('\Models\\', '\Actions\\')->append('\UpdateUserAction')->toString();
<<<<<<< HEAD
        
        $record = $this->getFormModel($userId);
        $data = $this->getFormFill();
        
=======

        $record = $this->getFormModel($userId);
        $data = $this->getFormFill();

>>>>>>> 9831a351 (.)
        $this->form->fill($data);
        $this->form->model($record);
        $this->data = $data;
        $this->record = $record;
    }

    /**
     * Ottiene il modello per il form.
     * Se viene fornito un userId, carica quell'utente, altrimenti usa l'utente autenticato.
<<<<<<< HEAD
     *
     * @param int|null $userId
     * @return Model
=======
>>>>>>> 9831a351 (.)
     */
    protected function getFormModel(?int $userId = null): Model
    {
        if ($userId) {
            $user = $this->model::findOrFail($userId);
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return $user;
        }

        // Se non è specificato un userId, usa l'utente correntemente autenticato
        $currentUser = Auth::user();
        if ($currentUser && $currentUser instanceof $this->model) {
            return $currentUser;
        }

        // Fallback: cerca un utente del tipo corretto associato all'utente autenticato
        if ($currentUser) {
            $user = $this->model::where('user_id', $currentUser->id)->first();
            if ($user) {
                return $user;
            }
        }

        // Ultimo fallback: nuovo modello
        return app($this->model);
    }

    /**
     * Ottiene i dati per il riempimento del form.
     *
     * @return array<string, mixed>
     */
    public function getFormFill(): array
    {
        $model = $this->record ?? $this->getFormModel();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        // Se il modello ha un ID, significa che è stato trovato nel database
        if ($model->exists) {
            try {
                return $model->toArray();
            } catch (\Exception $e) {
                // Se toArray() fallisce (problemi con enum), usa getAttributes()
<<<<<<< HEAD
                Log::warning("Errore in toArray() per modello {$this->model}: " . $e->getMessage());
                $attributes = $model->getAttributes();
                
=======
                Log::warning("Errore in toArray() per modello {$this->model}: ".$e->getMessage());
                $attributes = $model->getAttributes();

>>>>>>> 9831a351 (.)
                // Gestisci specificamente gli enum se presenti
                if (isset($attributes['type']) && ($model->type ?? null) instanceof \BackedEnum) {
                    $attributes['type'] = $model->type->value;
                }
<<<<<<< HEAD
                
                return $attributes;
            }
        }
        
=======

                return $attributes;
            }
        }

>>>>>>> 9831a351 (.)
        // Se è un nuovo modello, restituisci solo i campi fillable con valori null
        $fillable = $model->getFillable();
        $appends = $model->getAppends();
        $fields = array_merge($fillable, $appends);
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        return array_fill_keys($fields, null);
    }

    /**
     * Ottiene lo schema del form dalla resource.
     *
     * @return array<int|string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return $this->resource::getFormSchemaWidget();
    }

    /**
     * Gestisce il salvataggio delle modifiche delegando all'action specifica.
<<<<<<< HEAD
     * 
     * @see https://filamentphp.com/docs/3.x/forms/adding-a-form-to-a-livewire-component
     *
     * @return \Illuminate\Http\RedirectResponse|\Livewire\Features\SupportRedirects\Redirector
=======
     *
     * @see https://filamentphp.com/docs/3.x/forms/adding-a-form-to-a-livewire-component
>>>>>>> 9831a351 (.)
     */
    public function updateUser(): \Illuminate\Http\RedirectResponse|\Livewire\Features\SupportRedirects\Redirector
    {
        $data = $this->form->getState();
        $record = $this->record;
<<<<<<< HEAD
       
        // Delega l'aggiornamento all'action specifica
        $user = app($this->action)->execute($record, $data);
        
        // Notifica successo
        session()->flash('message', __('user::profile.update_success'));
        
        // Aggiorna il form con i nuovi dati
        $this->form->fill($this->getFormFill());
        
=======

        // Delega l'aggiornamento all'action specifica
        $user = app($this->action)->execute($record, $data);

        // Notifica successo
        session()->flash('message', __('user::profile.update_success'));

        // Aggiorna il form con i nuovi dati
        $this->form->fill($this->getFormFill());

>>>>>>> 9831a351 (.)
        return redirect()->back();
    }

    /**
     * Controlla se l'utente può modificare il record corrente.
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> 9831a351 (.)
     */
    public function canEdit(): bool
    {
        $currentUser = Auth::user();
<<<<<<< HEAD
        
=======

>>>>>>> 9831a351 (.)
        // L'utente può modificare solo il proprio profilo
        return $currentUser && (
            (($currentUser->id ?? null) !== null && ($this->record->id ?? null) !== null && $currentUser->id === $this->record->id) ||
            (($currentUser->id ?? null) !== null && $currentUser->id === ($this->record->user_id ?? null))
        );
    }
}
