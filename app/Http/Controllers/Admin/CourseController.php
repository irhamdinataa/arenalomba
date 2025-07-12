<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\TagCourse;
use App\Models\Course;
use App\Models\CategoryCourse;

use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
                $query = Course::with(['user','category'])->latest()->get();
            }else{
                $query = Course::where('users_id', Auth::user()->id)->with(['user','category'])->latest()->get();
            }    

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('kelas-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('course.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('course.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('course.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
            $all = Course::count();
            $published = Course::where('post_status','Published')->count();
            $draft = Course::where('post_status','Draft')->count();
            $trash = Course::onlyTrashed()->count();
        }else{
            $all = Course::where('users_id', Auth::user()->id)->count();
            $published = Course::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Course::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Course::onlyTrashed()->count();
        }

        return view('pages.admin.course.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function published()
    {
        if (request()->ajax()) {
            if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
                $query = Course::where('post_status','Published')->with(['user','category'])->latest()->get();
            }else{
                $query = Course::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }    
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('kelas-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('course.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('course.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('course.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
            $all = Course::count();
            $published = Course::where('post_status','Published')->count();
            $draft = Course::where('post_status','Draft')->count();
            $trash = Course::onlyTrashed()->count();
        }else{
            $all = Course::where('users_id', Auth::user()->id)->count();
            $published = Course::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Course::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Course::onlyTrashed()->count();
        }

        return view('pages.admin.course.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function draft()
    {
        if (request()->ajax()) {
            if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
                $query = Course::where('post_status','Draft')->with(['user','category'])->latest()->get();
            }else{
                $query = Course::where(['post_status' => 'Draft', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('kelas-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('course.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('course.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('course.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
            $all = Course::count();
            $published = Course::where('post_status','Published')->count();
            $draft = Course::where('post_status','Draft')->count();
            $trash = Course::onlyTrashed()->count();
        }else{
            $all = Course::where('users_id', Auth::user()->id)->count();
            $published = Course::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Course::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Course::onlyTrashed()->count();
        }

        return view('pages.admin.course.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function trash()
    {
        if (request()->ajax()) {
            $query = Course::onlyTrashed()->with(['user','category'])->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-xs" href="' . route('course-restore', $item->id) . '">
                            <i class="fas fa-sync"></i> &nbsp; Kembalikan
                        </a>
                        <form action="' . route('course-force-delete', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus Permanen
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        $all = Course::count();
        $published = Course::where('post_status','Published')->count();
        $draft = Course::where('post_status','Draft')->count();
        $trash = Course::onlyTrashed()->count();

        return view('pages.admin.course.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function create()
    {
        $categories = CategoryCourse::where('parent_id', null)->orderby('name', 'asc')->get();
        $tags = TagCourse::all();

        return view('pages.admin.course.create',[
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(CourseRequest $request)
    {
        $validatedData = $request->all();

        $validatedData['price'] =  (integer)str_replace(['Rp. ', '.',','], '', $request->input('price'));

        $content = $request->post_content;

        $validatedData['post_content'] = $content;
        $validatedData['post_teaser'] = Str::limit(strip_tags($request->post_teaser), 140);

        if($request->file('post_image')){
            
            $image = $request->file('post_image');
            $path = $image->hashName('assets/post-course');

            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(1200,675);

            Storage::put($path, (string) $image_resize->encode());

            $validatedData['post_image'] = $path;
        }

        $validatedData['post_status'] = $request->publish ? 'Published' : 'Draft';
        $validatedData['published_at'] = $request->published_at ? $request->published_at : date('Y-m-d H:i:s');
        $validatedData['users_id'] = auth()->user()->id;
        //slug
        $slug = Str::slug($request->post_title);
        $originalSlug = $slug;
        $counter = 1;

        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validatedData['slug'] = $slug;

        $post = Course::create($validatedData);

        $post->tag()->attach($request->tags);

        return redirect()
                    ->route('course.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = Course::findOrFail($id);
        $categories = CategoryCourse::where('parent_id', null)->orderby('name', 'asc')->get();
        $sub_categories = CategoryCourse::where('parent_id', $item->categories_id)->orderby('name', 'asc')->get();
        $tags = TagCourse::all();

        return view('pages.admin.course.edit',[
            'item' => $item,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'tags' => $tags,
        ]);
    }

    public function update(CourseRequest $request, $id)
    {
        $validatedData = $request->all();

        $validatedData['price'] =  (integer)str_replace(['Rp. ', '.',','], '', $request->input('price'));

        $item = Course::findOrFail($id);

        if($request->file('post_image')){
            Storage::delete($item->post_image);
            $image = $request->file('post_image');
            $path = $image->hashName('assets/post-course');

            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(1200,675);

            Storage::put($path, (string) $image_resize->encode());

            $validatedData['post_image'] = $path;
        }

        $validatedData['post_status'] = $request->publish ? 'Published' : 'Draft';
        $validatedData['published_at'] = $request->published_at;
        $validatedData['post_teaser'] = Str::limit(strip_tags($request->post_teaser), 140);

        //slug
        $slug = Str::slug($request->post_title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Course::where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validatedData['slug'] = $slug;

        $item->update($validatedData);

        $item->tag()->sync($request->tags);

        return redirect()
                    ->route('course.edit',$item->id)
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Course::findorFail($id);

        $item->delete();

        return redirect()
                    ->route('course.index')
                    ->with('success', 'Sukses! Artikel Berhasil Dihapus');
    }

    public function force_delete($id)
    {
        $item = Course::onlyTrashed()->findOrFail($id);

        Storage::delete($item->post_image); 
        
        $item->forceDelete();

        return redirect()
                    ->route('course-trash')
                    ->with('success', 'Sukses! 1 Artikel dihapus secara permanen.');
    }

    public function restore_data($id)
    {
        Course::withTrashed()->find($id)->restore();

        return redirect()
                    ->route('course-trash')
                    ->with('success', 'Sukses! 1 Artikel berhasil dikembalikan dari sampah.');
    }

    public function get_sub_categories(Request $request)
    {
        $parent_id = $request->cat_id;

        $subcategories = CategoryCourse::where('id',$parent_id)
                          ->with('subcategory')
                          ->get();
        
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
}
