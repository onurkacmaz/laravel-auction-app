<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use NumberFormatter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.tailwind');
        Str::macro('currency', function ($value) {
            $formatter = new NumberFormatter('tr_TR', NumberFormatter::CURRENCY);
            return $formatter->formatCurrency($value, 'TRY');
        });

        if (!$this->app->runningInConsole()) {
            View::composer('*', function ($view) {
                $view->with('generalSettings', Cache::get('generalSettings', []));
            });
        }

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->greeting('Merhaba!')
                ->subject('Email Adresinizi Doğrulayın')
                ->line('Butona tıklayarak email adresinizi doğrulayabilirsiniz.')
                ->action('Doğrula', URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                ));
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->greeting('Merhaba!')
                ->subject('Şifre Sıfırlama')
                ->line('Bu e-postayı, hesabınız için bir şifre sıfırlama talebi aldığımız için alıyorsunuz.')
                ->action('Sıfırla', url(route('password.reset', [
                    'token' => $url,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('Bu parola sıfırlama bağlantısının süresi 60 dakika içinde dolacak.')
                ->line('Parola sıfırlama talebinde bulunmadıysanız başka bir işlem yapmanız gerekmez.');
        });
    }
}
