<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\App;
use App\Models\Contest;
use App\Models\Course;
use App\Models\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Editor'){
            //artikel
            $all_post = Post::withTrashed()->count();
            $draft = Post::where('post_status', 'Draft')->get()->count();
            $published = Post::where('post_status', 'Published')->get()->count();
            $trash = Post::onlyTrashed()->count();
            //Lomba
            $all_contest = Contest::withTrashed()->count();
            $draft_contest = Contest::where('post_status', 'Draft')->get()->count();
            $published_contest = Contest::where('post_status', 'Published')->get()->count();
            $trash_contest = Contest::onlyTrashed()->count();

            //kelas
            $all_course = Course::withTrashed()->count();
            $draft_course = Course::where('post_status', 'Draft')->get()->count();
            $published_course = Course::where('post_status', 'Published')->get()->count();
            $trash_course = Course::onlyTrashed()->count();

            //video
            $all_video = Video::withTrashed()->count();
            $draft_video = Video::where('post_status', 'Draft')->get()->count();
            $published_video = Video::where('post_status', 'Published')->get()->count();
            $trash_video = Video::onlyTrashed()->count();

            $user = User::count();
        }else{
            $draft = Post::where(['post_status' => 'Draft', 'users_id' => Auth::user()->id])->get()->count();
            $published = Post::where(['post_status' => 'Published', 'users_id' => Auth::user()->id])->get()->count();
            $user = User::count();
        }

        $app = App::where('id', '1')->first();

        return view('pages.admin.dashboard',[
            'all_post' => $all_post,
            'draft' => $draft,
            'published' => $published,
            'trash' => $trash,
            'all_contest' => $all_contest,
            'draft_contest' => $draft_contest,
            'published_contest' => $published_contest,
            'trash_contest' => $trash_contest,
            'all_course' => $all_course,
            'draft_course' => $draft_course,
            'published_course' => $published_course,
            'trash_course' => $trash_course,
            'all_video' => $all_video,
            'draft_video' => $draft_video,
            'published_video' => $published_video,
            'trash_video' => $trash_video,
            'user' => $user,
            'app' => $app,
        ]);
    }
}
