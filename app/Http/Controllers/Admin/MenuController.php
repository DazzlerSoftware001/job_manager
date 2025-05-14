<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    // public function menu()
    // {
    //     $menuItems = DB::table('menu_items')->orderBy('order')->get();
    //     $custom = CustomPage::get();
    //     dd($custom);
    //     return view('admin.settings.menu', compact('menuItems'));
    // }
    public function menu()
    {
        $menuItems   = DB::table('menu_items')->orderBy('order')->get();
        $customPages = CustomPage::get();
        return view('admin.settings.menu', compact('menuItems', 'customPages'));
    }

    public function save(Request $request)
    {
        $items = $request->input('order'); // match JS key
        $this->saveOrder($items, null);

        return response()->json(['status' => 'success']);
    }

    private function saveOrder($items, $parentId)
    {
        foreach ($items as $index => $item) {
            DB::table('menu_items')
                ->where('id', $item['id'])
                ->update([
                    'order'     => $index,
                    'parent_id' => $parentId,
                ]);

            if (! empty($item['children'])) {
                $this->saveOrder($item['children'], $item['id']);
            }
        }
    }

    public function add(Request $request)
    {
        $menuItems = $request->input('menu_items', []);

        foreach ($menuItems as $item) {
            if (isset($item['selected']) && $item['selected']) {
                DB::table('menu_items')->insert([
                    'title'      => $item['title'],
                    'type'       => 'page',
                    'url'        => $item['url'],
                    'parent_id'  => null,
                    'order'      => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Menu items added successfully.');
    }

}
