# Neutralità della Documentazione dei Moduli

## Principio Fondamentale

La documentazione dei moduli deve essere neutra e riutilizzabile, senza riferimenti specifici al progetto corrente.

## Regole Specifiche

### 1. Evitare Riferimenti a Brand/Progetti Specifici

- **NO**: "Il modulo Patient gestisce tutte le informazioni relative ai pazienti e ai medici in ."
- **SÌ**: "Il modulo Patient gestisce tutte le informazioni relative ai pazienti e ai medici nel sistema."

### 2. Utilizzare Termini Generici

- **NO**: "Questa funzionalità è utilizzata nella clinica  per gestire le prenotazioni."
- **SÌ**: "Questa funzionalità è utilizzata per gestire le prenotazioni delle visite."

### 3. Mantenere Esempi Tecnici

- Gli esempi di codice devono essere mantenuti tecnici e focalizzati sulla funzionalità
- Evitare di includere nomi di dominio, URL o altri identificatori specifici del progetto

### 4. Separare Documentazione Specifica del Progetto

- La documentazione specifica del progetto deve essere mantenuta nella directory root `/docs`
- I riferimenti specifici al progetto vanno gestiti solo nella documentazione root, mai nei singoli moduli

## Motivazioni

### Perché la Neutralità è Importante

1. **Riutilizzabilità**: I moduli sono progettati per essere riutilizzati in diversi progetti
2. **Manutenibilità**: Una documentazione neutra è più facile da mantenere e aggiornare
3. **Best Practice Open Source**: Facilita la condivisione e il riutilizzo del codice
4. **Chiarezza**: Concentrarsi sulla funzionalità tecnica migliora la comprensione

## Esempi Pratici

### Documentazione di un Modello

#### Esempio Errato
```markdown
# Modello Doctor

Il modello `Doctor` rappresenta un medico nel sistema  e implementa il pattern Single Table Inheritance (STI).
```

#### Esempio Corretto
```markdown
# Modello Doctor

Il modello `Doctor` rappresenta un medico nel sistema e implementa il pattern Single Table Inheritance (STI).
```

### Documentazione di un Processo

#### Esempio Errato
```markdown
# Processo di Registrazione dei Dottori

Nel sistema , l'invio dell'email al dottore con il link per continuare la registrazione è un passaggio cruciale.
```

#### Esempio Corretto
```markdown
# Processo di Registrazione dei Dottori

L'invio dell'email al dottore con il link per continuare la registrazione è un passaggio cruciale nel processo.
```

## Applicazione

Questa regola si applica a:

- README.md dei moduli
- Documentazione dei modelli
- Documentazione dei processi
- Documentazione delle API
- Documentazione delle configurazioni
- Tutti i file markdown nella directory `/Modules/*/docs`
