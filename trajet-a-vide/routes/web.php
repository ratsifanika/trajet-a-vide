<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:carrier'])->group(function () {
    Route::get('/routes/create',[RouteController::class, 'create'])->name('route.create');
    Route::post('routes',[RouteController::class, 'store'])->name('route.store');
});
