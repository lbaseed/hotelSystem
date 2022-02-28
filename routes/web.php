<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffDepartment;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookingController;

// home page controllers
use App\Http\Controllers\HomeController;

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
Route::get('admin', [AdminController::class, 'index']);



// RoomType Routes
Route::resource('roomtype', RoomTypeController::class);
Route::get('roomtype/{id}/delete', [RoomTypeController::class, 'destroy']);
Route::get('roomtypeimage/{id}/delete', [RoomTypeController::class, 'destroy_image']);

// Room routes
Route::resource('rooms', RoomController::class);
Route::get('rooms/{id}/delete', [RoomController::class, 'destroy']);

// customer routes
Route::resource('customer', CustomerController::class);
Route::get('customer/{id}/delete', [CustomerController::class, 'destroy']);

// Staff Routes
Route::resource('staff', StaffController::class);
Route::get('staff/{id}/delete', [StaffController::class, 'destroy']);

// staff payments
Route::get('staff/payment/{id}/create', [StaffController::class, 'add_payment']);
Route::post('staff/payment/{id}', [StaffController::class, 'save_payment']);
Route::get('staff/payment/{id}/{staff_id}/delete', [StaffController::class, 'delete_payment']);


// Department Routes
Route::resource('department', StaffDepartment::class);
Route::get('department/{id}/delete', [StaffDepartment::class, 'destroy']);

 
// Booking Routes
Route::resource('booking', BookingController::class);
Route::get('booking/{id}/delete', [BookingController::class, 'destroy']);
Route::get('booking/{checkin_date}/available-rooms', [BookingController::class, 'available_rooms']);


// Home Page routes
Route::get('/', [HomeController::class, 'home']);
Route::get('cust/register', [CustomerController::class, 'register']);
Route::get('cust/login', [CustomerController::class, 'login']);
Route::post('cust/login', [CustomerController::class, 'check_login']);
Route::get('cust/dash', [CustomerController::class, 'cust_dash']);
Route::get('cust/logout', [CustomerController::class, 'logout']);


Route::get('cust/booking', [BookingController::class, 'front_booking']);
