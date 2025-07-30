# REGOLE CRITICHE PHPSTAN

## ⚠️ REGOLA ASSOLUTA: NON TOCCARE MAI phpstan.neon

**CRITICO**: Il file `laravel/phpstan.neon` può essere modificato SOLO dall'utente, MAI dall'assistente.

### Regole da seguire SEMPRE:
1. **NON modificare mai** il file `phpstan.neon`
2. **NON aggiungere** pattern di ignore al file `phpstan.neon`
3. **NON rimuovere** pattern esistenti dal file `phpstan.neon`
4. **NON toccare** la configurazione PHPStan in alcun modo
5. **Solo l'utente** può modificare `phpstan.neon`

### Cosa fare invece:
- Risolvere i problemi di codice direttamente nel codice
- Aggiungere type hints e cast appropriati
- Correggere i namespace e le importazioni
- Modificare la logica del codice per evitare errori PHPStan
- MAI toccare la configurazione PHPStan

### Memoria permanente:
Questa regola deve essere ricordata SEMPRE e applicata in TUTTI i casi. 