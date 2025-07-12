<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Api\ApiController;

//Admin
use App\Http\Controllers\Admin\AppsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryContestController;
use App\Http\Controllers\Admin\CategoryCourseController;
use App\Http\Controllers\Admin\ContestController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TagContestController;
use App\Http\Controllers\Admin\TagCourseController;
use App\Http\Controllers\Admin\UserController;

//Video
use App\Http\Controllers\Admin\CategoryVideoController;
use App\Http\Controllers\Admin\TagVideoController;
use App\Http\Controllers\Admin\VideoController;


Route::get('/foo', function () {
    $targetFolder = base_path().'/storage/app/public'; 
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage'; 
    symlink($targetFolder, $linkFolder);
});

Route::get('/clear-cache', function () {
    Artisan::call('route:cache');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [HomeController::class, 'detail'])->name('post-detail');
Route::get('/images/{post:slug}', [HomeController::class, 'detail_images'])->name('images-detail');

//Category
Route::get('/category/{category:slug}', [HomeController::class, 'homeCategory'])->name('home-category');
Route::get('/images', [HomeController::class, 'images'])->name('images');

//Tag
Route::get('/tag/{category:slug}', [HomeController::class, 'homeTag'])->name('home-tag');

//Author
Route::get('/author/{id}', [HomeController::class, 'author'])->name('author');

//Search Artikel
Route::get('/autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete');
Route::get('/search', [HomeController::class, 'searchArticle'])->name('search-article');

//Search Lomba
Route::get('/autocomplete-lomba', [HomeController::class, 'autocomplete_lomba'])->name('autocomplete-lomba');
Route::get('/search-lomba', [HomeController::class, 'search_lomba'])->name('search-lomba');

//Search Kelas
Route::get('/autocomplete-kelas', [HomeController::class, 'autocomplete_kelas'])->name('autocomplete-kelas');
Route::get('/search-kelas', [HomeController::class, 'search_kelas'])->name('search-kelas');

//Artikel
Route::get('/artikel', [HomeController::class, 'artikel'])->name('artikel.index');

//Info Lomba
Route::get('/lomba', [HomeController::class, 'lomba'])->name('lomba.index');
Route::get('/lomba/{slug}', [HomeController::class, 'detail_contest'])->name('contest-detail');
Route::get('kategori-lomba/{slug}', [HomeController::class, 'contest_category'])->name('contest-category');
Route::get('tag-lomba/{slug}', [HomeController::class, 'contest_tag'])->name('contest-tag');
Route::get('/pengajuan-lomba', [HomeController::class, 'pengajuan_lomba'])->name('pengajuan-lomba');
Route::post('/pengajuan-lomba', [HomeController::class, 'pengajuan_lomba_store'])->name('pengajuan-lomba-store');

//Info Kelas
Route::get('/kelas', [HomeController::class, 'kelas'])->name('kelas.index');
Route::get('/kelas/{slug}', [HomeController::class, 'detail_kelas'])->name('kelas-detail');
Route::get('kategori-kelas/{slug}', [HomeController::class, 'course_category'])->name('course-category');
Route::get('tag-kelas/{slug}', [HomeController::class, 'course_tag'])->name('course-tag');

//Video
Route::get('/video', [HomeController::class, 'video'])->name('video-home.index');
Route::get('/video/{slug}', [HomeController::class, 'detail_video'])->name('video-home-detail');
Route::get('kategori-video/{slug}', [HomeController::class, 'video_category'])->name('video-category');
Route::get('tag-video/{slug}', [HomeController::class, 'video_tag'])->name('video-tag');
Route::get('/autocomplete-video', [HomeController::class, 'autocomplete_video'])->name('autocomplete-video');

// Kru
Route::get('/kru', [HomeController::class, 'kru'])->name('kru.index');

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('admin')
	->middleware('auth')
	->group(function(){
		Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin-dashboard');	
		//POS	
		Route::resource('pos/post', PostController::class);
		Route::post('/post', [PostController::class, 'store'])->name('store-post');
		Route::post('/get-sub-categories', [PostController::class, 'get_sub_categories'])->name('get-sub-categories');
		Route::get('/pos/published', [PostController::class, 'published'])->name('post-published');
		Route::get('/pos/draft', [PostController::class, 'draft'])->name('post-draft');
		Route::get('/pos/trash', [PostController::class, 'trash'])->name('post-trash');
		Route::get('/pos/restore/{id}', [PostController::class, 'restore_data'])->name('post-restore');
		Route::delete('/pos/force-delete/{id}', [PostController::class, 'force_delete'])->name('post-force-delete');
		Route::resource('pos/category', CategoryController::class);
		Route::resource('pos/tag', TagController::class);

		//Info Lomba
		Route::resource('contest', ContestController::class);
		Route::post('get-sub-categories-contest', [ContestController::class, 'get_sub_categories'])->name('get-sub-categories-contest');
		Route::get('contest-published', [ContestController::class, 'published'])->name('contest-published');
		Route::get('contest-draft', [ContestController::class, 'draft'])->name('contest-draft');
		Route::get('contest-trash', [ContestController::class, 'trash'])->name('contest-trash');
		Route::get('contest-restore/{id}', [ContestController::class, 'restore_data'])->name('contest-restore');
		Route::get('contest-request', [ContestController::class, 'contest_request'])->name('contest-request');
		Route::get('contest-request-edit/{id}', [ContestController::class, 'edit_contest_request'])->name('contest-request-edit');
		Route::delete('contest-request-delete/{id}', [ContestController::class, 'delete_contest_request'])->name('contest-request-delete');
		Route::delete('contest-force-delete/{id}', [ContestController::class, 'force_delete'])->name('contest-force-delete');
		//Kategori Info Lomba
		Route::resource('contest-category', CategoryContestController::class);
		//Tag Info Lomba
		Route::resource('contest-tag', TagContestController::class);

		//Info Kelas
		Route::resource('course', CourseController::class);
		Route::post('get-sub-categories-course', [CourseController::class, 'get_sub_categories'])->name('get-sub-categories-course');
		Route::get('course-published', [CourseController::class, 'published'])->name('course-published');
		Route::get('course-draft', [CourseController::class, 'draft'])->name('course-draft');
		Route::get('course-trash', [CourseController::class, 'trash'])->name('course-trash');
		Route::get('course-restore/{id}', [CourseController::class, 'restore_data'])->name('course-restore');
		Route::get('course-request/{id}', [CourseController::class, 'course_request'])->name('course-restore');
		Route::delete('course-force-delete/{id}', [CourseController::class, 'force_delete'])->name('course-force-delete');
		//Kategori Info Kelas
		Route::resource('course-category', CategoryCourseController::class);
		//Tag Info Kelas
		Route::resource('course-tag', TagCourseController::class);

		//Video
		Route::resource('video', VideoController::class);
		Route::post('get-sub-categories-video', [VideoController::class, 'get_sub_categories'])->name('get-sub-categories-video');
		Route::get('video-published', [VideoController::class, 'published'])->name('video-published');
		Route::get('video-draft', [VideoController::class, 'draft'])->name('video-draft');
		Route::get('video-trash', [VideoController::class, 'trash'])->name('video-trash');
		Route::get('video-restore/{id}', [VideoController::class, 'restore_data'])->name('video-restore');
		Route::delete('video-force-delete/{id}', [VideoController::class, 'force_delete'])->name('video-force-delete');
		//Kategori Video
		Route::resource('video-category', CategoryVideoController::class);
		//Tag Info Kelas
		Route::resource('video-tag', TagVideoController::class);

		//User
		Route::resource('users/user', UserController::class);
		Route::post('/user', [UserController::class, 'store'])->name('store-user');
		Route::get('/users/user/profile',[UserController::class, 'show'])->name('profile-user');
		Route::get('/users/user/profile/password',[UserController::class, 'change_password'])->name('change-password');
		Route::put('/users/user/profile/{id}', [UserController::class, 'update_profile'])->name('profile-update');
		Route::post('/users/user/upload-profile', [UserController::class, 'upload_profile'])->name('profile-upload');
		Route::post('change-password', [UserController::class, 'update_password'])->name('update.password');
		//Setting
		Route::get('/settings/apps', [AppsController::class, 'index'])->name('apps.index');
		Route::put('/settings/apps/{id}', [AppsController::class, 'update'])->name('apps.update');
		Route::put('/settings/logo-apps/{id}', [AppsController::class, 'update_logo'])->name('logo-apps.update');
		Route::put('/settings/favicon-apps/{id}', [AppsController::class, 'update_favicon'])->name('favicon-apps.update');
		Route::put('/settings/banner-apps/{id}', [AppsController::class, 'update_banner'])->name('banner-apps.update');

	});

	Route::get('/api/provinces', [ApiController::class, 'getProvinces']);

