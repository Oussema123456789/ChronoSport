<?php
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\EpreuveController;
use App\Http\Controllers\ConcurrentController;
use App\Http\Controllers\ArbitreController;
use App\Http\Controllers\ArbitreAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\OrganisateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganisateurAdminController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\DossardController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\FormConfigurationController;
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
/*Debut Welcome*/
Route::get('/',[AvisController::class,'showAvis']);
/*Fin Welcome*/
/*Debut Contact*/
Route::get('/contact',[ContactController::class,'show']);
Route::Post('/contact/send',[ContactController::class,'store']);
/*Fin Contact*/
Route::get('/about', action: function () {return view('about');});
Route::get('/service', action: function () {return view('service');});
Route::get('/FormulaireSousse', action: function () {return view('Formulaires.FormulaireSousse');});
Route::get('/resultats', [ResultatController::class, 'showclient'])->name('resultats.show');
Route::get('/Calender', action: [EventController::class, 'showClientEvents1']);
Route::get('/inscription', [EventController::class, 'showClientEvents'])->name('client.events.index');
Route::get('/resultats/{id}', [ResultatController::class,'show1'])
     ->name('resultat.show');

// web.php



Route::resource('formulaire', FormulaireController::class);

//Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/organisateur/profile', [AdminController::class, 'userProfile1'])->name('organisateur.profile');
    Route::post('/organisateur/profile/update', [AdminController::class, 'updateProfile1'])->name('organisateur.profile.update');
});




// Show list of events with “S’inscrire” buttons
Route::get('/inscription-en-ligne', [PublicEventController::class, 'index'])->name('public.events');

// Show épreuves for a selected event
Route::get('/inscription-en-ligne/{event}/epreuves', [PublicEventController::class, 'showEpreuves'])->name('public.event.epreuves');







// Show form for inscription
Route::get('/inscription-en-ligne/{event}/epreuve/{epreuve}', [InscriptionController::class, 'create'])->name('inscription.create');

// Handle form submission
Route::post('/inscription-en-ligne/epreuve/{epreuve}', [InscriptionController::class, 'store'])->name('inscription.store');

Route::get('/inscriptions', [InscriptionController::class, 'listInscriptions'])->name('inscriptions');

Route::get('/inscriptions/list/{event}/{epreuve}', [InscriptionController::class, 'index'])->name('inscriptions.index');

// Routes pour la gestion complète des inscriptions par l'admin
Route::get('/admin/inscriptions/create/{event}/{epreuve}', [InscriptionController::class, 'adminCreate'])->name('admin.inscriptions.create');
Route::post('/admin/inscriptions/store', [InscriptionController::class, 'adminStore'])->name('admin.inscriptions.store');
Route::get('/admin/inscriptions/edit/{event}/{epreuve}/{inscription}', [InscriptionController::class, 'adminEdit'])->name('admin.inscriptions.edit');
Route::put('/admin/inscriptions/update/{event}/{epreuve}/{inscription}', [InscriptionController::class, 'adminUpdate'])->name('admin.inscriptions.update');
Route::delete('/admin/inscriptions/destroy/{event}/{epreuve}/{inscription}', [InscriptionController::class, 'adminDestroy'])->name('admin.inscriptions.destroy');





Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');



Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');





Route::post('/evenements', [EventController::class, 'store'])->name('evenements.store');
// Template route
Route::get('admin/template/{event}', [AdminController::class, 'template'])->name('admin.template');
Route::prefix('admin/template/{event}')->group(function () {
    Route::get('sponsors', [SponsorController::class, 'index'])->name('events.sponsors.index');
    Route::get('sponsors/create', [SponsorController::class, 'create'])->name('events.sponsors.create');
    Route::post('sponsors', [SponsorController::class, 'store'])->name('events.sponsors.store');
    Route::get('sponsors/{sponsor}', [SponsorController::class, 'show'])->name('events.sponsors.show');
    Route::get('sponsors/{sponsor}/edit', [SponsorController::class, 'edit'])->name('events.sponsors.edit');
    Route::put('sponsors/{sponsor}', [SponsorController::class, 'update'])->name('events.sponsors.update');
    Route::delete('sponsors/{sponsor}', [SponsorController::class, 'destroy'])->name('events.sponsors.destroy');
    Route::get('epreuves', [EpreuveController::class, 'index'])->name('events.epreuves.index');
    Route::get('epreuves/create', [EpreuveController::class, 'create'])->name('events.epreuves.create');
    Route::post('epreuves', action: [EpreuveController::class, 'store'])->name('events.epreuves.store');
    Route::get('epreuves/{epreuve}', [EpreuveController::class, 'show'])->name('events.epreuves.show');
    Route::get('epreuves/{epreuve}/edit', [EpreuveController::class, 'edit'])->name('events.epreuves.edit');
    Route::put('epreuves/{epreuve}', [EpreuveController::class, 'update'])->name('events.epreuves.update');
    Route::delete('epreuves/{epreuve}', [EpreuveController::class, 'destroy'])->name('events.epreuves.destroy');
});





//evenement route
Route::controller(EventController::class)->prefix('admin/event')->group(function () {
    Route::get('', 'index')->name('admin.event.index');
    Route::get('create', 'create')->name('admin.event.create');
    Route::post('store', 'store')->name('admin.event.store');
    Route::get('show/{event}', 'show')->name('admin.event.show');
// Show the edit form
Route::get('edit/{event}', 'edit')->name('admin.event.edit');

// Handle the form submission to update the event
Route::put('update/{event}', 'update')->name('admin.event.update');

    Route::delete('destroy/{event}', 'destroy')->name('admin.event.destroy');
    Route::get('assign-arbitres/{event}', 'assignArbitres')->name('admin.event.assign_arbitres');
    Route::post('assign-arbitres/{event}', 'storeArbitres')->name('admin.event.store_arbitres');
});
Route::post('admin/event/create', [EventController::class, 'create'])->name('evenements.create');



Route::prefix('admin/event')->name('admin.event.')->group(function () {
    Route::get('{event}/assign-arbitres', [EventController::class, 'assignArbitres'])->name('assign_arbitres');
    Route::post('{event}/store-arbitres', [EventController::class, 'storeArbitres'])->name('store_arbitres');
});








//CONCURRENT
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    // …
    Route::get('concurrents', [ConcurrentController::class, 'index'])
         ->name('concurrents.index');
    Route::get('concurrent/{dossard}', [ConcurrentController::class, 'showByDossard']);
});




Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('resultats', ResultatController::class);

    // Route to show form for creating a new concurrent
    Route::get('/concurrents/create', [ResultatController::class, 'createConcurrent'])
         ->name('concurrents.create');

    // Route to store a new concurrent
    Route::post('/concurrents', [ResultatController::class, 'storeConcurrent'])
         ->name('concurrents.store');

    // Your existing route to get a specific concurrent
    Route::get('/concurrent/{dossard}', [ResultatController::class, 'getConcurrent']);
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('resultats', [ResultatController::class, 'index'])->name('resultats.index');

    // Use {epreuveId} instead of {epreuve} to pass raw id, NOT model binding
    Route::get('resultats/create/{epreuveId}', [ResultatController::class, 'create'])->name('resultats.create');
    Route::post('resultats/store/{epreuveId}', [ResultatController::class, 'store'])->name('resultats.store');

    // For these, you use route-model binding for 'resultat'
    Route::get('resultats/{resultat}', [ResultatController::class, 'show'])->name('resultats.show');
    Route::get('resultats/{resultat}/edit', [ResultatController::class, 'edit'])->name('resultats.edit');
    Route::put('resultats/{resultat}', [ResultatController::class, 'update'])->name('resultats.update');
    Route::delete('resultats/{resultat}', [ResultatController::class, 'destroy'])->name('resultats.destroy');

    Route::get('resultats/{id}/download-diplome', [ResultatController::class, 'downloadDiplome'])->name('resultats.downloadDiplome');

    // show1 method uses model binding for Event and Epreuve
    Route::get('events/{event}/epreuves/{epreuve}/resultats', [ResultatController::class, 'show1'])->name('resultats.show1');
});


// Add this to web.php
Route::get('/resultat/{event}/{epreuve}', [ResultatController::class, 'show1'])->name('resultat.show');

Route::get('/resultatx/{event}', function (Event $event) {
    $epreuves = $event->epreuves;
    return view('resultatx', compact('event', 'epreuves'));
})->name('resultatx.show');





//dossard
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dossards', [DossardController::class, 'index'])->name('dossards.index');
    Route::get('/dossards/create', [DossardController::class, 'create'])->name('dossards.create');
    Route::post('/dossards/generate', [DossardController::class, 'generate'])->name('dossards.generate');
    Route::get('/dossards/download-list', [DossardController::class, 'downloadList'])->name('dossards.download.list');
    Route::get('/dossards/download-single', [DossardController::class, 'downloadSingle'])->name('dossards.download.single');

    // Configuration des formulaires
    Route::get('/form-config/{event}/edit', [FormConfigurationController::class, 'edit'])->name('form-config.edit');
    Route::put('/form-config/{event}', [FormConfigurationController::class, 'update'])->name('form-config.update');
    Route::get('/form-config/{event}/reset', [FormConfigurationController::class, 'reset'])->name('form-config.reset');
});

// Route de test temporaire sans authentification
Route::get('/test-form-config/{event}/edit', [FormConfigurationController::class, 'edit'])->name('test.form-config.edit');
Route::put('/test-form-config/{event}', [FormConfigurationController::class, 'update'])->name('test.form-config.update');

// Route de test pour les images
Route::get('/test-sponsors/{event}', function($eventId) {
    $event = \App\Models\Event::findOrFail($eventId);
    $sponsors = \App\Models\Sponsor::where('evenement_id', $eventId)->get();
    return view('test-sponsors-display', compact('event', 'sponsors'));
});
//diplome
Route::get('/diplome/{id}', [ResultatController::class, 'downloadDiplome'])->name('diplome.show');

Route::get('admin/resultats/create/{event}', [ResultatController::class, 'create'])->name('resultats.create');



// Show form to assign arbitres
Route::get('/admin/event/{event}/assign-arbitres', [EventController::class, 'assignArbitres'])->name('admin.event.assign_arbitres');

// Store the assigned arbitres
Route::post('/admin/event/{event}/assign-arbitres', [EventController::class, 'storeArbitres'])->name('admin.event.store_arbitres');

// routes/web.php
Route::get('/admin/arbitres/assign', [ArbitreAdminController::class, 'assignArbitresView'])->name('admin.arbitre.assign');

//route avis

Route::get('/avis/create', [AvisController::class, 'create'])->name('avis.create');
Route::post('/avis/store', [AvisController::class, 'store'])->name('avis.store');

Route::controller(ArbitreAdminController::class)->prefix('admin/arbitre')->group(function () {
    Route::get('', 'index')->name('admin.arbitre.index');
    Route::get('create', 'create')->name('admin.arbitre.create');
    Route::post('store', 'store')->name('admin.arbitre.store');
    Route::get('edit/{id}', 'edit')->name('admin.arbitre.edit');
    Route::put('edit/{id}', 'update')->name('admin.arbitre.update');
    Route::delete('destroy/{id}', 'destroy')->name('admin.arbitre.destroy');
});







Route::resource('admin/arbitre', ArbitreAdminController::class)->names('admin.arbitre');


// Arbitre Dashboard
Route::get('arbitre/home', [ArbitreController::class, 'home'])->name('arbitre.home');

Route::middleware(['web'])->group(function () {
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});



//ADMIN
Route::get('organisateur/template', [AdminController::class, 'template1'])->name('organisateur.home');
Route::get('organisateurr/template', [AdminController::class, 'template2'])->name('organisateur.template');

//Paiement
Route::resource('paiements', PaiementController::class);





// Arbitre assignment routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/arbitres/assign', [ArbitreAdminController::class, 'showAssignForm'])->name('arbitre.assign.form');
    Route::post('/arbitres/assign', [ArbitreAdminController::class, 'assignArbitres'])->name('arbitre.assign');
});
Route::get('admin/template/{event}/arbitres', function (Event $event) {
    $arbitres = $event->arbitres; // ✅ This uses the injected Event model
    return view('admin.arbitre.arbitres', compact('event', 'arbitres'));
})->name('admin.template.arbitres');



//Create organisateur
Route::prefix('organisateur/org')->middleware(['auth'])->group(function () {
    Route::get('/', [OrganisateurAdminController::class, 'index'])->name('organisateur.org.index');
    Route::get('/create', [OrganisateurAdminController::class, 'create'])->name('organisateur.org.create');
    Route::post('/', [OrganisateurAdminController::class, 'store'])->name('organisateur.org.store');
    Route::get('/{id}', [OrganisateurAdminController::class, 'show'])->name('organisateur.org.show');
    Route::get('/{id}/edit', [OrganisateurAdminController::class, 'edit'])->name('organisateur.org.edit');
    Route::put('/{id}', [OrganisateurAdminController::class, 'update'])->name('organisateur.org.update');
    Route::delete('/{id}', [OrganisateurAdminController::class, 'destroy'])->name('organisateur.org.destroy');
});



Route::prefix('arbitre')->name('arbitre.')->group(function () {
    Route::get('resultats', [ResultatController::class, 'index'])->name('resultats.index');

    // Use {epreuveId} instead of {epreuve} to pass raw id, NOT model binding
    Route::get('resultats/create/{epreuveId}', [ResultatController::class, 'create'])->name('resultats.create');
    Route::post('resultats/store/{epreuveId}', [ResultatController::class, 'store'])->name('resultats.store');

    // For these, you use route-model binding for 'resultat'
    Route::get('resultats/{resultat}', [ResultatController::class, 'show'])->name('resultats.show');
    Route::get('resultats/{resultat}/edit', [ResultatController::class, 'edit'])->name('resultats.edit');
    Route::put('resultats/{resultat}', [ResultatController::class, 'update'])->name('resultats.update');
    Route::delete('resultats/{resultat}', [ResultatController::class, 'destroy'])->name('resultats.destroy');

    Route::get('resultats/{id}/download-diplome', [ResultatController::class, 'downloadDiplome'])->name('resultats.downloadDiplome');

    // show1 method uses model binding for Event and Epreuve
    Route::get('events/{event}/epreuves/{epreuve}/resultats', [ResultatController::class, 'show1'])->name('resultats.show1');
});



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//ARBITRE


Route::prefix('arbitre')->middleware(['auth'])->name('arbitre.')->group(function () {
    // Dashboard/Home
    Route::get('/home', [ArbitreController::class, 'home'])->name('home');
    Route::get('/dashboard', function () {
        return view('arbitre.home');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ArbitreController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ArbitreController::class, 'updateProfile'])->name('profile.update');

    // Assigned Events
    Route::get('/events', [ArbitreController::class, 'assignedEvents'])->name('events.index');
    Route::get('/events/{event}', [ArbitreController::class, 'showEvent'])->name('event.show');

    // Result submissions
    Route::get('/events/{event}/resultats', [ArbitreController::class, 'resultats'])->name('events.resultats');
    Route::post('/events/{event}/resultats', [ArbitreController::class, 'submitResultats'])->name('events.resultats.submit');

    // View inscriptions for a specific event + epreuve
    Route::get('/events/{event}/epreuve/{epreuve}/inscriptions', [InscriptionController::class, 'index1'])
        ->name('inscriptions.index');

    // Result creation and storage by arbitres
    Route::get('/resultats/create/{event}', [ResultatController::class, 'arbitreCreate'])->name('resultats.create');
    Route::post('/resultats/store', [ResultatController::class, 'arbitreStore'])->name('resultats.store');
});




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


