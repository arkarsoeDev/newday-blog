<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('page.dashboard');

    Route::resource('/post', PostController::class, ['as' => 'dashboard'])->parameter('post', 'post:slug');
    Route::resource('/category', CategoryController::class, ['as' => 'dashboard']);
    Route::resource('/user', UserController::class, ['as' => 'dashboard']);
});

Route::get('/', [PageController::class, 'index'])->name('page.index');
Route::post('/posts', [PageController::class, 'posts'])->name('page.posts');

require __DIR__ . '/auth.php';