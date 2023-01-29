<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
                ->action('Doğrula', $url);
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->greeting('Merhaba!')
                ->subject('Şifre Sıfırlama')
                ->line('Bu e-postayı, hesabınız için bir şifre sıfırlama talebi aldığımız için alıyorsunuz.')
                ->action('Sıfırla', $url)
                ->line('Bu parola sıfırlama bağlantısının süresi 60 dakika içinde dolacak.')
                ->line('Parola sıfırlama talebinde bulunmadıysanız başka bir işlem yapmanız gerekmez.');
        });
    }
}
