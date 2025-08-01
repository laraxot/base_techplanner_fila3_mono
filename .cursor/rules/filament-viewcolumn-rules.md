# Regola: ViewColumn in Filament - Best Practices

## 🎯 Principio Fondamentale

**SEMPRE** verificare che la view riceva i dati corretti e che le variabili siano accessibili nel contesto Blade.

## ❌ Anti-Pattern da Evitare

```php
// ❌ MAI fare questo - ViewColumn senza passare i dati corretti
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    // Manca il passaggio dei dati del record
```

## ✅ Pattern Corretto

### 1. **ViewColumn con Dati Corretti**
```php
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    ->getStateUsing(function ($record) {
        return $record; // Passa il record completo alla view
    }),
```

### 2. **ViewColumn con Dati Formattati**
```php
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    ->getStateUsing(function ($record) {
        return [
            'phone' => $record->phone,
            'mobile' => $record->mobile,
            'email' => $record->email,
            'pec' => $record->pec,
            'whatsapp' => $record->whatsapp,
            'fax' => $record->fax,
        ];
    }),
```

### 3. **ViewColumn con Record Completo**
```php
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    ->getStateUsing(fn ($record) => $record),
```

## 🔧 Debugging ViewColumn

### Problema: "Undefined property: Closure::$phone"

**Causa**: La view riceve una Closure invece del modello o dei dati formattati.

**Soluzione**:
1. Usare `getStateUsing()` per passare i dati corretti
2. Verificare che la view acceda alle variabili corrette
3. Testare la view separatamente

### Verifica Dati nella View
```php
// Nella view Blade
@php
    // Debug: verificare cosa riceve la view
    dd($state); // o $record
@endphp
```

## 📋 Checklist ViewColumn

- [ ] Usare `getStateUsing()` per passare dati corretti
- [ ] Verificare che la view riceva i dati attesi
- [ ] Testare la view separatamente
- [ ] Gestire casi null/empty
- [ ] Documentare la struttura dati attesa

## 🎨 Best Practice per View Blade

### Struttura View Corretta
```blade
{{-- techplanner::filament.tables.columns.contacts --}}
@php
    // Verificare che $state sia il record o i dati formattati
    $record = $state;
    
    $contacts = [];
    
    if ($record->phone) {
        $contacts[] = [
            'type' => 'phone',
            'value' => $record->phone,
            'href' => 'tel:' . $record->phone,
            'icon' => 'heroicon-o-phone',
            'color' => 'text-blue-600 hover:text-blue-800',
            'title' => 'Telefono: ' . $record->phone
        ];
    }
@endphp

@if(empty($contacts))
    <span class="text-gray-400">Nessun contatto</span>
@else
    <div class="flex flex-wrap gap-2">
        @foreach($contacts as $contact)
            <a href="{{ $contact['href'] }}" 
               class="flex items-center {{ $contact['color'] }}"
               title="{{ $contact['title'] }}">
                <x-filament::icon 
                    :name="$contact['icon']" 
                    class="w-4 h-4 mr-1" 
                />
                {{ $contact['value'] }}
            </a>
        @endforeach
    </div>
@endif
```

## 🔄 Alternativa: TextColumn con HTML

Se ViewColumn causa problemi, usare TextColumn con HTML:

```php
'contacts' => TextColumn::make('contacts')
    ->label('Contatti')
    ->formatStateUsing(function ($record) {
        return $this->formatContacts($record);
    })
    ->html()
    ->wrap()
    ->searchable(['phone', 'email', 'pec', 'whatsapp', 'mobile', 'fax'])
    ->sortable(false),
```

## 📚 Documentazione Obbligatoria

Ogni ViewColumn deve essere documentata con:
1. Struttura dati passata alla view
2. Variabili disponibili nella view
3. Esempi di utilizzo
4. Gestione errori

*Ultimo aggiornamento: 2025-01-06* 