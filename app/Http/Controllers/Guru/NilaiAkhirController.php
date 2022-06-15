<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiAkhir;
use App\Models\Semester;
use App\Models\User;
use App\Services\NilaiAkhirService;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiAkhirController extends Controller
{
    public function create(int $semester_id, int $siswa_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $siswa = $semester->siswas()->findOrFail($siswa_id);
        $jawaban_tugases = $siswa->jawaban_tugas()
            ->whereHas("tugas", function ($query) use ($semester) {
                return $query->whereHas("pertemuan", function ($query) use ($semester) {
                    $query->where("semester_id", $semester->id);
                }, ">", 0);
            }, ">", 0)
            ->get();

        $hasil_quizzes = $siswa->hasil_quiz()
            ->whereHas("quiz", function ($query) use ($semester) {
                return $query->whereHas("pertemuan", function ($query) use ($semester) {
                    $query->where("semester_id", $semester->id);
                }, ">", 0);
            }, ">", 0)
            ->get();

        $absensi_count = $siswa->absensis()
            ->whereHas("pertemuan", function ($query) use ($semester) {
                $query->where("semester_id", $semester->id);
            }, ">", 0);

        return view("guru.semester.nilai-akhir.create-nilai-akhir", compact("jawaban_tugases", "hasil_quizzes", "absensi_count", "semester", "siswa"));
    }

    public function store(Request $request, NilaiAkhirService $nilaiAkhirService, int $semester_id, int $siswa_id)
    {
        DB::beginTransaction();
        try {
            $semester = $nilaiAkhirService->createNilaiAkhir($request->all());

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(int $nilai_akhir_id)
    {
        $nilai_akhir = NilaiAkhir::findOrFail($nilai_akhir_id);
        $semester = $nilai_akhir->semester;
        $siswa = $nilai_akhir->siswa;

        return view("guru.semester.nilai-akhir.create-nilai-akhir", compact("nilai_akhir", "semester", "siswa"));
    }

    public function update(Request $request, NilaiAkhirService $nilaiAkhirService, int $semester_id, int $nilai_akhir_id)
    {
        DB::beginTransaction();
        try {
            $semester = $nilaiAkhirService->updateNilaiAkhir($request->all(), $nilai_akhir_id);

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
