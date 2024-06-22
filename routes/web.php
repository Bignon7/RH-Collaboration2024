<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DemandecongeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FichepaieController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
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
    return view('welcome');
})->name('welcome');
// Route::get('/base', function () {
//     return view('base');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/contact', function () {
    return view('pages.contact_us');
})->name('contact_us');

Route::post('/contact.store', [NotificationController::class, 'store_message'])->name('contact.store.message');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard.welcome', [ProfileController::class, 'get_dash'])->name('get_dash');

    Route::middleware(['role'])->group(function () {
        Route::get('/register.new', [RegisteredUserController::class, 'create'])->name('register.new');
        Route::get('/register.new.employee', [RegisteredUserController::class, 'create_employee'])->name('register.new.employee');
        Route::post('/register.new.step2', [RegisteredUserController::class, 'to_step2'])->name('register.new.to_step2');
        Route::post('/register.new.store', [RegisteredUserController::class, 'store'])->name('register.new.store');
    });


    Route::controller(ServiceController::class)->group(function () {
        Route::get('/admin.create_service', 'create')->name('show_service_form');
        Route::post('/admin.store_service', 'store')->name('store_created_service');

        Route::get('/admin.index_service', 'index')->name('index_created_service');
        Route::get('/admin.{service}.edit_service', 'edit')->name('edit_created_service');
        Route::post('/admin.update_service{id}', 'update')->name('update_created_service');
        Route::get('/admin.{service}.delete_service', 'destroy')->name('delete_created_service');
    });

    Route::controller(FormationController::class)->group(function () {
        Route::get('/manager.create_formation', 'create')->name('show_formation_form');
        Route::post('/manager.store_formation', 'store')->name('store_created_formation');

        Route::get('/manager.index_formation', 'index')->name('index_created_formation');
        Route::get('/manager.{formation}.edit_formation', 'edit')->name('edit_created_formation');
        Route::post('/manager.update_formation{id}', 'update')->name('update_created_formation');
        Route::get('/manager.{formation}.delete_formation', 'destroy')->name('delete_created_formation');
        Route::get('/manager.formation.{id}.liste_inscrits', 'showInscrits')->name('formation.inscrits');
    });

    Route::controller(DemandecongeController::class)->group(function () {
        Route::get('/employe.create_demandeconge', 'create')->name('show_demandeconge_form');
        Route::post('/employe.store_demandecpnge', 'store')->name('store_created_demandeconge');

        Route::get('/manager.index_demandeconge', 'index')->name('index_created_demandeconge');

        Route::get('/employe.index{id}_demandeconge', 'indexById')->name('index_created_demandeconge_id');
        Route::get('/employe.{demandeconge}.edit_demandeconge', 'edit')->name('edit_created_demandeconge');
        Route::post('/employe.update_demandeconge{id}', 'update')->name('update_created_demandeconge');
        Route::get('/employe.{demandeconge}.delete_demandeconge', 'destroy')->name('delete_created_demandeconge');
        Route::put('/demandes-conges/{demandeConge}/repondre', 'repondre')->name('demandes.repondre');
    });


    Route::controller(UserController::class)->group(function () {

        //Route::get('/user.index_user_notification', 'notification_index')->name('user_notification_index');
        Route::get('/manager.index_contrat', 'contrat_index')->name('index_contrat_user');
        Route::get('/user.index_user', 'index')->name('index_created_user');
        Route::get('/admin.user.index_manager', 'admin_index_manager')->name('admin.index_created_manager');
        Route::get('/admin.user.index_user', 'admin_attendance_index')->name('admin.attendance');
        Route::get('/user.resetpassword', 'show_pass_form')->name('user_reset_password');
        Route::get('/user.{user}.show_user', 'show')->name('show_created_user');
        Route::get('/user.{user}.edit_user', 'edit')->name('edit_created_user');
        Route::post('/user.update_user{id}', 'update')->name('update_created_user');
        Route::get('/user.{user}.delete_user', 'destroy')->name('delete_created_user');
    });


    Route::controller(InscriptionController::class)->group(function () {
        Route::get('/user.index{id}_inscriptions', 'indexById')->name('index_inscription_id');
        Route::post('/user.inscrire{id}_inscriptions', 'inscrire')->name('inscrire_formation');
        Route::get('/user.quitter{id}_inscriptions', 'quitter')->name('quitter_formation');
    });


    Route::controller(DocumentController::class)->group(function () {
        Route::get('/generer.contrat{user}', 'generate_contract')->name('generer.contrat');
        Route::view('/storage/{lien}', 'pages.show_pdf_view')->name('show_pdf_view');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/user.notifications.unread', 'index')->name('user_notification_index.unread');
        Route::get('/user.notifications.read', 'read')->name('user_notification_index.read');
        Route::get('/user.notifications/{id}/read', 'markAsRead')->name('user_notifications.markAsRead');
        Route::get('/user.notifications/{id}/unread', 'markAsUnread')->name('user_notifications.markAsUnread');
        Route::get('/user.notifications/{id}.delete', 'destroy')->name('user_notifications.destroy');
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::post('/attendance/clock-in',  'clockIn')->name('attendance.clockin');
        Route::post('/attendance/clock-out', 'clockOut')->name('attendance.clockout');
        Route::get('/pointage', 'pointage')->name('pointage');
        Route::post('/rechercher', 'search')->name('rechercher');
        Route::post('/get-attendances',  'getAttendances')->name('get-attendances');
    });


    Route::controller(FichepaieController::class)->group(function () {
        Route::get('/generation',  'showsession')->name('showsession');
        Route::get('/import-fiches', 'showImportForm')->name('fiches.import');
        Route::post('/import-fiches',  'importFiches')->name('fiches.store');
        Route::get('/fiches/{id}/view', 'viewFiche')->name('fiches.view');
        Route::get('/mes-fiches',  'mesFiches')->name('fiches.mes');
        Route::get('/notification', 'send_notif_employee')->name('send_notif_employee');
        Route::get('/fichepaie.oneuser', 'showOneFicheForm')->name('show_import_fiche_form');
        Route::post('/fichepaie.store.one', 'storeOneUserFiche')->name('store_one_user_fiche');
    });
});




require __DIR__ . '/auth.php';
