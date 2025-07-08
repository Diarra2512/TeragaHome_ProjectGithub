<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PropertyController,
    DashboardController,
    AuthController,
    RegisterController,
    FavorisController
   
       // ← contrôleur pour mise à jour du statut des demandes
};

/*----------------------------------------------------------
| Pages publiques
|---------------------------------------------------------*/
Route::get('/', [PropertyController::class, 'home'])->name('home');

use App\Models\Property;

Route::get('/favoris', function () {
    $ids = request()->query('ids');

    if (!$ids) return view('favoris', ['favorites' => []]);

    $idsArray = explode(',', $ids);
    $favorites = Property::with('images')->whereIn('id', $idsArray)->get();

    return view('favoris', compact('favorites'));
})->name('favoris');

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

 // web.php
Route::patch('/requests/{contactRequest}', [DashboardController::class, 'updateRequest'])
    ->name('requests.update')
    ->middleware('auth');

});
