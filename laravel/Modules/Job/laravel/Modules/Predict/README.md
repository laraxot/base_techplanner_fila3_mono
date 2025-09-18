# module_predict

# Prediction Market Platform

Futurely.net è una piattaforma di Prediction Market, un sistema avanzato per la creazione e gestione di mercati predittivi automatizzati che svolgono la funzione di sondaggi. Questo progetto sfrutta un Automated Market Maker (AMM) basato sulla **Logarithmic Market Scoring Rule (LMSR)** per calcolare le probabilità di vittoria di ciascun titolo e determinare il valore delle azioni di ogni titolo all'interno del mercato.

## Come funziona

Il cuore della piattaforma è il meccanismo LMSR, che viene utilizzato per:

1. **Calcolare la probabilità di vittoria di ciascun titolo**: Il sistema LMSR permette di aggiornare dinamicamente le probabilità in base alle scommesse effettuate dagli utenti, garantendo che i prezzi delle azioni riflettano sempre la probabilità corrente.
2. **Determinare il valore delle azioni**: Il valore delle azioni di ciascun titolo è direttamente legato alle probabilità calcolate, con il LMSR che assicura una liquidità costante e un'esperienza di mercato equa, indipendentemente dal numero di partecipanti o dall'importo delle scommesse.

### LMSR (Logarithmic Market Scoring Rule)

La LMSR è una metodologia di pricing per mercati predittivi che consente di mantenere il bilancio del mercato indipendentemente dalle fluttuazioni nel volume delle transazioni. Il sistema assicura che i partecipanti possano acquistare e vendere azioni di vari titoli in qualsiasi momento, senza dover preoccuparsi delle dinamiche di domanda/offerta delle azioni.

### Proprietà chiave del LMSR:

- **Liquidità costante**: Garantisce che i partecipanti possano sempre acquistare o vendere azioni.
- **Aggiornamento dinamico delle probabilità**: Le probabilità di vittoria dei titoli vengono continuamente aggiornate in risposta alle nuove scommesse.
- **Equilibrio del mercato**: Il sistema è progettato per non andare mai in perdita, mantenendo un equilibrio automatico tra le scommesse piazzate.

### Funzione LMSR

La formula del LMSR si basa su una funzione di costo che aumenta con l'acquisto dei contratti (chiamati anche "azioni") dei vari titoli, assicurando che il prezzo di ogni contratto rifletta la probabilità attesa dell'evento associato. La funzione di costo *C* è definita come

![1725543129495](docs/image/README/1725543129495.png) 

dove:

* q = (q_1, q_2, ..., q_n) rappresenta i volumi dei contratti associati a ciascun esito possibile.
* b è il parametro di liquidità, che regola la sensibilità del prezzo ai volumi scambiati
* n è il numero di esiti possibili
* ln è il logaritmo naturale
* e è la base del logaritmo naturale

### Prezzo di un contratto (o azione)

Quando un utente decide di scomettere la propria liquidità su di un titolo, quello che sta facendo è acquistare un "contratto" (o azione) del titolo stesso. Il prezzo di un contratto associato all'esito *i*  è dato dalla derivata parziale della funzione di costo rispetto al volume del contratto *qi* :

![1725544924648](docs/image/README/1725544924648.png)


## Determinazione del titolo vincente

I mercati hanno una durata stabilita in fase di creazione del mercato stesso. La finestra temporale entro cui è possibile acquistare azioni dei titoli ha una durata strettamente minore del mercato stesso poichè se questa durasse tanto quanto il mercato le probabilità di vittoria stimate dei vari titoli sarebbe compromessa dagli acquisti e/o dalle vendite delle azioni all'ultimo minuto, ottenendo quindi percentuali inferiori al 1% per i titoli perdenti e percentuali superiori al 99% per i titoli vincenti. Al fine di garantire una stima verosimile della probabilità di vittoria dei rispettivi titoli di un mercato, sarà a discrezione del creatore del mercato stesso stabilire la data e l'ora di chiusura del mercato e della finestra temporale in cui gli utenti potranno comprare o vendere le azioni dei vari titoli.

### Criteri per la decretazione dei titoli vincenti

Nella piattaforma Futurely, i titoli vincenti all'interno di ciascun mercato vengono decretati secondo i seguenti criteri:

#### 1. Avvenimento nella Vita Reale

Un titolo viene dichiarato vincente quando un evento corrispondente si concretizza nella vita reale. Questo include, ma non è limitato a:

- **Elezioni Politiche**: Il titolo associato al candidato o al partito che vince effettivamente le elezioni sarà dichiarato vincente.
- **Eventi Sportivi**: Il titolo associato alla squadra o all'atleta che vince una competizione sportiva sarà dichiarato vincente.
- **Scoperte o raggiungimenti di specifici risultati di carattere scientifico o tecnologico**: Se un titolo è legato a una scoperta o a un'innovazione specifica, verrà dichiarato vincente se tale scoperta o innovazione si realizza nel mondo reale.

#### 2. Sondaggio

In alcuni mercati, il titolo vincente può essere decretato sulla base dei risultati di un sondaggio, che può essere condotto prima o dopo l'apertura del mercato. In questo caso:

- **Sondaggio Pre-Apertura**: Se il sondaggio viene effettuato prima dell'apertura del mercato, i risultati del sondaggio determineranno quale titolo sarà decretato vincente.
- **Sondaggio Post-Apertura**: Se il sondaggio viene effettuato dopo l'apertura del mercato, il titolo vincente sarà determinato in base ai risultati raccolti nel sondaggio successivo.

La scelta di utilizzare un sondaggio o di basare il risultato su eventi reali dipende dalla natura del mercato e dall'obiettivo specifico di previsione.
