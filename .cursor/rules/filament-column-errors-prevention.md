# Regola: Prevenzione Errori Colonne Filament - CRITICA

## 🚨 ERRORI CRITICI DA MAI FARE

### 1. **ERRORE CRITICO: HTML Hardcoded**
```php
// ❌ MAI fare questo - HTML hardcoded
protected static function getContactTypeIcon(string $contactType): string
{
    return match ($contactType) {
        'email' => '<i class="heroicon-o-envelope w-4 h-4 inline mr-1" title="Email"></i>',
        // ERRORE: Usa HTML hardcoded invece di componenti Filament
    };
}
```

**✅ CORRETTO: Usare componenti Filament**
```php
// ✅ CORRETTO - Usare componenti Filament
protected static function getContactTypeIcon(string $contactType): string
{
    return match ($contactType) {
        'email' => '<x-filament::icon name="heroicon-o-envelope" class="w-4 h-4 inline mr-1" />',
        // CORRETTO: Usa componenti Filament
    };
}
```

### 2. **ERRORE CRITICO: Stringhe Hardcoded**
```php
// ❌ MAI fare questo - Stringhe hardcoded
return parent::make($name)
    ->label('Contatto')  // ERRORE: hardcoded
    ->formatStateUsing(function ($record): string {
        return 'Nessun contatto';  // ERRORE: hardcoded
    });
```

**✅ CORRETTO: Usare traduzioni**
```php
// ✅ CORRETTO - Usare traduzioni
return parent::make($name)
    ->label(__('notify::columns.contact.label'))
    ->formatStateUsing(function ($record): string {
        return __('notify::columns.contact.empty_state');
    });
```

### 3. **ERRORE CRITICO: Parametri sbagliati in formatStateUsing**
```php
// ❌ MAI fare questo - Parametro sbagliato
->formatStateUsing(function (Contact $record): string {
    // ERRORE: formatStateUsing riceve il valore della colonna, NON il record
    return static::formatContact($record);
})
```

**✅ CORRETTO: Usare getStateUsing per il record**
```php
// ✅ CORRETTO - Usare getStateUsing per il record
->getStateUsing(function ($record): Contact {
    return $record;
})
->formatStateUsing(function ($value): string {
    return static::formatContact($value);
})
```

### 4. **ERRORE CRITICO: View non necessaria con formatStateUsing**
```php
// ❌ MAI fare questo - View non necessaria
protected string $view = 'notify::filament.tables.columns.contact';

public static function make(string $name = 'contact'): static
{
    return parent::make($name)
        ->formatStateUsing(function ($record): string {
            // ERRORE: Se usi formatStateUsing, non serve la view
        });
}
```

**✅ CORRETTO: Scegliere tra view O formatStateUsing**
```php
// ✅ CORRETTO - Solo formatStateUsing
public static function make(string $name = 'contact'): static
{
    return parent::make($name)
        ->formatStateUsing(function ($value): string {
            return static::formatContact($value);
        });
}

// ✅ CORRETTO - Solo view
protected string $view = 'notify::filament.tables.columns.contact';

public static function make(string $name = 'contact'): static
{
    return parent::make($name);
}
```

### 5. **ERRORE CRITICO: Tooltip con parametro sbagliato**
```php
// ❌ MAI fare questo - Tooltip con parametro sbagliato
->tooltip(fn (Contact $record): string => static::getContactTooltip($record));
```

**✅ CORRETTO: Tooltip con valore della colonna**
```php
// ✅ CORRETTO - Tooltip con valore della colonna
->tooltip(fn ($value): string => static::getContactTooltip($value));
```

## 🎯 PATTERN CORRETTO PER COLONNE PERSONALIZZATE

### 1. **Colonna con formatStateUsing (SENZA view)**
```php
<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Modules\Notify\Models\Contact;

class ContactColumn extends TextColumn
{
    public static function make(string $name = 'contact'): static
    {
        return parent::make($name)
            ->label(__('notify::columns.contact.label'))
            ->getStateUsing(function ($record): Contact {
                return $record;
            })
            ->formatStateUsing(function (Contact $contact): string {
                return static::formatContact($contact);
            })
            ->html()
            ->wrap()
            ->searchable(['contact_type', 'value', 'email', 'mobile_phone', 'first_name', 'last_name'])
            ->sortable(['contact_type', 'value', 'created_at'])
            ->tooltip(fn (Contact $contact): string => static::getContactTooltip($contact));
    }

    protected static function formatContact(Contact $contact): string
    {
        $contactInfo = [];
        
        // Nome completo
        if ($contact->first_name || $contact->last_name) {
            $fullName = trim($contact->first_name . ' ' . $contact->last_name);
            if ($fullName) {
                $contactInfo[] = '<span class="font-medium text-gray-900">' . $fullName . '</span>';
            }
        }
        
        // Tipo di contatto con icona
        $contactType = $contact->contact_type ?? 'unknown';
        $value = $contact->value ?? $contact->email ?? $contact->mobile_phone ?? '';
        
        if ($value) {
            $icon = static::getContactTypeIcon($contactType);
            $color = static::getContactTypeColor($contactType);
            $contactInfo[] = '<span class="flex items-center ' . $color . '">' . $icon . ' ' . $value . '</span>';
        }
        
        // Stato di verifica
        if ($contact->verified_at) {
            $contactInfo[] = '<span class="text-green-600 text-xs">✓ ' . __('notify::columns.contact.verified') . '</span>';
        }
        
        // Statistiche
        $stats = [];
        if ($contact->sms_count > 0) {
            $stats[] = '<span class="text-blue-600 text-xs">📱 ' . $contact->sms_count . ' ' . __('notify::columns.contact.sms') . '</span>';
        }
        if ($contact->mail_count > 0) {
            $stats[] = '<span class="text-green-600 text-xs">📧 ' . $contact->mail_count . ' ' . __('notify::columns.contact.email') . '</span>';
        }
        
        if (!empty($stats)) {
            $contactInfo[] = '<div class="flex gap-2 mt-1">' . implode('', $stats) . '</div>';
        }
        
        return empty($contactInfo) 
            ? '<span class="text-gray-400">' . __('notify::columns.contact.empty_state') . '</span>' 
            : implode('<br class="my-1">', $contactInfo);
    }

    protected static function getContactTypeIcon(string $contactType): string
    {
        return match ($contactType) {
            'email' => '<x-filament::icon name="heroicon-o-envelope" class="w-4 h-4 inline mr-1" />',
            'phone', 'mobile' => '<x-filament::icon name="heroicon-o-phone" class="w-4 h-4 inline mr-1" />',
            'mobile_phone' => '<x-filament::icon name="heroicon-o-device-phone-mobile" class="w-4 h-4 inline mr-1" />',
            'whatsapp' => '<x-filament::icon name="fab fa-whatsapp" class="w-4 h-4 inline mr-1" />',
            'telegram' => '<x-filament::icon name="fab fa-telegram" class="w-4 h-4 inline mr-1" />',
            'sms' => '<x-filament::icon name="heroicon-o-chat-bubble-left-right" class="w-4 h-4 inline mr-1" />',
            default => '<x-filament::icon name="heroicon-o-user" class="w-4 h-4 inline mr-1" />',
        };
    }

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

    protected static function getContactTooltip(Contact $contact): string
    {
        $tooltip = [];
        
        if ($contact->contact_type) {
            $tooltip[] = __('notify::columns.contact.tooltip.type') . ': ' . ucfirst($contact->contact_type);
        }
        
        if ($contact->verified_at) {
            $tooltip[] = __('notify::columns.contact.tooltip.verified') . ': ' . $contact->verified_at->format('d/m/Y H:i');
        }
        
        if ($contact->sms_count > 0) {
            $tooltip[] = __('notify::columns.contact.tooltip.sms_sent') . ': ' . $contact->sms_count;
        }
        
        if ($contact->mail_count > 0) {
            $tooltip[] = __('notify::columns.contact.tooltip.email_sent') . ': ' . $contact->mail_count;
        }
        
        return implode(' | ', $tooltip);
    }
}
```

### 2. **Colonna con view (SENZA formatStateUsing)**
```php
<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class ContactColumn extends TextColumn
{
    protected string $view = 'notify::filament.tables.columns.contact';

    public static function make(string $name = 'contact'): static
    {
        return parent::make($name)
            ->label(__('notify::columns.contact.label'))
            ->searchable(['contact_type', 'value', 'email', 'mobile_phone', 'first_name', 'last_name'])
            ->sortable(['contact_type', 'value', 'created_at']);
    }
}
```

## 📋 CHECKLIST PREVENZIONE ERRORI

- [ ] **MAI** usare HTML hardcoded, sempre componenti Filament
- [ ] **MAI** usare stringhe hardcoded, sempre traduzioni
- [ ] **MAI** confondere formatStateUsing con getStateUsing
- [ ] **MAI** usare view E formatStateUsing insieme
- [ ] **MAI** passare record completo a formatStateUsing
- [ ] **SEMPRE** usare getStateUsing per ottenere il record
- [ ] **SEMPRE** usare traduzioni per tutte le stringhe
- [ ] **SEMPRE** usare componenti Filament per le icone

## 🎯 REGOLE SPECIFICHE

### 1. **Componenti Filament**
- **SEMPRE** usare `<x-filament::icon>` invece di `<i>`
- **SEMPRE** usare `<x-filament::badge>` per badge
- **SEMPRE** usare `<x-filament::button>` per pulsanti

### 2. **Traduzioni**
- **SEMPRE** usare `__('modulo::chiave')` per traduzioni
- **SEMPRE** creare file di traduzione per le colonne
- **SEMPRE** usare chiavi descrittive

### 3. **Parametri Metodi**
- **formatStateUsing**: riceve il valore della colonna
- **getStateUsing**: riceve il record completo
- **tooltip**: riceve il valore della colonna

*Ultimo aggiornamento: 2025-01-06* 