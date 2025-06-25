<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footer()
    {

        $footer = FooterSetting::first();
        return view('admin.Settings.footer', compact('footer'));
    }

    public function FooterSettings(Request $request)
    {
        $footer = FooterSetting::firstOrNew([]);

        $request->validate([
            'description' => 'nullable|string',
            'address'     => 'nullable|string',
            'phone'       => 'nullable|string',
            'email'       => 'nullable|email',
            'copyright'   => 'nullable|string',
            'link_name'   => 'array',
            'link_url'    => 'array',
            'social_name' => 'array',
            'social_link' => 'array',
            'social_icon' => 'array',
        ]);

        $links = [];
        if ($request->link_name && $request->link_url) {
            foreach ($request->link_name as $i => $name) {
                if (! empty($name) && ! empty($request->link_url[$i])) {
                    $links[$name] = $request->link_url[$i];
                }
            }
        }

        $social_links = [];
        if ($request->social_name && $request->social_link && $request->social_icon) {
            foreach ($request->social_name as $i => $name) {
                $link = $request->social_link[$i] ?? null;
                $icon = $request->social_icon[$i] ?? null;

                if (! empty($name) && ! empty($link) && ! empty($icon)) {
                    $social_links[] = [
                        'name' => $name,
                        'link' => $link,
                        'icon' => $icon,
                    ];
                }
            }
        }

        $footer->description  = $request->description;
        $footer->address      = $request->address;
        $footer->phone        = $request->phone;
        $footer->email        = $request->email;
        $footer->copyright    = $request->copyright;
        $footer->links        = $links;
        $footer->social_links = $social_links;
        $footer->save();

        return response()->json([
            'status_code' => 1,
            'message'     => 'Footer settings updated successfully.',
        ]);
    }

}
