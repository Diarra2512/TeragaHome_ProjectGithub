<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PropertyController,
    DashboardController,
    AuthController,
    RegisterController
};

/*----------------------------------------------------------
| Pages publiques
|---------------------------------------------------------*/
Route::view('/', 'home')->name('home');
Route::get('/', [PropertyController::class, 'home'])->name('home');

/* Liste & détail des annonces accessibles à tous */
Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');

Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->whereNumber('property')           // ← seulement un ID numérique
    ->name('properties.show');

/*----------------------------------------------------------
| Auth – uniquement pour les invités
|---------------------------------------------------------*/
Route::middleware('guest')->group(function () {
    Route::get ('/login',    [AuthController::class,     'showLoginForm'])->name('login');
    Route::post('/login',    [AuthController::class,     'login']);

    Route::get ('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

/* Déconnexion (utilisateur connecté) */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*----------------------------------------------------------
| Zone protégée – utilisateur authentifié
|---------------------------------------------------------*/
Route::middleware('auth')->group(function () {

    /* Dashboard personnel */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /* Dépôt et gestion des annonces */
    Route::get ('/properties/create',          [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties',                 [PropertyController::class, 'store'])->name('properties.store');

    Route::get   ('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put   ('/properties/{property}',      [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}',      [PropertyController::class, 'destroy'])->name('properties.destroy');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get   ('/properties/{property}/edit', [PropertyController::class,'edit'])->name('properties.edit');
    Route::put   ('/properties/{property}',       [PropertyController::class,'update'])->name('properties.update');
    Route::delete('/properties/{property}',       [PropertyController::class,'destroy'])->name('properties.destroy');
});


