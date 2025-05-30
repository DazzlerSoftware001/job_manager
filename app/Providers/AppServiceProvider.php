<?php
namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('general_setting')) {
            $timezone = GeneralSetting::first()->timezone ?? 'Asia/Kolkata';
            Config::set('app.timezone', $timezone);
            date_default_timezone_set($timezone);
        } else {
            // Fallback during initial migration or setup
            Config::set('app.timezone', 'Asia/Kolkata');
            date_default_timezone_set('Asia/Kolkata');
        }
    }
}
