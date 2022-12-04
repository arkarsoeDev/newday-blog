<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('page.dashboard');

    Route::name('dashboard.')->group(function () {
        Route::resource('/post', PostController::class)->parameter('post', 'post:slug');
        Route::resource('/category', CategoryController::class);
        Route::resource('/user', UserController::class)->middleware('admin');
        Route::resource('/comment', CommentController::class);
        Route::resource('/profile', ProfileController::class)->only(['index', 'update'])->parameter('profile', 'user');
        Route::resource('/image', ImageController::class)->only(['store']);
        Route::resource('/tag', TagController::class);

        Route::resource('/post-view', PostViewController::class)->only(['index', 'destroy', 'show']);
        Route::get('/post-view-by-country',[PostViewController::class,'postViewsByCountry'])->name('post-view.by-country');
        Route::get('/post-view-by-date', [PostViewController::class, 'postViewsByDate'])->name('post-view.by-date');

        Route::put('/profile/update-password/{user}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::put('/profile/update-email/{user}', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
    });
});

// Route::delete('/comment', [CommentController::class, 'delete']);
// Route::post('/comment', [CommentController::class, 'create']);
// Route::get('/comment', [CommentController::class, 'index']);

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::get('/posts', [PageController::class, 'posts'])->name('page.posts');
Route::get('/posts/{post:slug}', [PageController::class, 'post'])->name('page.post');

require __DIR__ . '/auth.php';