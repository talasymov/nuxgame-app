<?php

use App\Http\Controllers\GameResultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function (){
    Route::get('/', 'index')->name('home');
});

Route::controller(LinkController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::get('/page/{unique_id}', 'pageA')->name('page_a');
    Route::post('/page/{unique_id}', 'handleAction')->name('handle_action');
});

Route::controller(GameResultController::class)->group(function () {
    Route::get('/history/{unique_id}', 'history')->name('history');
});
