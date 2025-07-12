<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\CategoryCourse;
use Yajra\DataTables\Facades\DataTables;

class CategoryCourseController extends Controller
{
    public function index()
    {
        $categories = CategoryCourse::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('pages.admin.course-category.index',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|numeric'
        ]);

        CategoryCourse::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id
        ]);

        return redirect()
                    ->route('course-category.index')
                    ->with('success', 'Sukses! 1 Kategori Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = CategoryCourse::findOrFail($id);
        $categories = CategoryCourse::where('parent_id', null)->orderby('name', 'asc')->get();

        return view('pages.admin.course-category.edit',[
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

        CategoryCourse::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'parent_id' => $request->parent_id
                ]);

        return redirect()
                    ->route('course-category.index')
                    ->with('success', 'Sukses! 1 Kategori telah diperbarui');
    }

    public function destroy($id)
    {
        $item = CategoryCourse::findorFail($id);
        $item->delete();

        return redirect()
                ->route('course-category.index')
                ->with('success', 'Sukses! 1 Kategori telah dihapus');
    }
}
