<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::group(['prefix' => 'dashboard', 'middleware' => "auth"], function(){
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => "equipements"], function(){
        Route::get('', [EquipementController::class, 'index'])->name('equipements');
        Route::get('/add', [EquipementController::class, 'add'])->name('equipements.add');
        Route::post('/store', [EquipementController::class,'store'])->name('equipements.store');
        Route::get('/edit/{id}', [EquipementController::class,'edit'])->name('equipements.edit');
        Route::post('/update/{id}', [EquipementController::class,'update'])->name('equipements.update');
        Route::get('/delete/{id}', [EquipementController::class,'delete'])->name('equipements.delete');
    });

    Route::group(['prefix' => "emprunts"], function(){
        Route::get('', [EmpruntController::class, 'index'])->name('emprunts');
        Route::get('/add', [EmpruntController::class, 'add'])->name('emprunts.add');
        Route::post('/store', [EmpruntController::class,'store'])->name('emprunts.store');
        Route::get('/edit/{id}', [EmpruntController::class,'edit'])->name('emprunts.edit');
        Route::post('/update/{id}', [EmpruntController::class,'update'])->name('emprunts.update');
        Route::get('/delete/{id}', [EmpruntController::class,'delete'])->name('emprunts.delete');
    });

    Route::group(['prefix' => "reservations"], function(){
        Route::get('', [ReservationController::class, 'index'])->name('reservations');
        Route::get('/add', [ReservationController::class, 'add'])->name('reservations.add');
        Route::post('/store', [ReservationController::class,'store'])->name('reservations.store');
        Route::get('/edit/{id}', [ReservationController::class,'edit'])->name('reservations.edit');
        Route::post('/update/{id}', [ReservationController::class,'update'])->name('reservations.update');
        Route::get('/delete/{id}', [ReservationController::class,'delete'])->name('reservations.delete');
    });

    Route::group(['prefix' => "users"], function(){
        Route::get('', [UserController::class, 'index'])->name('users');
        Route::get('/add', [UserController::class, 'add'])->name('users.add');
        Route::post('/store', [UserController::class,'store'])->name('users.store');
//        Route::get('/edit/{id}', [UserController::class,'edit'])->name('users.edit');
//        Route::put('/update/{id}', [UserController::class,'update'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class,'delete'])->name('users.delete');
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
