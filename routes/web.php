<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

    Route::resource('/post', PostController::class, ['as' => 'dashboard'])->parameter('post', 'post:slug');
    Route::resource('/category', CategoryController::class, ['as' => 'dashboard']);
    Route::resource('/user', UserController::class, ['as' => 'dashboard'])->middleware('admin');
    Route::resource('/comment', CommentController::class, ['as' => 'dashboard']);
    Route::resource('/profile', ProfileController::class, ['as' => 'dashboard'])->only(['index','update'])->parameter('profile','user');

    Route::put('/profile/update-password/{user}',[ProfileController::class,'updatePassword'])->name('dashboard.profile.updatePassword');
    Route::put('/profile/update-email/{user}', [ProfileController::class, 'updateEmail'])->name('dashboard.profile.updateEmail');
});

// Route::delete('/comment', [CommentController::class, 'delete']);
// Route::post('/comment', [CommentController::class, 'create']);
// Route::get('/comment', [CommentController::class, 'index']);

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::get('/posts', [PageController::class, 'posts'])->name('page.posts');
Route::get('/posts/{post:slug}', [PageController::class, 'post'])->name('page.post');

require __DIR__ . '/auth.php';