<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

<<<<<<< HEAD
use Exception;
=======
>>>>>>> 9831a351 (.)
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\View;
use Illuminate\Contracts\Auth\Authenticatable;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
=======
>>>>>>> 9831a351 (.)
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Throwable;

/**
 * Provides a widget for user logout functionality within Filament admin panels.
<<<<<<< HEAD
 * 
 * This widget handles the user logout process including session invalidation,
 * event dispatching, and proper redirection with localization support.
 * 
=======
 *
 * This widget handles the user logout process including session invalidation,
 * event dispatching, and proper redirection with localization support.
 *
>>>>>>> 9831a351 (.)
 * @method void mount() Initialize the widget and form state.
 * @method array<string, Component> getFormSchema() Define the form schema for the logout confirmation.
 * @method void logout() Handle the user logout process.
 * @method array<string, Action> getFormActions() Define the form actions (logout and cancel buttons).
 * @method array<string, string> getViewData() Get additional data to pass to the view.
<<<<<<< HEAD
 * 
=======
 *
>>>>>>> 9831a351 (.)
 * @property array<string, mixed>|null $data Widget data array managed by XotBaseWidget.
 * @property bool $isLoggingOut Flag indicating if logout is in progress.
 */
class LogoutWidget extends XotBaseWidget
{
    /**
     * The view that should be used to render the widget.
<<<<<<< HEAD
     * 
     * IMPORTANT: When using @livewire() directly in Blade templates,
     * the path should be without the module namespace.
     * 
     * @var string
     * 
     * @phpstan-ignore property.phpDocType 
=======
     *
     * IMPORTANT: When using @livewire() directly in Blade templates,
     * the path should be without the module namespace.
     *
     *
     * @phpstan-ignore property.phpDocType
>>>>>>> 9831a351 (.)
     */
    protected static string $view = 'user::widgets.logout';

    /**
     * Widget data array.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * CRITICAL: This property is managed by XotBaseWidget.
     * Do not remove or redeclare it.
     *
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    /**
     * Indicates if the logout process is in progress.
<<<<<<< HEAD
     *
     * @var bool
=======
>>>>>>> 9831a351 (.)
     */
    public bool $isLoggingOut = false;

    /**
     * Mount the widget and initialize the form.
<<<<<<< HEAD
     * 
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Get the form schema for the logout confirmation.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * This method implements the abstract method from XotBaseWidget.
     * Do not override the form() method as it's declared as final.
     *
     * @return array<string, Component>
     */
    public function getFormSchema(): array
    {
<<<<<<< HEAD
        $view='filament.widgets.auth.logout-message';
        //@phpstan-ignore-next-line
        if(!view()->exists($view)){
            throw new \Exception('View '.$view.' not found');
        }
=======
        $view = 'filament.widgets.auth.logout-message';
        // @phpstan-ignore-next-line
        if (! view()->exists($view)) {
            throw new \Exception('View '.$view.' not found');
        }

>>>>>>> 9831a351 (.)
        return [
            'message' => View::make($view)
                ->columnSpanFull(),
        ];
    }

    /**
     * Handle the user logout process.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * This method performs the following actions:
     * 1. Validates the current user session
     * 2. Dispatches pre-logout events
     * 3. Performs the actual logout
     * 4. Invalidates the session
     * 5. Dispatches post-logout events
     * 6. Logs the operation
     * 7. Handles redirection with proper localization
     *
<<<<<<< HEAD
     * @return void
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @throws \RuntimeException If the logout process fails
     */
    public function logout(): void
    {
        try {
            $this->isLoggingOut = true;

            // Get the authenticated user before logging out
            $user = $this->getAuthenticatedUser();
            if ($user === null) {
                $this->handleNoUserScenario();
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
                return;
            }

            $this->dispatchPreLogoutEvent($user);
            $this->performLogout();
            $this->dispatchPostLogoutEvent();
            $this->logLogoutSuccess($user);
            $this->redirectAfterLogout();
        } catch (Throwable $e) {
            $this->handleLogoutError($e);
        }
    }

    /**
     * Get the form actions for the widget.
     *
     * @return array<string, Action>
     */
    public function getFormActions(): array
    {
        return [
            'logout' => $this->getLogoutAction(),
            'cancel' => $this->getCancelAction(),
        ];
    }

    /**
     * Get the logout action configuration.
<<<<<<< HEAD
     *
     * @return Action
=======
>>>>>>> 9831a351 (.)
     */
    protected function getLogoutAction(): Action
    {
        return Action::make('logout')
            ->translateLabel()
            ->color('danger')
            ->size('lg')
            ->extraAttributes(['class' => 'w-full justify-center'])
            ->action(fn () => $this->logout());
    }

    /**
     * Get the cancel action configuration.
<<<<<<< HEAD
     *
     * @return Action
=======
>>>>>>> 9831a351 (.)
     */
    protected function getCancelAction(): Action
    {
        return Action::make('cancel')
            ->translateLabel()
            ->color('gray')
            ->size('lg')
            ->extraAttributes(['class' => 'w-full justify-center mt-2'])
            ->url($this->getLocalizedHomeUrl());
    }

    /**
     * Get localized home URL based on current locale.
<<<<<<< HEAD
     *
     * @return string
=======
>>>>>>> 9831a351 (.)
     */
    protected function getLocalizedHomeUrl(): string
    {
        $locale = App::getLocale();
<<<<<<< HEAD
        return '/' . ltrim($locale, '/');
=======

        return '/'.ltrim($locale, '/');
>>>>>>> 9831a351 (.)
    }

    /**
     * Get the authenticated user instance.
<<<<<<< HEAD
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
=======
>>>>>>> 9831a351 (.)
     */
    protected function getAuthenticatedUser(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Handle scenario when no user is authenticated.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function handleNoUserScenario(): void
    {
        $this->isLoggingOut = false;
        Log::warning('Logout attempted with no authenticated user');
    }

    /**
     * Dispatch pre-logout events.
<<<<<<< HEAD
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function dispatchPreLogoutEvent(Authenticatable $user): void
    {
        Event::dispatch('auth.logout.attempting', [$user]);
    }

    /**
     * Perform the actual logout operations.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function performLogout(): void
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
    }

    /**
     * Dispatch post-logout events.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function dispatchPostLogoutEvent(): void
    {
        Event::dispatch('auth.logout.successful');
    }

    /**
     * Log successful logout operation.
<<<<<<< HEAD
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function logLogoutSuccess(Authenticatable $user): void
    {
        Log::info('User logged out', [
            'user_id' => $user->getAuthIdentifier(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Handle redirect after successful logout.
<<<<<<< HEAD
     *
     * @return void
=======
>>>>>>> 9831a351 (.)
     */
    protected function redirectAfterLogout(): void
    {
        $redirect = redirect($this->getLocalizedHomeUrl())
            ->with('success', __('user::auth.logout_success'));
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
        $redirect->send();
        exit;
    }

    /**
     * Handle any errors that occur during logout.
     *
<<<<<<< HEAD
     * @param  \Throwable  $e
     * @return void
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @throws \RuntimeException
     */
    protected function handleLogoutError(Throwable $e): void
    {
<<<<<<< HEAD
        Log::error('Logout error: ' . $e->getMessage(), [
=======
        Log::error('Logout error: '.$e->getMessage(), [
>>>>>>> 9831a351 (.)
            'exception' => get_class($e),
            'trace' => $e->getTraceAsString(),
        ]);

        $this->isLoggingOut = false;
        Session::flash('error', __('user::auth.logout_error'));
    }

    /**
     * Get view data for the widget.
     *
     * @return array{
     *     title: string,
     *     description: string
     * }
     */
    protected function getViewData(): array
    {
        return [
            'title' => __('user::auth.logout_title'),
            'description' => __('user::auth.logout_confirmation'),
        ];
    }
}
