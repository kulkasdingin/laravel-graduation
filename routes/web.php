<?php

use App\Http\Controllers\GraduateController;
use App\Models\Graduate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $graduates = Graduate::get();
    return view('index', compact('graduates'));
});

Route::group(['middleware'=>'web'],function() {
    Auth::routes(['register'=>false]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=>'/resource'], function() {
        Route::resource('graduates', GraduateController::class);
    });

});

