<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\ConnectionsController;
use App\Http\Controllers\User\ContactRequestsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return request()->user() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('profile/{username}', [ProfileController::class, 'publicProfile'])->name('public_profile');
Route::get('profile/id/{id}', [ProfileController::class, 'publicProfileId'])->name('public_profile_id');
Route::post('profile/{id}/download-contact', [ProfileController::class, 'downloadContact'])->name('download_contact');
Route::post('connectRequest', [ProfileController::class, 'connectRequest'])->name('connect_request');
Route::post('clickTracker/{network}', [ProfileController::class, 'clickTracker'])->name('click_tracker');

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/add', [AdminDashboardController::class, 'addUser'])->name('users.create');
    Route::put('/users/toggle-block-status/{id}', [AdminDashboardController::class, 'toggleBlockStatus'])->name('users.toggle-block-status');
    Route::post('/users', [AdminDashboardController::class, 'storeUser'])->name('users.store');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');
    Route::patch('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::get('/users/{id}', [AdminDashboardController::class, 'editUser'])->name('users.edit');
    Route::get('/all-users', [AdminDashboardController::class, 'allUsers'])->name('all-users');
});

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get-stats', [DashboardController::class, 'getStats'])->name('dashboard.get-stats');

    // Profile...
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::post('/change-password', [ProfileController::class, 'storeChangePassword'])->name('profile.change-password.store');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/upload-asset', [ProfileController::class, 'uploadAsset'])->name('profile.upload-asset');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::delete('/delete-asset/{type}', [ProfileController::class, 'deleteAsset'])->name('profile.delete-asset');
    });

    // Contacts...
    Route::group(['prefix' => 'contact-requests'], function () {
        Route::get('/', [ContactRequestsController::class, 'index'])->name('contact-requests.index');
        Route::post('/', [ContactRequestsController::class, 'store'])->name('contact-requests.store');
        Route::get('/all-requests', [ContactRequestsController::class, 'allRequests'])->name('contact-requests.all-requests');
        Route::get('/all-requests/export', [ContactRequestsController::class, 'exportRequests'])->name('contact-requests.export-requests');
        Route::delete('/{contactRequest}', [ContactRequestsController::class, 'destroy'])->name('contact-requests.destroy');
    });

    // Connections...
    Route::group(['prefix' => 'connections'], function () {
        Route::get('/', [ConnectionsController::class, 'index'])->name('connections.index');
        Route::post('/', [ConnectionsController::class, 'store'])->name('connections.store');
        Route::delete('/{connection}', [ConnectionsController::class, 'destroy'])->name('connections.destroy');
    });
});

require __DIR__.'/auth.php';
