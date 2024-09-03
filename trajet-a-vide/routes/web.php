<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:carrier'])->group(function () {
    Route::get('/routes/create',[RouteController::class, 'create'])->name('route.create');
    Route::post('routes',[RouteController::class, 'store'])->name('route.store');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'login'])->name('login');#TODO: create method login in RegisterController
