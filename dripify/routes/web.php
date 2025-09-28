<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/login','login')->name('login');

Route::post('/login', LoginController::class)->name('login.attempt');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::view('/dashboard', 'dashboard')->name('dashboard');


Route::post('/logout', function(){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

//pprt nao suporto mais

Route::view('/register', 'register')->name('register');


Route::post('/register' , RegisterController::class)->name('register.store');
