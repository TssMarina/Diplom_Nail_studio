<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/portfolio', function () {
    return view('about.portfolio');
});

Route::get('/contact', function () {
    return view('about.contact');
});

Route::get('/favour', function () {
    return view('about.favour');
});

Route::get('/appointment', function () {
    return view('about.appointment');
});

Route::get('/admin', function () {
    return view('admin.appointment');
})->middleware('auth');

Route::get('/admin/favour', function () {
    return view('admin.favour');
})->middleware('auth');

Route::get('/admin/portfolio', function () {
    return view('admin.portfolio');
})->middleware('auth');

Route::get('/admin/appointment', function () {
    return view('admin.appointment');
})->middleware('auth');

Route::get('/admin/calendar', function () {
    return view('admin.calendar');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
