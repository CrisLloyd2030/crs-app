<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserRolesController;
use App\Http\Controllers\AdminModulesController;
use App\Http\Controllers\AdminComponentsController;
use App\Http\Controllers\AdminUserManagementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Roles;

Route::get('/', function () {
    return redirect()->route('login');
});


// authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login/post', [AuthenticatedSessionController::class, 'store'])->name('postLogin');
});

Route::middleware('auth', 'role:'. Roles::SUPERADMIN)->group(function () {
    // logout 
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    //components
    Route::get('admin/get/modules', [AdminComponentsController::class, 'getModules'])->name('get-modules');

    //admin roles
    Route::get('admin/user_roles', [AdminUserRolesController::class, 'getIndex'])->name('roles');

    //admin modules 
    Route::get('admin/modules', [AdminModulesController::class, 'getIndex'])->name('modules');
    Route::post('admin/modules/add', [AdminModulesController::class, 'postSave'])->name('postModule');
    Route::post('admin/modules/permission', [AdminModulesController::class, 'postPermission'])->name('postModulePermission');

    //admin users management
    Route::get('admin/users', [AdminUserManagementController::class, 'getIndex'])->name('admin-users');
    Route::post('admin/users/add', [AdminUserManagementController::class, 'postSave'])->name('postUser');

    Route::get('admin/Dashboard', [DashboardController::class, 'index'])->name('dashboard');

});