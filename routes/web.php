<?php

use App\Http\Controllers\Guru\KurikulumController as GuruKurikulumController;
use App\Http\Controllers\User\UserController as UserManajemenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group([
    "prefix" => "guru",
    "as" => "guru.",
    "middleware" => ["auth"]
],
function () {
    Route::group([
        "prefix" => "kurikulum",
        "as" => "kurikulum.",
    ],
    function () {
        Route::get("", [GuruKurikulumController::class, 'index'])->name("index");
        Route::get("/create", [GuruKurikulumController::class,'create'])->name("create");
        Route::post("/store", [GuruKurikulumController::class, 'store'])->name("store");
        Route::get("/{kurikulum_id}", [GuruKurikulumController::class, 'show'])->name("show");
        Route::get("/{kurikulum_id}/edit", [GuruKurikulumController::class, 'edit'])->name("edit");
        Route::post("/{kurikulum_id}/update", [GuruKurikulumController::class, 'update'])->name("update");
    });

    Route::group([
        "prefix" => "user",
        "as" => "user."
    ],
    function () {
        Route::get("", [UserManajemenController::class, 'index'])->name("index");
        Route::get("/create", [UserManajemenController::class,'create'])->name("create");
        Route::post("/store", [UserManajemenController::class, 'store'])->name("store");
        Route::get("/{user_id}", [UserManajemenController::class, 'show'])->name("show");
        Route::get("/{user_id}/edit", [UserManajemenController::class, 'edit'])->name("edit");
        Route::post("/{user_id}/update-detail", [UserManajemenController::class, 'updateDetail'])->name("updateDetail");
        Route::post("/{user_id}/update-password", [UserManajemenController::class, 'updatePassword'])->name("updatePassword");
    });
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');