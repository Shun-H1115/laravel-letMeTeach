<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CommissionsController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('categories', CategoriesController::class);

Route::resource('posts', PostsController::class)->middleware('auth');

Route::resource('posts.reviews', ReviewsController::class)->middleware('auth');

Route::resource('commissions', CommissionsController::class)->middleware('auth');

Route::get('posts.ranking', [PostsController::class, 'ranking'])->name('posts.ranking');

Route::get('/info', function () {
    return view('info');
})->name('info');

Route::get('/toppage', function () {
    return view('toppage');
})->name('toppage');

require __DIR__.'/auth.php';
