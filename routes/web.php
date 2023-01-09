<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('home');


Route::get('/auth/login', [AuthController::class, "inlog"])->name('login');
Route::post('/auth/login', [AuthController::class, 'inlogPost']);

Route::get('/auth/signUp', [AuthController::class, 'signUp'])->name("signUp");
Route::post('/auth/signUp', [AuthController::class, 'signUpPost']);


Route::get("/auth/logout", [AuthController::class, 'logout'])->name('logout');




Route::prefix('/post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::get('/show/{post}', [PostController::class, 'show'])->name('showPost');


    Route::middleware(['auth'])->group(function () {
        Route::get('/like/{post}', [PostController::class, 'like'])->name('likePost');
        Route::get('/dislike/{post}', [PostController::class, 'dislike'])->name('dislikePost');
    });

    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::get("/create", [PostController::class, 'create'])->name('postCreate');
        Route::post("/create", [PostController::class, 'store']);
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('postEdit');
        Route::put('/edit/{post}', [PostController::class, 'update']);

        Route::get("/delete/{post}", [PostController::class, 'delete'])->name('postDelete');
    });
});

Route::middleware(['auth'])->prefix('/comment')->group(function () {
    Route::post('/create/{post}', [CommentController::class, 'store'])->name('commentCreate');
    Route::get('/like/{comment}', [CommentController::class, 'like'])->name('likeComment');
    Route::get('/dislike/{comment}', [CommentController::class, 'dislike'])->name('dislikeComment');
});
