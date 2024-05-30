<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Concrete\AuthController;
use App\Http\Controllers\Concrete\BeerController;
use App\Http\Controllers\Concrete\UserController;
use App\Http\Controllers\Concrete\LanguageController;

/** Welcome */
Route::get('/', function () {
    return view('welcome');
});

/** PHPInfo */
Route::get('/php', function () {
    echo phpinfo();
});

/** Localize */
Route::get('/setLocale/{locale}', [LanguageController::class, 'setLocale'])->name('locale');

/** Auth */
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('oauth');
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

/** Register */
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [UserController::class, 'create'])->name('user.create');

/** Dashboard */
Route::middleware('auth')->get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

/** User */
Route::group(['prefix' => '/user', 'middleware' => ['auth']], function () {
    Route::get('/list', [UserController::class, 'read'])->name('user.list');
    Route::put('/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/delete', [UserController::class, 'delete'])->name('user.delete');
});

/** Beer */
Route::group(['prefix' => '/beer', 'middleware' => ['auth']], function () {
    Route::get('/breweries', [BeerController::class, 'breweries'])->name('beer.breweries');
});
