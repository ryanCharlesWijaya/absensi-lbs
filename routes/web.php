<?php

use App\Http\Controllers\Guru\KurikulumController as GuruKurikulumController;
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
    "as" => "guru."
],
function () {
    Route::group([
        "prefix" => "kurikulum",
        "as" => "kurikulum.",
        "middleware" => ["auth"]
    ],
    function () {
        Route::get("", [GuruKurikulumController::class, 'index'])->name("index");
        Route::get("/create", [GuruKurikulumController::class, 'create'])->name("create");
        Route::post("/store", [GuruKurikulumController::class, 'store'])->name("store");
        Route::get("/{kurikulum_id}", [GuruKurikulumController::class, 'show'])->name("show");
        Route::get("/{kurikulum_id}/edit", [GuruKurikulumController::class, 'edit'])->name("edit");
        Route::post("/{kurikulum_id}/update", [GuruKurikulumController::class, 'update'])->name("update");
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
