# Prediction Market Use Case

## Introduzione

Un **Prediction Market** è un mercato in cui i partecipanti possono scommettere sul risultato di eventi futuri, come elezioni, risultati sportivi o trend di mercato. Questo use case descrive come il modulo `Activity` può essere utilizzato per implementare un sistema di prediction market utilizzando l'approccio di Event Sourcing in Laravel.

## Obiettivi

- Permettere agli utenti di creare mercati di previsione per eventi specifici.
- Consentire agli utenti di piazzare scommesse su possibili risultati.
- Tracciare tutte le attività relative ai mercati e alle scommesse come eventi.
- Fornire report e proiezioni in tempo reale basati sugli eventi registrati.

## Eventi Principali

1. **MarketCreated**: Registra la creazione di un nuovo mercato di previsione con dettagli come nome, descrizione, data di scadenza e possibili risultati.
2. **BetPlaced**: Registra una scommessa piazzata da un utente su un risultato specifico di un mercato.
3. **MarketResolved**: Registra la risoluzione di un mercato, indicando il risultato vincitore e distribuendo i premi agli utenti che hanno scommesso correttamente.
4. **UserBalanceUpdated**: Registra l'aggiornamento del saldo di un utente dopo la risoluzione di un mercato.

## Radice Aggregate

**PredictionMarketAggregateRoot**: Gestisce la logica di business per un mercato di previsione.

```php
namespace Modules\Activity\Aggregates;

class PredictionMarketAggregateRoot
{
    private $uuid;
    private $bets = [];
    private $status = 'open';
    
    public static function create(string $uuid, string $name, string $description, array $outcomes, string $expiryDate): self
    {
        $aggregate = new self();
        $aggregate->recordThat(new MarketCreated($uuid, $name, $description, $outcomes, $expiryDate));
        return $aggregate;
    }
    
    public function placeBet(string $userId, string $outcome, float $amount)
    {
        if ($this->status !== 'open') {
            throw new \Exception('Cannot place bet on a closed market');
        }
        $this->recordThat(new BetPlaced($this->uuid, $userId, $outcome, $amount));
    }
    
    public function resolve(string $winningOutcome)
    {
        $this->status = 'resolved';
        $this->recordThat(new MarketResolved($this->uuid, $winningOutcome));
        // Logica per calcolare e distribuire i premi
        foreach ($this->bets as $bet) {
            if ($bet['outcome'] === $winningOutcome) {
                // Calcola premio
                $prize = $bet['amount'] * 2; // Esempio semplificato
                $this->recordThat(new UserBalanceUpdated($bet['userId'], $prize));
            }
        }
    }
    
    protected function applyMarketCreated(MarketCreated $event)
    {
        $this->uuid = $event->uuid;
    }
    
    protected function applyBetPlaced(BetPlaced $event)
    {
        $this->bets[] = ['userId' => $event->userId, 'outcome' => $event->outcome, 'amount' => $event->amount];
    }
    
    private function recordThat($event)
    {
        // Logica per registrare l'evento
    }
}
```

## Proiettori

1. **MarketSummaryProjector**: Aggiorna una vista di lettura con il riassunto di ogni mercato, inclusi il numero di scommesse e l'importo totale scommesso.
2. **UserBetHistoryProjector**: Registra la cronologia delle scommesse di ogni utente per report personalizzati.
3. **MarketOutcomeProjector**: Aggiorna i risultati finali dei mercati risolti.

**Esempio di Proiettore**:
```php
namespace Modules\Activity\Projectors;

class MarketSummaryProjector
{
    public function onMarketCreated(MarketCreated $event, string $uuid)
    {
        $summary = MarketSummary::findOrCreate($uuid);
        $summary->name = $event->name;
        $summary->description = $event->description;
        $summary->outcomes = $event->outcomes;
        $summary->expiry_date = $event->expiryDate;
        $summary->total_bets = 0;
        $summary->total_amount = 0;
        $summary->save();
    }
    
    public function onBetPlaced(BetPlaced $event, string $uuid)
    {
        $summary = MarketSummary::findOrCreate($uuid);
        $summary->increment('total_bets');
        $summary->total_amount += $event->amount;
        $summary->save();
    }
    
    public function onMarketResolved(MarketResolved $event, string $uuid)
    {
        $summary = MarketSummary::findOrCreate($uuid);
        $summary->winning_outcome = $event->winningOutcome;
        $summary->status = 'resolved';
        $summary->save();
    }
}
```

## Flusso Operativo

1. **Creazione del Mercato**: Un amministratore crea un mercato di previsione specificando i dettagli e i possibili risultati.
   - Evento generato: `MarketCreated`
2. **Piazzamento Scommesse**: Gli utenti piazzano scommesse sui risultati che ritengono più probabili.
   - Evento generato: `BetPlaced`
3. **Risoluzione del Mercato**: Una volta che l'evento reale si verifica, il mercato viene risolto e i premi vengono distribuiti.
   - Eventi generati: `MarketResolved`, `UserBalanceUpdated`
4. **Report e Analisi**: I proiettori aggiornano viste di lettura per mostrare lo stato attuale dei mercati, la cronologia delle scommesse degli utenti e i risultati finali.

## Benefici dell'Event Sourcing

- **Tracciabilità**: Ogni azione (creazione mercato, scommessa, risoluzione) è registrata come evento, fornendo un audit trail completo.
- **Flessibilità**: Nuove funzionalità, come analisi predittive o report avanzati, possono essere aggiunte rigiocando gli eventi su nuovi proiettori.
- **Coerenza**: La radice aggregate garantisce che le scommesse non siano piazzate su mercati chiusi o scaduti.

## Consigli per l'Implementazione

1. **Validazione**: Assicurarsi che le scommesse siano validate (es. saldo utente sufficiente) prima di registrare l'evento `BetPlaced`.
2. **Snapshotting**: Implementare snapshot per i mercati con molte scommesse per migliorare le performance.
3. **Versionamento**: Preparare un sistema di migrazione per eventi come `BetPlaced` in caso di cambiamenti nei dati richiesti.
4. **Testing**: Creare factory di test per eventi e testare ogni proiettore separatamente per garantire idempotenza.

## Conclusione

Implementare un prediction market nel modulo `Activity` utilizzando l'Event Sourcing permette di gestire in modo efficace la complessità di mercati e scommesse, garantendo tracciabilità e flessibilità per future espansioni. Seguendo i pattern descritti, è possibile creare un sistema robusto e scalabile per mercati di previsione.
