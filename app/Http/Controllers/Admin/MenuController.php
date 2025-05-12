<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    public function menu()
    {
        $menuItems = DB::table('menu_items')->orderBy('order')->get();
        return view('admin.settings.menu', compact('menuItems'));
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
                    'order' => $index,
                    'parent_id' => $parentId,
                ]);

            if (!empty($item['children'])) {
                $this->saveOrder($item['children'], $item['id']);
            }
        }
    }
}
