# Regola: Colonne Personalizzate Filament - Best Practices

## 🎯 Principio Fondamentale

**SEMPRE** creare colonne personalizzate che estendono `TextColumn` per funzionalità complesse, mantenendo coerenza con le convenzioni Filament.

## ❌ Anti-Pattern da Evitare

```php
// ❌ MAI fare questo - Colonna personalizzata senza struttura
class ContactColumn extends TextColumn
{
    // Nessuna implementazione o struttura
}
```

## ✅ Pattern Corretto

### 1. **Struttura Base per Colonna Personalizzata**
```php
<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Modules\Notify\Models\Contact;

class ContactColumn extends TextColumn
{
    protected string $view = 'notify::filament.tables.columns.contact';

    public static function make(string $name = 'contact'): static
    {
        return parent::make($name)
            ->label('Contatto')
            ->formatStateUsing(function (Contact $record): string {
                return static::formatContact($record);
            })
            ->html()
            ->wrap()
            ->searchable(['contact_type', 'value', 'email', 'mobile_phone'])
            ->sortable(['contact_type', 'value', 'created_at'])
            ->tooltip(fn (Contact $record): string => static::getContactTooltip($record));
    }

    protected static function formatContact(Contact $record): string
    {
        // Implementazione della formattazione
    }

    protected static function getContactTooltip(Contact $record): string
    {
        // Implementazione del tooltip
    }
}
```

### 2. **Metodi Helper Obbligatori**
```php
/**
 * Formatta il contatto per la visualizzazione.
 *
 * @param \Modules\Notify\Models\Contact $record
 * @return string
 */
protected static function formatContact(Contact $record): string
{
    $contactInfo = [];
    
    // Nome completo
    if ($record->first_name || $record->last_name) {
        $fullName = trim($record->first_name . ' ' . $record->last_name);
        if ($fullName) {
            $contactInfo[] = '<span class="font-medium text-gray-900">' . $fullName . '</span>';
        }
    }
    
    // Tipo di contatto con icona
    $contactType = $record->contact_type ?? 'unknown';
    $value = $record->value ?? $record->email ?? $record->mobile_phone ?? '';
    
    if ($value) {
        $icon = static::getContactTypeIcon($contactType);
        $color = static::getContactTypeColor($contactType);
        $contactInfo[] = '<span class="flex items-center ' . $color . '">' . $icon . ' ' . $value . '</span>';
    }
    
    return empty($contactInfo) 
        ? '<span class="text-gray-400">Nessun contatto</span>' 
        : implode('<br class="my-1">', $contactInfo);
}

/**
 * Restituisce l'icona appropriata per il tipo di contatto.
 *
 * @param string $contactType
 * @return string
 */
protected static function getContactTypeIcon(string $contactType): string
{
    return match ($contactType) {
        'email' => '<i class="heroicon-o-envelope w-4 h-4 inline mr-1" title="Email"></i>',
        'phone', 'mobile' => '<i class="heroicon-o-phone w-4 h-4 inline mr-1" title="Telefono"></i>',
        'mobile_phone' => '<i class="heroicon-o-device-phone-mobile w-4 h-4 inline mr-1" title="Cellulare"></i>',
        'whatsapp' => '<i class="fab fa-whatsapp w-4 h-4 inline mr-1" title="WhatsApp"></i>',
        'telegram' => '<i class="fab fa-telegram w-4 h-4 inline mr-1" title="Telegram"></i>',
        'sms' => '<i class="heroicon-o-chat-bubble-left-right w-4 h-4 inline mr-1" title="SMS"></i>',
        default => '<i class="heroicon-o-user w-4 h-4 inline mr-1" title="Contatto"></i>',
    };
}

/**
 * Restituisce il colore appropriato per il tipo di contatto.
 *
 * @param string $contactType
 * @return string
 */
protected static function getContactTypeColor(string $contactType): string
{
    return match ($contactType) {
        'email' => 'text-blue-600 hover:text-blue-800',
        'phone', 'mobile' => 'text-green-600 hover:text-green-800',
        'mobile_phone' => 'text-purple-600 hover:text-purple-800',
        'whatsapp' => 'text-green-600 hover:text-green-800',
        'telegram' => 'text-blue-500 hover:text-blue-700',
        'sms' => 'text-orange-600 hover:text-orange-800',
        default => 'text-gray-600 hover:text-gray-800',
    };
}

/**
 * Genera il tooltip per il contatto.
 *
 * @param \Modules\Notify\Models\Contact $record
 * @return string
 */
protected static function getContactTooltip(Contact $record): string
{
    $tooltip = [];
    
    if ($record->contact_type) {
        $tooltip[] = 'Tipo: ' . ucfirst($record->contact_type);
    }
    
    if ($record->verified_at) {
        $tooltip[] = 'Verificato: ' . $record->verified_at->format('d/m/Y H:i');
    }
    
    if ($record->sms_count > 0) {
        $tooltip[] = 'SMS inviati: ' . $record->sms_count;
    }
    
    if ($record->mail_count > 0) {
        $tooltip[] = 'Email inviate: ' . $record->mail_count;
    }
    
    return implode(' | ', $tooltip);
}
```

## 🎨 View Blade per Colonna Personalizzata

### Struttura View Corretta
```blade
{{-- resources/views/filament/tables/columns/contact.blade.php --}}
@php
    $contact = $getState();
    $record = $getRecord();
@endphp

<div class="flex flex-col space-y-1">
    @if($record->first_name || $record->last_name)
        <div class="font-medium text-gray-900">
            {{ trim($record->first_name . ' ' . $record->last_name) }}
        </div>
    @endif
    
    @if($record->value || $record->email || $record->mobile_phone)
        <div class="flex items-center text-sm">
            @php
                $contactType = $record->contact_type ?? 'unknown';
                $value = $record->value ?? $record->email ?? $record->mobile_phone;
                $icon = match ($contactType) {
                    'email' => 'heroicon-o-envelope',
                    'phone', 'mobile' => 'heroicon-o-phone',
                    'mobile_phone' => 'heroicon-o-device-phone-mobile',
                    'whatsapp' => 'fab fa-whatsapp',
                    'telegram' => 'fab fa-telegram',
                    'sms' => 'heroicon-o-chat-bubble-left-right',
                    default => 'heroicon-o-user',
                };
                $color = match ($contactType) {
                    'email' => 'text-blue-600',
                    'phone', 'mobile' => 'text-green-600',
                    'mobile_phone' => 'text-purple-600',
                    'whatsapp' => 'text-green-600',
                    'telegram' => 'text-blue-500',
                    'sms' => 'text-orange-600',
                    default => 'text-gray-600',
                };
            @endphp
            
            <x-filament::icon 
                :name="$icon" 
                class="w-4 h-4 mr-1 {{ $color }}" 
            />
            <span class="{{ $color }}">{{ $value }}</span>
        </div>
    @endif
    
    @if($record->verified_at)
        <div class="text-green-600 text-xs flex items-center">
            <x-filament::icon 
                name="heroicon-o-check-circle" 
                class="w-3 h-3 mr-1" 
            />
            Verificato
        </div>
    @endif
    
    @if($record->sms_count > 0 || $record->mail_count > 0)
        <div class="flex gap-2 text-xs">
            @if($record->sms_count > 0)
                <span class="text-blue-600 flex items-center">
                    <x-filament::icon 
                        name="heroicon-o-chat-bubble-left-right" 
                        class="w-3 h-3 mr-1" 
                    />
                    {{ $record->sms_count }} SMS
                </span>
            @endif
            
            @if($record->mail_count > 0)
                <span class="text-green-600 flex items-center">
                    <x-filament::icon 
                        name="heroicon-o-envelope" 
                        class="w-3 h-3 mr-1" 
                    />
                    {{ $record->mail_count }} Email
                </span>
            @endif
        </div>
    @endif
</div>
```

## 📋 Checklist Colonna Personalizzata

- [ ] Estende `TextColumn` correttamente
- [ ] Implementa metodo `make()` con configurazione completa
- [ ] Usa `formatStateUsing()` per logica di formattazione
- [ ] Implementa metodi helper per icona e colore
- [ ] Gestisce casi null/empty
- [ ] Fornisce tooltip informativo
- [ ] Supporta ricerca e ordinamento
- [ ] Include view Blade se necessario
- [ ] Documenta tutti i metodi con PHPDoc
- [ ] Testa la funzionalità

## 🔄 Utilizzo Corretto

### In una Resource
```php
use Modules\Notify\Filament\Tables\Columns\ContactColumn;

public function getTableColumns(): array
{
    return [
        'contact' => ContactColumn::make('contact'),
        // altre colonne...
    ];
}
```

### In un RelationManager
```php
use Modules\Notify\Filament\Tables\Columns\ContactColumn;

public function table(Table $table): Table
{
    return $table
        ->columns([
            ContactColumn::make('contact'),
            // altre colonne...
        ]);
}
```

## 📚 Best Practices

### 1. **Performance**
- Usare eager loading per relazioni
- Ottimizzare query di ricerca
- Caching per dati complessi

### 2. **Accessibilità**
- Tooltip informativi
- Icone con alt text
- Contrasto colori appropriato

### 3. **Manutenibilità**
- Codice centralizzato e riutilizzabile
- Configurazione flessibile
- Documentazione completa

### 4. **Responsive**
- Layout flessibile
- Icone scalabili
- Testo adattivo

## 🎯 Regole Specifiche per Modulo Notify

### 1. **Contatti**
- **SEMPRE** mostrare nome completo se disponibile
- **SEMPRE** usare icone appropriate per tipo di contatto
- **SEMPRE** indicare stato di verifica
- **SEMPRE** mostrare statistiche di invio

### 2. **Icone Standard**
- 📧 Email: `heroicon-o-envelope`
- 📞 Telefono: `heroicon-o-phone`
- 📱 Cellulare: `heroicon-o-device-phone-mobile`
- 💬 WhatsApp: `fab fa-whatsapp`
- 📱 Telegram: `fab fa-telegram`
- 💬 SMS: `heroicon-o-chat-bubble-left-right`

### 3. **Colori Standard**
- Email: `text-blue-600`
- Telefono: `text-green-600`
- Cellulare: `text-purple-600`
- WhatsApp: `text-green-600`
- Telegram: `text-blue-500`
- SMS: `text-orange-600`

*Ultimo aggiornamento: 2025-01-06* 