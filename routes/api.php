<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\FavourController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/admin/categories', [FavourController::class, 'getCategories']);

Route::get('/admin/masters', [MasterController::class, 'getList']);
Route::get('/masters', [MasterController::class, 'getListForAppointment']);

Route::get('/admin/favour', [FavourController::class, 'getList']);
Route::get('/favour', [FavourController::class, 'getListForAppointment']);
Route::post('/admin/favour/delete/{favour_id}', [FavourController::class, 'remove']);
Route::post('/admin/favour/edited/{id}', [FavourController::class, 'edit']);
Route::post('/admin/favour/create', [FavourController::class, 'create']);

Route::post('/appointment/create', [AppointmentController::class, 'create']);
Route::get('/admin/appointment', [AppointmentController::class, 'getList']);
Route::post('/admin/appointment/{id}', [AppointmentController::class, 'editStatus']);

Route::get('/calendar', [CalendarController::class, 'getListForAppointment']);
Route::get('/admin/calendar', [CalendarController::class, 'getList']);
Route::post('/admin/calendar/delete/{id}', [CalendarController::class, 'remove']);
Route::post('/admin/calendar/create', [CalendarController::class, 'create']);

Route::get('/admin/portfolio', [PortfolioController::class, 'getList']);
Route::post('/admin/portfolio/delete/{portfolio_id}', [PortfolioController::class, 'remove']);
Route::post('/admin/portfolio/create', [PortfolioController::class, 'create']);


Route::post('/login', [AuthController::class, 'login']);
