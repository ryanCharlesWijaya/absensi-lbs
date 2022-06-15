<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanTugas;
use App\Services\JawabanTugasService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JawabanTugasController extends Controller
{
    public function showNilai(int $pertemuan_id, int $jawaban_tugas_id)
    {
        $jawaban_tugas = JawabanTugas::findOrFail($jawaban_tugas_id);

        return view("guru.jawaban-tugas.jawaban-tugas-detail", compact("jawaban_tugas"));
    }

    public function nilai(Request $request, JawabanTugasService $jawabanTugasService, int $pertemuan_id, int $jawaban_tugas_id)
    {
        DB::beginTransaction();
        try {
            $jawabanTugasService->updateNilai($request->input("nilai", 0), $jawaban_tugas_id);

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
