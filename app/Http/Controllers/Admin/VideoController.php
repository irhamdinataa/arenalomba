<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\TagVideo;
use App\Models\Video;
use App\Models\CategoryVideo;

use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
                $query = Video::with(['user','category'])->latest()->get();
            }else{
                $query = Video::where('users_id', Auth::user()->id)->with(['user','category'])->latest()->get();
            }    

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('video-home-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('video.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('video.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('video.edit', $item->id) . '">
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
            $all = Video::count();
            $published = Video::where('post_status','Published')->count();
            $draft = Video::where('post_status','Draft')->count();
            $trash = Video::onlyTrashed()->count();
        }else{
            $all = Video::where('users_id', Auth::user()->id)->count();
            $published = Video::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Video::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Video::onlyTrashed()->count();
        }

        return view('pages.admin.video.index',[
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
                $query = Video::where('post_status','Published')->with(['user','category'])->latest()->get();
            }else{
                $query = Video::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }    
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('video-home-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('video.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('video.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('video.edit', $item->id) . '">
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
            $all = Video::count();
            $published = Video::where('post_status','Published')->count();
            $draft = Video::where('post_status','Draft')->count();
            $trash = Video::onlyTrashed()->count();
        }else{
            $all = Video::where('users_id', Auth::user()->id)->count();
            $published = Video::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Video::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Video::onlyTrashed()->count();
        }

        return view('pages.admin.video.index',[
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
                $query = Video::where('post_status','Draft')->with(['user','category'])->latest()->get();
            }else{
                $query = Video::where(['post_status' => 'Draft', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('video-home-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('video.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('video.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('video.edit', $item->id) . '">
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
            $all = Video::count();
            $published = Video::where('post_status','Published')->count();
            $draft = Video::where('post_status','Draft')->count();
            $trash = Video::onlyTrashed()->count();
        }else{
            $all = Video::where('users_id', Auth::user()->id)->count();
            $published = Video::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Video::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Video::onlyTrashed()->count();
        }

        return view('pages.admin.video.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function trash()
    {
        if (request()->ajax()) {
            $query = Video::onlyTrashed()->with(['user','category'])->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-xs" href="' . route('video-restore', $item->id) . '">
                            <i class="fas fa-sync"></i> &nbsp; Kembalikan
                        </a>
                        <form action="' . route('video-force-delete', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
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

        $all = Video::count();
        $published = Video::where('post_status','Published')->count();
        $draft = Video::where('post_status','Draft')->count();
        $trash = Video::onlyTrashed()->count();

        return view('pages.admin.video.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function create()
    {
        $categories = CategoryVideo::where('parent_id', null)->orderby('name', 'asc')->get();
        $tags = TagVideo::all();

        return view('pages.admin.video.create',[
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(VideoRequest $request)
    {
        $validatedData = $request->all();

        $validatedData['post_content'] = $request->post_content;
        $validatedData['post_status'] = $request->publish ? 'Published' : 'Draft';
        $validatedData['published_at'] = $request->published_at ? $request->published_at : date('Y-m-d H:i:s');
        $validatedData['users_id'] = auth()->user()->id;

        //slug
        $slug = Str::slug($request->post_title);
        $originalSlug = $slug;
        $counter = 1;

        while (Video::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validatedData['slug'] = $slug;

        $post = Video::create($validatedData);

        $post->tag()->attach($request->tags);

        return redirect()
                    ->route('video.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = Video::findOrFail($id);
        $categories = CategoryVideo::where('parent_id', null)->orderby('name', 'asc')->get();
        $sub_categories = CategoryVideo::where('parent_id', $item->categories_id)->orderby('name', 'asc')->get();
        $tags = TagVideo::all();

        return view('pages.admin.video.edit',[
            'item' => $item,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'tags' => $tags,
        ]);
    }

    public function update(VideoRequest $request, $id)
    {
        $validatedData = $request->all();

        $item = Video::findOrFail($id);

        $validatedData['post_status'] = $request->publish ? 'Published' : 'Draft';
        $validatedData['published_at'] = $request->published_at;
        //slug
        $slug = Str::slug($request->post_title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Video::where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validatedData['slug'] = $slug;

        $item->update($validatedData);

        $item->tag()->sync($request->tags);

        return redirect()
                    ->route('video.edit',$item->id)
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Video::findorFail($id);

        $item->delete();

        return redirect()
                    ->route('video.index')
                    ->with('success', 'Sukses! Artikel Berhasil Dihapus');
    }

    public function force_delete($id)
    {
        $item = Video::onlyTrashed()->findOrFail($id);
        
        $item->forceDelete();

        return redirect()
                    ->route('video-trash')
                    ->with('success', 'Sukses! 1 Artikel dihapus secara permanen.');
    }

    public function restore_data($id)
    {
        Video::withTrashed()->find($id)->restore();

        return redirect()
                    ->route('video-trash')
                    ->with('success', 'Sukses! 1 Artikel berhasil dikembalikan dari sampah.');
    }

    public function get_sub_categories(Request $request)
    {
        $parent_id = $request->cat_id;

        $subcategories = CategoryVideo::where('id',$parent_id)
                          ->with('subcategory')
                          ->get();
        
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
}
