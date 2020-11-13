<?php

use App\Models\Users\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    // User::find(1)->notify(new TestNotification());
});


Auth::routes(['verify' => true]);

Route::get('/', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('/home', 'HomeController@index')->name('home');
