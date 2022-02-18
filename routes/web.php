<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController;

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
    return view('landing');
});

// RoomType Routes
Route::resource('roomtype', RoomTypeController::class);
Route::get('roomtype/{id}/delete', [RoomTypeController::class, 'destroy']);



