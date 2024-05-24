<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Concrete\AuthController;
use App\Http\Controllers\Concrete\BeerController;

/** Views */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/php', function () {
    echo phpinfo();
});

Route::get('/login', function () { return view('auth.login'); })->name('login');

/** Login */
Route::post('/oauth', [AuthController::class, 'login']);

/** Auth */
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

Route::group(['prefix' => '/beer', 'middleware' => ['auth']], function () {
    Route::get('/breweries', [BeerController::class, 'breweries']);
});
