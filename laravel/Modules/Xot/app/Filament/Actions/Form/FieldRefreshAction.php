<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Xot\Filament\Actions\Form;

// Header actions must be an instance of Filament\Actions\Action, or Filament\Actions\ActionGroup.
// use Filament\Tables\Actions\Action;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Webmozart\Assert\Assert;
use Filament\Resources\Pages\ListRecords;
use Modules\Xot\Actions\GetTransKeyAction;
use Filament\Forms\Components\Actions\Action;
use Modules\Xot\Actions\Export\ExportXlsByCollection;
use Filament\Notifications\Notification;

class FieldRefreshAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel();
        $this->icon('heroicon-o-arrow-path')
            ->tooltip('Ricalcola valore')
            ->action($this->getRefreshAction());
    }

    private function getRefreshAction(): \Closure
    {
        return function (?string $state, Set $set, ?Model $record): void {
            $name = $this->getName();
            if ($name === null) {
                throw new \RuntimeException('Action name is required for field refresh');
            }

            if ($record === null) {
                throw new \RuntimeException('Record is required for field refresh');
            }

            $methodName = 'get' . Str::studly($name);

            if (!method_exists($record, $methodName)) {
                throw new \RuntimeException("Method {$methodName} does not exist on record");
            }

            $value = $record->{$methodName}();
            $set($name, $value);

            Notification::make()
                ->title("Ricalcolato {$name}")
                ->body("Vecchio valore: {$state}, nuovo valore: {$value}")
                ->success()
                ->send();
        };
    }

    public static function getDefaultName(): ?string
    {
        return 'field_refresh';
    }
}
