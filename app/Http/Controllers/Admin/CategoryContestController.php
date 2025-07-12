<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\CategoryContest;
use Yajra\DataTables\Facades\DataTables;

class CategoryContestController extends Controller
{
    public function index()
    {
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('pages.admin.contest-category.index',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|numeric'
        ]);

        CategoryContest::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return redirect()
                    ->route('contest-category.index')
                    ->with('success', 'Sukses! 1 Kategori Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = CategoryContest::findOrFail($id);
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();

        return view('pages.admin.contest-category.edit',[
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

        CategoryContest::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'parent_id' => $request->parent_id
                ]);

        return redirect()
                    ->route('contest-category.index')
                    ->with('success', 'Sukses! 1 Kategori telah diperbarui');
    }

    public function destroy($id)
    {
        $item = CategoryContest::findorFail($id);
        $item->delete();

        return redirect()
                ->route('contest-category.index')
                ->with('success', 'Sukses! 1 Kategori telah dihapus');
    }
}
