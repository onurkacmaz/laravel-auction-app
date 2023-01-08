<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
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
    }
}
