<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\KurikulumController as GuruKurikulumController;
use App\Http\Controllers\User\UserController as UserManajemenController;
use App\Http\Controllers\Guru\KurikulumResourceController as GuruKurikulumResourceController;
use App\Http\Controllers\Guru\PertemuanController as GuruPertemuanController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Guru\SoalController as GuruSoalController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PertemuanController as SiswaPertemuanController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\QuizController as SiswaQuizController;
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

Route::middleware("auth")->group(function () {
    Route::get('/', [DashboardController::class, "index"])->name("dashboard");
});

// Guru Route
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
        Route::get("/{kurikulum_id}/detail", [GuruKurikulumController::class, 'show'])->name("show");
        Route::get("/{kurikulum_id}/edit", [GuruKurikulumController::class, 'edit'])->name("edit");
        Route::post("/{kurikulum_id}/update", [GuruKurikulumController::class, 'update'])->name("update");

        Route::get("/{kurikulum_id}/assign-siswa", [GuruKurikulumController::class, 'showAssignSiswa'])->name("showAssignSiswa");
        Route::post("/{kurikulum_id}/assign-siswa", [GuruKurikulumController::class, 'assignSiswa'])->name("assignSiswa");

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
            Route::get("/pertemuan/create", [GuruPertemuanController::class,'create'])->name("create");
            Route::post("/pertemuan/store", [GuruPertemuanController::class, 'store'])->name("store");
            Route::get("/pertemuan/{pertemuan_id}/detail", [GuruPertemuanController::class, 'show'])->name("show");
            Route::get("/pertemuan/{pertemuan_id}/edit", [GuruPertemuanController::class, 'edit'])->name("edit");
            Route::post("/pertemuan/{pertemuan_id}/update", [GuruPertemuanController::class, 'update'])->name("update");
            Route::post("/pertemuan/{pertemuan_id}/delete", [GuruPertemuanController::class, 'delete'])->name("delete");

            Route::group([
                "prefix" => "pertemuan/{pertemuan_id}/quiz",
                "as" => "quiz."
            ],
            function () {
                Route::get("/create", [GuruQuizController::class, 'create'])->name("create");
                Route::post("/store", [GuruQuizController::class, 'store'])->name("store");
                Route::get("/{quiz_id}/detail", [GuruQuizController::class, 'show'])->name('show');
                Route::get("/{quiz_id}/edit", [GuruQuizController::class, 'edit'])->name("edit");
                Route::post("/{quiz_id}/update", [GuruQuizController::class, 'update'])->name("update");
                Route::post("/{quiz_id}/delete", [GuruQuizController::class, 'delete'])->name("delete");
            });
            
            Route::group([
                "prefix" => "pertemuan/{pertemuan_id}/tugas",
                "as" => "tugas.",
            ],
            function ()
            {
                Route::get("/create", [GuruTugasController::class, 'create'])->name("create");
                Route::post("/store", [GuruTugasController::class, 'store'])->name("store");
                Route::get("/{tugas_id}/detail", [GuruTugasController::class, 'show'])->name('show');
                Route::get("/{tugas_id}/edit", [GuruTugasController::class, 'edit'])->name("edit");
                Route::post("/{tugas_id}/update", [GuruTugasController::class, 'update'])->name("update");
                Route::post("/{tugas_id}/delete", [GuruTugasController::class, 'delete'])->name("delete");
            });
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
        Route::get("", [GuruSoalController::class, 'index'])->name("index");
        Route::get("/create", [GuruSoalController::class, 'create'])->name("create");
        Route::post("/store", [GuruSoalController::class, 'store'])->name("store");
        Route::get("/{soal_id}/detail", [GuruSoalController::class, 'show'])->name('show');
        Route::get("/{soal_id}/edit", [GuruSoalController::class, 'edit'])->name("edit");
        Route::post("/{soal_id}/update", [GuruSoalController::class, 'update'])->name("update");
        Route::post("/{soal_id}/delete", [GuruSoalController::class, 'delete'])->name("delete");
    });

    Route::get("/", [DashboardController::class, 'index']);
    });

// Siswa Route
Route::group([
    "prefix" => "siswa",
    "as" => "siswa.",
    "middleware" => ["auth", "auth.siswa"]
],
function () {    
    Route::group([
        "prefix" => "pertemuan",
        "as" => "pertemuan.",
    ],
    function () {
        Route::get("", [SiswaPertemuanController::class, 'index'])->name("index");
        Route::get("/create", [SiswaPertemuanController::class,'create'])->name("create");
        Route::post("/store", [SiswaPertemuanController::class, 'store'])->name("store");
        Route::get("/{pertemuan_id}/download-resource", [SiswaPertemuanController::class, 'downloadResource'])->name("downloadResource");
        Route::get("/{pertemuan_id}/edit", [SiswaPertemuanController::class, 'edit'])->name("edit");
        Route::post("/{pertemuan_id}/update", [SiswaPertemuanController::class, 'update'])->name("update");

        Route::group([
            "prefix" => "/{pertemuan_id}/tugas",
            "as" => "tugas."
        ],
        function ()
        {
            Route::get("/{tugas_id}/create", [SiswaTugasController::class, "create"])->name("create");
            Route::post("/{tugas_id}/store", [SiswaTugasController::class, "upload"])->name("upload");
        });

        Route::group([
            "prefix" => "/{pertemuan_id}/quiz",
            "as" => "quiz."
        ],
        function ()
        {
            Route::get("/{quiz_id}/create", [SiswaQuizController::class, "kerjakanQuiz"])->name("kerjakanQuiz");
            Route::post("/{quiz_id}/store", [SiswaQuizController::class, "kumpulQuiz"])->name("kumpulQuiz");
        });
    });

    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
