<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TagController;
use App\Models\User;

use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserInfoController;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/user/update', [UserInfoController::class, 'update'])->name('user.update');
Route::get('/profile', [UserInfoController::class, 'show']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/create', [BookController::class, 'create']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::get('/books/{book}/edit', [BookController::class, 'edit']);
Route::post('/books/store', [BookController::class, 'store']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::get('/{book}/chapters/create', [ChapterController::class, 'create']);
Route::post('/{book}/chapters/store', [ChapterController::class, 'store']);

Route::get('/chapters/{chapter}', [ChapterController::class, 'show']);
Route::get('/chapters/{chapter}/delete', [ChapterController::class, 'destroy']);
Route::get('/chapters/{chapter}/edit', [ChapterController::class, 'edit']);
Route::put('/chapters/{chapter}', [ChapterController::class, 'update']);
Route::get('/titles', [BookController::class, 'getTitles']);
Route::get('/rating', [RatingController::class, 'show']);
Route::post('/rating/store', [RatingController::class, 'store']);
Route::post('/comment/store', [CommentController::class, 'store']);
Route::get('/{comment}/delete', [CommentController::class, 'destroy']);
Route::get('/tags', [TagController::class, 'index']);
Route::post('{book}/tags/store', [BookController::class, 'tagStore']);
Route::get('{book}/tags/', [BookController::class, 'getTags']);
Route::delete('{book}/tags/', [BookController::class, 'destroyTag']);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
