<?php

namespace Modules\Xot\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class CheckConventionsCommand extends Command
{
    protected $signature = 'xot:check-conventions';
    protected $description = 'Verifica le convenzioni del progetto';

    private array $violations = [];

    public function handle()
    {
        $this->info('Verifica convenzioni in corso...');

        $this->checkFilamentResources()
            ->checkFilamentPages()
            ->checkFilamentWidgets()
            ->checkTranslations()
            ->checkNotifications();

        if (empty($this->violations)) {
            $this->info('✅ Tutte le convenzioni sono rispettate!');
            return 0;
        }

        $this->error('❌ Violazioni trovate:');
        foreach ($this->violations as $violation) {
            $this->line("- {$violation}");
        }

        return 1;
    }

    private function checkFilamentResources(): self
    {
        $resources = $this->getClassesInNamespace('App\\Filament\\Resources');

        foreach ($resources as $resource) {
            $reflection = new ReflectionClass($resource);

            // Verifica estensione XotBaseResource
            if (!$reflection->isSubclassOf('Modules\\Xot\\Filament\\Resources\\XotBaseResource')) {
                $this->violations[] = "Resource {$resource} deve estendere XotBaseResource";
            }

            // Verifica metodi form e table
            if ($reflection->hasMethod('form') || $reflection->hasMethod('table')) {
                $this->violations[] = "Resource {$resource} non deve implementare form() o table() direttamente";
            }
        }

        return $this;
    }

    private function checkFilamentPages(): self
    {
        $pages = $this->getClassesInNamespace('App\\Filament\\Pages');

        foreach ($pages as $page) {
            $reflection = new ReflectionClass($page);

            if (!$reflection->isSubclassOf('Modules\\Xot\\Filament\\Pages\\XotBasePage')) {
                $this->violations[] = "Page {$page} deve estendere XotBasePage";
            }
        }

        return $this;
    }

    private function checkFilamentWidgets(): self
    {
        $widgets = $this->getClassesInNamespace('App\\Filament\\Widgets');

        foreach ($widgets as $widget) {
            $reflection = new ReflectionClass($widget);

            if (!$reflection->isSubclassOf('Modules\\Xot\\Filament\\Widgets\\XotBaseWidget')) {
                $this->violations[] = "Widget {$widget} deve estendere XotBaseWidget";
            }
        }

        return $this;
    }

    private function checkTranslations(): self
    {
        $files = File::allFiles(resource_path('lang'));

        foreach ($files as $file) {
            $content = file_get_contents($file->getPathname());

            // Verifica uso di ->label()
            if (preg_match('/->label\(/', $content)) {
                $this->violations[] = "File {$file->getFilename()} usa ->label(), usare __() invece";
            }
        }

        return $this;
    }

    private function checkNotifications(): self
    {
        $files = File::allFiles(app_path());

        foreach ($files as $file) {
            $content = file_get_contents($file->getPathname());

            // Verifica creazione classi notifica
            if (preg_match('/class.*Notification/', $content)) {
                $this->violations[] = "File {$file->getFilename()} crea una classe Notification, usare recordNotification invece";
            }
        }

        return $this;
    }

    private function getClassesInNamespace(string $namespace): array
    {
        $classes = [];
        $path = str_replace('\\', '/', $namespace);
        $path = app_path(str_replace('App/', '', $path));

        if (is_dir($path)) {
            $files = File::allFiles($path);

            foreach ($files as $file) {
                $class = $namespace . '\\' . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    $file->getRelativePathname()
                );

                if (class_exists($class)) {
                    $classes[] = $class;
                }
            }
        }

        return $classes;
    }
}
