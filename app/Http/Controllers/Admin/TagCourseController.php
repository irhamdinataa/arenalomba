<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\TagCourse;

use Yajra\DataTables\Facades\DataTables;

class TagCourseController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = TagCourse::latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('course-tag.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('course-tag.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.admin.course-tag.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);

        TagCourse::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()
                    ->route('course-tag.index')
                    ->with('success', 'Sukses! Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = TagCourse::findOrFail($id);

        return view('pages.admin.course-tag.edit',[
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        TagCourse::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                ]);

        return redirect()
                    ->route('course-tag.index')
                    ->with('success', 'Sukses! 1 Data telah diperbarui');
    }

    public function destroy($id)
    {
        $item = TagCourse::findorFail($id);
        $item->delete();

        return redirect()
                ->route('course-tag.index')
                ->with('success', 'Sukses! 1 Data telah dihapus');
    }
}
