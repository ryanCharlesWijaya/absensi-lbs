<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\SemesterController as GuruSemesterController;
use App\Http\Controllers\User\UserController as UserManajemenController;
use App\Http\Controllers\Guru\SemesterResourceController as GuruSemesterResourceController;
use App\Http\Controllers\Guru\PertemuanController as GuruPertemuanController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Guru\SoalController as GuruSoalController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PertemuanController as SiswaPertemuanController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Guru\JawabanTugasController as GuruJawabanTugasController;
use App\Http\Controllers\Guru\KurikulumController as GuruKurikulumController;
use App\Http\Controllers\Guru\PengumumanController as GuruPengumumanController;
use App\Http\Controllers\Guru\NilaiAkhirController;
use App\Http\Controllers\Guru\ResourceSiswaController as GuruResourceSiswaController;
use App\Http\Controllers\Guru\SekolahController as GuruSekolahController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\QuizController as SiswaQuizController;
use App\Http\Controllers\Siswa\ResourceSiswaController as SiswaResourceSiswaController;
use App\Http\Controllers\Siswa\SemesterController;
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
    });

    Route::group([
        "prefix" => "pengumuman",
        "as" => "pengumuman.",
    ],
    function () {
        Route::get("", [GuruPengumumanController::class, 'index'])->name("index");
        Route::get("/create", [GuruPengumumanController::class,'create'])->name("create");
        Route::post("/store", [GuruPengumumanController::class, 'store'])->name("store");
        Route::get("/{pengumuman_id}/detail", [GuruPengumumanController::class, 'show'])->name("show");
        Route::get("/{pengumuman_id}/edit", [GuruPengumumanController::class, 'edit'])->name("edit");
        Route::post("/{pengumuman_id}/update", [GuruPengumumanController::class, 'update'])->name("update");
        Route::post("/{pengumuman_id}/delete", [GuruPengumumanController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "semester",
        "as" => "semester.",
    ],
    function () {
        Route::get("", [GuruSemesterController::class, 'index'])->name("index");
        Route::get("/create", [GuruSemesterController::class,'create'])->name("create");
        Route::post("/store", [GuruSemesterController::class, 'store'])->name("store");
        Route::get("/{semester_id}/detail", [GuruSemesterController::class, 'show'])->name("show");
        Route::get("/{semester_id}/edit", [GuruSemesterController::class, 'edit'])->name("edit");
        Route::post("/{semester_id}/update", [GuruSemesterController::class, 'update'])->name("update");

        Route::get("/{semester_id}/assign-siswa", [GuruSemesterController::class, 'showAssignSiswa'])->name("showAssignSiswa");
        Route::post("/{semester_id}/assign-siswa", [GuruSemesterController::class, 'assignSiswa'])->name("assignSiswa");

        Route::get("/{semester_id}/nilai-akhir/{siswa_id}/create", [NilaiAkhirController::class, 'create'])->name("nilaiAkhir.create");
        Route::get("/{semester_id}/nilai-akhir/{nilai_akhir_id}/show", [NilaiAkhirController::class, 'show'])->name("nilaiAkhir.show");
        Route::post("/{semester_id}/nilai-akhir/{siswa_id}/store", [NilaiAkhirController::class, 'store'])->name("nilaiAkhir.store");
        Route::get("/{semester_id}/nilai-akhir/{nilai_akhir_id}/edit", [NilaiAkhirController::class, 'edit'])->name("nilaiAkhir.edit");
        Route::post("/{semester_id}/nilai-akhir/{nilai_akhir_id}/update", [NilaiAkhirController::class, 'update'])->name("nilaiAkhir.update");

        Route::group([
            "as" => "resources."
        ],
        function () {
            Route::get("/{semester_id}/resources", [GuruSemesterResourceController::class, 'index'])->name("index");
            Route::get("/{semester_id}/resources/create", [GuruSemesterResourceController::class, 'create'])->name("create");
            Route::post("/{semester_id}/resources/store", [GuruSemesterResourceController::class, 'store'])->name("store");
            Route::get("/{semester_id}/resources/{media_id}", [GuruSemesterResourceController::class, 'show'])->name("show");
            Route::get("/{semester_id}/resources/{media_id}/download", [GuruSemesterResourceController::class, 'download'])->name("download");
            Route::post("/{semester_id}/resources/{media_id}/delete", [GuruSemesterResourceController::class, 'delete'])->name("delete");
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
                "prefix" => "pertemuan/{pertemuan_id}/absensi",
                "as" => "absensi."
            ],
            function ()
            {
                Route::post("/{absensi_id}/update/status/{status}", [GuruAbsensiController::class, "updateStatus"])->name("updateStatus");
            });

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
                "prefix" => "pertemuan/{pertemuan_id}/hasil-quiz",
                "as" => "hasilQuiz."
            ],
            function ()
            {
                Route::get("/{hasil_quiz_id}/review", [GuruQuizController::class, "reviewHasilQuiz"])->name("reviewQuiz");
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

            Route::group([
                "prefix" => "pertemuan/{pertemuan_id}/jawaban-tugas",
                "as" => "jawabanTugas.",
            ],
            function () 
            {
                Route::get("/{jawaban_tugas_id}/nilai", [GuruJawabanTugasController::class, 'showNilai'])->name("showNilai");
                Route::post("/{jawaban_tugas_id}/nilai", [GuruJawabanTugasController::class, 'nilai'])->name("nilai");
            });
        });
    });

    Route::group([
        "prefix" => "user",
        "as" => "user."
    ],
    function () {
        Route::get("", [UserManajemenController::class, 'index'])->name("index");
        Route::get("/list-siswa", [UserManajemenController::class, 'listSiswa'])->name("listSiswa");
        Route::get("/create", [UserManajemenController::class,'create'])->name("create");
        Route::get("/create-siswa", [UserManajemenController::class,'createSiswa'])->name("createSiswa");
        Route::post("/store", [UserManajemenController::class, 'store'])->name("store");
        Route::get("/{user_id}", [UserManajemenController::class, 'show'])->name("show");
        Route::get("/{user_id}/edit", [UserManajemenController::class, 'edit'])->name("edit");
        Route::post("/{user_id}/delete", [UserManajemenController::class, 'delete'])->name("delete");
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

    Route::group([
        "prefix" => "resource-siswa",
        "as" => "resourceSiswa."
    ],
    function () {
        Route::get("", [GuruResourceSiswaController::class, 'index'])->name("index");
        Route::get("/create", [GuruResourceSiswaController::class, 'create'])->name("create");
        Route::post("/store", [GuruResourceSiswaController::class, 'store'])->name("store");
        Route::get("/{resource_siswa_id}/download", [GuruResourceSiswaController::class, 'download'])->name("download");
        Route::post("/{resource_siswa_id}/delete", [GuruResourceSiswaController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "sekolah",
        "as" => "sekolah."
    ],
    function () {
        Route::get("", [GuruSekolahController::class, 'index'])->name("index");
        Route::get("/create", [GuruSekolahController::class, 'create'])->name("create");
        Route::post("/store", [GuruSekolahController::class, 'store'])->name("store");
        Route::get("/{sekolah_id}/detail", [GuruSekolahController::class, 'show'])->name('show');
        Route::get("/{sekolah_id}/edit", [GuruSekolahController::class, 'edit'])->name("edit");
        Route::post("/{sekolah_id}/update", [GuruSekolahController::class, 'update'])->name("update");
        Route::post("/{sekolah_id}/delete", [GuruSekolahController::class, 'delete'])->name("delete");
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
        "prefix" => "semester",
        "as" => "semester."
    ],
    function () {
        Route::get("", [SemesterController::class, 'index'])->name("index");
        Route::get("/{semester_id}/detail", [SemesterController::class, 'show'])->name("show");
    });

    Route::group([
        "prefix" => "pertemuan",
        "as" => "pertemuan.",
    ],
    function () {
        Route::get("/create", [SiswaPertemuanController::class,'create'])->name("create");
        Route::post("/store", [SiswaPertemuanController::class, 'store'])->name("store");
        Route::get("/{pertemuan_id}/download-resource", [SiswaPertemuanController::class, 'downloadResource'])->name("downloadResource");
        Route::get("/{pertemuan_id}/edit", [SiswaPertemuanController::class, 'edit'])->name("edit");
        Route::post("/{pertemuan_id}/update", [SiswaPertemuanController::class, 'update'])->name("update");

        Route::group([
            "prefix" => "/{pertemuan_id}/absensi",
            "as" => "absensi."
        ],
        function ()
        {
            Route::post("/{absensi_id}/absen", [SiswaAbsensiController::class, "absen"])->name("absen");
        });

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
            Route::get("/{quiz_id}/review", [SiswaQuizController::class, "reviewQuiz"])->name("reviewQuiz");
        });
    });

    Route::group([
        "prefix" => "resource-siswa",
        "as" => "resourceSiswa."
    ],
    function () {
        Route::get("", [SiswaResourceSiswaController::class, 'index'])->name("index");
        Route::get("/create", [SiswaResourceSiswaController::class, 'create'])->name("create");
        Route::post("/store", [SiswaResourceSiswaController::class, 'store'])->name("store");
        Route::get("/{resource_siswa_id}/download", [SiswaResourceSiswaController::class, 'download'])->name("download");
        Route::post("/{resource_siswa_id}/delete", [SiswaResourceSiswaController::class, 'delete'])->name("delete");
    });

    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
