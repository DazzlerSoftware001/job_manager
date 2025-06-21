<?php
namespace App\Http\Controllers;

use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallationController extends Controller
{
    public function preInstall()
    {
        return view('installation.pre-installation');
    }

    public function configuration()
    {
        $mailSetting = MailSetting::first();
        return view('installation.configuration', compact('mailSetting'));
    }

    public function storeConfiguration(Request $request)
    {
        $request->validate([
            'app_name'      => 'required',
            'app_url'       => 'required|url',
            'db_host'       => 'required',
            'db_user'       => 'required',
            'db_name'       => 'required',
            'db_password'   => 'nullable',
            'mail_host'     => 'required',
            'mail_port'     => 'required',
            'mail_username' => 'required',
            'mail_password' => 'nullable',
        ]);

        // Set environment values
        $envPath = base_path('.env');
        if (! File::exists($envPath)) {
            File::copy(base_path('.env.example'), $envPath);
        }

        $envContent = File::get($envPath);
        $envUpdates = [
            'APP_NAME'    => $request->app_name,
            'APP_URL'     => $request->app_url,
            'DB_HOST'     => $request->db_host,
            'DB_DATABASE' => $request->db_name,
            'DB_USERNAME' => $request->db_user,
            'DB_PASSWORD' => $request->db_password ?? '',
        ];

        foreach ($envUpdates as $key => $value) {
            $envContent = preg_replace("/^$key=.*$/m", "$key=\"$value\"", $envContent);
        }

        File::put($envPath, $envContent);
        Artisan::call('config:clear');

        // Prepare mail settings data
        $data = [
            'mail_host'     => $request->mail_host,
            'mail_port'     => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
        ];

        // Save or update mail settings
        $MailSetting = MailSetting::first();
        if (! $MailSetting) {
            $MailSetting = new MailSetting();
            $MailSetting->fill($data);
            $MailSetting->created_at = now();
        } else {
            $MailSetting->fill($data);
            $MailSetting->updated_at = now();
        }
        $MailSetting->save();

        return redirect()->route('installer.finish')->with('success', 'Configuration saved successfully!');
    }

    // public function storeConfiguration(Request $request)
    // {
    //     $request->validate([
    //         'app_name'      => 'required',
    //         'app_url'       => 'required|url',
    //         'email'         => 'required|email',
    //         'purchase_code' => 'required',
    //         'db_host'       => 'required',
    //         'db_user'       => 'required',
    //         'db_name'       => 'required',
    //         'db_password'   => 'nullable',
    //         'mail_host'     => 'required',
    //         'mail_port'     => 'required',
    //         'mail_username' => 'required',
    //         'mail_password' => 'nullable',
    //     ]);

    //     // 🔒 Match email and code
    //     if (
    //         $request->purchase_code !== 'ABC1234-XYZ5678' ||
    //         $request->email !== 'your@email.com'
    //     ) {
    //         return back()->withErrors([
    //             'purchase_code' => 'Invalid purchase code or email address.',
    //         ])->withInput();
    //     }

    //     // Set environment values
    //     $envPath = base_path('.env');
    //     if (! File::exists($envPath)) {
    //         File::copy(base_path('.env.example'), $envPath);
    //     }

    //     $envContent = File::get($envPath);
    //     $envUpdates = [
    //         'APP_NAME'    => $request->app_name,
    //         'APP_URL'     => $request->app_url,
    //         'DB_HOST'     => $request->db_host,
    //         'DB_DATABASE' => $request->db_name,
    //         'DB_USERNAME' => $request->db_user,
    //         'DB_PASSWORD' => $request->db_password ?? '',
    //     ];

    //     foreach ($envUpdates as $key => $value) {
    //         $envContent = preg_replace("/^$key=.*$/m", "$key=\"$value\"", $envContent);
    //     }

    //     File::put($envPath, $envContent);
    //     Artisan::call('config:clear');

    //     // Prepare mail settings data
    //     $data = [
    //         'mail_host'     => $request->mail_host,
    //         'mail_port'     => $request->mail_port,
    //         'mail_username' => $request->mail_username,
    //         'mail_password' => $request->mail_password,
    //     ];

    //     // Save or update mail settings
    //     $MailSetting = MailSetting::first();
    //     if (! $MailSetting) {
    //         $MailSetting = new MailSetting();
    //         $MailSetting->fill($data);
    //         $MailSetting->created_at = now();
    //     } else {
    //         $MailSetting->fill($data);
    //         $MailSetting->updated_at = now();
    //     }
    //     $MailSetting->save();

    //     return redirect()->route('installer.finish')->with('success', 'Configuration saved successfully!');
    // }

    public function finish()
    {
        // Mark as installed
        file_put_contents(storage_path('installed'), 'installed');

        // Show final installation success screen
        return view('installation.finish');
    }

}
