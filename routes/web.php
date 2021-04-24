<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Author\AuthorDashboardController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\FavoriteController as AdminFavoriteController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Author\AuthorSettingsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Author\AuthorCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('subscriber', [SubscriberController::class, 'store']);
Route::get('post/{slug}', [SinglePostController::class, 'details'])->name('post.details');
Route::get('post', [SinglePostController::class, 'index'])->name('post.index');

Route::get('/category/{slug}', [SinglePostController::class, 'postByCategory'])->name('category.posts');
Route::get('/tag/{slug}', [SinglePostController::class, 'postByTag'])->name('tag.posts');






Route::group(['middleware'=>['auth']], function (){
    Route::post('favorite/{post}/add', [FavoriteController::class, 'add'])->name('post.favorite');
    Route::post('comment/{post}', [CommentController::class, 'store'])->name('comment.store');
});


Route::group(['as'=> 'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth', 'admin']], function(){

    Route::get('/', [AdminDashboardController::class, 'routeforredirect']);
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


    Route::get('settings', [SettingsController::class, 'index']);
    Route::post('profile-update', [SettingsController::class, 'updateprofile']);
    Route::post('update-password', [SettingsController::class, 'updatePassword']);

    Route::get('/favorite', [AdminFavoriteController::class, 'index'])->name('favorite.index');

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comment.index');
    Route::get('/comment/delete/{id}', [AdminCommentController::class, 'destroy'])->name('comment.destroy');


    // Tags
    Route::get('/tags/add', [TagController::class, 'create']);
    Route::post('tags/add/submit', [TagController::class, 'store']);
    Route::get('/tags/edit/{id}', [TagController::class, 'edit']);
    Route::post('/tags/update/{id}', [TagController::class, 'update']);
    Route::get('/tags/delete/{id}', [TagController::class, 'destroy']);
    Route::get('/tags', [TagController::class, 'index']);

    // Category
    Route::get('/category/add', [CategoryController::class, 'create']);
    Route::post('category/add/submit', [CategoryController::class, 'store']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);
    Route::get('/category', [CategoryController::class, 'index']);

    // Post
    Route::get('/post/add', [PostController::class, 'create']);
    Route::post('post/add/submit', [PostController::class, 'store']);
    Route::get('/post/edit/{post}', [PostController::class, 'edit']);
    Route::post('/post/update/{post}', [PostController::class, 'update']);
    Route::get('/post/delete/{post}', [PostController::class, 'destroy']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/post/{post}', [PostController::class, 'show']);

    Route::get('/post/{id}/approve', [PostController::class, 'approval']);
    

    // Route For SUbscribers
    Route::get('subscriber', [AdminSubscriberController::class, 'index'])->name('subscriber.index');
    Route::get('subscriber/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscriber.delete');




});
Route::group(['as'=> 'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth', 'author']], function(){

    
    Route::get('/dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/comments', [AuthorCommentController::class, 'index'])->name('comment.index');
    Route::get('/comment/delete/{id}', [AuthorCommentController::class, 'destroy'])->name('comment.destroy');

    
    Route::get('settings', [AuthorSettingsController::class, 'index']);
    Route::post('profile-update', [AuthorSettingsController::class, 'updateprofile']);
    Route::post('update-password', [AuthorSettingsController::class, 'updatePassword']);



    Route::get('post', [AuthorPostController::class, 'index']);
    Route::get('post/create', [AuthorPostController::class, 'create']);
    Route::post('post', [AuthorPostController::class, 'store']);
    Route::get('post/{post}/show', [AuthorPostController::class, 'show']);
    Route::get('post/{post}/edit', [AuthorPostController::class, 'edit']);
    Route::post('post/{post}', [AuthorPostController::class, 'update']);
    Route::get('post/{post}', [AuthorPostController::class, 'destroy']);

});



