<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\system\BranchController; 
use App\Http\Controllers\usermanagement\AuthAdminController;
use App\Http\Controllers\RolesAndUsersManagement\RoleController;
use App\Http\Controllers\RolesAndUsersManagement\UserManagementController;


Route::get('auth/admin', function () {
    $data = [
        'route' => 'admin'
    ];
    return view('auth.welcome' , $data);
})->middleware('guest:web,admins')->name('admin.login-page');

Route::group(["prefix" => "auth/admin"], function () {
    Route::post("login", [AuthAdminController::class, "login"])->name("admin.login")->middleware('guest');
    Route::get("logout", [AuthAdminController::class, "logout"])->name("admin.logout")->middleware('auth:admins');
});
Route::group(['middleware' => 'auth:admins', 'prefix' => 'admin'], function () {


    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name("admin.dashboard");

    // User Managment
    Route::group(['prefix' => 'user_management'], function () {

        Route::get('/', [UserManagementController::class, 'index'])->name('admin.user_management');
        Route::get('/create', [UserManagementController::class, 'create'])->name('admin.user_management.create');
        Route::post('/create', [UserManagementController::class, 'store'])->name('admin.user_management.store');
        Route::get('/view/{id}', [UserManagementController::class, 'view'])->name('admin.user_management.view');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.user_management.edit');
        Route::patch('/update/{id}', [UserManagementController::class, 'update'])->name('admin.user_management.update');
        Route::post('/update_status', [UserManagementController::class, 'update_status'])->name('admin.user_management.update_status');
        Route::get('/delete/{id}', [UserManagementController::class, 'destroy'])->name('admin.user_management.delete');
        Route::post('/bulk-user-delete', [UserManagementController::class, 'bulk_user_delete'])->name('admin.bulk-user-delete');

    });

    // Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::get('/delete', [RoleController::class, 'destroy'])->name('admin.roles.delete');
        Route::post('/bulk-role-delete', [RoleController::class, 'bulk_role_delete'])->name('admin.bulk-role-delete');
    });

    // Company 
    Route::group(['prefix' => 'companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('admin.companies');
        Route::get('/create', [CompanyController::class, 'create'])->name('admin.companies.create');
        Route::post('/store', [CompanyController::class, 'store'])->name('admin.companies.store');
        Route::get('/view/{id}', [CompanyController::class, 'view'])->name('admin.companies.view'); 
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('admin.companies.edit');
        Route::post('/{id}/update', [CompanyController::class, 'update'])->name('admin.companies.update');
        Route::get('/delete', [CompanyController::class, 'destroy'])->name('admin.companies.delete');
        Route::post('/bulk-role-delete', [CompanyController::class, 'bulk_companies_delete'])->name('admin.bulk-companies-delete');
    });

 

    // Branches
    Route::group(['prefix' => 'branches'], function () {
        Route::get('/', [BranchController::class, 'index'])->name('admin.branches');
        Route::get('/create', [BranchController::class, 'create'])->name('admin.branches.create');
        Route::post('/store', [BranchController::class, 'store'])->name('admin.branches.store');
        Route::get('/view/{id}', [BranchController::class, 'view'])->name('admin.branches.view'); 
        Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('admin.branches.edit');
        Route::post('/{id}/update', [BranchController::class, 'update'])->name('admin.branches.update');
        Route::get('/delete', [BranchController::class, 'destroy'])->name('admin.branches.delete');
        Route::post('/bulk-role-delete', [BranchController::class, 'bulk_department_delete'])->name('admin.bulk-branch-delete');
    });
});
