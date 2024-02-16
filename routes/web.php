<?php

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

Route::get('/', function () {
    return view('listings');
});
