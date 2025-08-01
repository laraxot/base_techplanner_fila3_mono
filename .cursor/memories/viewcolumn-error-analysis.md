# Memoria: Errore ViewColumn - TechPlanner (2025-01-06)

## 🚨 ERRORE CRITICO IDENTIFICATO

**Errore**: `Undefined property: Closure::$phone`
**File**: `laravel/Modules/TechPlanner/resources/views/filament/tables/columns/contacts.blade.php:13`
**Causa**: ViewColumn non passa correttamente i dati alla view

## 🔍 ANALISI DEL PROBLEMA

### 1. **Implementazione Errata**
```php
// ❌ ERRATO - ViewColumn senza getStateUsing()
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
```

### 2. **Problema nella View**
```blade
{{-- ❌ ERRATO - $record è una Closure, non il modello Client --}}
@php
    if ($record->phone) { // Errore: Closure non ha proprietà phone
        $contacts[] = [...];
    }
@endphp
```

### 3. **Causa Root**
- ViewColumn di default passa una Closure alla view
- La view cerca di accedere a `$record->phone` ma `$record` è una Closure
- Manca `getStateUsing()` per passare i dati corretti

## ✅ SOLUZIONE IMPLEMENTATA

### 1. **Correzione ViewColumn**
```php
// ✅ CORRETTO - Con getStateUsing()
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    ->getStateUsing(fn ($record) => $record),
```

### 2. **Correzione View Blade**
```blade
{{-- ✅ CORRETTO - Verifica del tipo di dato --}}
@php
    $record = $state; // $state contiene il record Client
    
    $contacts = [];
    
    if ($record && $record->phone) {
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
```

## 📚 LEZIONI APPRESE

### 1. **ViewColumn Best Practices**
- **SEMPRE** usare `getStateUsing()` per passare dati corretti
- **SEMPRE** verificare il tipo di dato nella view
- **SEMPRE** testare la view separatamente

### 2. **Debugging ViewColumn**
- Usare `dd($state)` nella view per verificare i dati ricevuti
- Verificare che `$state` sia il tipo di dato atteso
- Controllare la documentazione Filament per ViewColumn

### 3. **Alternative Considerate**
- TextColumn con HTML per maggiore controllo
- ViewColumn con dati formattati per maggiore flessibilità
- Componente Livewire per logica complessa

## 🔧 IMPLEMENTAZIONE FINALE

### Opzione 1: ViewColumn Corretto
```php
'contacts' => ViewColumn::make('contacts')
    ->view('techplanner::filament.tables.columns.contacts')
    ->getStateUsing(fn ($record) => $record),
```

### Opzione 2: TextColumn con HTML (Raccomandato)
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

## 📋 CHECKLIST FUTURA

- [ ] **SEMPRE** usare `getStateUsing()` con ViewColumn
- [ ] **SEMPRE** verificare il tipo di dato nella view
- [ ] **SEMPRE** testare ViewColumn separatamente
- [ ] **SEMPRE** documentare la struttura dati attesa
- [ ] **SEMPRE** gestire casi null/empty nella view

## 🎯 REGOLE AGGIORNATE

1. **ViewColumn**: Usare sempre `getStateUsing()` per passare dati corretti
2. **View Blade**: Verificare sempre il tipo di dato ricevuto
3. **Debugging**: Usare `dd()` per verificare i dati nella view
4. **Alternative**: Considerare TextColumn con HTML per logica complessa

*Ultimo aggiornamento: 2025-01-06* 