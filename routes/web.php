<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('test', 'biocode.ticket');

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');
