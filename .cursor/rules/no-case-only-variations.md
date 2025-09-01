# REGOLA CRITICA: MAI classi con nomi che differiscono solo per case

## Violazione Grave Identificata
**TimeclockWidget vs TimeClockWidget** → differiscono solo per maiuscola 'C'

## REGOLA ASSOLUTA E NON NEGOZIABILE
**MAI creare multiple classi dove i nomi differiscono SOLO per maiuscole/minuscole**

### Motivazioni Critiche
1. **Confusione Sviluppatori**: Impossibile distinguere chiaramente tra classi simili
2. **Nightmare Manutenzione**: Aggiornamenti applicati alla classe sbagliata  
3. **File System Issues**: Sistemi case-insensitive creano conflitti
4. **Code Clarity**: Viola principio di naming chiaro e inequivocabile
5. **Team Collaboration**: Carico cognitivo eccessivo per tutti gli sviluppatori
6. **IDE Problems**: Auto-completion diventa inaffidabile
7. **Refactoring Dangerous**: Operazioni search/replace diventano pericolose

### Esempi VIETATI
- ❌ `TimeclockWidget` vs `TimeClockWidget`
- ❌ `userController` vs `UserController`  
- ❌ `employeeModel` vs `EmployeeModel`
- ❌ `workHour` vs `WorkHour`

### Esempi CORRETTI
- ✅ `TimeClockWidget` vs `AttendanceWidget`
- ✅ `UserController` vs `AuthController`
- ✅ `EmployeeModel` vs `DepartmentModel`
- ✅ `WorkHour` vs `BreakTime`

## Processo di Consolidamento

### 1. Identificazione
```bash
# Cercare case-only variations
find . -iname "*.php" | sort | uniq -di
```

### 2. Analisi Funzionalità
- Confrontare implementazioni
- Identificare duplicazioni
- Determinare quale nome mantenere

### 3. Consolidamento
- Scegliere il nome più appropriato (convenzioni inglesi)
- Unire funzionalità in classe singola
- Mantenere la migliore implementazione

### 4. Pulizia
- Aggiornare tutti riferimenti e import
- Rimuovere file duplicati
- Aggiornare documentazione
- Testare che non ci siano riferimenti rotti

## Prevenzione

### Checklist Pre-Commit
- [ ] Nomi classi univoci nello stesso namespace
- [ ] Nessuna case-only variation
- [ ] Nomi descrittivi e chiari
- [ ] Convenzioni inglesi rispettate

### Naming Standards
- Usare PascalCase per classi
- Nomi descrittivi e specifici
- Evitare abbreviazioni ambigue
- Seguire convenzioni Laravel/Filament

## Correzione Immediata
1. **Mantenere**: `TimeClockWidget.php` (nome più chiaro)
2. **Rimuovere**: Tutti i riferimenti a `TimeclockWidget`
3. **Aggiornare**: Documentazione per riflettere nome unificato
4. **Testare**: Tutti i riferimenti e importazioni

## Enforcement
- Controlli automatici per case-only duplicates
- Review obbligatorio di tutti class names
- Documentazione aggiornata in tutti moduli
- Training team su naming conventions

**QUESTA È UNA REGOLA FONDAMENTALE DI CODE QUALITY E MAINTAINABILITY**
