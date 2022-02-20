<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;

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

// Authentication
Route::get('login', [AdminController::class, 'login']);
Route::get('logout', [AdminController::class, 'logout']);
Route::post('login', [AdminController::class, 'check_login']);

// Admin Dashbaord
Route::get('admin', function () {
    return view('landing');
});
Route::get('/', [AdminController::class, 'index']);


// RoomType Routes
Route::resource('roomtype', RoomTypeController::class);
Route::get('roomtype/{id}/delete', [RoomTypeController::class, 'destroy']);

// Room routes
Route::resource('rooms', RoomController::class);
Route::get('rooms/{id}/delete', [RoomController::class, 'destroy']);

// customer routes
Route::resource('customer', CustomerController::class);
Route::get('customer/{id}/delete', [CustomerController::class, 'destroy']);


 


