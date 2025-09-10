<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Auth;

<<<<<<< HEAD
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
>>>>>>> 9831a351 (.)

class AuthLogout extends Component
{
    public function mount(): void
    {
        Auth::logout();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
<<<<<<< HEAD
        $view='livewire.auth.logout';
        //@phpstan-ignore-next-line
        if(!view()->exists($view)){
            throw new \Exception("View $view not found");
        }
        $view_params=[];
        return view($view,$view_params);
=======
        $view = 'livewire.auth.logout';
        // @phpstan-ignore-next-line
        if (! view()->exists($view)) {
            throw new \Exception("View $view not found");
        }
        $view_params = [];

        return view($view, $view_params);
>>>>>>> 9831a351 (.)
    }
}
