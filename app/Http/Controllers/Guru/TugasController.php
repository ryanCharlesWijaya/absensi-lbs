<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Tugas;
use App\Services\TugasService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    public function create(int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("guru.tugas.create-tugas", compact("pertemuan"));
    }

    public function store(Request $request, TugasService $tugasService, int $pertemuan_id)
    {
        DB::beginTransaction();
        try {
            $tugas = $tugasService->createTugas($request->all());

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(int $pertemuan_id, int $tugas_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $tugas = Tugas::findOrFail($tugas_id);

        return view("guru.tugas.edit-tugas", compact("pertemuan", "tugas"));
    }

    public function update(Request $request, TugasService $tugasService, int $pertemuan_id, int $tugas_id)
    {
        DB::beginTransaction();
        try {
            $tugas = $tugasService->updateTugas($request->all(), $tugas_id);

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $pertemuan_id, int $tugas_id)
    {
        DB::beginTransaction();
        try {
            Tugas::findOrFail($tugas_id)->delete();

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
