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
            'description' => 'Tema Sixteen per SaluteOra - AGID Bootstrap Italia compliant',
            'author' => 'SaluteOra Team',
            'agid_compliant' => true,
            'bootstrap_italia' => true,
            'tailwind_css' => true,
            'accessibility' => 'WCAG 2.1 AA',
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

    /**
     * Ottiene il Menu Builder per accesso diretto ai menu
     */
    public function getMenuBuilder(): MenuBuilder
    {
        return $this->menuBuilder;
    }

    /**
     * Ottiene i menu compilati per una location specifica
     */
    public function getMenu(string $location): array
    {
        return match ($location) {
            'slim_header' => $this->menuBuilder->getSlimHeader()->toArray(),
            'header' => $this->menuBuilder->getHeader()->toArray(),
            'footer' => $this->menuBuilder->getFooter()->toArray(),
            'footer_bar' => $this->menuBuilder->getFooterBar()->toArray(),
            default => throw new \InvalidArgumentException("Unknown menu location: {$location}")
        };
    }

    /**
     * Verifica la compliance AGID del tema
     */
    public function checkAgidCompliance(): array
    {
        return [
            'bootstrap_italia' => true,
            'wcag_2_1_aa' => $this->getConfig('accessibility.screen_reader_content', true),
            'skip_links' => $this->getConfig('accessibility.skip_links', true),
            'keyboard_navigation' => $this->getConfig('accessibility.keyboard_navigation', true),
            'cookiebar' => $this->getConfig('layout.cookiebar', true),
            'breadcrumbs' => $this->getConfig('layout.breadcrumbs.enabled', true),
        ];
    }

    /**
     * Ottiene statistiche sui componenti implementati
     */
    public function getComponentStats(): array
    {
        // Questa sarà espansa con il progress del tema
        return [
            'total_agid_components' => 54,
            'implemented' => 26,
            'compliance_percentage' => 48,
            'critical_missing' => ['dropdown', 'pagination', 'spid_integration'],
            'status' => 'in_development'
        ];
    }
} 