<?php

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

Route::view('/', 'links.create')->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/links/store', [App\Http\Controllers\LinkController::class, 'store'])->name('links.store');


Route::group(['middleware' => 'auth'], function(){
    Route::resource('/users', App\Http\Controllers\UserController::class)->only('edit', 'update');
    Route::resource('links', App\Http\Controllers\LinkController::class)->except('store');
});

Route::get('/{shortcode}', [\App\Http\Controllers\LinkController::class, 'show'])->name('redirect');

