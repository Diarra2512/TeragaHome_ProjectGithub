<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PropertyController,
    DashboardController,
    AuthController,
    RegisterController,
    ContactRequestController   // ← contrôleur pour mise à jour du statut des demandes
};

/*----------------------------------------------------------
| Pages publiques
|---------------------------------------------------------*/
Route::get('/', [PropertyController::class, 'home'])->name('home');

/* Liste & détail des annonces accessibles à tous */
Route::get('/properties',               [PropertyController::class, 'index']) ->name('properties.index');
Route::get('/properties/{property}',    [PropertyController::class, 'show'])  ->whereNumber('property')->name('properties.show');

/* === Formulaire Contact sur une annonce === */
Route::get ('/properties/{property}/contact', [PropertyController::class, 'contact'])     ->whereNumber('property')->name('properties.contact');
Route::post('/properties/{property}/contact',
    [PropertyController::class,'contactSend']
)->name('properties.contact');

/*----------------------------------------------------------
| Auth – invités uniquement
|---------------------------------------------------------*/
Route::middleware('guest')->group(function () {
    Route::get ('/login',    [AuthController::class,     'showLoginForm'])->name('login');
    Route::post('/login',    [AuthController::class,     'login']);

    Route::get ('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

/* Déconnexion (connecté) */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*----------------------------------------------------------
| Zone protégée – utilisateur authentifié
|---------------------------------------------------------*/
Route::middleware('auth')->group(function () {

    /* Dashboard - page principale avec les annonces */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Page dédiée aux demandes reçues */
    Route::get('/dashboard/requests', [DashboardController::class, 'requests'])->name('dashboard.requests');

    /* CRUD Annonces */
    Route::get   ('/properties/create',            [PropertyController::class,'create'])->name('properties.create');
    Route::post  ('/properties',                   [PropertyController::class,'store']) ->name('properties.store');
    Route::get   ('/properties/{property}/edit',   [PropertyController::class,'edit'])  ->name('properties.edit');
    Route::put   ('/properties/{property}',        [PropertyController::class,'update'])->name('properties.update');
    Route::delete('/properties/{property}',        [PropertyController::class,'destroy'])->name('properties.destroy');

    /* === Mise à jour du statut d’une demande (bouton “OK” dans le dashboard) === */
    Route::patch('/requests/{contactRequest}', [ContactRequestController::class, 'update'])
        ->whereNumber('contactRequest')
        ->name('requests.update');
});
