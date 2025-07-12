<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContestReqRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\PostTag;
use App\Models\Tag;

use App\Models\Contest;
use App\Models\CategoryContest;
use App\Models\TagContest;
use App\Models\ContestTag;
use App\Models\ContestRequesta;

use App\Models\Course;
use App\Models\CategoryCourse;
use App\Models\TagCourse;
use App\Models\CourseTag;

use App\Models\Video;
use App\Models\CategoryVideo;
use App\Models\TagVideo;

use App\Models\Location;
use App\Models\ParticipantRequest;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //Artikel
        $post = Post::with(['user','category'])->where([
            ['post_status','=', 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(4);

        $contest = Contest::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();

        $courses = Course::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(8)->latest()->get();

        $videos = Video::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(7)->latest()->get();

        return view('pages.home.index',[
            'post' => $post,
            'contest' => $contest,
            'courses' => $courses,
            'videos' => $videos,
        ]);
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        $posts = Post::select('post_title', 'slug')
            ->where('post_title', 'LIKE', '%' . $query . '%')
            ->where('post_status', 'Published')
            ->where('published_at', '<', now())
            ->take(5)
            ->get();

        $results = $posts->map(function ($post) {
            return [
                'value' => $post->post_title, 
                'slug' => $post->slug,       
            ];
        });

        return response()->json($results);
    }

    public function searchArticle(Request $request)
    {
        $post = Post::with(['user','category'])
                        ->where('post_title', $request->keyword)
                        ->orWhere('post_title', 'like','%'.$request->keyword.'%')
                        ->paginate(6);
        $count = Post::with(['user','category'])->where('post_title', $request->keyword)->orWhere('post_title', 'like','%'.$request->keyword.'%')->count();
        $latest_post = Post::with(['user','category'])->where([
                            ['post_status','=', 'Published'],
                            ['published_at','<', now()],
                        ])->take(6)->latest()->get();

        return view('pages.home.search',[
            'post' => $post,
            'keyword' => $request->keyword,
            'count' => $count,
            'latest_post' => $latest_post
        ]);

    }

    public function detail($slug)
    {
        $post = Post::with(['user','category'])->where('slug',$slug)->firstOrFail();
        
        $latest_post = Post::with(['user','category'])->where([
            ['post_status','=', 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();
        $related_post = Post::with(['user','category'])->where([
            ['users_id','=', $post->users_id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(3)->latest()->get();

        if ($post->sub_categories != NULL) {
            $sc = Category::where('id', $post->sub_categories)->firstOrFail();
        }else{
            $sc = '';   
        }

        return view('pages.home.detail',[
            'post' => $post,
            'sc' => $sc,
            'latest_post' => $latest_post,
            'related_post' => $related_post
        ]);
    }

    public function homeCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $post = Post::with(['user','category'])->where([
            ['categories_id','=', $category->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->orWhere('sub_categories', '=', $category->id)
        ->latest()->paginate(6);

        $latest_post = Post::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.category',[
            'category' => $category,
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function homeTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();        
        
        $post_tag = DB::table('post_tag')
            ->join('posts', 'post_tag.post_id', '=', 'posts.id')
            ->join('categories', 'posts.categories_id', '=', 'categories.id')
            ->join('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->join('users', 'posts.users_id', '=', 'users.id')
            ->select('posts.post_title', 'posts.post_teaser', 'posts.post_image', 'posts.slug', 'posts.published_at', 'categories.name as category', 'categories.slug as category_slug', 'tags.name', 'users.name as author')
            ->where('post_tag.tag_id', $tag->id)
            ->where('posts.published_at','<', now())
            ->get();

        $latest_post = Post::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
        
        return view('pages.home.tag',[
            'tag' => $tag,
            'post_tag' => $post_tag,
            'latest_post' => $latest_post,
        ]);
    }

    public function author($id)
    {
        $user = User::findOrFail($id);

        $post = Post::with(['user','category'])->where([
            ['users_id','=', $user->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(10);

        $latest_post = Post::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();

        $contest = Contest::with(['user','category'])->where([
            ['users_id','=', $user->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(10);

        $course = Course::with(['user','category'])->where([
            ['users_id','=', $user->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(10);
        
        return view('pages.home.author',[
            'user' => $user,
            'latest_post' => $latest_post,
            'post' => $post,
            'contest' => $contest,
            'course' => $course,
        ]);
    }

    //Info Lomba
    public function lomba(Request $request)
    {
        if ($request->has('search')) {
            $keyword = $request->keyword;
            $participant = $request->participant;
            $location = $request->location;
            $categories_id = $request->categories_id;
            $payment = $request->payment;
            $status = $request->status;

            $query = Contest::with(['user','category','participants']);

            if ($keyword) {
                $query->where('post_title', 'like', '%' . $keyword . '%');
            }

            if ($participant != 'all') {
                $query->whereHas('participants', function ($q) use ($participant) {
                    $q->where('name', $participant);
                });
            }

            if ($location != 'all') {
                $query->where('location', $location);
            }

            if ($categories_id != 'all') {
                $query->where('categories_id', $categories_id);
            }

            if (!empty($payment)) {
                $query->whereIn('payment', $payment);
            }

            if (!empty($status)) {
                $query->whereIn('status', $status);
            }

            $query->where('post_status','Published');
            $query->where('published_at','<', now());

            $post = $query->latest()->paginate(6);

        } else {
            $post = Contest::with(['user','category'])->where([
                ['post_status','=' , 'Published'],
                ['published_at','<', now()],
            ])->latest()->paginate(6);
        }

        $latest_post = Contest::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();

        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        $provinces = Location::where('type', 'province')->orderBy('name','asc')->get();
    
        return view('pages.home.lomba.index',[
            'title' => 'Info Lomba',
            'post' => $post,
            'latest_post' => $latest_post,
            'categories' => $categories,
            'provinces' => $provinces,
        ]);
    }

    public function detail_contest($slug)
    {
        $post = Contest::with(['user','category','participants'])->where('slug',$slug)->firstOrFail();
        
        $latest_post = Contest::with(['user','category'])->where([
            ['post_status','=', 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();

        $related_post = Contest::with(['user','category'])->where([
            ['users_id','=', $post->users_id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(3)->latest()->get();

        if ($post->sub_categories != NULL) {
            $sc = CategoryContest::where('id', $post->sub_categories)->firstOrFail();
        }else{
            $sc = '';   
        }

        

        return view('pages.home.detail-contest',[
            'post' => $post,
            'sc' => $sc,
            'latest_post' => $latest_post,
            'related_post' => $related_post,
        ]);
    }

    public function contest_category($slug)
    {
        $category = CategoryContest::where('slug', $slug)->firstOrFail();
        
        $post = Contest::with(['user','category'])->where([
            ['categories_id','=', $category->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->orWhere('sub_categories', '=', $category->id)
        ->latest()->paginate(6);

        $latest_post = Contest::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.lomba.category',[
            'category' => $category,
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function contest_tag($slug)
    {
        $tag = TagContest::where('slug', $slug)->firstOrFail();        
        
        $contest_tag_contest = DB::table('contest_tag_contest')
            ->join('contest', 'contest_tag_contest.contest_id', '=', 'contest.id')
            ->join('category_contest', 'contest.categories_id', '=', 'category_contest.id')
            ->join('tag_contest', 'contest_tag_contest.tag_contest_id', '=', 'tag_contest.id')
            ->join('users', 'contest.users_id', '=', 'users.id')
            ->select('contest.post_title', 'contest.post_teaser', 'contest.post_image', 'contest.slug', 'contest.published_at', 'category_contest.name as category', 'category_contest.slug as category_slug', 'tag_contest.name', 'users.name as author')
            ->where('contest_tag_contest.tag_contest_id', $tag->id)
            ->where('contest.published_at','<', now())
            ->get();

        $latest_post = Contest::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
        
        return view('pages.home.lomba.tag',[
            'tag' => $tag,
            'contest_tag_contest' => $contest_tag_contest,
            'latest_post' => $latest_post,
        ]);
    }

    //kelas
    public function kelas()
    {
        $post = Course::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(6);

        $latest_post = Course::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.kelas.index',[
            'title' => 'Info Kelas',
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function detail_kelas($slug)
    {
        $post = Course::with(['user','category'])->where('slug',$slug)->firstOrFail();
        
        $latest_post = Course::with(['user','category'])->where([
            ['post_status','=', 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();

        $related_post = Course::with(['user','category'])->where([
            ['users_id','=', $post->users_id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(3)->latest()->get();

        if ($post->sub_categories != NULL) {
            $sc = CategoryCourse::where('id', $post->sub_categories)->firstOrFail();
        }else{
            $sc = '';   
        }

        return view('pages.home.kelas.detail',[
            'post' => $post,
            'sc' => $sc,
            'latest_post' => $latest_post,
            'related_post' => $related_post
        ]);
    }

    public function course_tag($slug)
    {
        $tag = TagCourse::where('slug', $slug)->firstOrFail();        
        
        $course_tag_course = DB::table('course_tag_course')
            ->join('courses as course', 'course_tag_course.course_id', '=', 'course.id')
            ->join('category_course', 'course.categories_id', '=', 'category_course.id')
            ->join('tag_course', 'course_tag_course.tag_course_id', '=', 'tag_course.id')
            ->join('users', 'course.users_id', '=', 'users.id')
            ->select('course.post_title', 'course.post_teaser', 'course.post_image', 'course.slug', 'course.published_at', 'category_course.name as category', 'category_course.slug as category_slug', 'tag_course.name', 'users.name as author')
            ->where('course_tag_course.tag_course_id', $tag->id)
            ->where('course.published_at','<', now())
            ->get();

        $latest_post = Course::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
        
        return view('pages.home.kelas.tag',[
            'tag' => $tag,
            'course_tag_course' => $course_tag_course,
            'latest_post' => $latest_post,
        ]);
    }

    //Video
    public function video()
    {
        $post = Video::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(6);

        $latest_post = Video::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.video.index',[
            'title' => 'Video',
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function detail_video($slug)
    {
        $post = Video::with(['user','category'])->where('slug',$slug)->firstOrFail();
        
        $latest_post = Video::with(['user','category'])->where([
            ['post_status','=', 'Published'],
            ['published_at','<', now()],
        ])->take(6)->latest()->get();

        $related_post = Video::with(['user','category'])->where([
            ['users_id','=', $post->users_id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(3)->latest()->get();

        if ($post->sub_categories != NULL) {
            $sc = CategoryVideo::where('id', $post->sub_categories)->firstOrFail();
        }else{
            $sc = '';   
        }

        return view('pages.home.video.detail',[
            'post' => $post,
            'sc' => $sc,
            'latest_post' => $latest_post,
            'related_post' => $related_post
        ]);
    }

    public function video_category($slug)
    {
        $category = CategoryVideo::where('slug', $slug)->firstOrFail();
        
        $post = Video::with(['user','category'])->where([
            ['categories_id','=', $category->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->orWhere('sub_categories', '=', $category->id)
        ->latest()->paginate(6);

        $latest_post = Video::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.video.category',[
            'category' => $category,
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function video_tag($slug)
    {
        $tag = TagVideo::where('slug', $slug)->firstOrFail();        
        
        $tag_video_video = DB::table('tag_video_video')
            ->join('videos as video', 'tag_video_video.video_id', '=', 'video.id')
            ->join('category_video', 'video.categories_id', '=', 'category_video.id')
            ->join('tag_video', 'tag_video_video.tag_video_id', '=', 'tag_video.id')
            ->join('users', 'video.users_id', '=', 'users.id')
            ->select('video.post_title', 'video.embed_link', 'video.slug', 'video.published_at', 'category_video.name as category', 'category_video.slug as category_slug', 'tag_video.name', 'users.name as author')
            ->where('tag_video_video.tag_video_id', $tag->id)
            ->where('video.published_at','<', now())
            ->get();

        $latest_post = Video::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
        
        return view('pages.home.video.tag',[
            'tag' => $tag,
            'tag_video_video' => $tag_video_video,
            'latest_post' => $latest_post,
        ]);
    }

    public function autocomplete_video(Request $request)
    {
        $query = $request->get('query');

        $posts = Video::select('post_title', 'slug')
            ->where('post_title', 'LIKE', '%' . $query . '%')
            ->where('post_status', 'Published')
            ->where('published_at', '<', now())
            ->take(5)
            ->get();

        // Format agar dikembalikan dalam format typeahead yang bisa digunakan
        $results = $posts->map(function ($post) {
            return [
                'value' => $post->post_title, // untuk ditampilkan di dropdown
                'slug' => $post->slug,        // untuk redirect
            ];
        });

        return response()->json($results);
    }

    //Artikel
    public function artikel()
    {
        $post = Post::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->latest()->paginate(6);

        $latest_post = Post::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.artikel.index',[
            'title' => 'Artikel',
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function course_category($slug)
    {
        $category = CategoryCourse::where('slug', $slug)->firstOrFail();
        
        $post = Course::with(['user','category'])->where([
            ['categories_id','=', $category->id],
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->orWhere('sub_categories', '=', $category->id)
        ->latest()->paginate(6);

        $latest_post = Course::with(['user','category'])->where([
            ['post_status','=' , 'Published'],
            ['published_at','<', now()],
        ])->take(4)->latest()->get();
    
        return view('pages.home.kelas.category',[
            'category' => $category,
            'post' => $post,
            'latest_post' => $latest_post,
        ]);
    }

    public function pengajuan_lomba()
    {
        $categories = CategoryContest::where('parent_id', null)->orderby('name', 'asc')->get();
        $tags = TagCourse::all();
        $provinces = Location::where('type', 'province')->orderBy('name','asc')->get();

        return view('pages.home.lomba.pengajuan',[
            'title' => 'Pengajuan Info Lomba',
            'categories' => $categories,
            'tags' => $tags,
            'provinces' => $provinces,
        ]);
    }

    public function pengajuan_lomba_store(ContestReqRequest $request)
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

        $validatedData['is_approve'] = 'Menunggu Proses';

        if($request->publish){
            $validatedData['post_status'] = 'Published';
        }else{
            $validatedData['post_status'] = 'Draft';
        }

        if($request->is_schedule == 'Ya'){
            $validatedData['published_at'] = $request->published_at;
        }else{
            $validatedData['published_at'] = date('Y-m-d H:i:s');
        }

        $validatedData['users_id'] = auth()->user()->id;
        $validatedData['slug'] = Str::slug($request->post_title);

        $validatedData['is_approve'] = 'Menunggu Proses';

        $post = ContestRequesta::create($validatedData);

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

            ParticipantRequest::insert($insert_data);
        }

        return redirect()
                    ->route('pengajuan-lomba')
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan, Data akan diverifikasi oleh admin');
    }

    public function autocomplete_lomba(Request $request)
    {
        $data = $request->all();

        $query = $data['query'];

        $filter_data = Contest::select('post_title')
                        ->where([
                            ['post_title', 'LIKE', '%'.$query.'%'],
                            ['post_status','=', 'Published'],
                            ['published_at','<', now()],
                        ])
                        ->pluck('post_title');

        return response()->json($filter_data);
    }

    public function search_lomba(Request $request)
    {
        $post = Contest::with(['user','category'])
                        ->where('post_title', $request->keyword)
                        ->orWhere('post_title', 'like','%'.$request->keyword.'%')
                        ->paginate(6);
        $count = Contest::with(['user','category'])->where('post_title', $request->keyword)->orWhere('post_title', 'like','%'.$request->keyword.'%')->count();
        $latest_post = Contest::with(['user','category'])->where([
                            ['post_status','=', 'Published'],
                            ['published_at','<', now()],
                        ])->take(6)->latest()->get();

        return view('pages.home.lomba.search',[
            'post' => $post,
            'keyword' => $request->keyword,
            'count' => $count,
            'latest_post' => $latest_post
        ]);

    }

    public function autocomplete_kelas(Request $request)
    {
        $query = $request->get('query');

        $posts = Course::select('post_title', 'slug')
            ->where('post_title', 'LIKE', '%' . $query . '%')
            ->where('post_status', 'Published')
            ->where('published_at', '<', now())
            ->take(5)
            ->get();

        $results = $posts->map(function ($post) {
            return [
                'value' => $post->post_title, 
                'slug' => $post->slug,       
            ];
        });

        return response()->json($results);
    }

    public function search_kelas(Request $request)
    {
        $post = Course::with(['user','category'])
                        ->where('post_title', $request->keyword)
                        ->orWhere('post_title', 'like','%'.$request->keyword.'%')
                        ->paginate(6);
        $count = Course::with(['user','category'])->where('post_title', $request->keyword)->orWhere('post_title', 'like','%'.$request->keyword.'%')->count();
        $latest_post = Course::with(['user','category'])->where([
                            ['post_status','=', 'Published'],
                            ['published_at','<', now()],
                        ])->take(6)->latest()->get();

        return view('pages.home.kelas.search',[
            'post' => $post,
            'keyword' => $request->keyword,
            'count' => $count,
            'latest_post' => $latest_post
        ]);

    }
    //KRU
    public function kru()
    {
    
        return view('pages.home.kru',[
            'title' => 'kru',
        ]);
    }
}
