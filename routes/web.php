<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\CompanyAdmin\DashboardController as CompanyAdminDashboardController;
use App\Http\Controllers\CompanyAdmin\ContactRequestsController as CompanyAdminContactRequestsController;


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

    Route::get('/companies', [AdminDashboardController::class, 'companies'])->name('companies');
    Route::get('/all-company', [AdminDashboardController::class, 'allCompany'])->name('all-company');
    Route::get('/company/add', [AdminDashboardController::class, 'addCompany'])->name('company.create');
    Route::post('/company/store', [AdminDashboardController::class, 'storeCompanyAdmin'])->name('company.store');
    Route::get('/company/{id}', [AdminDashboardController::class, 'editCompany'])->name('company.edit'); 
    Route::get('/company/{id}/users', [AdminDashboardController::class, 'companyUsers'])->name('company.users');
    Route::get('/company/{id}/usersdata', [AdminDashboardController::class, 'companyUsersData'])->name('company.usersdata');

});

Route::middleware(['auth', 'isCompanyAdmin'])->prefix('company-admin')->name('companyAdmin.')->group(function () {
    // Dashboard and User Management Routes
    Route::get('/my-users', [CompanyAdminDashboardController::class, 'index'])->name('my-users');
    Route::get('/', [CompanyAdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [CompanyAdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/get-stats', [CompanyAdminDashboardController::class, 'getStats'])->name('dashboard.get-stats');
    Route::get('/get-users', [CompanyAdminDashboardController::class, 'getUsers'])->name('dashboard.get-users');


    //dashboard.get-users
    // Route::get('/users/add', [CompanyAdminDashboardController::class, 'addUser'])->name('users.create');
    Route::put('/users/toggle-block-status/{id}', [CompanyAdminDashboardController::class, 'toggleBlockStatus'])->name('users.toggle-block-status');
    // Route::post('/users', [CompanyAdminDashboardController::class, 'storeUser'])->name('users.store');
    // Route::delete('/users/{id}/soft-delete', [CompanyAdminDashboardController::class, 'softDelete'])->name('users.softDelete');
    // Route::delete('/users/{id}', [CompanyAdminDashboardController::class, 'destroyUser'])->name('users.destroy');
    // Route::patch('/users/{id}', [CompanyAdminDashboardController::class, 'updateUser'])->name('users.update');
    Route::get('/users/{id}', [CompanyAdminDashboardController::class, 'editUser'])->name('users.edit');
    Route::get('/all-users', [CompanyAdminDashboardController::class, 'allUsers'])->name('all-users');

    // Contact Requests Routes
    Route::get('contact-requests', [CompanyAdminContactRequestsController::class, 'index'])->name('contact-requests.index');
    // Route::post('contact-requests', [CompanyAdminContactRequestsController::class, 'store'])->name('contact-requests.store');
    Route::get('contact-requests/all-requests', [CompanyAdminContactRequestsController::class, 'allRequests'])->name('contact-requests.all-requests');
    Route::get('contact-requests/all-requests/export', [CompanyAdminContactRequestsController::class, 'exportRequests'])->name('contact-requests.export-requests');
    Route::delete('contact-requests/{contactRequest}', [CompanyAdminContactRequestsController::class, 'destroy'])->name('contact-requests.destroy');
    Route::get('contact-requests/{id}', [CompanyAdminContactRequestsController::class, 'show'])->name('contact-requests.show');
    Route::get('contact-requests/{id}/edit', [CompanyAdminContactRequestsController::class, 'edit'])->name('contact-requests.edit');
    Route::patch('contact-requests/{id}', [CompanyAdminContactRequestsController::class, 'update'])->name('contact-requests.update');
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

    // Connections...
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
