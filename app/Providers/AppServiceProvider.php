<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        // Jika aplikasi berjalan di environment production (Railway),
        // paksa semua URL aset dan link menggunakan HTTPS.
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
