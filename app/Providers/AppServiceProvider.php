<?php
namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\MailSetting;

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

        // mail configration 
        if (Schema::hasTable('mail_settings')) {
        $mail = MailSetting::first();
        if ($mail) {
            config([
                'mail.default' => $mail->mail_mailer ?? 'smtp',
                'mail.mailers.smtp.host' => $mail->mail_host,
                'mail.mailers.smtp.port' => $mail->mail_port,
                'mail.mailers.smtp.username' => $mail->mail_username,
                'mail.mailers.smtp.password' => $mail->mail_password,
                'mail.mailers.smtp.encryption' => $mail->mail_encryption,
                'mail.from.address' => $mail->mail_from_address,
                'mail.from.name' => $mail->mail_from_name,
            ]);
        }
    }
    }
}
