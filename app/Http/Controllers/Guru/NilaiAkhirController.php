<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiAkhir;
use App\Models\Semester;
use App\Models\User;
use App\Services\NilaiAkhirService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiAkhirController extends Controller
{
    public function create(int $semester_id, int $siswa_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $siswa = $semester->siswas()->findOrFail($siswa_id);

        return view("guru.nilai-akhir.create-nilai-akhir", compact("semester", "siswa"));
    }

    public function store(Request $request, NilaiAkhirService $nilaiAkhirService, int $semester_id)
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

        return view("guru.nilai-akhir.create-nilai-akhir", compact("nilai_akhir", "semester", "siswa"));
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
