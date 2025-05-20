<?php
<<<<<<< HEAD
declare(strict_types=1);
=======

>>>>>>> 1b374b6 (.)
use function Laravel\Folio\{middleware, name};
use Filament\Notifications\Notification;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Actions\Action;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Livewire\Volt\Component;
use Modules\Tenant\Services\TenantService;

/** @var array */
//$middleware=TenantService::config('middleware');
//$base_middleware=Arr::get($middleware,'base',[]);
$base_middleware=[];

name('home');
middleware($base_middleware);



new class extends Component
{
<<<<<<< HEAD

=======
   
>>>>>>> 1b374b6 (.)
};

?>

<<<<<<< HEAD
<x-layouts.app>
    <div>
       <x-page-content slug="home" />
    </div>
</x-layouts.app>
=======
<x-layouts.marketing>
    <div>
        {!! $_theme->showPageContent('home') !!}
    </div>
</x-layouts.marketing>
>>>>>>> 1b374b6 (.)
