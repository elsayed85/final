<?php

use App\Events\TestEvent;
use App\Models\Users\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;




Auth::routes(['verify' => true]);

Route::get('/', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('/home', 'HomeController@index')->name('home');


Route::get('test', function () {
    broadcast(new TestEvent());
});
