<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

//HOME
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USER 

Route::get('/user/profile/{id?}', [\App\Http\Controllers\UserController::class, 'index'])->name('user.profile');
Route::get('/user/settings/', [\App\Http\Controllers\UserController::class, 'settings'])->name('user.settings');
Route::get('/user/getImage/{file?}', [\App\Http\Controllers\UserController::class, 'getImage'])->name('user.image');
Route::post('/user/update/', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//GAME
Route::get('/game/create', [\App\Http\Controllers\GameController::class, 'create'])->name('game.create');
Route::post('/game/save', [\App\Http\Controllers\GameController::class, 'save'])->name('game.save');
Route::get('/game/image/{filename?}', [\App\Http\Controllers\GameController::class, 'getImage'])->name('game.image');
Route::get('/game/detail/{id?}', [\App\Http\Controllers\GameController::class, 'detail'])->name('game.detail');
Route::get('/game/famoust', [\App\Http\Controllers\GameController::class, 'famoust'])->name('game.famoust');


//REVIEW
Route::post('/review/save', [\App\Http\Controllers\ReviewController::class, 'save'])->name('review.save');
Route::get('/review/delete/{id?}', [\App\Http\Controllers\ReviewController::class, 'delete'])->name('review.delete');
Route::get('/review/filter/{game_id?}/{action?}', [\App\Http\Controllers\ReviewController::class, 'filter'])->name('review.filter');


//LIKES
Route::get('/like/add/{id?}', [\App\Http\Controllers\LikeController::class, 'add'])->name('like.add');
Route::get('/like/delete/{id?}', [\App\Http\Controllers\LikeController::class, 'delete'])->name('like.delete');