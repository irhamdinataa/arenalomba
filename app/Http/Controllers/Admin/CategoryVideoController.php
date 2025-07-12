<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\CategoryVideo;
use Yajra\DataTables\Facades\DataTables;

class CategoryVideoController extends Controller
{
    public function index()
    {
        $categories = CategoryVideo::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('pages.admin.video-category.index',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|numeric'
        ]);

        CategoryVideo::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return redirect()
                    ->route('video-category.index')
                    ->with('success', 'Sukses! 1 Kategori Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = CategoryVideo::findOrFail($id);
        $categories = CategoryVideo::where('parent_id', null)->orderby('name', 'asc')->get();

        return view('pages.admin.video-category.edit',[
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|numeric'
        ]);

        CategoryVideo::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'parent_id' => $request->parent_id
                ]);

        return redirect()
                    ->route('video-category.index')
                    ->with('success', 'Sukses! 1 Kategori telah diperbarui');
    }

    public function destroy($id)
    {
        $item = CategoryVideo::findorFail($id);
        $item->delete();

        return redirect()
                ->route('video-category.index')
                ->with('success', 'Sukses! 1 Kategori telah dihapus');
    }
}
