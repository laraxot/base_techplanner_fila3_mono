# Struttura dei Temi in il progetto

## Percorso Base
Tutti i temi DEVONO essere posizionati nella cartella:
```
/var/www/html/base_saluteora/laravel/Themes/
```

## Struttura Standard
```
laravel/
└── Themes/
    └── {ThemeName}/
        ├── resources/
        │   ├── views/
        │   │   ├── layouts/
        │   │   ├── components/
        │   │   └── pages/
        │   ├── css/
        │   └── js/
        ├── config/
        ├── routes/
        └── composer.json
```

## Errore Comune: Posizionamento Errato
❌ Percorso ERRATO:
```
/var/www/html/base_saluteora/Themes/
```

✅ Percorso CORRETTO:
```
/var/www/html/base_saluteora/laravel/Themes/
```

### Motivo dell'Errore
1. La directory `laravel/` è il contenitore principale per tutti i componenti dell'applicazione
2. I temi sono parte integrante dell'applicazione Laravel
3. Devono essere posizionati insieme agli altri componenti Laravel

### Impatto dell'Errore
- Problemi di caricamento delle viste
- Errori nei percorsi dei file
- Malfunzionamento del sistema di temi
- Problemi con gli asset

## Best Practices

### 1. Struttura Directory
- Mantenere tutti i componenti Laravel nella cartella `laravel/`
- Seguire la struttura standard dei temi
- Utilizzare nomi descrittivi per i temi

### 2. Organizzazione File
- Separare viste, assets e configurazioni
- Mantenere una struttura coerente tra i temi
- Utilizzare sottocartelle logiche

### 3. Convenzioni di Naming
- Usare PascalCase per i nomi dei temi
- Usare kebab-case per i file
- Mantenere coerenza nei nomi

## Collegamenti Bidirezionali
- [Struttura Moduli](../../../docs/architecture/modules-structure.md)
- [Gestione Temi](theme-management.md)
- [Configurazione Temi](theme-configuration.md)

## Vedi Anche
- [Documentazione Principale](../../../docs/INDEX.md)
- [Standard di Codice](../../../docs/standards/coding-standards.md)
- [Best Practices](../../../docs/standards/best-practices.md) 
## Collegamenti tra versioni di theme-structure.md
* [theme-structure.md](../../../Themes/One/docs/theme-structure.md)

