<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\general\CategoryController;
use App\Http\Controllers\general\DepartmentController;
use App\Http\Controllers\usermanagement\AuthAdminController;
use App\Http\Controllers\RolesAndUsersManagement\RoleController;
use App\Http\Controllers\RolesAndUsersManagement\UserManagementController;


Route::get('auth/admin', function () {
    $data = [
        'route' => 'admin'
    ];
    return view('auth.welcome' , $data);
})->middleware('guest:web,admins,staffs')->name('admin.login-page');

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

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/view/{id}', [CategoryController::class, 'view'])->name('admin.categories.view'); 
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/delete', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        Route::post('/bulk-role-delete', [CategoryController::class, 'bulk_category_delete'])->name('admin.bulk-category-delete');
    });

    // Departments
    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.departments');
        Route::get('/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('admin.departments.store');
        Route::get('/view/{id}', [DepartmentController::class, 'view'])->name('admin.departments.view'); 
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
        Route::post('/{id}/update', [DepartmentController::class, 'update'])->name('admin.departments.update');
        Route::get('/delete', [DepartmentController::class, 'destroy'])->name('admin.departments.delete');
        Route::post('/bulk-role-delete', [DepartmentController::class, 'bulk_department_delete'])->name('admin.bulk-department-delete');
    });
});
