<?php

declare(strict_types=1);

namespace WireElements\Pro;

use Livewire\Features\SupportConsoleCommands\Commands\UpgradeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WireElementsProServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('wire-elements-pro')
            ->hasConfigFile()
            ->hasAssets()
            ->hasViews()
            ->hasTranslations();
    }

    public function bootingPackage()
    {
        UpgradeCommand::addThirdPartyUpgradeStep(WireElementsProUpgrade::class);
    }
}
