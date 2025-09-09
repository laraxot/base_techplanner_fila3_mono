<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

use Themes\Sixteen\Services\MenuBuilder;

/**
 * Servizio per la gestione del tema Sixteen.
 * 
 * Questo servizio fornisce metodi per la gestione
 * delle configurazioni e funzionalità del tema.
 * 
 * Enhanced version integrating with the new Menu Builder System
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

    public function __construct(
        protected MenuBuilder $menuBuilder
    ) {
    }

    /**
     * Restituisce il nome del tema.
     *
     * @return string
     */
    public function getThemeName(): string
    {
        return $this->themeName;
    }

    /**
     * Restituisce la versione del tema.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Restituisce la configurazione del tema.
     *
     * @return array<string, mixed>
     */
    public function getConfig(): array
    {
        return [
            'name' => $this->themeName,
            'version' => $this->version,
            'author' => 'Laraxot Team',
            'description' => 'Modern responsive theme for Laraxot applications',
            'features' => [
                'responsive_design',
                'dark_mode_support',
                'component_library',
                'accessibility_compliant',
            ],
        ];
    }

    /**
     * Costruisce il menu usando il MenuBuilder.
     *
     * @return array<string, mixed>
     */
    public function buildMenu(): array
    {
        return $this->menuBuilder->build();
    }

    /**
     * Inizializza le risorse del tema.
     *
     * @return void
     */
    public function initialize(): void
    {
        // Caricamento delle risorse CSS e JS
        // Configurazione dei componenti del tema
        // Setup delle configurazioni specifiche
    }
}
