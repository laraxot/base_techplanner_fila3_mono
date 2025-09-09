---
trigger: always_on
description: 
globs: 
---
# Regola Cursor – Integrazione Filament FullCalendar e ServiceProvider di Modulo

## Ambito
- Globale (UI, root, automazione, azioni custom, ServiceProvider)

## Motivazione
- Garantire una integrazione coerente, tipizzata e documentata di FullCalendar e dei ServiceProvider di modulo, evitando duplicazioni e anti-pattern.

## Regola
- Documentare sempre l'integrazione sia in `Modules/UI/docs/full_calendar.md` che in `docs/full_calendar.md`.
- Usare solo esempi tipizzati, validati e con PHPDoc.
- Aggiornare le regole .mdc e la documentazione ad ogni variazione.
- Nei ServiceProvider di modulo:
  - Usare sempre il namespace corretto
  - Caricare views, translations, migrations con path relativi e namespace coerente
  - Registrare asset SVG e icone solo tramite helper Filament
  - Separare correttamente boot/register
  - Non inserire logica custom in register se non necessaria

## Esempio pratico
```php
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(fn (Event $event) => [
                'title' => $event->name,
                'start' => $event->starts_at,
                'end' => $event->ends_at,
            ])->all();
    }
}
```

## Pattern e Anti-pattern identificati
### Pattern
- Utilizzo di tipi espliciti e PHPDoc in tutti i metodi
- Uso di EventData per tipizzazione avanzata
- Collegamenti bidirezionali tra docs di modulo e root
- Path relativi e namespace coerente per views/lang/migrations/svg
- Registrazione asset/icone solo tramite helper Filament
- Separazione netta tra boot/register

### Anti-pattern
- Duplicazione della logica di fetchEvents in più widget
- Azioni senza validazione o policy
- Stringhe hardcoded per label/tooltip
- Gestione errori JS assente o superficiale
- Uso del namespace `App\Filament` invece di `Modules<NomeModulo>\Filament`
- Utilizzo di ->label() invece dei file di traduzione
- Path assoluti o errati nei metodi di caricamento
- Namespace errato (es. App\ o mancante)
- Registrazione asset custom fuori da FilamentAsset/FilamentIcon
- Logica custom in register senza necessità
- Mancanza di PHPDoc
- Caricamento asset SVG senza namespace

## Errori comuni nei ServiceProvider di modulo
- `loadViewsFrom` o `loadTranslationsFrom` con path errato o namespace non coerente
- Asset SVG non registrati o non namespaced
- Confusione tra boot e register (logica di bootstrap in register)
- Namespace errato nella dichiarazione della classe
- Mancanza di test di regressione su asset/icona custom

## Contesto bugfix
- **Versione**: [es. Laravel 10.x, Filament 3.x]
- **Ambiente**: [es. produzione, staging, locale]
- **Condizioni di trigger**: [es. icona non visibile, asset non caricato, errore su loadViews]
- **Dipendenze/configurazioni**: [es. aggiornamento richiesto di Filament, path asset cambiato]

## Checklist operativa aggiornata
- [ ] Analizza la causa e il contesto dell'errore
- [ ] Aggiorna la doc del modulo più vicino (esclusa la root)
- [ ] Crea/aggiorna collegamenti bidirezionali con la root
- [ ] Aggiorna le regole .mdc (cursor/windsurf)
- [ ] Documenta pattern e anti-pattern
- [ ] Implementa la correzione (namespace, path, asset, tipizzazione)
- [ ] Scrivi test di regressione
- [ ] Verifica impatti su moduli interconnessi
- [ ] Registra il contesto bugfix e aggiorna le memorie

## Best Practice
- Usare tipi espliciti e PHPDoc
- Validare i dati in fetchEvents
- Gestire i permessi con le policy Filament
- Documentare ogni personalizzazione

## Collegamenti
- [Modules/UI/docs/full_calendar.md](mdc:../../Modules/UI/docs/full_calendar.md)
- [docs/full_calendar.md](mdc:../../docs/full_calendar.md)
- [../windsurf/rules/full_calendar.mdc](mdc:../../.windsurf/rules/full_calendar.mdc)
- [Modules/Xot/docs/SERVICE_PROVIDER.md](mdc:../../Modules/Xot/docs/SERVICE_PROVIDER.md)

## Ultimo aggiornamento
2025-06-04
