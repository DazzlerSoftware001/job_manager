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
        $menuItems  = $request->input('menu_items', []);
        $duplicates = [];

        foreach ($menuItems as $item) {
            if (isset($item['selected']) && $item['selected']) {
                $customPage = CustomPage::where('title', $item['title'])->first();

                $exists = DB::table('menu_items')
                    ->where('title', $item['title'])
                    ->orWhere(function ($query) use ($customPage) {
                        if ($customPage) {
                            $query->where('custom_page_id', $customPage->id);
                        }
                    })
                    ->exists();

                if ($exists) {
                    $duplicates[] = $item['title'];
                    continue;
                }

                DB::table('menu_items')->insert([
                    'custom_page_id' => $customPage->id ?? null,
                    'title'          => $item['title'],
                    'type'           => 'page',
                    'url'            => $item['url'],
                    'parent_id'      => null,
                    'order'          => 0,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
        }

        // Return JSON only, not redirect
        if (! empty($duplicates)) {
            return response()->json([
                'status_code' => 2,
                'message'     => 'Some items were skipped (already added): ' . implode(', ', $duplicates),
            ]);
        }

        return response()->json([
            'status_code' => 1,
            'message'     => 'Menu items added successfully.',
        ]);
    }

    public function delete($id)
{
    $this->deleteWithChildren($id);

    if (request()->ajax()) {
        return response()->json(['status' => 'success']);
    }

    return redirect()->back()->with('success', 'Menu item and its children deleted successfully.');
}

private function deleteWithChildren($id)
{
    $children = DB::table('menu_items')->where('parent_id', $id)->pluck('id');

    foreach ($children as $childId) {
        $this->deleteWithChildren($childId);
    }

    DB::table('menu_items')->where('id', $id)->delete();
}


}
