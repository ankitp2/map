<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::match(['get','post'],'/register',[AuthController::class,'register'])->name('register');
Route::POST('/login',[AuthController::class,'login'])->name('login-home');
Route::GET('/logout',[AuthController::class,'logout'])->name('logout');
Route::group(['middleware' => 'useradmin'],function(){
    Route::GET('map',[MapController::class,'index'])->name('map.index');
    Route::POST('map',[MapController::class,'store'])->name('map.store');

});
