<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuranController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrayerTimesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MosqueeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostulationChefController;
use App\Http\Controllers\PostulationImamController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PostulationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/evenements', [EventController::class, 'index'])->name('evenements');


Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/zakaat', function () {
    return view('zakaat');
})->name('zakaat');

//Route Mosquée
Route::resource('gest_mosquees', MosqueeController::class)->parameters([
    'gest_mosquees' => 'mosquee'
]);
Route::get('/mosquees', [MosqueeController::class, 'indexAll'])->name('mosquees');
Route::get('/mosquees', [MosqueeController::class, 'listeMosquees'])->name('mosquees');

Route::get('/voir_mosquees', [MosqueeController::class, 'voirMosquees'])->name('voir_mosquees');


//Routes de dashboard president de l'association
Route::group(['middleware' =>  ['auth', 'president']], function () {
Route::get('president/dashboard', function () {
    return view('president.dashboard');
})->name('president.dashboard');


Route::get('/president/evenements', function () {
    return view('president.evenements');
})->name('president.evenements');


Route::get('/president/gest_mosquees', [MosqueeController::class, 'index'])->name('president.gest_mosquees');
Route::get('president/demandes', [PostulationChefController::class, 'afficherDemandesPourPresident'])->name('president.demande_chef');
Route::get('president/demandes/statut/{statut?}', [PostulationChefController::class, 'filterByStatut'])->name('president.demandes.filtrer');
Route::get('president/demandes/{id}', [PostulationChefController::class, 'show'])->name('president.demandes.show');
Route::post('president/demandes/{id}/update-statut', [PostulationChefController::class, 'updateStatut'])->name('president.demandes.updateStatut');
Route::delete('president/demandes/{id}', [PostulationChefController::class, 'destroy'])->name('president.demandes.supprimer');
Route::get('president/evenements', [EvenementController::class, 'index'])->name('president.evenements.index');
Route::post('president/evenements', [EvenementController::class, 'store'])->name('president.evenements.store');

Route::get('president/evenements/{id}/edit', [EvenementController::class, 'edit'])->name('president.evenements.edit');
Route::put('president/evenements/{id}', [EvenementController::class, 'update'])->name('president.evenements.update');

Route::delete('president/evenements/{id}', [EvenementController::class, 'destroy'])->name('president.evenements.destroy');
});

//route event 
Route::get('événements', function () {
    return view('event');
})->name('event');
Route::get('/événements', [EvenementController::class, 'afficherListe'])->name('evenements.liste');


//postulation adherant pour devenir chef de mosquée
Route::middleware(['auth'])->group(function () {
    Route::get('/postuler/{mosquee_id}', [PostulationChefController::class, 'create'])->name('postulation_chef.create');
    Route::post('/postuler/{mosquee_id}', [PostulationChefController::class, 'store'])->name('postulation_chef.store');
    Route::get('/mes-postulations', [PostulationChefController::class, 'index'])->name('mes_postulations');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-post', [PostulationImamController::class, 'mesPostulations'])
        ->name('postulations.mes');
});


Route::group(['middleware' =>  ['auth', 'chef']], function () {
    Route::get('chefmosque/dashboard', function () {
        return view('chefmosque.dashboard');
    })->name('chefmosque.dashboard');

    Route::get('/chefmosque/demande_imam', [PostulationImamController::class, 'index'])
        ->name('demande_imam.index');
    
    Route::put('/chefmosque/demande_imam/{id}/statut', [PostulationImamController::class, 'updateStatut'])
        ->name('demande_imam.updateStatut');

    Route::delete('/chefmosque/demande_imam/{id}', [PostulationImamController::class, 'destroy'])
        ->name('demande_imam.destroy');
});

//postulation adherant pour devenir imam
Route::middleware(['auth'])->group(function () {
Route::post('/postulation-imam', [PostulationImamController::class, 'store'])->name('postulation-imam.store');
Route::get('/postulation-imam', [PostulationImamController::class, 'create'])->name('postulation-imam.form');
});

//systeme de messagerie
Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});

Route::get('/aladhan', function () {
    return view('components/prayer-times');
})->name('aladhan');


Route::get('/zakaat/send', function () {
    return view('sendZakaat');
})->name('sendZakaat');


Route::get('/calendrier', function () {
    return view('calendrier');
})->name('calendrier');

//Routes du coran
Route::get('/coran', [QuranController::class, 'index'])->name('quran.index');
Route::get('/sourate/{id}', [QuranController::class, 'showSourate'])->name('quran.surah');
Route::get('/coran/recherche', [QuranController::class, 'search'])->name('quran.search');
Route::get('/sourates/search', [QuranController::class, 'suggestSourates'])->name('quran.suggest');


// Authenticated user dashboard
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/not-authorized', function () {
    return view('notAuthorized');
})->name('notAuthorized');


// Profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';



// Prayer Times Routes

Route::get('/prayer-times', [PrayerTimesController::class, 'index'])->name('prayer.times');
Route::get('/prayer-times/api', [PrayerTimesController::class, 'getPrayerTimes'])->name('prayer.times.api');

// Role selection
Route::get('/role-selection', [RoleController::class, 'index'])->name('role.selection');
Route::post('/role-selection', [RoleController::class, 'setRole'])->name('role.set');
Route::get('/role-pending', [RoleController::class, 'pending'])->name('role.pending');


// Language Routes
Route::get('/change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');


Route::get('/associations', [AssociationController::class, 'index'])->name('associations');
Route::group(['middleware' => 'auth'], function () {
    Route::get('association-postulation', [AssociationController::class, 'create'])->name('create');
    Route::post('/association-postulation/store', [PostulationController::class, 'store'])->name('association.postulation.store');
});




    //admin middleware 
    Route::group(['middleware' =>  ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [UserController::class, 'statistique'])->name('admin.dashboard');
    Route::get('admin/postulations', [UserController::class, 'getPostulations'])->name('association.postulation');
    Route::get('admin/postulations/{postulation}', [PostulationController::class, 'show'])->name('admin.postulation.show');
    Route::put('admin/postulations/{postulation}/status', [PostulationController::class, 'updateStatus'])->name('admin.postulation.updateStatus');
    Route::get('admin/users', [UserController::class, 'getUsers'])->name('users');
    Route::put('/admin/user/role', [UserController::class, 'changeRoleFromAdmin'])->name('user.role.change');
    Route::get('/admin/cours', [CoursController::class, 'getCoursesForAdmin'])->name('admin.cours');
    Route::get('admin/cours/show/{id}', [CoursController::class, 'getCourseForAdmin'])->name('admin.cours.show');
    Route::put('admin/cours/{cours}/status', [CoursController::class, 'changeCoursStatut'])->name('cours.statut.change');
    Route::get('admin/users' , [UserController::class , 'getUsers'])->name('users');
    Route::put('/admin/user/role' , [UserController::class , 'changeRoleFromAdmin'])->name('user.role.change');
   
    // Donation management routes
    Route::get('/admin/donations', [DonationController::class, 'index'])->name('admin.donations');
    Route::get('/admin/donations/{donation}', [DonationController::class, 'show'])->name('admin.donations.show');
    Route::patch('/admin/donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('admin.donations.update-status');
    Route::delete('/admin/donations/{donation}', [DonationController::class, 'destroy'])->name('admin.donations.destroy');

Route::get('/admin/cours' , [CoursController::class , 'getCoursesForAdmin'])->name('admin.cours');
Route::get('admin/cours/show/{id}' , [CoursController::class , 'getCourseForAdmin'])->name('admin.cours.show');
Route::put('admin/cours/{cours}/status' , [CoursController::class , 'changeCoursStatut'])->name('cours.statut.change');

});

//imam middleware needed
    Route::group(['middleware' =>  ['auth', 'imam']], function () {

Route::get('/imam/dashboard', function () {
    return view('imam/dashboard');
})->name('imam.dashboard');
Route::get('/imam/cours', [UserController::class, 'getImamCourses'])->name('imam.cours');

Route::post('imam/cours/create', [CoursController::class, 'store'])->name('cours.store');
Route::get('imam/cours/details/{id}', [CoursController::class, 'getCours'])->name('cours.detail');
Route::get('imam/articles', [ArticleController::class, 'getArticlesForImam'])->name('imam.articles');
Route::post('imam/articles/store', [ArticleController::class, 'store'])->name('articles.store');
Route::get('imam/articles/show/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('imam/articles/destroy/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::put('imam/articles/edit', [ArticleController::class, 'edit'])->name('articles.edit');



Route::get('cours', [CoursController::class, 'index'])->name('cours');
Route::get('cours/show/{cours}', [CoursController::class, 'getCourseForUser'])->name('cours.show');




Route::post('imam/cours/create' , [CoursController::class , 'store'])->name('cours.store');
Route::get('imam/cours/details/{id}' , [CoursController::class , 'getCours'])->name('cours.detail');
Route::get('imam/articles' , [ArticleController::class , 'getArticlesForImam'])->name('imam.articles');
Route::post('imam/articles/store' , [ArticleController::class , 'store'])->name('articles.store');
Route::get('imam/articles/show/{id}' , [ArticleController::class , 'show'])->name('articles.show');
Route::delete('imam/articles/destroy/{id}' , [ArticleController::class , 'destroy'])->name('articles.destroy');
Route::put('imam/articles/edit' , [ArticleController::class , 'edit'])->name('articles.edit');
});


Route::get('cours' , [CoursController::class , 'index'])->name('cours');
Route::get('cours/show/{cours}' , [CoursController::class , 'getCourseForUser'])->name('cours.show');
Route::get('/articles/details/{id}' , [ArticleController::class , 'getDetailsForUser'])->name('article.details');


// Language switching
Route::get('/language/switch/{locale}', [LanguageController::class, 'changeLanguage'])->name('language.switch');

// Greeting test route (locale example)
Route::get('/greeting/{locale}', function (string $locale) {
    if (!in_array($locale, ['fr', 'ar', 'en'])) {
        abort(400);
    }

    App::setLocale($locale);

    return view('greeting');
})->name('greeting.locale');

// Donations
Route::get('/donations', [DonationController::class, 'showDonationPage'])->name('donations');
Route::post('/donations/submit', [DonationController::class, 'submit'])->name('donations.submit');



Route::get('/zakaat/envoyer', [PaymentController::class, 'showForm'])->name('sendZakaat');
Route::post('/zakaat/payer', [PaymentController::class, 'processPayment'])->name('processZakaat');
Route::get('/download-receipt/{zakat_id}', [PaymentController::class, 'downloadReceipt'])->name('download.receipt');


// Auth routes (Laravel Breeze / Fortify / Jetstream)
require __DIR__ . '/auth.php';

// Additional donation logic routes
require __DIR__.'/donation.php';



