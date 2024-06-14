<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DemandecongeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ProfileController;
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


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard.welcome', [ProfileController::class, 'get_dash'])->name('get_dash');

    Route::middleware(['role'])->group(function () {
        Route::get('/register.new', [RegisteredUserController::class, 'create'])->name('register.new');
        Route::post('/register.new', [RegisteredUserController::class, 'store'])->name('register.new.store');
    });


    Route::controller(ServiceController::class)->group(function () {
        Route::get('/admin.create_service', 'create')->name('show_service_form');
        Route::post('/admin.store_service', 'store')->name('store_created_service');

        Route::get('/admin.index_service', 'index')->name('index_created_service');
        Route::get('/admin.{service}.edit_service', 'edit')->name('edit_created_service');
        Route::post('/admin.update_service', 'update')->name('update_created_service');
        Route::get('/admin.{service}.delete_service', 'destroy')->name('delete_created_service');
    });

    Route::controller(FormationController::class)->group(function () {
        Route::get('/manager.create_formation', 'create')->name('show_formation_form');
        Route::post('/manager.store_formation', 'store')->name('store_created_formation');

        Route::get('/manager.index_formation', 'index')->name('index_created_formation');
        Route::get('/manager.{formation}.edit_formation', 'edit')->name('edit_created_formation');
        Route::post('/manager.update_formation', 'update')->name('update_created_formation');
        Route::get('/manager.{formation}.delete_formation', 'destroy')->name('delete_created_formation');
    });

    Route::controller(DemandecongeController::class)->group(function () {
        Route::get('/employe.create_demandeconge', 'create')->name('show_demandeconge_form');
        Route::post('/employe.store_demandecpnge', 'store')->name('store_created_demandeconge');

        Route::get('/manager.index_demandeconge', 'index')->name('index_created_demandeconge');

        Route::get('/employe.index{id}_demandeconge', 'indexById')->name('index_created_demandeconge_id');
        Route::get('/employe.{demandeconge}.edit_demandeconge', 'edit')->name('edit_created_demandeconge');
        Route::post('/employe.update_demandeconge', 'update')->name('update_created_demandeconge');
        Route::get('/employe.{demandeconge}.delete_demandeconge', 'destroy')->name('delete_created_demandeconge');
    });


    Route::controller(UserController::class)->group(function () {

        Route::get('/user.index_user_notication', 'notification_index')->name('user_notification_index');
        Route::get('/user.index_user', 'index')->name('index_created_user');
        Route::get('/admin.user.index_manager', 'admin_index_manager')->name('admin.index_created_manager');
        Route::get('/admin.user.index_user', 'admin_attendance_index')->name('admin.attendance');
        Route::get('/user.resetpassword', 'show_pass_form')->name('user_reset_password');
        Route::get('/user.{user}.show_user', 'show')->name('show_created_user');
        Route::get('/user.{user}.edit_user', 'edit')->name('edit_created_user');
        Route::post('/user.update_user', 'update')->name('update_created_user');
        Route::get('/user.{user}.delete_user', 'destroy')->name('delete_created_user');
    });


    Route::controller(InscriptionController::class)->group(function () {
        Route::get('/user.index{id}_inscriptions', 'indexById')->name('index_inscription_id');
    });
});




require __DIR__ . '/auth.php';
