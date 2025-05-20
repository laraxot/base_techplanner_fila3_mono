# Rapporto PHPStan Livello 3 per il modulo Cms

Data analisi: 2025-04-15 22:09:22

## Riepilogo

Trovati 6 errori al livello 3.

## Errori e suggerimenti

### File: `/var/www/html/saluteora/laravel/Modules/Cms/app/Filament/Resources/PageContentResource/Pages/ListPageContents.php`

#### Linea 39: Method Modules\Cms\Filament\Resources\PageContentResource\Pages\ListPageContents::getListTableColumns() should return array<string, Filament\Tables\Columns\Column> but returns array<int, Filament\Tables\Columns\TextColumn>.

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

#### Linea 57: Method Modules\Cms\Filament\Resources\PageContentResource\Pages\ListPageContents::getTableActions() should return array<string, Filament\Tables\Actions\Action

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

#### Linea 70: Method Modules\Cms\Filament\Resources\PageContentResource\Pages\ListPageContents::getTableBulkActions() should return array<string, Filament\Tables\Actions\BulkAction> but returns array<int, Filament\Tables\Actions\DeleteBulkAction>.

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

### File: `/var/www/html/saluteora/laravel/Modules/Cms/app/Filament/Resources/PageResource/Pages/ListPages.php`

#### Linea 87: Method Modules\Cms\Filament\Resources\PageResource\Pages\ListPages::getTableActions() should return array<string, Filament\Tables\Actions\Action

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

#### Linea 100: Method Modules\Cms\Filament\Resources\PageResource\Pages\ListPages::getTableBulkActions() should return array<string, Filament\Tables\Actions\BulkAction> but returns array<int, Filament\Tables\Actions\DeleteBulkAction>.

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

### File: `/var/www/html/saluteora/laravel/Modules/Cms/app/Models/Menu.php`

#### Linea 160: PHPDoc tag @var with type class-string<Modules\Xot\Contracts\HasRecursiveRelationshipsContract> is not subtype of native type 'Modules\\Cms\\Models\\Menu'.

**Suggerimento generale**: Rivedi il codice per assicurarti che:
- Tutte le classi/interfacce utilizzate siano importate correttamente
- I tipi siano dichiarati e utilizzati in modo coerente
- Le variabili siano inizializzate prima dell'uso
- I nomi di metodi e proprietà siano corretti

## Risorse utili

- [Documentazione PHPStan](https://phpstan.org/user-guide/getting-started)
- [Tipi in PHP](https://www.php.net/manual/en/language.types.declarations.php)
- [PSR-12: Standard di codifica](https://www.php-fig.org/psr/psr-12/)

## Collegamenti tra versioni di level_3.md
* [level_3.md](laravel/Modules/Chart/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Reporting/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Gdpr/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Notify/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Xot/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Dental/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/User/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/UI/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Lang/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Job/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Media/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Tenant/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Activity/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Patient/docs/phpstan/level_3.md)
* [level_3.md](laravel/Modules/Cms/docs/phpstan/level_3.md)

