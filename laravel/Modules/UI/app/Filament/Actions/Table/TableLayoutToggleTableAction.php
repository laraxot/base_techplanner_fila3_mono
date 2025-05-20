<?php

declare(strict_types=1);

<<<<<<< HEAD
namespace Modules\UI\Filament\Actions\Table;
=======
namespace Modules\UI\app\Filament\Actions\Table;
>>>>>>> 77f8368 (.)

use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Session;
use Modules\UI\Enums\TableLayout;
<<<<<<< HEAD
use Modules\UI\Traits\TableLayoutTrait;
=======
use Modules\UI\app\Traits\TableLayoutTrait;
>>>>>>> 77f8368 (.)

class TableLayoutToggleTableAction extends Action
{
    use TableLayoutTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $current = $this->getCurrentLayout();

        $this
            ->label('Toggle Layout')
            ->tooltip($current->getLabel())
            ->color($current->getColor())
            ->icon($current->getIcon())
            ->action(fn ($livewire) => $this->toggleLayout($livewire));
    }

    /**
     * @param \Filament\Resources\Pages\ListRecords|null $livewire
     */
    protected function toggleLayout($livewire): void
    {
        $currentLayout = $this->getCurrentLayout();
        $newLayout = $currentLayout->toggle();
        
        $this->setTableLayout($newLayout);

        if ($livewire instanceof ListRecords) {
            $livewire->dispatch('$refresh');
        }
    }

    protected function getCurrentLayout(): TableLayout
    {
        return $this->getTableLayout();
    }
<<<<<<< HEAD

    public static function getDefaultName(): string
    {
        return 'table_layout_toggle';
    }
=======
>>>>>>> 77f8368 (.)
}
