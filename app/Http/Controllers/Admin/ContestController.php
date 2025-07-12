<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContestRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\TagContest;
use App\Models\Contest;
use App\Models\ContestRequesta;
use App\Models\CategoryContest;
use App\Models\Location;
use App\Models\Participant;
use App\Models\ParticipantRequest;

use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ContestController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
                $query = Contest::with(['user','category'])->latest()->get();
            }else{
                $query = Contest::where('users_id', Auth::user()->id)->with(['user','category'])->latest()->get();
            }    

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('contest-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('contest.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('contest.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('contest.edit', $item->id) . '">
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
            $all = Contest::count();
            $published = Contest::where('post_status','Published')->count();
            $draft = Contest::where('post_status','Draft')->count();
            $trash = Contest::onlyTrashed()->count();
        }else{
            $all = Contest::where('users_id', Auth::user()->id)->count();
            $published = Contest::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Contest::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Contest::onlyTrashed()->count();
        }

        return view('pages.admin.contest.index',[
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
                $query = Contest::where('post_status','Published')->with(['user','category'])->latest()->get();
            }else{
                $query = Contest::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }    
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('contest-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('contest.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('contest.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('contest.edit', $item->id) . '">
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
            $all = Contest::count();
            $published = Contest::where('post_status','Published')->count();
            $draft = Contest::where('post_status','Draft')->count();
            $trash = Contest::onlyTrashed()->count();
        }else{
            $all = Contest::where('users_id', Auth::user()->id)->count();
            $published = Contest::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Contest::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Contest::onlyTrashed()->count();
        }

        return view('pages.admin.contest.index',[
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
                $query = Contest::where('post_status','Draft')->with(['user','category'])->latest()->get();
            }else{
                $query = Contest::where(['post_status' => 'Draft', 'users_id' => Auth::user()->id])->with(['user','category'])->latest()->get();
            }

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return Auth::user()->roles == 'Administrator'? '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                <a class="dropdown-item" href="' . route('contest-detail', $item->slug) . '" target="_blank">Detail</a>
                                <a class="dropdown-item" href="' . route('contest.edit', $item->id) . '">Ubah</a>
                                <form action="' . route('contest.destroy', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                     Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    ':'
                        <a class="btn btn-primary btn-xs" href="' . route('contest.edit', $item->id) . '">
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
            $all = Contest::count();
            $published = Contest::where('post_status','Published')->count();
            $draft = Contest::where('post_status','Draft')->count();
            $trash = Contest::onlyTrashed()->count();
        }else{
            $all = Contest::where('users_id', Auth::user()->id)->count();
            $published = Contest::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->count();
            $draft = Contest::where(['post_status'=>'Draft', 'users_id' => Auth::user()->id])->count();
            $trash = Contest::onlyTrashed()->count();
        }

        return view('pages.admin.contest.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function trash()
    {
        if (request()->ajax()) {
            $query = Contest::onlyTrashed()->with(['user','category'])->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-xs" href="' . route('contest-restore', $item->id) . '">
                            <i class="fas fa-sync"></i> &nbsp; Kembalikan
                        </a>
                        <form action="' . route('contest-force-delete', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini secara permanen dari situs anda?'".')">
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

        $all = Contest::count();
        $published = Contest::where('post_status','Published')->count();
        $draft = Contest::where('post_status','Draft')->count();
        $trash = Contest::onlyTrashed()->count();

        return view('pages.admin.contest.index',[
            'all' => $all,
            'published' => $published,
            'draft' => $draft,
            'trash' => $trash
        ]);
    }

    public function create()
    {
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        $tags = TagContest::all();
        $provinces = Location::where('type', 'province')->orderBy('name','asc')->get();

        return view('pages.admin.contest.create',[
            'categories' => $categories,
            'tags' => $tags,
            'provinces' => $provinces,
        ]);
    }

    public function store(ContestRequest $request)
    {
        $validatedData = $request->all();

        $validatedData['price'] =  (integer)str_replace(['Rp. ', '.',','], '', $request->input('price'));

        $content = $request->post_content;

        $validatedData['post_content'] = $content;
        $validatedData['post_teaser'] = Str::limit(strip_tags($request->post_teaser), 140);

        if($request->file('post_image')){
            
            $image = $request->file('post_image');
            $path = $image->hashName('assets/post-contest');

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

        while (Contest::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $validatedData['slug'] = $slug;

        //update Contest Request
        if ($request->is_request == 'YA') {
            $cr = ContestRequesta::findOrFail($request->id_request);
            $cr->is_approve = 'Diterima';
            $cr->update();

            $validatedData['post_image'] = $cr->post_image;
        }

        $post = Contest::create($validatedData);

        $post->tag()->attach($request->tags);

        //insert participant
        $post_id = $post->id;
        $participant = $request->participant;

        if (!empty(array_filter($participant, 'strlen'))) {

            $insert_data = [];
            for ($count = 0; $count < count($participant); $count++) {
                if (!empty($participant[$count])) {
                    $data_ac = array(
                        'contest_id' => $post_id,
                        'name' => $request->participant[$count],
                    );
                    $insert_data[] = $data_ac;
                }
            }

            Participant::insert($insert_data);
        }

        return redirect()
                    ->route('contest.index')
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $item = Contest::findOrFail($id);
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        $sub_categories = CategoryContest::where('parent_id', $item->categories_id)->orderby('name', 'asc')->get();
        $tags = TagContest::all();
        $provinces = Location::where('type', 'province')->orderBy('name','asc')->get();

        $selectedParticipants = Participant::where('contest_id', $id)
                                            ->pluck('name') 
                                            ->toArray();  


        return view('pages.admin.contest.edit',[
            'item' => $item,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'tags' => $tags,
            'provinces' => $provinces,
            'selectedParticipants' => $selectedParticipants,
        ]);
    }

    public function update(ContestRequest $request, $id)
    {
        $validatedData = $request->all();

        $validatedData['price'] =  (integer)str_replace(['Rp. ', '.',','], '', $request->input('price'));

        $item = Contest::findOrFail($id);

        if($request->file('post_image')){
            Storage::delete($item->post_image);
            $image = $request->file('post_image');
            $path = $image->hashName('assets/post-contest');

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
            Contest::where('slug', $slug)
                ->where('id', '!=', $id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $item->update($validatedData);

        $item->tag()->sync($request->tags);

        $submitted = collect($request->participant ?? []);
        $existing = Participant::where('contest_id', $id)->pluck('name');

        $toInsert = $submitted->diff($existing);
        $toDelete = $existing->diff($submitted);

        foreach ($toInsert as $name) {
            Participant::create(['contest_id' => $id, 'name' => $name]);
        }

        Participant::where('contest_id', $id)
            ->whereIn('name', $toDelete)
            ->delete();

        return redirect()
                    ->route('contest.edit',$item->id)
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Contest::findorFail($id);

        $item->delete();

        return redirect()
                    ->route('contest.index')
                    ->with('success', 'Sukses! Artikel Berhasil Dihapus');
    }

    public function force_delete($id)
    {
        $item = Contest::onlyTrashed()->findOrFail($id);

        Storage::delete($item->post_image); 
        
        $item->forceDelete();

        return redirect()
                    ->route('contest-trash')
                    ->with('success', 'Sukses! 1 Artikel dihapus secara permanen.');
    }

    public function restore_data($id)
    {
        Contest::withTrashed()->find($id)->restore();

        return redirect()
                    ->route('contest-trash')
                    ->with('success', 'Sukses! 1 Artikel berhasil dikembalikan dari sampah.');
    }

    public function get_sub_categories(Request $request)
    {
        $parent_id = $request->cat_id;

        $subcategories = CategoryContest::where('id',$parent_id)
                          ->with('subcategory')
                          ->get();
        
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    public function contest_request()
    {
        if (request()->ajax()) {
            $query = ContestRequesta::with(['user','category'])->latest()->get();    

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    $editLink = '';
                    $deleteLink = '';

                    if ($item->is_approve == 'Menunggu Proses') {
                        $editLink = '<a class="dropdown-item" href="' . route('contest-request-edit', $item->id) . '">Detail</a>';
                    }

                    $deleteLink = '
                        <form action="' . route('contest-request-delete', $item->id) . '" method="POST" id="deleteForm'.$item->id.'">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="dropdown-item btn-delete" data-form-id="deleteForm'.$item->id.'">
                                Hapus
                            </button>
                        </form>
                    ';

                    return '
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" id="dropdownFadeInUp" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-cog"></i></button>
                            <div class="dropdown-menu animated--fade-in-up" aria-labelledby="dropdownFadeInUp">
                                '.$editLink.'
                                '.$deleteLink.'
                            </div>
                        </div>
                    ';
                })
                ->editColumn('is_approve', function ($item) {
                    if ($item->is_approve == 'Menunggu Proses') {
                        $status = '<span class="badge rounded-pill bg-warning text-dark">Menunggu Proses</span>';
                    } elseif($item->is_approve == 'Diterima') {
                        $status = '<span class="badge rounded-pill bg-success">Diterima</span>';
                    }else{
                        $status = '<span class="badge rounded-pill bg-danger">Ditolak</span>';
                    }
                    
                   return $status;
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','is_approve'])
                ->make();
        }

        return view('pages.admin.contest.request');
    }

    public function edit_contest_request($id)
    {
        $item = ContestRequesta::findOrFail($id);
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        $sub_categories = CategoryContest::where('parent_id', $item->categories_id)->orderby('name', 'asc')->get();
        $tags = TagContest::all();

        $provinces = Location::where('type', 'province')->orderBy('name','asc')->get();

        $selectedParticipants = ParticipantRequest::where('contest_id', $id)
                                            ->pluck('name') 
                                            ->toArray(); 

        return view('pages.admin.contest.edit-request',[
            'item' => $item,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'tags' => $tags,
            'provinces' => $provinces,
            'selectedParticipants' => $selectedParticipants,
        ]);
    }

    public function delete_contest_request($id)
    {
        $item = ContestRequesta::findOrFail($id);

        Storage::delete($item->post_image); 
        
        $item->forceDelete();

        return redirect()
                    ->route('contest-request')
                    ->with('success', 'Sukses! 1 Artikel dihapus secara permanen.');
    }
}
