<?php

declare(strict_types=1);

namespace Modules\Cms\Http\View\Composers;

// use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

/**
 * Class XotComposer.
 */
class XotComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $user = Auth::user();
        if (! $user instanceof Authenticatable) {
            return;
        }

        $profile = $user->profile;
        $lang = app()->getLocale();
        $params = [];
        $route_current = Route::current();
        if ($route_current instanceof \Illuminate\Routing\Route) {
            $params = $route_current->parameters();
        }

        $view->with('params', $params);
        $view->with('lang', $lang);
        $view->with('profile', $profile);
    }
}
