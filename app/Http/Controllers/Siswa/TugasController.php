<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Tugas;
use App\Services\JawabanTugasService;
use App\Services\TugasService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    public function create(int $pertemuan_id, int $tugas_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $tugas = Tugas::findOrFail($tugas_id);

        $jawaban_tugas = $tugas->jawaban()->where("siswa_id", Auth::id())->first();

        return view("siswa.tugas.create-tugas", compact("pertemuan", "tugas", "jawaban_tugas"));
    }

    public function upload(Request $request, JawabanTugasService $jawabanTugasService, int $pertemuan_id, int $tugas_id)
    {
        DB::beginTransaction();
        try {
            $jawaban_tugas = $jawabanTugasService->uploadJawabanTugas($request->all(), $tugas_id);

            DB::commit();
            return redirect(route("siswa.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
