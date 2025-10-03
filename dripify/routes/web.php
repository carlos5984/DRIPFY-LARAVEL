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


// Prefixo opcional "clothing"
Route::middleware('auth')->prefix('clothing')->group(function () {
    // Formulário para criar roupa
    Route::get('/create', [ClothingController::class, 'create'])->name('clothing.create');

    // Rota para salvar roupa
    Route::post('/', [ClothingController::class, 'store'])->name('clothing.store');

    Route::get('/', [ClothingController::class, 'index'])->name('clothing.index');
});

// ----------------------
// Look Routes
// ----------------------
Route::prefix('look')->middleware('auth')->group(function () {
    Route::get('/add', [LookController::class, 'formAddLook'])->name('look.formAdd'); // Form add look
    Route::post('/add', [LookController::class, 'addLook'])->name('look.add'); // Submit look
    Route::get('/list', [LookController::class, 'listLooks'])->name('look.list'); // List looks
});
