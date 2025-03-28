<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\general\CategoryController;
use App\Http\Controllers\general\DepartmentController;
use App\Http\Controllers\usermanagement\AuthStaffController;
use App\Http\Controllers\RolesAndUsersManagement\RoleController;
use App\Http\Controllers\RolesAndUsersManagement\UserManagementController;


Route::get('/staff/auth', function () {
    $data = [
        'route' => 'staff'
    ];
    return view('auth.welcome' , $data);
})->middleware('guest')->name('login-page');

Route::group(["prefix" => "staff/auth"], function () {
    Route::post("login", [AuthStaffController::class, "login"])->name("login")->middleware('guest');
    Route::get("logout", [AuthStaffController::class, "logout"])->name("logout")->middleware('auth');
});

Route::group(['middleware' => 'auth:staffs', 'prefix' => 'staff'], function () {
   

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
        Route::post('/bulk-user-delete', [UserManagementController::class, 'bulk_user_delete'])->name('bulk-user-delete');
    });

    // Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/delete', [RoleController::class, 'destroy'])->name('roles.delete');
        Route::post('/bulk-role-delete', [RoleController::class, 'bulk_role_delete'])->name('bulk-role-delete');
    });

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/view/{id}', [CategoryController::class, 'view'])->name('categories.view');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/delete', [CategoryController::class, 'destroy'])->name('categories.delete');
        Route::post('/bulk-role-delete', [CategoryController::class, 'bulk_category_delete'])->name('bulk-category-delete');
    });

    // Departments
    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('departments');
        Route::get('/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/view/{id}', [DepartmentController::class, 'view'])->name('departments.view');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::post('/{id}/update', [DepartmentController::class, 'update'])->name('departments.update');
        Route::get('/delete', [DepartmentController::class, 'destroy'])->name('departments.delete');
        Route::post('/bulk-role-delete', [DepartmentController::class, 'bulk_department_delete'])->name('bulk-department-delete');
    });
});
