<?php

/**
 * ----.
 */

declare(strict_types=1);

namespace Modules\User\Providers;

<<<<<<< HEAD
use Webmozart\Assert\Assert;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Modules\User\Datas\PasswordData;
use Modules\User\Models\OauthClient;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Modules\Notify\Emails\SpatieEmail;
use Modules\User\Models\OauthAuthCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Modules\Xot\Contracts\UserContract;
use Illuminate\Validation\Rules\Password;
use Modules\User\Models\OauthAccessToken;
use Modules\User\Models\OauthRefreshToken;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\User\Models\OauthPersonalAccessClient;
use SocialiteProviders\Manager\ServiceProvider as SocialiteServiceProvider;
=======
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use Laravel\Passport\Passport;
use Modules\Notify\Emails\SpatieEmail;
use Modules\User\Datas\PasswordData;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Providers\XotBaseServiceProvider;
use SocialiteProviders\Manager\ServiceProvider as SocialiteServiceProvider;
use Webmozart\Assert\Assert;
>>>>>>> 9831a351 (.)

class UserServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'User';
<<<<<<< HEAD
    protected string $module_dir = __DIR__;
=======

    protected string $module_dir = __DIR__;

>>>>>>> 9831a351 (.)
    protected string $module_ns = __NAMESPACE__;

    public function boot(): void
    {
        parent::boot();
        $this->registerAuthenticationProviders();
        $this->registerEventListener();
        $this->registerPasswordRules();
        $this->registerPulse();
        $this->registerMailsNotification();
    }

    public function register(): void
    {
        parent::register();
        $this->registerTeamModelBindings();
    }

    /**
     * Register the team model bindings.
     */
    protected function registerTeamModelBindings(): void
    {
        $this->app->bind('team_user_model', function () {
            return \Modules\User\Models\TeamUser::class;
        });

        $this->app->bind('team_invitation_model', function () {
            return \Modules\User\Models\TeamInvitation::class;
        });
    }

    public function registerMailsNotification(): void
    {
        $app_name = config('app.name');
        if (! is_string($app_name)) {
            $app_name = '';
        }

        ResetPassword::toMailUsing(function ($notifiable, string $token): SpatieEmail {
            /*
            return (new MailMessage)
                ->template('user::notifications.email')
                ->subject(__('user::reset_password.password_reset_subject'))
                ->line(__('user::reset_password.password_cause_of_email'))
                ->action(__('user::reset_password.reset_password'), url(route('password.reset', $token, false)))
                ->line(__('user::reset_password.password_if_not_requested'))
                ->line(__('user::reset_password.thank_you_for_using_app'))
                ->salutation(__('user::reset_password.regards'));
            */
            Assert::isInstanceOf($notifiable, Model::class);
            $email = new SpatieEmail($notifiable, 'reset-password');
            $email->mergeData([
                'token' => $token,
                'reset_password_url' => url(route('password.reset', ['token' => $token], false)),
            ]);
<<<<<<< HEAD
            
=======

>>>>>>> 9831a351 (.)
            // ✅ FIX CRITICO: Imposta il destinatario dell'email con metodo Laravel standard
            if (method_exists($notifiable, 'getEmailForPasswordReset')) {
                $email->to($notifiable->getEmailForPasswordReset());
            } elseif (isset($notifiable->email)) {
                $email->to($notifiable->email);
            } else {
                // Fallback per debug
                \Illuminate\Support\Facades\Log::error('SpatieEmail: Destinatario email non trovato', [
                    'notifiable_class' => get_class($notifiable),
<<<<<<< HEAD
                    'notifiable_id' => $notifiable->id ?? 'unknown'
                ]);
            }
            
            return $email;
        });

        
=======
                    'notifiable_id' => $notifiable->id ?? 'unknown',
                ]);
            }

            return $email;
        });

>>>>>>> 9831a351 (.)
        /*
        $salutation = __('user::verify_email.salutation', ['app_name' => $app_name]);
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) use ($salutation): MailMessage {
            return (new MailMessage)
                ->template('user::notifications.email')
                ->subject(__('user::verify_email.subject'))
                ->greeting(__('user::verify_email.greeting'))
                ->line(__('user::verify_email.line1'))
                ->action(__('user::verify_email.action'), $url)
                ->line(__('user::verify_email.line2'))
                ->salutation($salutation);
        });
        */
        VerifyEmail::toMailUsing(function ($notifiable, string $url): SpatieEmail {
            Assert::isInstanceOf($notifiable, Model::class);
            $email = new SpatieEmail($notifiable, 'verify-email');
            $email->mergeData([
                'verification_url' => $url,
            ]);
            if (method_exists($notifiable, 'getEmailForPasswordReset')) {
                $email->to($notifiable->getEmailForPasswordReset());
            } elseif (isset($notifiable->email)) {
                $email->to($notifiable->email);
            }
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return $email;
        });
    }

    public function registerPulse(): void
    {
        Config::set('pulse.path', 'pulse/admin');
        Gate::define('viewPulse', function (UserContract $user): bool {
            return $user->hasRole('super-admin');
        });
    }

    public function registerPasswordRules(): void
    {
        Password::defaults(function (): Password {
            $pwd = PasswordData::make();
<<<<<<< HEAD
=======

>>>>>>> 9831a351 (.)
            return $pwd->getPasswordRule();
        });
    }

    protected function registerAuthenticationProviders(): void
    {
        $this->registerPassport();
        $this->registerSocialite();
    }

    protected function registerEventListener(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    private function registerSocialite(): void
    {
        $this->app->register(SocialiteServiceProvider::class);
    }

    private function registerPassport(): void
    {
        if (method_exists(Passport::class, 'routes')) {
            Passport::routes();
        }

        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        Passport::tokensCan([
            'view-user' => 'View user information',
            'core-technicians' => 'the technicians can ',
        ]);
    }
}
