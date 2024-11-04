<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserRolesController;
use App\Http\Controllers\AdminModulesController;
use App\Http\Controllers\AdminComponentsController;
use App\Http\Controllers\AdminUserManagementController;

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
    return view('pages.dashboard');
});

//components
Route::get('admin/get/modules', [AdminComponentsController::class, 'getModules'])->name('get-modules');

//admin roles
Route::get('admin/user_roles', [AdminUserRolesController::class, 'getIndex'])->name('roles');

//admin modules 
Route::get('admin/modules', [AdminModulesController::class, 'getIndex'])->name('modules');
Route::post('admin/modules/add', [AdminModulesController::class, 'postSave'])->name('postModule');

//admin users management
Route::get('admin/users', [AdminUserManagementController::class, 'getIndex'])->name('admin-users');
Route::post('admin/users/add', [AdminUserManagementController::class, 'postSave'])->name('postUser');

Route::get('admin/Dashboard', [DashboardController::class, 'index'])->name('dashboard');