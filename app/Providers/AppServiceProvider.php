<?php
namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

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
        $timezone = GeneralSetting::first()->timezone ?? 'Asia/Kolkata';
        Config::set('app.timezone', $timezone);
        date_default_timezone_set($timezone);
    }
}
