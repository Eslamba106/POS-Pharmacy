<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usermanagement\AuthController;
use App\Http\Controllers\RolesAndUsersManagement\RoleController;
use App\Http\Controllers\RolesAndUsersManagement\UserManagementController;



Route::group(['middleware' => 'auth:web,staffs', 'prefix' => 'admin'], function () {


    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name("dashboard");

    // User Managment
    Route::group(['prefix' => 'user_management'], function () {

        Route::get('/', [UserManagementController::class, 'index'])->name('user_management');
        Route::get('/create', [UserManagementController::class, 'create'])->name('user_management.create');
        Route::post('/create', [UserManagementController::class, 'store'])->name('user_management.store');
        Route::get('/view/{id}', [UserManagementController::class, 'view'])->name('user_management.view');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('user_management.edit');
        Route::patch('/update/{id}', [UserManagementController::class, 'update'])->name('user_management.update');
        Route::post('/update_status', [UserManagementController::class, 'update_status'])->name('user_management.update_status');
        Route::get('/delete/{id}', [UserManagementController::class, 'destroy'])->name('user_management.delete');
    });

    // Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/delete', [RoleController::class, 'destroy'])->name('roles.delete');
    });
});
