# Module Comment

Modulo dedicato alla gestione dei commenti

## Aggiungere Modulo nella base del progetto

Dentro la cartella laravel/Modules

```bash
git submodule add https://github.com/laraxot/module_comment_fila3.git Comment
```
Verrà creata la cartella Comment con dentro tutto il contenuto del modulo.

## Verificare che il modulo sia attivo

```bash
php artisan module:list
```

in caso abilitarlo

```bash
php artisan module:enable Comment
```

## Eseguire le migrazioni

```bash
php artisan module:migrate Comment
```

## Inserire le dipendenze

Per installare correttamente il modulo Comment è necessario installare le dipendenze dei 3 seguenti moduli:

- [UI](https://github.com/laraxot/module_ui_fila3/blob/dev/README.md)
- [Xot](https://github.com/laraxot/module_xot_fila3/blob/dev/README.md)
- [Tenant](https://github.com/laraxot/module_tenant_fila3/blob/dev/README.md)
- 

Leggere ed eseguire correttamente le istruzioni all'interno dei file README.md di ciascuno di questi moduli

## Configurazione comments.php

Dopo aver installato il modulo, eseguire dentro la cartella laravel, il comando 

```bash
php -d memory_limit=-1 composer.phar update -W
```

e in seguito

```bash
php artisan vendor:publish --tag="comments-config"
```
che creerà il file laravel\config\comments.php

...quali modelli bisogna sostituire?
...bisogna modificare il file principale dentro laravel\config oppure anche/solo i file dentro le configurazioni di dominio?
