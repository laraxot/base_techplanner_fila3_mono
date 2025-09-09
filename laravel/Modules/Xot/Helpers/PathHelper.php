<?php

declare(strict_types=1);

namespace Modules\Xot\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Helper per la gestione dei percorsi nel progetto TechPlanner.
 */
class PathHelper
{
    /**
     * Percorso base del progetto.
     */
    public static string $projectBasePath = '/var/www/html/_bases/base_techplanner_fila3_mono';

    /**
     * Percorso base di Laravel.
     */
    public static string $laravelBasePath = '/var/www/html/_bases/base_techplanner_fila3_mono/laravel';

    /**
     * Percorso base dei moduli.
     */
    public static string $modulesBasePath = '/var/www/html/_bases/base_techplanner_fila3_mono/laravel/Modules';

    /**
     * Ottiene il percorso completo di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso completo del modulo
     */
    public static function modulePath(string $moduleName): string
    {
        return self::$modulesBasePath.'/'.$moduleName;
    }

    /**
     * Ottiene il percorso dei modelli di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso dei modelli
     */
    public static function modelsPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/app/Models';
    }

    /**
     * Ottiene il percorso delle migrazioni di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso delle migrazioni
     */
    public static function migrationsPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/database/migrations';
    }

    /**
     * Ottiene il percorso dei seeder di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso dei seeder
     */
    public static function seedersPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/database/seeders';
    }

    /**
     * Ottiene il percorso dei controller di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso dei controller
     */
    public static function controllersPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/app/Http/Controllers';
    }

    /**
     * Ottiene il percorso delle risorse Filament di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso delle risorse Filament
     */
    public static function filamentResourcesPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/app/Filament/Resources';
    }

    /**
     * Ottiene il percorso dei provider di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso dei provider
     */
    public static function providersPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/app/Providers';
    }

    /**
     * Ottiene il percorso delle viste di un modulo.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return string Percorso delle viste
     */
    public static function viewsPath(string $moduleName): string
    {
        return self::modulePath($moduleName).'/resources/views';
    }

    /**
     * Verifica se un percorso è corretto secondo le convenzioni del progetto.
     *
     * @param  string  $path  Percorso da verificare
     * @return bool True se il percorso è corretto, false altrimenti
     */
    public static function isValidPath(string $path): bool
    {
        // Verifica che il percorso contenga /laravel/Modules/ e non solo /Modules/
        if (Str::contains($path, '/base_techplanner_fila3_mono/Modules/')) {
            return false;
        }

        // Verifica che il percorso contenga /laravel/ dopo /saluteora/
        if (Str::contains($path, '/saluteora/') && ! Str::contains($path, '/saluteora/laravel/')) {
            return false;
        }

        return true;
    }

    /**
     * Corregge un percorso errato secondo le convenzioni del progetto.
     *
     * @param  string  $path  Percorso da correggere
     * @return string Percorso corretto
     */
    public static function correctPath(string $path): string
    {
        // Corregge /var/www/html/base_techplanner_fila3_mono/Modules/ in /var/www/html/base_techplanner_fila3_mono/laravel/Modules/
        if (Str::contains($path, '/base_techplanner_fila3_mono/Modules/')) {
            return str_replace('/base_techplanner_fila3_mono/Modules/', '/base_techplanner_fila3_mono/laravel/Modules/', $path);
        }

        // Corregge /var/www/html/Modules/ in /var/www/html/base_techplanner_fila3_mono/laravel/Modules/
        if (Str::contains($path, '/var/www/html/Modules/')) {
            return str_replace('/var/www/html/Modules/', '/var/www/html/base_techplanner_fila3_mono/laravel/Modules/', $path);
        }

        return $path;
    }

    /**
     * Ottiene tutti i moduli disponibili.
     *
     * @return array<string> Array con i nomi dei moduli
     */
    public static function getModules(): array
    {
        $modulesPath = self::$modulesBasePath;

        if (! File::exists($modulesPath)) {
            return [];
        }

        /** @var array<string> $directories */
        $directories = File::directories($modulesPath);

        return array_map(fn (string $path): string => basename($path), $directories);
    }

    /**
     * Verifica se un modulo esiste.
     *
     * @param  string  $moduleName  Nome del modulo
     * @return bool True se il modulo esiste, false altrimenti
     */
    public static function moduleExists(string $moduleName): bool
    {
        return File::exists(self::modulePath($moduleName));
    }
}
