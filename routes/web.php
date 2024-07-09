<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/', [PagesController::class, 'index'])->name('pages.index');
    Route::get('/create', [PagesController::class, 'create'])->name('pages.create');
    Route::post('/store', [PagesController::class, 'store'])->name('pages.store');
    Route::get('/create', 'App\Http\Controllers\Backend\pageController@create')->name('page.create');
    Route::post('/store', 'App\Http\Controllers\Backend\pageController@store')->name('page.store');
    Route::get('/edit/{id}', 'App\Http\Controllers\Backend\pageController@edit')->name('page.edit');
    Route::post('/update/{id}', 'App\Http\Controllers\Backend\pageController@update')->name('page.update');
    Route::get('/delete/{id}', 'App\Http\Controllers\Backend\pageController@destroy')->name('page.destroy');
 
