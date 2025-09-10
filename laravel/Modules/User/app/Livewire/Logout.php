<?php
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
declare(strict_types=1);

namespace Modules\User\Livewire;

<<<<<<< HEAD
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
=======
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
>>>>>>> 9831a351 (.)

/**
 * Logout component for handling user logout functionality.
 */
class Logout extends Component
{
    /**
     * Processing state indicator.
     */
    public bool $processing = false;

    /**
     * Handle user logout process.
     */
    public function logout(): ?RedirectResponse
    {
        $this->processing = true;

        try {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('home');
        } catch (\Exception $e) {
            $this->processing = false;
            session()->flash('error', __('Errore durante il logout. Riprova.'));
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return null;
        }
    }

    /**
     * Render the logout component view.
     */
    public function render(): View
    {
        return view('user::livewire.logout');
    }
}
