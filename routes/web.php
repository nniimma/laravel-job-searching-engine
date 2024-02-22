<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ! we can directly return datas:
Route::get('/directreturn', function () {
    return response("<h1>Hello, this is a direct returning!</h1>", 200)->header('Hello', 'This is a header that I created!');
});

Route::get('/listings/manage', [ListingController::class, 'manage'])->name('listings.manage')->middleware('auth');

Route::get('/', [ListingController::class, 'index'])->name('listings.index');
Route::resource('/listings', ListingController::class);
Route::resource('/listings', ListingController::class)->only(['destroy', 'create', 'store', 'edit', 'update'])->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->name('register.create')->middleware('guest');
Route::post('/register', [UserController::class, 'store'])->name('register.store')->middleware('guest');

Route::get('/login', [UserController::class, 'showLogin'])->name('login.create')->middleware('guest');
Route::post('/login', [UserController::class, 'postLogin'])->name('login')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
