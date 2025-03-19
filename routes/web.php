<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usermanagement\AuthController;

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
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
    session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language');


Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('login-page');

Route::group(["prefix" => "auth"], function () {
    Route::post("login", [AuthController::class, "login"])->name("login")->middleware('guest');
    Route::get("logout", [AuthController::class, "logout"])->name("logout")->middleware('auth');
});
