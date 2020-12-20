<?php

use App\Events\SendPositionEvent;
use App\Http\Controllers\Api\BioCode\MessagesController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Cars\CarsController;
use App\Http\Controllers\Api\V1\ChatBot\CarsController as ChatBotCarsController;
use App\Http\Controllers\Api\V1\ChatBot\HomeController;
use App\Http\Controllers\Api\V1\ChatBot\ProfileController;
use App\Http\Controllers\Api\V1\User\AvatarController;
use App\Http\Controllers\Api\V1\User\BansController;
use App\Http\Controllers\Api\V1\User\LogoutController;
use App\Http\Controllers\Api\V1\User\StatusController;
use App\Jobs\SendBioCodeUserEmailJob;
use App\Models\BioCode\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'hardware', 'as' => "hardware."], function () {
    Route::get('test', function () {
        return "hi ardino";
    });

    Route::get('send', function () {
        $location = ['lat' => 1234, 'lang' => 789456];

        event(new SendPositionEvent($location));

        Log::info('okay');

        return response()->json($location);
    });
});


Route::group(['prefix' => 'biocode'], function () {
    Route::post('/messages', [MessagesController::class, "send"]);
    Route::get('/messages/sdc', [MessagesController::class, "getAllMessages"]);

    Route::get('test', function () {
        User::findMany([
            "1136"
        ])->map(function ($user) {
            dispatch(new SendBioCodeUserEmailJob($user))->delay(now()->addSeconds(15));
        });
    });
});


Route::post('register', [RegisterController::class, "register"])->name('register');
Route::post('login', [LoginController::class, "login"])->name('login');
Route::post('reset', [ForgotPasswordController::class, "reset"])->name('reset');


Route::group(['prefix' => 'chatbot', 'namespace' => "ChatBot", 'as' => "chatbot."], function () {
    Route::post('user-exist', [HomeController::class, "CheckIfUserExist"])->name('CheckIfUserExist');
    Route::post('generate-token', [HomeController::class, "generateNewToken"])->name('generateNewToekn');
    Route::get("cars", [ChatBotCarsController::class, "index"])->name("cars.index");

    Route::group(['middleware' => ['auth:sanctum'], 'as' => "user.", 'prefix' => "user"], function () {
        Route::get('profile', [ProfileController::class, "profile"])->name('profile');
        Route::post('update-avatar', [ProfileController::class, "updateAvatar"])->name('update_avatar');
    });
});

Route::group(['middleware' => ['auth:sanctum', 'role:client']], function () {

    Route::get("cars", [CarsController::class, "index"])->name("cars.index");

    Route::group(['prefix' => 'user', 'namespace' => "User"], function () {
        Route::post('logout', [LogoutController::class, "__invoke"])->name('logout');
        Route::post('update-avatar', [AvatarController::class, "__invoke"])->name('update_avatar');

        Route::group(['prefix' => 'status', 'as' => "status"], function () {
            Route::get('all', [StatusController::class, "all"])->name('all');
            Route::get('email', [StatusController::class, "email"])->name('email');
            Route::get('phone', [StatusController::class, "phone"])->name('phone');
            Route::get('ban', [StatusController::class, "ban"])->name('ban');
        });

        Route::get("bans", [BansController::class, "index"])->name("bans.index");
    });
});
