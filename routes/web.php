<?php
use App\Http\Controllers\AdminController;


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
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

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
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Annonces
    Route::get('/properties', [AdminController::class, 'properties'])->name('admin.properties.index');
    Route::delete('/properties/{property}', [AdminController::class, 'destroyProperty'])->name('admin.properties.destroy');
    Route::get('/admin/properties/{property}', [AdminController::class, 'showProperty'])->name('admin.properties.show');


   

});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/requests', [AdminController::class, 'requests'])->name('admin.requests.index');
     Route::get('/requests/{contactRequest}', [AdminController::class, 'showRequest'])->name('admin.requests.show');
    Route::delete('/requests/{contactRequest}', [AdminController::class, 'destroyRequest'])->name('admin.requests.destroy');
    
});


Route::get('/contact', function () {
    return view('contact-general');
})->name('contact');


