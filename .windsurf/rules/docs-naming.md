---
trigger: always_on
description:
globs:
---
# Documentation Naming Convention Rule

## Description
All files and folders within the `docs/` directory must use lowercase characters, with the only exception being `README.md`.

## Rationale
- Ensure documentation consistency
- Improve navigation
- Cross-platform compatibility
- Maintainability

## Examples
```plaintext
# ❌ Wrong
docs/ErroriGravi/
docs/Implementazione/
docs/STANDARDS.md
docs/FormArchitecture.md

# ✅ Correct
docs/errori-gravi/
docs/implementazione/
docs/standards.md
docs/form-architecture.md
```

## Related
- [Documentation Structure](mdc:../../docs/struttura-documentazione.md)
- [Best Practices](mdc:../../docs/best-practices.md)
- [Coding Standards](mdc:../../docs/standards/coding-standards.md)

> [2025-05-28] Policy aggiornata: tutti i file e cartelle in docs/ devono essere lowercase, tranne README.md. Motivazione: coerenza, portabilità, manutenzione.

## Policy sui collegamenti
- Tutti i link nei file .md DEVONO essere sempre relativi rispetto alla posizione del file.
- Motivazione: portabilità, refactoring sicuro, navigazione autonoma del modulo.
- Logica: nessun path assoluto, nessun lock-in.
- Politica: ogni modulo è autonomo.
- Filosofia: un solo punto di verità.
- Religione: "Non avrai altro path all'infuori del relativo".
- Zen: serenità nella navigazione, nessun link rotto dopo un refactor.
