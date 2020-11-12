<?php

use App\Models\Users\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/home', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    return view('welcome');
});

Route::get('/test', function () {
    User::find(1)->notify(new TestNotification());
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
