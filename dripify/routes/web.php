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
    Route::post('/store', [ClothingController::class, 'store'])->name('clothing.store');

    Route::get('/list', [ClothingController::class, 'index'])->name('clothing.index');

    Route::patch('/clothing/{clothing}/toggle-available', [ClothingController::class, 'toggleAvailable'])
    ->name('clothing.toggleAvailable');

});

// ----------------------
// Look Routes
// ----------------------
Route::prefix('look')->middleware('auth')->group(function () {
    Route::view('/add', 'looks/formAddLook')->name('look.formAddLook'); // Form add look
    Route::post('/add', [LookController::class, 'store'])->name('look.add'); // Submit look
    Route::get('/list', [LookController::class,  'index'])->name('look.index'); // List looks
});
