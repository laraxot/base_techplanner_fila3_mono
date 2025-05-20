<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Auth;

use Livewire\Component;

class AuthLogout extends Component
{
    public function mount(): void
    {
        auth()->logout();
        $this->redirect(route('login'));
    }

    public function render()
    {
        return view('user::livewire.auth.logout');
    }
}
