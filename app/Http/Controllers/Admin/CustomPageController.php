<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPage;

class CustomPageController extends Controller
{
    public function PageSettings()
    {
        $pages = CustomPage::all();
        return view('admin.Settings.PageSetting', compact('pages'));
    }

    public function CreatePage()
    {
        return view('admin.Settings.CreatePage');
    }

    public function InsertPage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:custom_pages',
            'content' => 'required',
        ]);

        CustomPage::create($request->all());

        return redirect()->route('Admin.PageSettings')->with('success', 'Page created successfully.');
    }

    public function EditPage($id)
    {
        $page = CustomPage::findOrFail($id);
        return view('admin.Settings.EditPage', compact('page'));
    }

    public function UpdatePage(Request $request, $id)
    {
        $page = CustomPage::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:custom_pages,slug,' . $page->id,
            'content' => 'required',
        ]);

        $page->update($request->all());

        return redirect()->route('Admin.PageSettings')->with('success', 'Page updated successfully.');
    }

    public function DeletePage($id)
    {
        $page = CustomPage::findOrFail($id);
        $page->delete();

        return redirect()->route('Admin.PageSettings')->with('success', 'Page deleted successfully.');
    }

    public function ViewPage($slug)
    {
        $page = CustomPage::where('slug', $slug)->firstOrFail();

        return view('admin.Settings.ViewPage', compact('page'));
    }

}
