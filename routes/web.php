<?php

use App\Http\Controllers\Guru\KurikulumController as GuruKurikulumController;
use App\Http\Controllers\User\UserController as UserManajemenController;
use App\Http\Controllers\Guru\KurikulumResourceController as GuruKurikulumResourceController;
use App\Http\Controllers\Guru\PertemuanController as KurikulumPertemuanController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SoalController;
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
        Route::get("/{kurikulum_id}/show", [GuruKurikulumController::class, 'show'])->name("show");
        Route::get("/{kurikulum_id}/edit", [GuruKurikulumController::class, 'edit'])->name("edit");
        Route::post("/{kurikulum_id}/update", [GuruKurikulumController::class, 'update'])->name("update");

        Route::group([
            "as" => "resources."
        ],
        function () {
            Route::get("/{kurikulum_id}/resources", [GuruKurikulumResourceController::class, 'index'])->name("index");
            Route::get("/{kurikulum_id}/resources/create", [GuruKurikulumResourceController::class, 'create'])->name("create");
            Route::post("/{kurikulum_id}/resources/store", [GuruKurikulumResourceController::class, 'store'])->name("store");
            Route::get("/{kurikulum_id}/resources/{media_id}", [GuruKurikulumResourceController::class, 'show'])->name("show");
            Route::get("/{kurikulum_id}/resources/{media_id}/download", [GuruKurikulumResourceController::class, 'download'])->name("download");
            Route::post("/{kurikulum_id}/resources/{media_id}/delete", [GuruKurikulumResourceController::class, 'delete'])->name("delete");
        });

        Route::group([
            "as" => "pertemuan."
        ],
        function () {
        Route::get("/pertemuan", [KurikulumPertemuanController::class, 'index'])->name("index");
        Route::get("/pertemuan/create", [KurikulumPertemuanController::class,'create'])->name("create");
        Route::post("/pertemuan/store", [KurikulumPertemuanController::class, 'store'])->name("store");
        Route::get("/pertemuan/{pertemuan_id}/edit", [KurikulumPertemuanController::class, 'edit'])->name("edit");
        Route::post("/pertemuan/{pertemuan_id}/update", [KurikulumPertemuanController::class, 'update'])->name("update");
        Route::post("/pertemuan/{pertemuan_id}/delete", [KurikulumPertemuanController::class, 'delete'])->name("delete");

        });
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

    Route::group([
        "prefix" => "soal",
        "as" => "soal."
    ],
    function () {
        Route::get("", [SoalController::class, 'index'])->name("index");
        Route::get("/create", [SoalController::class, 'create'])->name("create");
        Route::post("/store", [SoalController::class, 'store'])->name("store");
        Route::get("/{soal_id}/detail", [SoalController::class, 'show'])->name('show');
        Route::get("/{soal_id}/edit", [SoalController::class, 'edit'])->name("edit");
        Route::post("/{soal_id}/update", [SoalController::class, 'update'])->name("update");
        Route::post("/{soal_id}/delete", [SoalController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "quiz",
        "as" => "quiz."
    ],
    function () {
        Route::get("", [QuizController::class, 'index'])->name("index");
        Route::get("/create", [QuizController::class, 'create'])->name("create");
        Route::post("/store", [QuizController::class, 'store'])->name("store");
        Route::get("/{quiz_id}/detail", [QuizController::class, 'show'])->name('show');
        Route::get("/{quiz_id}/edit", [QuizController::class, 'edit'])->name("edit");
        Route::post("/{quiz_id}/update", [QuizController::class, 'update'])->name("update");
        Route::post("/{quiz_id}/delete", [QuizController::class, 'delete'])->name("delete");
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
