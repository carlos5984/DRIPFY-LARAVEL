<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\LookController;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/login','login')->name('login');

Route::post('/login', LoginController::class)->name('login.attempt');


Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');  

Route::post('/logout', function(){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

//pprt nao suporto mais

Route::view('/register', 'register')->name('register');


Route::post('/register' , RegisterController::class)->name('register.store');

Route::prefix('clothing')->middleware('auth')->group(function () {
    Route::get('/add', [ClothingController::class, 'formAddRoupa'])->name('clothing.formAdd'); // Form
    Route::post('/add', [ClothingController::class, 'addRoupa'])->name('clothing.add'); // Submit
    Route::get('/list', [ClothingController::class, 'listroupas'])->name('clothing.list'); // List clothes
    Route::post('/delete', [ClothingController::class, 'deleteroupa'])->name('clothing.delete'); // Delete clothing
    Route::post('/toggle-available', [ClothingController::class, 'alterarAvailable'])->name('clothing.toggleAvailable'); // Toggle available
});

// ----------------------
// Look Routes
// ----------------------
Route::prefix('look')->middleware('auth')->group(function () {
    Route::get('/add', [LookController::class, 'formAddLook'])->name('look.formAdd'); // Form add look
    Route::post('/add', [LookController::class, 'addLook'])->name('look.add'); // Submit look
    Route::get('/list', [LookController::class, 'listLooks'])->name('look.list'); // List looks
});