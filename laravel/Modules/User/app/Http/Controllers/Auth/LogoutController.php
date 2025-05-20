<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 0b525d2 (.)
/**
 * Logs out the current user and redirects to the home page.
 *
 * @return \Illuminate\Http\RedirectResponse
 */

<<<<<<< HEAD
namespace Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Esegue il logout dell'utente.
     */
    public function __invoke(): RedirectResponse
    {
        // Esegui il logout
        Auth::logout();

        // Invalida la sessione
        Session::invalidate();

        // Rigenera il token CSRF
        Session::regenerateToken();

        // Redirect alla home
        return redirect()->route('home');
=======
declare(strict_types=1);

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\User\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::logout();

        return redirect(route('home'));
>>>>>>> 0b525d2 (.)
    }
}
