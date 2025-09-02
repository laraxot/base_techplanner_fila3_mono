<?php

declare(strict_types=1);

namespace Themes\Sixteen\Services;

use Illuminate\Support\Collection;
use Themes\Sixteen\Contracts\MenuFilterInterface;

/**
 * Menu Builder Service per Sixteen Theme
 * Ispirato al tema ufficiale italia/design-laravel-theme
 * Supporta menu dinamici, filtri e autorizzazioni
 */
class MenuBuilder
{
    protected Collection $slimHeader;
    protected Collection $header;
    protected Collection $footer;
    protected Collection $footerBar;
    protected array $filters = [];

    public function __construct()
    {
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();
    }

    /**
     * Aggiungi elementi al menu slim header
     */
    public function addSlimHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->slimHeader = $this->slimHeader->merge($processedItems);
        
        return $this;
    }

    /**
     * Aggiungi elementi al menu header principale
     */
    public function addHeader(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->header = $this->header->merge($processedItems);
        
        return $this;
    }

    /**
     * Aggiungi elementi al menu footer
     */
    public function addFooter(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footer = $this->footer->merge($processedItems);
        
        return $this;
    }

    /**
     * Aggiungi elementi alla footer bar
     */
    public function addFooterBar(array $items): self
    {
        $processedItems = $this->transformItems($items);
        $this->footerBar = $this->footerBar->merge($processedItems);
        
        return $this;
    }

    /**
     * Registra filtri da applicare ai menu items
     */
    public function setFilters(array $filters): self
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * Costruisci e restituisci tutti i menu
     */
    public function build(): array
    {
        return [
            'slim_header' => $this->slimHeader->toArray(),
            'header' => $this->header->toArray(),
            'footer' => $this->footer->toArray(),
            'footer_bar' => $this->footerBar->toArray(),
        ];
    }

    /**
     * Ottieni solo il menu header
     */
    public function getHeader(): Collection
    {
        return $this->header;
    }

    /**
     * Ottieni solo il menu slim header
     */
    public function getSlimHeader(): Collection
    {
        return $this->slimHeader;
    }

    /**
     * Ottieni solo il menu footer
     */
    public function getFooter(): Collection
    {
        return $this->footer;
    }

    /**
     * Ottieni solo la footer bar
     */
    public function getFooterBar(): Collection
    {
        return $this->footerBar;
    }

    /**
     * Carica menu dalla configurazione
     */
    public function loadFromConfig(): self
    {
        $config = config('sixteen.menu', []);

        if (!empty($config['slim_header'])) {
            $this->addSlimHeader($config['slim_header']);
        }

        if (!empty($config['header'])) {
            $this->addHeader($config['header']);
        }

        if (!empty($config['footer'])) {
            $this->addFooter($config['footer']);
        }

        if (!empty($config['footer_bar'])) {
            $this->addFooterBar($config['footer_bar']);
        }

        return $this;
    }

    /**
     * Reset di tutti i menu
     */
    public function reset(): self
    {
        $this->slimHeader = collect();
        $this->header = collect();
        $this->footer = collect();
        $this->footerBar = collect();

        return $this;
    }

    /**
     * Trasforma e processa gli elementi del menu
     */
    protected function transformItems(array $items): Collection
    {
        return collect($items)
            ->map([$this, 'processMenuItem'])
            ->filter() // Rimuove elementi false/null dai filtri
            ->values(); // Re-index array
    }

    /**
     * Processa un singolo elemento del menu
     */
    public function processMenuItem($item): array|false|null
    {
        // Se è una stringa, rappresenta un header/separatore
        if (is_string($item)) {
            return [
                'type' => 'header',
                'text' => $item,
            ];
        }

        // Se è un separatore
        if ($item === '-') {
            return [
                'type' => 'separator',
            ];
        }

        // Applica filtri
        foreach ($this->filters as $filter) {
            if ($filter instanceof MenuFilterInterface) {
                $item = $filter->filter($item);
                
                // Se il filtro restituisce false, rimuovi l'elemento
                if ($item === false) {
                    return false;
                }
            }
        }

        // Determina il tipo di elemento
        $item['type'] = $this->determineItemType($item);

        // Processa dropdown se presente
        if (isset($item['dropdown'])) {
            $item['dropdown'] = $this->transformItems($item['dropdown'])->toArray();
        }

        // Processa megamenu se presente
        if (isset($item['megamenu'])) {
            $item['megamenu'] = collect($item['megamenu'])
                ->map(function ($column) {
                    return $this->transformItems($column)->toArray();
                })
                ->toArray();
        }

        // Aggiungi proprietà di default
        $item = array_merge([
            'active' => false,
            'target' => null,
            'icon' => null,
            'badge' => null,
            'attributes' => [],
        ], $item);

        return $item;
    }

    /**
     * Determina il tipo di elemento del menu
     */
    protected function determineItemType(array $item): string
    {
        if (isset($item['dropdown'])) {
            return 'dropdown';
        }

        if (isset($item['megamenu'])) {
            return 'megamenu';
        }

        if (isset($item['url']) || isset($item['route'])) {
            return 'link';
        }

        return 'text';
    }

    /**
     * Controlla se un menu ha elementi
     */
    public function hasItems(string $menu): bool
    {
        return match ($menu) {
            'slim_header' => $this->slimHeader->isNotEmpty(),
            'header' => $this->header->isNotEmpty(),
            'footer' => $this->footer->isNotEmpty(),
            'footer_bar' => $this->footerBar->isNotEmpty(),
            default => false,
        };
    }

    /**
     * Conta gli elementi di un menu
     */
    public function countItems(string $menu): int
    {
        return match ($menu) {
            'slim_header' => $this->slimHeader->count(),
            'header' => $this->header->count(),
            'footer' => $this->footer->count(),
            'footer_bar' => $this->footerBar->count(),
            default => 0,
        };
    }

    /**
     * Trova un elemento del menu per ID
     */
    public function findItem(string $id, string $menu = null): array|null
    {
        $menus = $menu ? [$menu => $this->{$menu}] : [
            'slim_header' => $this->slimHeader,
            'header' => $this->header,
            'footer' => $this->footer,
            'footer_bar' => $this->footerBar,
        ];

        foreach ($menus as $menuItems) {
            $found = $menuItems->firstWhere('id', $id);
            if ($found) {
                return $found;
            }
        }

        return null;
    }

    /**
     * Rimuovi un elemento del menu per ID
     */
    public function removeItem(string $id, string $menu = null): self
    {
        $menus = $menu ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menus as $menuName) {
            $this->{$menuName} = $this->{$menuName}->reject(function ($item) use ($id) {
                return isset($item['id']) && $item['id'] === $id;
            });
        }

        return $this;
    }

    /**
     * Aggiorna un elemento del menu
     */
    public function updateItem(string $id, array $updates, string $menu = null): self
    {
        $menus = $menu ? [$menu] : ['slim_header', 'header', 'footer', 'footer_bar'];

        foreach ($menus as $menuName) {
            $this->{$menuName} = $this->{$menuName}->map(function ($item) use ($id, $updates) {
                if (isset($item['id']) && $item['id'] === $id) {
                    return array_merge($item, $updates);
                }
                return $item;
            });
        }

        return $this;
    }

    /**
     * Ottieni statistiche sui menu
     */
    public function getStats(): array
    {
        return [
            'slim_header_count' => $this->slimHeader->count(),
            'header_count' => $this->header->count(),
            'footer_count' => $this->footer->count(),
            'footer_bar_count' => $this->footerBar->count(),
            'total_items' => $this->slimHeader->count() + 
                           $this->header->count() + 
                           $this->footer->count() + 
                           $this->footerBar->count(),
            'has_dropdowns' => $this->header->contains('type', 'dropdown'),
            'has_megamenus' => $this->header->contains('type', 'megamenu'),
        ];
    }
}