# REGOLA CRITICA: SOLO INGLESE per nomi classi/file/metodi

## Violazione Grave Identificata
**TimbratureWidget** → parola italiana "Timbrature" usata nel nome classe

## REGOLA ASSOLUTA E NON NEGOZIABILE
**MAI USARE PAROLE ITALIANE NEI NOMI DI:**

### Codice PHP
- ❌ Classi: `TimbratureWidget`, `DipendenteResource`
- ✅ Classi: `TimeClockWidget`, `EmployeeResource`
- ❌ Metodi: `getCronologiaTimbrature()`, `calcolaOreLavorate()`
- ✅ Metodi: `getTimeEntries()`, `calculateWorkHours()`
- ❌ Proprietà: `$timbrature`, `$oraCorrente`
- ✅ Proprietà: `$timeEntries`, `$currentTime`

### Database
- ❌ Tabelle: `timbrature`, `dipendenti`, `reparti`
- ✅ Tabelle: `time_entries`, `employees`, `departments`
- ❌ Colonne: `data_timbratura`, `ora_ingresso`
- ✅ Colonne: `timestamp`, `clock_in_time`

### File e Directory
- ❌ File: `TimbratureWidget.php`, `gestione-dipendenti.blade.php`
- ✅ File: `TimeClockWidget.php`, `employee-management.blade.php`
- ❌ Directory: `Timbrature/`, `Gestione/`
- ✅ Directory: `TimeClock/`, `Management/`

## ECCEZIONI CONSENTITE (SOLO)
- File di traduzione in `lang/it/` e `lang/en/`
- Commenti PHP per spiegazioni in italiano
- Testi utente nelle view Blade
- Come ultima spiaggia quando non esiste alternativa inglese

## NAMING PATTERNS APPROVATI
### Time Management
- `TimeClock`, `TimeTracker`, `WorkHour`, `TimeEntry`
- `ClockIn`, `ClockOut`, `BreakStart`, `BreakEnd`

### Employee Management
- `Employee`, `Department`, `Position`, `Schedule`
- `Attendance`, `Leave`, `Vacation`, `Overtime`

### UI Components
- `Dashboard`, `Overview`, `Stats`, `Report`
- `Widget`, `Resource`, `Page`, `Action`
- `Create`, `Edit`, `List`, `View`, `Delete`

## PREVENZIONE
1. **Pensare prima in inglese** quando si creano nomi
2. **Consultare documentazione Laravel/Filament** (sempre in inglese)
3. **Usare dizionari tecnici inglesi** per terminologia corretta
4. **Verificare naming conventions** nei moduli esistenti
5. **Rivedere nomi prima di commit** - checklist obbligatoria

## CORREZIONE IMMEDIATA
- `TimbratureWidget` → `TimeClockWidget`
- `timbrature-widget.blade.php` → `time-clock-widget.blade.php`
- Aggiornare tutti i riferimenti e documentazione

## IMPORTANZA CRITICA
Questa regola garantisce:
- **Coerenza internazionale** del codice
- **Manutenibilità** del progetto  
- **Compatibilità** con standard Laravel/Filament
- **Collaborazione** con sviluppatori internazionali
- **Rispetto filosofia Laraxot**

## CHECKLIST PRE-COMMIT
- [ ] Nomi classi in inglese
- [ ] Nomi file in inglese  
- [ ] Nomi metodi in inglese
- [ ] Nomi proprietà in inglese
- [ ] Nomi tabelle/colonne in inglese
- [ ] Namespace in inglese
- [ ] Nessuna parola italiana nel codice (eccetto eccezioni)

**QUESTA REGOLA È ASSOLUTA E NON NEGOZIABILE**
