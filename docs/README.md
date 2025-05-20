# Documentation Guidelines

This directory (`docs`) serves as the primary documentation repository for the project. All team members should follow these guidelines:

## Core Principles

1. **Single Source of Truth**: This `docs` directory is the main repository for all project documentation.
2. **Continuous Updates**: Documentation must be updated whenever:
   - Code changes are made
   - Issues are resolved
   - New features are implemented
   - Bug fixes are applied

## Best Practices

1. **Pre-Change Check**: Before making any changes to the codebase:
   - Review relevant documentation in this directory
   - Avoid duplicating existing information
   - Identify potential impacts on existing documentation

2. **Regular Review**:
   - Periodically review documentation for accuracy
   - Update outdated information
   - Identify areas needing more detailed documentation

3. **Documentation Structure**:
   - Keep documentation organized and easy to navigate
   - Use clear, consistent formatting
   - Include examples where appropriate
   - Link related documents together

## Current Documentation

The following documentation is currently available:
- `documentation_script_readme.md`: Script documentation
- `documentation_strategy.md`: Documentation strategy
- `form_schema_audit.md`: Form schema auditing
- `laraxot.md`: Laraxot framework documentation
- `module_geo.md`: Geographic module documentation
- `project.md`: Project overview
- `widget.md`: Widget documentation

## Contributing

When contributing to documentation:
1. Use clear and concise language
2. Include relevant code examples
3. Update the table of contents if necessary
4. Cross-reference related documentation
5. Commit documentation changes along with code changes

## [Aggiornamento 2024-06-10] Collegamento Tema One

- Vedi [laravel/Themes/One/docs/README.md](../laravel/Themes/One/docs/README.md) per dettagli sulle scelte architetturali e funzionali adottate nella risoluzione dei conflitti composer.json, package.json, tailwind.config.js e vite.config.js.
- Le scelte seguono le [merge_conflict_resolution.md](./merge_conflict_resolution.md).

# Documentazione del Progetto

## 📚 Indice

- [Architettura](architecture.md)
- [Installazione](installation.md)
- [Configurazione](configuration.md)
- [Sviluppo](development.md)
- [Deployment](deployment.md)
- [Manutenzione](maintenance.md)
- [Troubleshooting](troubleshooting.md)
- [FAQ](faq.md)
- [Changelog](changelog.md)
- [Contributing](contributing.md)
- [Licenza](license.md)

## 🎨 Temi

- [Tema One](laravel/Themes/One/README.md) - Tema frontend moderno e riusabile basato su Filament 3.x

## 🔄 Risoluzione Conflitti

Durante la risoluzione dei conflitti sono state prese le seguenti decisioni architetturali:

1. **Standardizzazione dei nomi dei pacchetti**:
   - Utilizzo del namespace `laraxot` per i pacchetti generici
   - Nomi dei pacchetti in formato snake_case (es. `theme_one_fila3`)

2. **Configurazione Vite**:
   - Mantenimento della configurazione base di Vite
   - Aggiunta di alias per i componenti del tema
   - Supporto per TypeScript e PostCSS

3. **Documentazione**:
   - Mantenimento della documentazione generica per progetti multipli
   - Aggiunta di riferimenti incrociati tra documentazioni
   - Standardizzazione del formato Markdown

4. **Dipendenze**:
   - Allineamento con i requisiti di Filament 3.x
   - Utilizzo di versioni specifiche per evitare incompatibilità
   - Documentazione chiara delle dipendenze obbligatorie

Per maggiori dettagli sulla risoluzione dei conflitti, consulta i file di configurazione e la documentazione specifica di ogni componente.
