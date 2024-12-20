<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CarController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::middleware(['auth', 'role:carrier'])->group(function () {
    Route::get('/routes/create',[RouteController::class, 'create'])->name('route.create');
    Route::post('/routes',[RouteController::class, 'store'])->name('route.store');
    Route::post('/cars/store', [CarController::class, 'store'])->name('car.store');
    Route::get('/route/{id}', [RouteController::class, 'show'])->name('route.show');
    Route::post('/route/{id}/booking', [RouteController::class, 'book'])->name('route.show');

    Route::get('/admin/routes', [RouteController::class, 'adminRoutes'])->name('admin.routes');
    Route::post('/admin/bookings/{id}/validate', [RouteController::class, 'validateBooking']);
    Route::get('/admin/routes/{id}/manage', [RouteController::class, 'manageRoute']);
});
Route::get('/routes/search', [RouteController::class, 'searchRoutes']);



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/cities/search', [CityController::class, 'search'])->name('cities.search');

