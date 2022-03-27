<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LanguageController;

Route::resource('user', UserController::class);

Route::controller(MoviesController::class)->group(function(){
    Route::get('/', 'index')->name('movies.index');
    Route::get('/home', 'index');
    Route::get('/movies/{movie}', 'show')->name('movies.show')->middleware('auth');
});

Route::controller(TvController::class)->group(function(){
    Route::get('/tv', 'index')->name('tv.index');
    Route::get('/tv/{id}', 'show')->name('tv.show')->middleware('auth');
});

Route::controller(ActorsController::class)->group(function(){
    Route::get('/actors', 'index')->name('actors.index');
    Route::get('/actors/page/{page?}', 'index');
    Route::get('/actors/{actor}', 'show')->name('actors.show')->middleware('auth');
});

Route::controller(GenresController::class)->group(function(){
    
    Route::get('/genres', 'index')->name('genres.index');
    Route::get('/genres/{id}', 'show')->name('genres.show')->middleware('auth');
});

Route::controller(FavoriteController::class)->group(function(){
    Route::get('/favorite/create/{id}', 'create')->name('favorite.create')->middleware('auth');
    Route::get('/favorite/show/', 'show')->name('favorite.show')->middleware('auth');
    Route::get('/favorite/destroy/{id}', 'destroy')->name('favorite.destroy')->middleware('auth');
});

Route::controller(LanguageController::class)->group(function(){
    Route::get('/language', 'index')->name('language.index');
    Route::get('/language/countries', 'countries')->name('language.countries');
    Route::get('/language/{id}', 'show')->name('language.show')->middleware('auth');
});