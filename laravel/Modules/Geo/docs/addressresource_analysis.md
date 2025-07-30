# Analisi Tecnica AddressResource - Modulo Geo

## Panoramica Generale

L'`AddressResource` è una classe Filament che gestisce l'interfaccia amministrativa per gli indirizzi nel modulo Geo. Estende `XotBaseResource` e fornisce funzionalità complete per la gestione degli indirizzi con integrazione geografica.

## Struttura della Classe

### Ereditarietà e Configurazione
```php
class AddressResource extends XotBaseResource
{
    protected static ?string $model = Address::class;
    protected static ?string $navigationGroup = "Geo";
    protected static ?int $navigationSort = 3;
}
```

### Caratteristiche Principali
- **Modello**: `Address::class`
- **Gruppo di Navigazione**: "Geo"
- **Ordine di Navigazione**: 3
- **Tipo**: Resource Filament per gestione indirizzi

## Analisi del Form Schema

### Struttura Gerarchica degli Indirizzi
Il form implementa una struttura gerarchica per gli indirizzi italiani:

1. **Regione** (`administrative_area_level_1`)
2. **Provincia** (`administrative_area_level_2`) 
3. **Località** (`locality`)
4. **CAP** (`postal_code`)
5. **Via** (`route`)
6. **Numero Civico** (`street_number`)

### Campi Principali

#### Campo Nazione
```php
"country" => Forms\Components\TextInput::make("country")
    ->maxLength(255)
    ->default("Italia")
    ->visible(false)
    ->columnSpan(2)
```
- **Default**: "Italia"
- **Visibilità**: Nascosto
- **Span**: 2 colonne

#### Selezione Regione
```php
"administrative_area_level_1" => Select::make('administrative_area_level_1')
    ->options(Region::orderBy('name')->get()->pluck("name", "id"))
    ->searchable()
    ->required()
    ->live()
    ->afterStateUpdated(function (Set $set) {
        $set("administrative_area_level_2", null);
        $set("locality", null);
        $set("postal_code", null);
        $set("cap", null);
    })
```
- **Caricamento**: Tutte le regioni ordinate per nome
- **Comportamento**: Live update con reset dei campi dipendenti
- **Validazione**: Obbligatorio

#### Selezione Provincia
```php
'administrative_area_level_2' => Select::make('administrative_area_level_2')
    ->options(function (Get $get) {
        $region = $get('administrative_area_level_1');
        if (!$region) return [];
        
        return Province::where('region_id', $region)
            ->orderBy('name')
            ->get()
            ->pluck("name", "id")
            ->toArray();
    })
    ->searchable()
    ->required()
    ->live()
    ->disabled(fn (Get $get) => !$get('administrative_area_level_1'))
```
- **Dipendenze**: Attiva solo se è selezionata una regione
- **Filtro**: Province della regione selezionata
- **Comportamento**: Live update con reset dei campi dipendenti

#### Selezione Località
```php
'locality' => Select::make('locality')
    ->options(function (Get $get) {
        $region = $get('administrative_area_level_1');
        $province = $get('administrative_area_level_2');
        if (!$region || !$province) return [];
        
        return Locality::where('region_id', $region)
            ->where('province_id', $province)
            ->orderBy('name')
            ->get()
            ->pluck("name", "id")
            ->toArray();
    })
    ->searchable()
    ->required()
    ->live()
    ->disabled(fn (Get $get) => !$get('administrative_area_level_1') || !$get('administrative_area_level_2'))
```
- **Dipendenze**: Attiva solo se sono selezionate regione e provincia
- **Filtro**: Località della provincia selezionata
- **Validazione**: Obbligatorio

#### Selezione CAP
```php
'postal_code' => Select::make('postal_code')
    ->options(function (Get $get) {
        $region = $get('administrative_area_level_1');
        $province = $get('administrative_area_level_2');
        $city = $get('locality');
        
        return Locality::query()
            ->where('region_id', $region)
            ->where('province_id', $province)
            ->when($city, fn($query) => $query->where('id', $city))
            ->select('postal_code')
            ->distinct()
            ->orderBy('postal_code')
            ->get()
            ->pluck('postal_code', 'postal_code')
            ->toArray();
    })
    ->searchable()
    ->required()
    ->live()
    ->disabled(fn (Get $get) => !$get('administrative_area_level_1') || !$get('administrative_area_level_2'))
```
- **Logica**: CAP disponibili per la località selezionata
- **Ottimizzazione**: Query con `distinct()` per evitare duplicati
- **Dipendenze**: Attiva solo se sono selezionate regione e provincia

#### Campi Indirizzo
```php
"route" => Forms\Components\TextInput::make("route")
    ->required()
    ->maxLength(255),

"street_number" => Forms\Components\TextInput::make("street_number")
    ->maxLength(20)
```
- **Via**: Campo obbligatorio per la via
- **Numero**: Campo opzionale per il numero civico

#### Campo Primario
```php
"is_primary" => Forms\Components\Toggle::make("is_primary")
    ->default(false)
```
- **Funzione**: Indica se l'indirizzo è primario
- **Default**: False

## Analisi della Tabella

### Colonne Principali
1. **Nome** (`name`): Nome dell'indirizzo
2. **Indirizzo Completo** (`full_address`): Indirizzo formattato
3. **Tipo** (`type`): Badge colorato per il tipo di indirizzo
4. **Località** (`locality`): Località dell'indirizzo
5. **Primario** (`is_primary`): Icona booleana
6. **Campi Tecnici**: `model_type`, `model_id`, `created_at`, `updated_at`

### Formattazione Tipo Indirizzo
```php
"type" => Tables\Columns\TextColumn::make("type")
    ->badge()
    ->formatStateUsing(fn(string $state): string => match ($state) {
        AddressTypeEnum::BILLING->value => "Fatturazione",
        AddressTypeEnum::SHIPPING->value => "Spedizione",
        AddressTypeEnum::HOME->value => "Casa",
        AddressTypeEnum::WORK->value => "Lavoro",
        AddressTypeEnum::OTHER->value => "Altro",
        default => $state,
    })
    ->colors([
        "primary" => fn(string $state): bool => $state === AddressTypeEnum::BILLING->value,
        "success" => fn(string $state): bool => $state === AddressTypeEnum::SHIPPING->value,
        "info" => fn(string $state): bool => $state === AddressTypeEnum::HOME->value,
        "warning" => fn(string $state): bool => $state === AddressTypeEnum::WORK->value,
        "gray" => fn(string $state): bool => $state === AddressTypeEnum::OTHER->value,
    ])
```

## Analisi dei Filtri

### Filtri Disponibili
1. **Tipo Indirizzo**: Filtro per tipo (Fatturazione, Spedizione, Casa, Lavoro, Altro)
2. **Primario**: Filtro ternario per indirizzi primari
3. **Località**: Filtro per località
4. **Provincia**: Filtro per provincia
5. **Regione**: Filtro per regione

### Logica dei Filtri
- **Filtri Dinamici**: Utilizzano query per ottenere valori distinti
- **Ottimizzazione**: Query con `distinct()` per evitare duplicati
- **Null Safety**: Controlli per valori null

## Analisi delle Azioni

### Azioni Standard
- **Edit**: Modifica dell'indirizzo
- **View**: Visualizzazione dettagliata
- **Delete**: Eliminazione dell'indirizzo

### Azione Personalizzata
```php
"setPrimary" => Tables\Actions\Action::make("setPrimary")
    ->visible(fn(Address $record): bool => !$record->is_primary)
    ->icon("heroicon-o-star")
    ->color("warning")
    ->requiresConfirmation()
    ->action(function (Address $record): void {
        // Rimuove l'attributo primario da tutti gli altri indirizzi
        Address::query()
            ->where("model_type", $record->model_type)
            ->where("model_id", $record->model_id)
            ->where("id", "!=", $record->id)
            ->update(["is_primary" => false]);

        // Imposta questo indirizzo come primario
        $record->update(["is_primary" => true]);
    })
```

**Caratteristiche**:
- **Visibilità**: Solo per indirizzi non primari
- **Icona**: Stella
- **Colore**: Warning
- **Conferma**: Richiede conferma
- **Logica**: Gestisce l'unicità dell'indirizzo primario

## Analisi del Search Step

### Metodo `getSearchStep()`
Implementa un sistema di ricerca gerarchica per indirizzi:

1. **Regione**: Selezione regione
2. **Provincia**: Selezione provincia (dipendente dalla regione)
3. **CAP**: Selezione CAP (dipendente da regione e provincia)

### Caratteristiche
- **Dipendenze**: Campi dipendenti che si aggiornano live
- **Reset**: Reset automatico dei campi dipendenti
- **Validazione**: Campi obbligatori
- **Disabilitazione**: Campi disabilitati se mancano le dipendenze

## Punti di Forza

1. **Gerarchia Completa**: Implementa correttamente la gerarchia geografica italiana
2. **Live Updates**: Aggiornamenti in tempo reale dei campi dipendenti
3. **Validazione**: Controlli appropriati per campi obbligatori
4. **UX**: Interfaccia intuitiva con campi disabilitati quando appropriato
5. **Gestione Primario**: Logica corretta per l'indirizzo primario
6. **Filtri Avanzati**: Sistema di filtri completo e ottimizzato

## Aree di Miglioramento

1. **Performance**: Query multiple per ogni campo dipendente
2. **Caching**: Mancanza di caching per i dati geografici
3. **Validazione**: Validazione lato client limitata
4. **Accessibilità**: Mancanza di attributi ARIA
5. **Internazionalizzazione**: Testi hardcoded in italiano
6. **Documentazione**: Commenti limitati per metodi complessi

## Dipendenze

### Modelli Utilizzati
- `Address`: Modello principale
- `Region`: Modello regioni
- `Province`: Modello province
- `Locality`: Modello località

### Enum Utilizzati
- `AddressTypeEnum`: Enum per i tipi di indirizzo

### Componenti Filament
- `Forms`: Componenti form
- `Tables`: Componenti tabella
- `Infolists`: Componenti info list

---

*Analisi completata il: $(date)*
*Modulo: Geo*
*Classe: AddressResource* 