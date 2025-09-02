<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

/**
 * Servizio per la gestione del tema Sixteen.
 * 
 * Questo servizio fornisce metodi per la gestione
 * delle configurazioni e funzionalità del tema.
 */
class ThemeService
{
    /**
     * Nome del tema.
     */
    protected string $themeName = 'Sixteen';

    /**
     * Versione del tema.
     */
    protected string $version = '1.0.0';

    /**
     * Ottiene il nome del tema.
     */
    public function getName(): string
    {
        return $this->themeName;
    }

    /**
     * Ottiene la versione del tema.
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Ottiene le informazioni del tema.
     */
    public function getInfo(): array
    {
        return [
            'name' => $this->themeName,
            'version' => $this->version,
            'description' => 'Tema Sixteen per SaluteOra',
            'author' => 'SaluteOra Team',
        ];
    }

    /**
     * Verifica se il tema è attivo.
     */
    public function isActive(): bool
    {
        return config('app.theme') === 'sixteen';
    }

    /**
     * Ottiene le configurazioni del tema.
     */
    public function getConfig(string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return config('sixteen');
        }

        return config('sixteen.' . $key, $default);
    }
}
