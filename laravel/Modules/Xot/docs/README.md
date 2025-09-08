# Xot Module - Framework Base Laraxot

## Overview
Modulo base del framework Laraxot con funzionalità core e best practices.

## Quick Links
- [🏆 PHPStan Level 9 Achievement](phpstan-level9-achievement.md) - **✅ COMPLETATO** - 832→0 errori PHPStan
- [🎨 Theme Assets Workflow](theme-assets-workflow.md) - **⚠️ CRITICO** - Workflow CSS/JS per temi
- [PHPStan Array Types Fixes](phpstan-array-types-fixes.md) - **✅ COMPLETATO** - Correzioni complete tipi array
- [Filament Complete Guide](consolidated/filament-complete-guide.md)
- [PHPStan Complete Guide](consolidated/phpstan-complete-guide.md)
- [Migration Complete Guide](consolidated/migration-complete-guide.md)
- [Testing Complete Guide](consolidated/testing-complete-guide.md)
- [Translation Complete Guide](consolidated/translation-complete-guide.md)

## Architecture
- Base classes per tutti i moduli
- Service providers centralizzati
- Convenzioni e standard
- Actions per operazioni PDF e business logic

### Actions
- [GetPdfContentByRecordAction](actions/get-pdf-content-by-record-action.md) - Generazione contenuto PDF da record Eloquent
- [ContentPdfAction](archive/actions/content-pdf-action.md) - Generazione PDF da HTML/viste
- [StreamDownloadPdfAction](archive/actions/pdf-stream-download-action.md) - Download PDF diretto

## Installation
```bash
composer require laraxot/xot
```

## Configuration
Configurazione automatica tramite service providers.

## Documentation Archive
I file di documentazione originali sono stati consolidati per seguire i principi DRY + KISS.
Per accedere alla documentazione dettagliata originale, vedere il backup in:
`docs-consolidation-backup-*/Xot-docs-original/`

## Principles
- **DRY**: Un solo punto di verità
- **KISS**: Semplicità e chiarezza
- **Type Safety**: Tipizzazione rigorosa
- **Documentation**: Documentazione essenziale

## Links
<<<<<<< HEAD
- [Root Documentation](../../../project_docs/)
=======
- [Root Documentation](../../../docs/)
- [SaluteOra Module](../SaluteOra/docs/)
>>>>>>> ded3027d (.)
- [Original Documentation Backup](../../../docs-consolidation-backup-*/Xot-docs-original/)
