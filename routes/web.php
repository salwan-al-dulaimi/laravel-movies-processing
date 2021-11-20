<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\FavoriteController;


Route::resource('user', UserController::class);

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/home', [MoviesController::class, 'index']);
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show')->middleware('auth');

Route::get('/tv', [TvController::class, 'index'])->name('tv.index');
Route::get('/tv/{id}', [TvController::class, 'show'])->name('tv.show')->middleware('auth');

Route::get('/actors', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorsController::class, 'index']);
Route::get('/actors/{actor}', [ActorsController::class, 'show'])->name('actors.show')->middleware('auth');

Route::get('/genres', [GenresController::class, 'index'])->name('genres.index');
Route::get('/genres/{id}', [GenresController::class, 'show'])->name('genres.show')->middleware('auth');

Route::get('/favorite/create/{id}', [FavoriteController::class, 'create'])->name('favorite.create')->middleware('auth');
Route::get('/favorite/show/', [FavoriteController::class, 'show'])->name('favorite.show')->middleware('auth');
Route::get('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy')->middleware('auth');
